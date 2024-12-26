<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PRESMA</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <section class="login-box">
        <div class="login-form">
            <form id="loginForm" method="POST" action="index.php?action=login">
                    <div class="text-center">
                        <h2 class="fw-bold mb-2"><img src="../assets/img/cil_education.png" alt="" style="width: 80px; height:80px;" ></h2>
                        <h1 class="fw-bold fs-2 mb-0" style="color: #FEC01A;">Selamat Datang</h1>
                        <p class="mt-1 text-muted" style="font-size: 15px; padding-left: 50px; padding-right: 50px;">Silakan masukkan <strong>NIM/NIDN</strong> dan <strong>password</strong> Anda
                            untuk melanjutkan.</p>
                    </div>
                    <?php if (isset($_GET['message']) && $_GET['message'] == 'error'): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['message']) && $_GET['message'] == 'session_expired'): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Sesi Anda telah habis. Silakan login kembali.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['message']) && $_GET['message'] == 'logged_out'): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Anda telah berhasil logout.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);  // Menghapus pesan error setelah ditampilkan
                }
                ?>

                <div class="input-box">
                    <input type="text" id="username" name="username" placeholder="NIM/NIDN" required>
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="bx bxs-lock-alt"></i>
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                </div>
                <button type="submit" class="submit-login mt-3" style="background-color: #244282;">Login</button>
            </form>
        </div>
        <div class="gambar-login">
            <img src="../assets/img/Gedung Sipil.jpg" alt="Gedung">
        </div>
    </section>
    <script src="../assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>