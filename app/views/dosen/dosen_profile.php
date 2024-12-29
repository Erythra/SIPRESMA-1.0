<?php
include 'partials/header.php';
 include 'partials/sidenav.php';

// Periksa apakah sesi pengguna tersedia
if (!isset($_SESSION['user'])) {
    echo "<div class='alert alert-danger text-center' role='alert'>
            Data pengguna tidak ditemukan. Silakan login kembali.
          </div>";
    exit;
}
?>

<body>

    <!-- Main Content -->
    <div class="container my-5" style="margin-top: 8rem !important; margin-left: 20rem; max-width:63rem">
        <div class="row">
            <!-- Form Section -->
            <div class="col-lg-6 align-items-center justify-align-center">
                <form>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['success'];
                            unset($_SESSION['success']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <p class="form-control-plaintext">
                                <?= $_SESSION['user']['nama_dosen'] ?? '<span class="text-danger">Nama tidak tersedia</span>'; ?>
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="">
                            <label for="nim" class="form-label">NIDN</label>
                            <p class="form-control-plaintext">
                                <?= $_SESSION['user']['NIDN'] ?? '<span class="text-danger">NIM tidak tersedia</span>'; ?>
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                    <div class="">
                            <label for="email" class="form-label">Email</label>
                            <p class="form-control-plaintext">
                                <?= $_SESSION['user']['email_dosen'] ?? '<span class="text-danger">Email tidak tersedia</span>'; ?>
                            </p>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Profil Section -->
            <div class="col-lg-6 text-center profile-section">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Foto Profil">
                <h3 id="profile-name"><?= $_SESSION['user']['nama_dosen'] ?? 'Nama'; ?></h3>
                <p class="text-primary" id="profile-nim">NIDN. <?= $_SESSION['user']['NIDN'] ?? 'NIDN'; ?></p>
                <p style="text-transform:uppercase"><?= $_SESSION['user']['role'] ?? 'role'; ?></p>
            </div>
        </div>
    </div>

    <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>