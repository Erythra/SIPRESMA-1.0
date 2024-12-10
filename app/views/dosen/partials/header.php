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
    <link rel="stylesheet" href="././../assets/css/mahasiswa/style.css">
    <link rel="stylesheet" href="././../assets/css/admin/sidebar.css">
    <link rel="stylesheet" href="././../assets/css/admin/navbar.css">
    <link rel="stylesheet" href="././../assets/css/style.css">
    <link rel="stylesheet" href="././../assets/css/header.css">
    <link rel="stylesheet" href="././../assets/css/mahasiswa/profile.css">
    

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top" style="border-radius: 0px">
        <div class="container-fluid" style="padding-left: 32px; padding-right: 32px;">
            <div class="d-flex align-items-center ms-auto" style="gap: 12px;">
                <div class="card p-2">
                    <i class="bi bi-sun text-muted"></i>
                </div>
                <div class="user-info">
                    <div class="d-flex flex-column text-end">
                        <p class="info-text-nav" style="font-weight:600; font-size: 15px;">
                            <?php echo isset($_SESSION['user']['nama_dosen']) ? $_SESSION['user']['nama_dosen'] : 'Dosen'; ?>
                        </p>
                        <p class="info-text-nav" style="color:#AEAEB2; font-size: 13px;">
                            <?php echo isset($_SESSION['user']['NIDN']) ? $_SESSION['user']['NIDN'] : 'NIDN'; ?>
                        </p>
                    </div>

                    <!-- Dropdown Trigger -->
                    <div class="dropdown position-relative d-flex align-items-center">
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


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </nav>