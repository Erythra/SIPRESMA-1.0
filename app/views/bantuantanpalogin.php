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

        footer.footer {
            margin-top: auto;
        }
    </style>
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

    <div class="container mt-4">
        <!-- Informasi & Bantuan Section -->
        <div class="border-0 mb-4" style=" padding: 20px;">
            <h5 class="fw-bold" style="color: #1a2a6c; font-size: 32px;">Informasi & Bantuan</h5>

            <div class="list-group mt-3">
                <!-- Panduan -->
                <a href="index.php?page=panduantanpalogin"
                    class="list-group-item list-group-item-action d-flex align-items-center gap-3"
                    style="border-radius: 12px !important; padding: 20px">
                    <i class="bi bi-book text-warning fs-4"></i>
                    <div>
                        <h6 class="mb-1 fw-bold" style="color: #1a2a6c ;">Panduan</h6>
                        <p class="mb-0 text-muted">
                            Temukan semua informasi yang Anda butuhkan untuk menggunakan platform pencatatan prestasi
                            mahasiswa dengan mudah.
                        </p>
                    </div>
                    <i class="bi bi-chevron-right ms-auto text-secondary"></i>
                </a>
                <br>
                <!-- Pertanyaan yang Sering Diajukan -->
                <a href="index.php?page=faqtanpalogin"
                    class="list-group-item list-group-item-action d-flex align-items-center gap-3"
                    style="border-radius: 12px !important; padding: 20px">
                    <i class="bi bi-question-circle text-warning fs-4"></i>
                    <div>
                        <h6 class="mb-1 fw-bold" style="color: #1a2a6c;">Pertanyaan yang sering diajukan</h6>
                        <p class="mb-0 text-muted">
                            Punya pertanyaan? Temukan jawabannya di sini! Kami telah mengumpulkan pertanyaan yang sering
                            diajukan oleh mahasiswa.
                        </p>
                    </div>
                    <i class="bi bi-chevron-right ms-auto text-secondary"></i>
                </a>
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

</html>
