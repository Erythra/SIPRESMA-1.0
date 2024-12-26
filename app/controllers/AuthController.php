<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    private $userModel;

    public function __construct($conn)
    {
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
}
