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

    .row .col .card {
        background-color: #F5F7FF !important;

    }

    .row .col .card p {
        margin-bottom: 0 !important;
        font-size: 14px;
    }

    .content {
        margin-top: 20px;
        margin-bottom: 20px;

    }

    .content .card {
        color: #1a2a6c !important;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .content .card .row .col {
        max-width: 30rems !important;
    }

    .content .card h5 {
        font-size: 16px;
        font-weight: 600;
    }

    .content .card .row .col .card {
        min-width: 28.4375rem !important;
    }

    .main-card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        color: #1a2a6c;


    }

    .content .card .row .col .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
    <div class="container content" style="margin-top: 50px;">
        <div class="card main-card d-flex justify-content-center align-items-center vh-10 p-4">
            <h1 class="text-center" style="font-weight: 600 !important; font-size: 1.5rem;">Pertanyaan yang Sering
                Diajukan</h1>
            <br>
            <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
                <div class="col">
                    <div class="card p-4 text-center shadow-sm">
                        <h5>Bagaimana cara mendaftarkan prestasi saya di SIPRESMA?</h5>
                        <p>Anda dapat mendaftarkan prestasi dengan login ke akun SIPRESMA Anda,
                            lalu pilih menu Prestasi dan klik tambah prestasi. Isi formulir dengan lengkap dan unggah
                            dokumen pendukung.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 text-center shadow-sm">
                        <h5>Bagaimana kita mengetahui data kita divalidasi?</h5>
                        <p>Cara mengetahuinya dengan cara mengecek di fitur list prestasi pada kolom status.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 text-center shadow-sm">
                        <h5>Apa yang harus dilakukan jika data prestasi saya ditolak?</h5>
                        <p>Jika data prestasi ditolak, Anda dapat melihat alasan penolakan di menu Detail Prestasi lalu
                            cek riwayat persetujuan. Setelah itu, perbaiki data Anda sesuai alasan penolakan dan ajukan
                            kembali.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 text-center shadow-sm">
                        <h5>Apakah prestasi yang tidak bersifat akademik bisa didaftarkan?</h5>
                        <p>Ya, SIPRESMA menerima prestasi non-akademik seperti olahraga, seni, dan kegiatan sosial,
                            selama memenuhi kriteria yang telah ditetapkan.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 text-center shadow-sm">
                        <h5>Bagaimana cara mengedit data prestasi yang sudah didaftarkan?</h5>
                        <p>Anda dapat mengedit data selama statusnya masih Belum Disetujui. Klik tombol Edit di menu
                            List Prestasi, lakukan perubahan, lalu simpan data Anda.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 text-center shadow-sm">
                        <h5>Apakah saya dapat mendaftarkan lebih dari satu prestasi dalam waktu bersamaan?</h5>
                        <p>Ya, Anda dapat mendaftarkan lebih dari satu prestasi. Cukup tambahkan setiap prestasi secara
                            terpisah melalui menu Tambah Prestasi dan lengkapi dokumen pendukung untuk masing-masing
                            prestasi.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 text-center shadow-sm">
                        <h5>Apakah saya dapat menghapus prestasi yang sudah didaftarkan?</h5>
                        <p>Prestasi yang sudah didaftarkan tidak dapat dihapus, tetapi Anda dapat mengeditnya jika
                            statusnya masih Belum Disetujui.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p>© 2024 SIPRESMA.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

