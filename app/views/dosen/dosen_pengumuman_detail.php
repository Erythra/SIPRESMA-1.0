<?php include 'partials/header.php';
include 'partials/sidenav.php';

include '../config/config.php';

if (isset($_GET['id_pengumuman'])) {
    $id_pengumuman = $_GET['id_pengumuman'];

    $sql = "SELECT * FROM pengumuman WHERE id_pengumuman = ?";
    $stmt = sqlsrv_prepare($conn, $sql, array($id_pengumuman));

    if (!$stmt) {
        die(print_r(sqlsrv_errors(), true));
    }

    $result = sqlsrv_execute($stmt);

    if ($result && sqlsrv_has_rows($stmt)) {
        $pengumuman = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        $tgl_dibuat = $pengumuman['tgl_dibuat'];
        $tgl_diupdate = $pengumuman['tgl_diupdate'] ? $pengumuman['tgl_diupdate'] : null;

        $formatted_tgl_dibuat = date_format($tgl_dibuat, 'd-m-Y H:i');
        $formatted_tgl_diupdate = $tgl_diupdate ? date_format($tgl_diupdate, 'd-m-Y H:i') : 'Belum diupdate';
    } else {
        echo "Pengumuman tidak ditemukan.";
        exit();
    }
} else {
    echo "ID Pengumuman tidak diterima.";
    exit();
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

<div class="" style="margin-left: 317px; margin-right: 32px; margin-top: 90px;">

    <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 20px;">
        <div>
            <h4 class="fw-semibold">Detail Pengumuman</h4>
            <h6 class="fw-medium text-muted">Home - Detail Pengumuman</h6>
        </div>


    </div>

    <div class="row justify-content-between" style="margin-bottom: 120px;">
        <!-- Left Column -->
        <div class="col-lg-12">
            <!-- Data Pengumuman -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style="font-size: 16px;">Detail Pengumuman</div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Judul Pengumuman</p>
                            <p class="mb-3" style="color: #495057;">
                                <?php echo htmlspecialchars($pengumuman['judul_pengumuman']); ?>
                            </p>

                            <p class="mb-0 fw-bold">Isi Pengumuman</p>
                            <p class="mb-3" style="color: #495057;">
                                <?php echo nl2br(htmlspecialchars($pengumuman['isi_pengumuman'])); ?>
                            </p>
                        </div>

                        <div class="col-md-4">
                            <p class="mb-0 fw-bold">Gambar Pengumuman</p>
                            <p class="mb-3" style="color: #495057;">
                                <style>
                                    .image-container {
                                        position: relative;
                                        width: 100%;
                                        padding-top: 56.25%;
                                        overflow: hidden;
                                        border-radius: 1rem;
                                    }

                                    .image-container img {
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        width: 100%;
                                        height: 100%;
                                        object-fit: cover;
                                    }
                                </style>
                                <?php if ($pengumuman['gambar_pengumuman']) : ?>
                            <div class="image-container">
                                <img src="<?php echo htmlspecialchars($pengumuman['gambar_pengumuman']); ?>" alt="Gambar Pengumuman" class="img-fluid" />
                            </div>
                        <?php else: ?>
                            Tidak ada gambar
                        <?php endif; ?>
                        </p>
                        </div>
                    </div>
                    <hr class="separator my-3" />
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Tanggal Dibuat</p>
                            <p class="mb-0" style="color: #495057;">
                                <?php echo htmlspecialchars($formatted_tgl_dibuat); ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Tanggal Diupdate</p>
                            <p class="mb-0" style="color: #495057;">
                                <?php echo htmlspecialchars($formatted_tgl_diupdate); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>