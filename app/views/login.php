<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PRESMA</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <section class="login-box">
        <div class="login-form">
            <form id="loginForm" method="POST" action="index.php?action=login">
                <h1><strong>Login Akun Anda</strong></h1>
                <?php if (isset($_GET['message']) && $_GET['message'] == 'session_expired'): ?>
                    <p style="color: red;">Sesi Anda telah habis. Silakan login kembali.</p>
                <?php endif; ?>
                <?php if (isset($_GET['message']) && $_GET['message'] == 'logged_out'): ?>
                    <p style="color: green;">Anda telah berhasil logout.</p>
                <?php endif; ?>
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);  // Menghapus pesan error setelah ditampilkan
                }
                ?>

                <div class="input-box">
                    <input type="text" id="username" name="username" placeholder="Username" required>
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="bx bxs-lock-alt"></i>
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                </div>
                <button type="submit" class="submit-login">Login</button>
            </form>
        </div>
        <div class="gambar-login">
            <img src="../assets/img/Gedung Sipil.jpg" alt="Gedung">
        </div>
    </section>
    <script src="../assets/js/script.js"></script>
</body>

</html>