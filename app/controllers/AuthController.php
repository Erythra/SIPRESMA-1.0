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

            if (strlen($username) < 5 || strlen($password) < 5) {
                echo "Username dan password harus minimal 5 karakter.";
                return;
            }

            $user = $this->userModel->validateLogin($username, $password);

            if ($user) {
                $_SESSION['user'] = $user;
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
}
