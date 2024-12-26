<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Pengajuan Prestasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <style>
        body {
            background-color: #F5F2FE;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;

        }

        .content {
            margin-top: 20px;
            margin-bottom: 20px;

        }

        .content .card {
            color: #1a2a6c !important;
        }

        .content .card h5 {
            font-size: 16px;
            font-weight: 600;
            font-style: italic;

        }

        .step-image {
            max-width: 100%;
        }

        .main-card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            color: #1a2a6c;

        }

        hr {
            border: none;
            height: 2px;
            background-color: #666;
            margin: 10px 0;
        }
    </style>
</head>


<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
            <!-- Logo -->
            <img class="logo-sipresma" src="../assets/img/Logo 4x.png" alt="SIPRESMA-LOGO" href="index.html"
                style="z-index: 120;">

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=homepertama">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=login">Prestasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=login">IPK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=login">Leaderboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?page=bantuantanpalogin">Bantuan</a>
                    </li>
                </ul>
            </div>

            <!-- User Info and Image -->
            <div class="user-info">
                <a class="btn btn-login" href="index.php?page=login">Login ke Sistem</a>
            </div>

            <!-- Navbar Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!-- Content -->
    <div class="container content" style="margin-top: 50px;">
        <div class="card main-card d-flex justify-content-center align-items-center vh-10 p-4">
            <h1 class="text-center" style="font-weight: 500 !important;">Panduan Pengajuan Prestasi</h1>
        </div>
        <div class="card p-4">
            <p style="font-weight: bolder; font-size: 17px;">Berikut langkah-langkah penggunaan Website SIPRESMA:</p>
            <!-- Step 1 -->
            <h5>1. Akses halaman Home</h5>
            <img src="../assets/img/panduan1.png" alt="Halaman Home" class="img-fluid step-image mb-4">
            <hr>
            <!-- Step 2 -->
            <h5>2. Klik Button Login ke Sistem</h5>
            <p>Login dengan menginputkan NIM untuk username dan password lalu klik Login.</p>
            <img src="../assets/img/panduan2.png" alt="Halaman Login" class="img-fluid step-image mb-4">
            <hr>
            <!-- Step 3 -->
            <h5>3. Jika Username dan Password sesuai</h5>
            <p>Maka akan secara otomatis diarahkan ke halaman Home.</p>
            <img src="../assets/img/panduan3.jpg" alt="Halaman Home Setelah Login" class="img-fluid step-image mb-4">
            <hr>
            <!-- Step 4 -->
            <h5>4. Navigasi ke menu Prestasi</h5>
            <p>Pada halaman Home ini terdapat navbar dengan beberapa menu. Klik <strong>Prestasi</strong> untuk melihat daftar prestasi.</p>
            <img src="../assets/img/panduan4.jpg" alt="Halaman Prestasi" class="img-fluid step-image mb-4">
            <hr>
            <!-- Step 5 -->
            <h5>5. Menambah Data Prestasi</h5>
            <p>Klik tombol <strong>Tambah Prestasi</strong> di pojok kanan atas tabel untuk menampilkan form pengisian data.</p>
            <img src="../assets/img/panduan5.jpg" alt="Form Tambah Prestasi" class="img-fluid step-image mb-4">
            <hr>
            <!-- Step 6 -->
            <h5>6. Simpan Data Prestasi</h5>
            <p>Isi data dengan lengkap lalu klik <strong>Simpan</strong> di pojok kanan bawah. Jika tidak ingin mengirimkan data, klik <strong>Batal</strong>.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>© 2024 SIPRESMA.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>