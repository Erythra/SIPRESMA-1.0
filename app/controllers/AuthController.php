<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    private $userModel;
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->userModel = new UserModel($conn);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // if (strlen($username) < 5 || strlen($password) < 5) {
            //     echo "Username dan password harus minimal 5 karakter.";
            //     return;
            // }

            $user = $this->userModel->validateLogin($username, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                $_SESSION['role'] = $user['role'] ?? '';
                $_SESSION['loggedin_time'] = time();

                if (isset($user['role_dosen'])) {
                    header("Location: index.php?page=dosen_dashboard");
                } else {
                    header("Location: index.php?page=home");
                }
            } else {
                $_SESSION['error'] = "NIM/NIDN atau password salah.";
                header("Location: index.php?page=login");
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php?page=login&message=logged_out");
        exit();
    }
    public function isSessionActive()
    {
        if (isset($_SESSION['loggedin_time']) && (time() - $_SESSION['loggedin_time'] > 3600)) {
            session_destroy();
            echo "<script>sessionExpired();</script>";
            exit();
        }
        return true;
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $oldPassword = $_POST['old_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Validasi input
            if (strlen($newPassword) < 6) {
                $_SESSION['error'] = "Password baru harus minimal 6 karakter.";
                header("Location: index.php?page=edit");
                return;
            }

            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = "Password baru dan konfirmasi password tidak cocok.";
                header("Location: index.php?page=edit");
                return;
            }

            // Pastikan pengguna login sebagai mahasiswa
            $user = $_SESSION['user'] ?? null;
            if (!$user || $user['role'] !== 'mahasiswa') {
                $_SESSION['error'] = "Anda tidak memiliki izin untuk mengubah password.";
                header("Location: index.php?page=login");
                return;
            }

            $NIM = $user['NIM'];

            // Ganti password
            $result = $this->userModel->changePasswordMahasiswa($NIM, $oldPassword, $newPassword);

            if ($result) {
                $_SESSION['user']['password_mahasiswa'] = $newPassword;
                $_SESSION['success'] = "Password berhasil diubah.";
                header("Location: index.php?page=profile");
            } else {
                $_SESSION['error'] = "Password lama salah atau gagal mengubah password.";
                header("Location: index.php?page=profile");
            }
        }
    }

    public function getDaftarMataKuliah($id_mahasiswa, $semester)
    {
        $query = "SELECT 
                    ROW_NUMBER() OVER (ORDER BY mk.kode_mata_kuliah) AS No,
                    mk.kode_mata_kuliah AS Kode_MK,
                    mk.nama_mata_kuliah AS Mata_Kuliah,
                    mk.sks AS SKS,
                    mk.jam AS Jam,
                    CASE
                        WHEN n.nilai_mahasiswa >= 80 THEN 'A'
                        WHEN n.nilai_mahasiswa >= 70 THEN 'B'
                        WHEN n.nilai_mahasiswa >= 60 THEN 'C'
                        ELSE 'D'
                    END AS Nilai
                FROM 
                    nilai_mahasiswa n
                INNER JOIN 
                    mahasiswa m ON n.id_mahasiswa = m.id_mahasiswa
                INNER JOIN 
                    mata_kuliah mk ON n.id_mata_kuliah = mk.id_mata_kuliah
                WHERE 
                    n.id_mahasiswa = ? 
                    AND mk.smt = ?";

        $params = array(
            array($id_mahasiswa, SQLSRV_PARAM_IN),
            array($semester, SQLSRV_PARAM_IN)
        );

        $stmt = sqlsrv_prepare($this->conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            $data = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
        } else {
            die(print_r(sqlsrv_errors(), true));
        }

        if (empty($data)) {
            error_log("No data found for id_mahasiswa: " . $id_mahasiswa . " and semester: " . $semester);
        }

        return $data;
    }

    public function hitungIPK($mataKuliahData)
    {
        $totalPoin = 0;
        $totalSks = 0;

        $nilaiKePoin = [
            'A' => 4,
            'B' => 3,
            'C' => 2,
            'D' => 1
        ];

        foreach ($mataKuliahData as $mk) {
            $nilai = $mk['Nilai'];
            $poin = isset($nilaiKePoin[$nilai]) ? $nilaiKePoin[$nilai] : 0;
            $sks = $mk['SKS'];

            $totalPoin += $poin * $sks;
            $totalSks += $sks;
        }

        return $totalSks > 0 ? number_format($totalPoin / $totalSks, 2, '.', '') : 0;
    }

    public function hitungIPS($id_mahasiswa)
    {
        $mataKuliahSemester2 = $this->getDaftarMataKuliah($id_mahasiswa, 2);
        $mataKuliahSemester3 = $this->getDaftarMataKuliah($id_mahasiswa, 3);

        $ipkSemester2 = $this->hitungIPK($mataKuliahSemester2);
        $ipkSemester3 = $this->hitungIPK($mataKuliahSemester3);

        $ips = ($ipkSemester2 + $ipkSemester3) / 2;

        return round($ips, 2);
    }

    public function getLeaderboardMahasiswa($semester = null)
    {
        var_dump($semester);

        $query = "SELECT 
                m.NIM, 
                m.nama_mahasiswa, 
                m.foto_mahasiswa, 
                m.program_studi, 
                n.nilai_mahasiswa, 
                mk.sks, 
                mk.smt
              FROM 
                mahasiswa m
              INNER JOIN 
                nilai_mahasiswa n ON m.id_mahasiswa = n.id_mahasiswa
              INNER JOIN 
                mata_kuliah mk ON n.id_mata_kuliah = mk.id_mata_kuliah";

        if ($semester) {
            $query .= " WHERE mk.smt = ?";
            $params = array($semester);
        } else {
            $params = [];
        }

        $query .= " ORDER BY m.NIM, mk.kode_mata_kuliah";

        $stmt = sqlsrv_query($this->conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = [];
        $studentData = [];

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            if (!isset($studentData[$row['NIM']])) {
                $studentData[$row['NIM']] = [
                    'NIM' => $row['NIM'],
                    'nama_mahasiswa' => $row['nama_mahasiswa'],
                    'foto_mahasiswa' => $row['foto_mahasiswa'],
                    'program_studi' => $row['program_studi'],
                    'totalPoin' => 0,
                    'totalSks' => 0
                ];
            }

            $poin = 0;
            if ($row['nilai_mahasiswa'] >= 80) {
                $poin = 4;
            } elseif ($row['nilai_mahasiswa'] >= 70) {
                $poin = 3;
            } elseif ($row['nilai_mahasiswa'] >= 60) {
                $poin = 2;
            } else {
                $poin = 1;
            }

            $studentData[$row['NIM']]['totalPoin'] += $poin * $row['sks'];
            $studentData[$row['NIM']]['totalSks'] += $row['sks'];
        }

        foreach ($studentData as $student) {
            $ipk = $student['totalSks'] > 0 ? number_format($student['totalPoin'] / $student['totalSks'], 2, '.', '') : 0;
            $student['IPK'] = $ipk;

            if ($ipk >= 3.5) {
                $grade = 'A';
            } elseif ($ipk >= 3.0) {
                $grade = 'B';
            } elseif ($ipk >= 2.0) {
                $grade = 'C';
            } else {
                $grade = 'D';
            }

            $student['Grade'] = $grade;
            $data[] = $student;
        }

        usort($data, function ($a, $b) {
            return $b['IPK'] <=> $a['IPK'];
        });

        return $data;
    }
}
