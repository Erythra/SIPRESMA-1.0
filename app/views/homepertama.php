<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SIPRESMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <!-- Logo -->
            <img class="logo-sipresma" src="../assets/img/Logo 4x.png" alt="SIPRESMA-LOGO" href="index.html"
                style="z-index: 120;">

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav text-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="homepertama.php">Home</a>
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
                        <a class="nav-link" href="index.php?page=bantuantanpalogin">Bantuan</a>
                    </li>
                </ul>
            </div>

            <!-- User Info and Image -->
            <div class="user-info">
                <!-- <div class="d-flex flex-column text-end">
                    <p class="info-text-nav" style="font-weight:600; font-size: 15px;">Farhan Mawaludin</p>
                    <p class="info-text-nav" style="color:#AEAEB2; font-size: 13px;">2341720258</p>
                </div>
                <img src="../../assets/img/animoji.png" alt=""> -->
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

    <!-- <div class="mb-0">
        <p class="info-text fw-light">Home</p>
    </div> -->


    <section class="hero-section d-flex align-items-center mb-2">
        <div class="container text-center">
            <h1 style="font-weight: bold;">
                Selamat datang di Sistem Informasi<br>
                <span style="color: #FEC01A;">Pencatatan Prestasi Mahasiswa</span>
            </h1>
            <a class="btn btn-log" href="index.php?page=login">Login ke Sistem</a>
        </div>
    </section>


    <section class="announcement-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center ">
                <h2 style="font-weight: bold;">Pengumuman <span class="text-warning">Terbaru</span></h2>
                <div class="d-flex align-items-center button">
                    <a class="btn btn-outline-primary d-flex align-items-center" href="#">
                        Lihat semua Pengumuman
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card rounded-3 shadow-sm">
                        <div class="card-body">
                            <img src="../assets/img/ruang.jpg" alt="" class="card-img-top rounded-2">
                            <h5 class="card-title mt-3">Beasiswa Unggul untuk Mahasiswa Berprestasi!</h5>
                            <p class="card-text">Selamat! Bagi kalian mahasiswa berprestasi, kini saatnya meraih
                                kesempatan emas. membuka pendaftaran Beasiswa Unggul dengan berbagai benefit menarik.
                                Jangan lewatkan kesempatan untuk mengembangkan potensimu lebih jauh.</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <small class="text-muted">31 Februari 2024</small>
                            <a class="float-end link" href="#">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card rounded-3 shadow-sm">
                        <div class="card-body">
                            <img src="../assets/img/ruang.jpg" alt="" class="card-img-top rounded-2">
                            <h5 class="card-title mt-3">Beasiswa Unggul untuk Mahasiswa Berprestasi!</h5>
                            <p class="card-text">Selamat! Bagi kalian mahasiswa berprestasi, kini saatnya meraih
                                kesempatan emas. membuka pendaftaran Beasiswa Unggul dengan berbagai benefit menarik.
                                Jangan lewatkan kesempatan untuk mengembangkan potensimu lebih jauh.</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <small class="text-muted">31 Februari 2024</small>
                            <a class="float-end link" href="#">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card rounded-3 shadow-sm">
                        <div class="card-body">
                            <img src="../assets/img/ruang.jpg" alt="" class="card-img-top rounded-2">
                            <h5 class="card-title mt-3">Beasiswa Unggul untuk Mahasiswa Berprestasi!</h5>
                            <p class="card-text">Selamat! Bagi kalian mahasiswa berprestasi, kini saatnya meraih
                                kesempatan emas. membuka pendaftaran Beasiswa Unggul dengan berbagai benefit menarik.
                                Jangan lewatkan kesempatan untuk mengembangkan potensimu lebih jauh.</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <small class="text-muted">31 Februari 2024</small>
                            <a class="float-end link" href="#">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="help-center-section">
        <div class="container">
            <h2 class=mb-2">Informasi & Bantuan</h2>
            <div class="row d-flex justify-content-between align-items-start">
                <div class="col-md-6">
                    <a href="index.php?page=panduantanpalogin" class="text-decoration-none">
                        <ul class="list-group mb-3 shadow-sm">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-content">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="../assets/img/ri_guide-line.png"
                                                style="width: 32px; height: 32px; margin-right: 12px;" alt="">
                                            <h5 class="fw-bold">Panduan</h5>
                                        </div>
                                        <p>Temukan semua informasi yang Anda butuhkan untuk menggunakan platform
                                            pencatatan
                                            prestasi mahasiswa dengan mudah.</p>
                                    </div>
                                    <div class="separator"></div>
                                    <i class="bi bi-chevron-right icon-arrow"></i>
                                </div>
                            </li>
                        </ul>
                    </a>
                    <ul class="list-group mb-3 shadow-sm">
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-content">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="../assets/img/lucide_circle-help.png"
                                            style="width: 32px; height: 32px; margin-right: 12px;" alt="">
                                        <h5 class="fw-bold">Pertanyaan yang sering diajukan</h5>
                                    </div>
                                    <p>Punya pertanyaan? Temukan jawabannya di sini! Kami telah mengumpulkan pertanyaan
                                        yang sering diajukan oleh mahasiswa.</p>
                                </div>
                                <div class="separator"></div>
                                <i class="bi bi-chevron-right icon-arrow"></i>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img src="../assets/img/Thumbnail.png" alt="Help Center" class="img-fluid">
                </div>
            </div>
        </div>
    </section>


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