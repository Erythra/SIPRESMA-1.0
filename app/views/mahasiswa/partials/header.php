<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SIPRESMA</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"
        integrity="sha384-1xu3hIvtwpZ2K7dCDEevO6GukF5KtAKIvPYuhU1bDrK9OK91bIY1F9WmrDCNzA3Q" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="././../assets/css/mahasiswa/scroll.css">
    <link rel="stylesheet" href="././../assets/css/style.css">
    <link rel="stylesheet" href="././../assets/css/header.css">
    <link rel="stylesheet" href="././../assets/css/mahasiswa/profile.css">
    <link rel="stylesheet" href="././../assets/css/mahasiswa/editprofile.css">
    <link rel="stylesheet" href="././../assets/css/mahasiswa/tabelprestasi.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet">

    <style>
                /* Basic styling for table and dropdown */
        .table-bordered {
            border: 1px solid #dee2e6;
            border-radius: .25rem;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }

        .select2 {
            width: 100%;
        }

        .select2-container .select2-selection--single {
            height: calc(1.5em + .75rem + 2px);
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            display: none;
        }
    </style>

</head>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- AJAX -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet">

</head>

<style>
    body {
        background-color: #F5F2FE;
        margin: 0;
    }
</style>
<nav>

    <div class="fixed-top">
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
            <div class="container">
                <!-- Logo -->
                <img class="logo-sipresma" src="././../assets/img/Logo 4x.png" alt="SIPRESMA-LOGO" href="#"
                    style="z-index: 1200;">

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav text-center">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'home') ? 'active' : ''; ?>" href="index.php?page=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'prestasi' || isset($_GET['page']) && $_GET['page'] == 'tambahprestasi') || isset($_GET['page']) && $_GET['page'] == 'prestasidetail' ? 'active' : ''; ?>"
                                href="././../public/index.php?page=prestasi">
                                Prestasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'ipk') ? 'active' : ''; ?>" href="index.php?page=ipk">IPK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'peringkat_akademik') ? 'active' : ''; ?>" href="index.php?page=peringkat_akademik">Leaderboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'bantuan') ? 'active' : ''; ?>" href="index.php?page=bantuan">Bantuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'semua_pengumuman') ? 'active' : ''; ?>" href="index.php?page=semua_pengumuman">Pengumuman</a>
                        </li>
                    </ul>
                </div>

                <!-- User Info and Image -->
                <div class="user-info" style="z-index: 1200;">
                    <div class="d-flex flex-column text-end">
                        <p class="info-text-nav" style="font-weight:600; font-size: 15px;">
                            <?php echo isset($_SESSION['user']['nama_mahasiswa']) ? $_SESSION['user']['nama_mahasiswa'] : 'Mahasiswa'; ?>
                        </p>
                        <p class="info-text-nav" style="color:#AEAEB2; font-size: 13px;">
                            <?php echo isset($_SESSION['user']['NIM']) ? $_SESSION['user']['NIM'] : 'NIM'; ?>
                        </p>
                    </div>

                    <!-- Dropdown Trigger -->
                    <div class="dropdown position-relative d-flex align-items-center" style="z-index: 1000;">
                        <!-- Avatar -->
                        <img src="././../assets/img/animoji.png" alt="User Image" class="dropdown-toggle mb-1"
                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"
                            style="cursor: pointer; width: 40px; height: 40px; border-radius: 50%;">

                        <!-- Arrow Icon -->
                        <i class="bi bi-caret-down-fill ms-2" data-bs-toggle="dropdown" aria-expanded="false"
                            style="cursor: pointer; font-size: 16px; color: #6c757d;"></i>

                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end fw-semibold custom-dropdown"
                            aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="index.php?page=profile">
                                    <i class="bi bi-person-fill me-2"></i> View Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="index.php?action=logout">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>


                <!-- Navbar Toggler for mobile view -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="mb-5">
            <p class="info-text fw-light"></p>
        </div>
    </div>
</nav>