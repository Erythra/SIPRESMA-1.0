<?php
include 'partials/header.php';

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
    <div class="container my-5" style="margin-top: 8rem !important;">
        <div class="row">
            <!-- Form Section -->
            <div class="col-lg-6 my-4">
                <form>
                    <?php if (isset($_SESSION['success'])): ?>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['success'];
                            unset($_SESSION['success']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <h4 class="fw-semibold fs-3 mb-3">Profile Mahasiswa</h4>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value=" <?= $_SESSION['user']['nama_mahasiswa'] ?? '<span class="text-danger">Nama tidak tersedia</span>'; ?>"
                                disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim"
                                value="<?= $_SESSION['user']['NIM'] ?? '<span class="text-danger">NIM tidak tersedia</span>'; ?>"
                                disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= $_SESSION['user']['email_mahasiswa'] ?? '<span class="text-danger">Email tidak tersedia</span>'; ?>"
                                disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="nim" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password_mahasiswa" name="password_mahasiswa"
                                value="<?= $_SESSION['user']['password_mahasiswa'] ?? '<span class="text-danger">Email tidak tersedia</span>'; ?>"
                                disabled>
                        </div>
                    </div>

                    <a href="index.php?page=edit" class="btn btn-simpan mt-3">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </form>
            </div>

            <!-- Profil Section -->
            <div class="col-lg-6 text-center profile-section">
                <img src="PBL-SIPRESMA/assets/img/animoji.png" alt="Foto Profil">
                <h3 id="profile-name"><?= $_SESSION['user']['nama_mahasiswa'] ?? 'Nama'; ?></h3>
                <p class="text-primary" id="profile-nim">NIM. <?= $_SESSION['user']['NIM'] ?? 'NIM'; ?></p>
                <p>MAHASISWA</p>
                <p style="color: #244282;">TEKNOLOGI INFORMASI <br> D-IV TEKNIK INFORMATIKA</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>