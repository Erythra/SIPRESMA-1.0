<?php
include 'partials/header.php';

// Pastikan sesi user sudah dimulai dan data tersedia.
$user = $_SESSION['user'] ?? null;

// Pastikan data user tersedia sebelum diproses.
if (!$user) {
    header("Location: login.php"); // Redirect jika user tidak ada.
    exit;
}
?>

<!-- Main Content -->
<div class="container my-5" style=" margin-top: 120px !important;">
    <div class="row">
        <!-- Form Section -->
        <div class="col-lg-8">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Isi Password baru anda. Jika sudah selesai, klik tombol simpan.
            </div>
            <form method="POST" action="index.php?action=ganti_password">
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
                    <div class="col-md-6">
                        <label for="nim" class="form-label">Password lama</label>
                        <input type="password" class="form-control" id="password_mahasiswa" name="old_password"
                            value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nim" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="password_mahasiswa" name="new_password"
                            value="">
                    </div>
                    <div class="col-md-6">
                        <label for="nim" class="form-label">Konfirmasi</label>
                        <input type="password" class="form-control" id="password_mahasiswa" name="confirm_password"
                            value="">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary fw-medium"
                    style="background-color: #244282; border: none;">
                    <i class="fa fa-check"></i> Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Profile Section -->
        <div class="col-lg-4 text-center profile-section">
            <img src="<?php echo htmlspecialchars($user['foto_mahasiswa'] ?? 'https://cdn-icons-png.flaticon.com/512/149/149071.png'); ?>"
                alt="Foto Profil">
            <h3 id="profile-name"><?php echo htmlspecialchars($user['nama_mahasiswa']); ?></h3>
            <p class="text-primary" id="profile-nim">NIM. <?php echo htmlspecialchars($user['NIM']); ?></p>
            <p>MAHASISWA</p>
            <p style="color: #244282;">TEKNOLOGI INFORMASI <br> D-IV TEKNIK INFORMATIKA</p>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include 'partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>