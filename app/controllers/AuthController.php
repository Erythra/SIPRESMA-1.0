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
                echo "NIM/NIDN atau password salah.";
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
            header("Location: index.php?page=login&message=session_expired");
            exit();
        }
        return true;
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
                n.id_mahasiswa = :id_mahasiswa 
                AND mk.smt = :semester";

        $stmt = $this->conn->sqlsrv_prepare($query);
        $stmt->bindParam(':id_mahasiswa', $id_mahasiswa, PDO::PARAM_INT);
        $stmt->bindParam(':semester', $semester, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
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
    
        // Menggunakan number_format untuk memastikan dua angka di belakang koma
        return $totalSks > 0 ? number_format($totalPoin / $totalSks, 2, '.', '') : 0;
    }
    

    public function hitungIPS($id_mahasiswa) {
        $mataKuliahSemester2 = $this->getDaftarMataKuliah($id_mahasiswa, 2);
        $mataKuliahSemester3 = $this->getDaftarMataKuliah($id_mahasiswa, 3);

        $ipkSemester2 = $this->hitungIPK($mataKuliahSemester2);
        $ipkSemester3 = $this->hitungIPK($mataKuliahSemester3);

        $ips = ($ipkSemester2 + $ipkSemester3) / 2;

        return round($ips, 2);
    }
}
