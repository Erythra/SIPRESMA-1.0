<?php
include './../app/views/mahasiswa/partials/header.php';

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Pengajuan Prestasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
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
    <!-- Content -->
    <div class="container content" style="margin-top: 6rem;">
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
    <?php
    include 'partials/footer.php';
    ?>
</body>

</html>