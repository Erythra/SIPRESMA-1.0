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
?>

<div class="mb-5"> <!-- breadcrumb -->
    <p class="info-text fw-light">Home - Semua Pengumuman</p>
</div>
<div class="container mt-4">
    <div class="row">
        <?php foreach ($pengumumanList as $pengumuman) : ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
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
                            border-radius: 1rem;
                        }
                    </style>
                    <div class="aspect-ratio-16-9">
                        <img src="<?php echo htmlspecialchars($pengumuman['gambar_pengumuman']); ?>" alt="Pengumuman">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><?php echo htmlspecialchars($pengumuman['judul_pengumuman']); ?></h5>
                            <p class="card-text">
                                <?php
                                echo htmlspecialchars(mb_strimwidth($pengumuman['isi_pengumuman'], 0, 100, '...'));
                                ?>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <p class="card-text text-muted mb-0"><small><?php echo date_format($pengumuman['tgl_dibuat'], "d M Y"); ?></small></p>
                            <a href="index.php?page=detail_pengumuman&id_pengumuman=<?php echo $pengumuman['id_pengumuman']; ?>" class="btn btn-link">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'partials/footer.php'; ?>