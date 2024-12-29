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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->validateLogin($username, $password);

            if ($user) {
                // Set session
                $_SESSION['user'] = $user;
                $_SESSION['role_dosen'] = $user['role_dosen'] ?? '';
                $_SESSION['loggedin_time'] = time();

                // Redirect berdasarkan role
                if (isset($user['role_dosen']) && $user['role_dosen'] === 'dosen') {
                    header("Location: index.php?page=dosen_prestasi");
                    exit();
                } elseif (isset($user['role_dosen']) && $user['role_dosen'] === 'ketua jurusan') {
                    header("Location: index.php?page=dosen_dashboard");
                    exit();
                } elseif (isset($user['role_dosen']) && $user['role_dosen'] === 'admin') {
                    header("Location: index.php?page=dosen_dashboard");
                    exit();
                } else {
                    header("Location: index.php?page=home");
                    exit();
                }
            } else {
                $_SESSION['error'] = "NIM/NIDN atau password salah.";
                header("Location: index.php?page=login");
                exit();
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
        $timeout = 3600;
        if (isset($_SESSION['loggedin_time']) && (time() - $_SESSION['loggedin_time'] > $timeout)) {
            session_unset();
            session_destroy();
            $_SESSION['error'] = "Sesi Anda telah habis. Silakan login kembali.";
            header("Location: index.php?page=login");
            exit();
        }
        $_SESSION['loggedin_time'] = time();
        return true;
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $oldPassword = $_POST['old_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

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

            $user = $_SESSION['user'] ?? null;
            if (!$user || $user['role'] !== 'mahasiswa') {
                $_SESSION['error'] = "Anda tidak memiliki izin untuk mengubah password.";
                header("Location: index.php?page=login");
                return;
            }

            $NIM = $user['NIM'];

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

    public function getDaftarMataKuliah($id_mahasiswa, $semester = null)
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
                n.id_mahasiswa = ?";

        if ($semester !== null) {
            $query .= " AND mk.smt = ?";
            $params = array(
                array($id_mahasiswa, SQLSRV_PARAM_IN),
                array($semester, SQLSRV_PARAM_IN)
            );
        } else {
            $params = array(
                array($id_mahasiswa, SQLSRV_PARAM_IN)
            );
        }

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

    public function getLeaderboardNonAkademik()
    {

        $query = "SELECT 
                    m.nama_mahasiswa,
                    m.NIM,
                    m.program_studi,
                    SUM(dp.poin) AS totalPoin, 
                    m.foto_mahasiswa
                FROM 
                    prestasi_mahasiswa pm
                JOIN 
                    mahasiswa m ON pm.id_mahasiswa = m.id_mahasiswa
                JOIN 
                    data_prestasi dp ON pm.id_prestasi = dp.id_prestasi
                WHERE 
                    dp.status_pengajuan = 'Approved'
                GROUP BY 
                    m.nama_mahasiswa,
                    m.NIM,
                    m.program_studi,
                    m.foto_mahasiswa
                ORDER BY 
                    totalPoin DESC";

        $result = sqlsrv_query($this->conn, $query);

        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $leaderboard = [];
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $leaderboard[] = $row;
        }

        return $leaderboard;
    }

    public function getLeaderboardAll($semester = null)
    {

        $academicLeaderboard = $this->getLeaderboardMahasiswa($semester);

        $nonAcademicLeaderboard = $this->getLeaderboardNonAkademik();

        $leaderboard = [];

        foreach ($academicLeaderboard as $academic) {
            $leaderboard[$academic['NIM']] = [
                'NIM' => $academic['NIM'],
                'nama_mahasiswa' => $academic['nama_mahasiswa'],
                'foto_mahasiswa' => $academic['foto_mahasiswa'],
                'program_studi' => $academic['program_studi'],
                'IPK' => $academic['IPK'],
                'Grade' => $academic['Grade'],
                'totalPoinAkademik' => $academic['totalPoin'],
                'totalSks' => $academic['totalSks'],
                'totalPoinNonAkademik' => 0,
            ];
        }

        foreach ($nonAcademicLeaderboard as $nonAcademic) {
            if (isset($leaderboard[$nonAcademic['NIM']])) {
                $leaderboard[$nonAcademic['NIM']]['totalPoinNonAkademik'] = $nonAcademic['totalPoin'];
            } else {

                $leaderboard[$nonAcademic['NIM']] = [
                    'NIM' => $nonAcademic['NIM'],
                    'nama_mahasiswa' => $nonAcademic['nama_mahasiswa'],
                    'foto_mahasiswa' => $nonAcademic['foto_mahasiswa'],
                    'program_studi' => $nonAcademic['program_studi'],
                    'IPK' => 0,
                    'Grade' => 'D',
                    'totalPoinAkademik' => 0,
                    'totalSks' => 0,
                    'totalPoinNonAkademik' => $nonAcademic['totalPoin'],
                ];
            }
        }

        usort($leaderboard, function ($a, $b) {
            $totalA = $a['totalPoinAkademik'] + $a['totalPoinNonAkademik'];
            $totalB = $b['totalPoinAkademik'] + $b['totalPoinNonAkademik'];
            return $totalB <=> $totalA;
        });

        return $leaderboard;
    }
}
