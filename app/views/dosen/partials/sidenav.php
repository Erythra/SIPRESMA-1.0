<!-- Sidebar -->
<div class="sidebar position-absolute top-0 start-0 position-fixed"
        style="width: 285px; height: 100vh;z-index: 1050; background-color: #244282;">
        <a href="#"
            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none p-3">
            <img class="logo-sipresma" src="././../assets/img/Logo white.png" alt="SIPRESMA-LOGO"
                style="width: 163px; height: 36px; margin-left: 20px;">
        </a>
        <ul class="nav nav-pills flex-column mb-auto text-white" style="padding-left: 20px; padding-right: 20px;">
            <!-- <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">
                <i class="bi bi-house-door-fill me-2"></i>
                Home
            </a>
        </li> -->
            <li>
                <a href="././../public/index.php?page=dosen_dashboard" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'dosen_dashboard') ? 'active' : ''; ?> link-body-emphasis text-white" style="padding: 14px;">
                    <i class="bi bi-grid me-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="././../public/index.php?page=dosen_prestasi" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'dosen_prestasi' || isset($_GET['page']) && $_GET['page'] == 'dosen_prestasi_add' ) ? 'active' : ''; ?> link-body-emphasis text-white" style="padding: 14px;">
                    <i class="bi bi-book me-2"></i>
                    Prestasi
                </a>
            </li>
            <li>
                <a href="" class="nav-link  link-body-emphasis text-white" style="padding: 14px;">
                    <i class="bi bi-folder2 me-2"></i>
                    Data IPK
                </a>
            </li>
            <li>
                <a href="././../public/index.php?page=dosen_peringkat_akademik" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'dosen_peringkat_akademik') ? 'active' : ''; ?> link-body-emphasis text-white" style="padding: 14px;">
                    <i class="bi bi-trophy me-2"></i>
                    Papan Peringkat
                </a>
            </li>
        </ul>
    </div>