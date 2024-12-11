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
<div class="container my-5 style=" margin-top: 6rem;">

    <div class="row">
        <!-- Form Section -->
        <div class="col-lg-8">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Isi identitas anda dengan lengkap. Jika sudah selesai, klik tombol simpan.
            </div>
            <form method="POST" action="index.php?action=edit">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="<?php echo htmlspecialchars($user['nama_mahasiswa']); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim"
                            value="<?php echo htmlspecialchars($user['NIM']); ?>" required>
                    </div>
                </div>



                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?php echo htmlspecialchars($user['email_mahasiswa']); ?>" required>
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
            <img src="<?php echo htmlspecialchars($user['foto_mahasiswa'] ?? 'default-image.png'); ?>"
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