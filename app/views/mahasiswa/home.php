<?php
include 'partials/header.php';

$sql = "SELECT id_pengumuman, gambar_pengumuman, judul_pengumuman, isi_pengumuman, tgl_dibuat FROM pengumuman";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$pengumumanList = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $pengumumanList[] = $row;
}

$pengumumanList = array_slice($pengumumanList, 0, 3);
?>

<div style="margin-top: 4rem;">
    <section class="hero-section d-flex align-items-center mb-2">
        <div class="container text-center">
            <h1 style="font-weight: bold;">
                Selamat datang di Sistem Informasi<br>
                <span style="color: #FEC01A;">Pencatatan Prestasi Mahasiswa</span>
            </h1>
        </div>
    </section>


    <section class="announcement-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 style="font-weight: bold;">Pengumuman <span class="text-warning">Terbaru</span></h2>
                <div class="d-flex align-items-center button">
                    <a class="btn btn-outline-primary d-flex align-items-center" href="index.php?page=semua_pengumuman">
                        Lihat semua Pengumuman
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <div style="max-height: 400px;">
                <div class="row">
                    <?php if (empty($pengumumanList)) : ?>
                    <div class="col-12 text-center">
                        <p>Pengumuman tidak tersedia</p>
                    </div>
                    <?php else : ?>
                    <?php foreach ($pengumumanList as $pengumuman) : ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <style>
                            .aspect-ratio-16-9 {
                                position: relative;
                                width: 100%;
                                padding-top: 56.25%;
                                overflow: hidden;
                                background: #f0f0f0
                            }

                            .aspect-ratio-16-9 img {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                            }
                            </style>
                            <div class="aspect-ratio-16-9" style="border-radius: 1rem;">
                                <img src="<?php echo htmlspecialchars($pengumuman['gambar_pengumuman']); ?>"
                                    alt="Pengumuman">
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title">
                                        <?php echo htmlspecialchars($pengumuman['judul_pengumuman']); ?></h5>
                                    <p class="card-text">
                                        <?php echo htmlspecialchars(mb_strimwidth($pengumuman['isi_pengumuman'], 0, 100, '...')); ?>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <p class="card-text text-muted mb-0">
                                        <small><?php echo date_format($pengumuman['tgl_dibuat'], "d M Y"); ?></small>
                                    </p>
                                    <a href="index.php?page=detail_pengumuman&id_pengumuman=<?php echo $pengumuman['id_pengumuman']; ?>"
                                        class="btn btn-link" style="text-decoration: none;">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="help-center-section">
        <div class="container">
            <h2 class="mb-2">Informasi & Bantuan</h2>
            <div class="row d-flex justify-content-between align-items-start">
                <div class="col-md-6">
                    <a href="index.php?page=panduan" style="text-decoration: none;">
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
                    <a href="index.php?page=faq" style="text-decoration: none;">
                        <ul class="list-group mb-3 shadow-sm">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-content">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="../assets/img/lucide_circle-help.png"
                                                style="width: 32px; height: 32px; margin-right: 12px;" alt="">
                                            <h5 class="fw-bold">Pertanyaan yang sering diajukan</h5>
                                        </div>
                                        <p>Punya pertanyaan? Temukan jawabannya di sini! Kami telah mengumpulkan
                                            pertanyaan yang sering diajukan oleh mahasiswa.</p>
                                    </div>
                                    <div class="separator"></div>
                                    <i class="bi bi-chevron-right icon-arrow"></i>
                                </div>
                            </li>
                        </ul>
                    </a>
                </div>
                <div class="col-md-6">
                    <img src="../assets/img/Thumbnail.png" alt="Help Center" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>