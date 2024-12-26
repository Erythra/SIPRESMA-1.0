<?php
include 'partials/header.php';

$id_pengumuman = isset($_GET['id_pengumuman']) ? intval($_GET['id_pengumuman']) : 0;

$sql = "SELECT * FROM pengumuman WHERE id_pengumuman = ?";
$params = array($id_pengumuman);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt && sqlsrv_has_rows($stmt)) {
    $pengumuman = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
} else {
    echo '<div class="alert alert-danger">Pengumuman tidak ditemukan!</div>';
    include 'partials/footer.php';
    exit;
}

$isi_pengumuman = $pengumuman['isi_pengumuman'];

$paragraphs = explode("\n\n", $isi_pengumuman);

$formatted_text = implode("</p><p>", $paragraphs);

$formatted_text = "<p>" . $formatted_text . "</p>";

?>

<div class="mb-5">
    <p class="info-text fw-light">Home - Pengumuman Terbaru - Detail Pengumuman</p>
</div>

<div class="container mt-5 mb-5">
    <div class="card shadow-sm p-4">
        <div class="row">
            <div class="col-md-12">
                <div style="float: left; margin-right: 32px; width: 50%;">
                    <div class="ratio ratio-16x9">
                        <img src="<?php echo htmlspecialchars($pengumuman['gambar_pengumuman']); ?>"
                            alt="Detail Pengumuman"
                            class="img-fluid rounded"
                            style="object-fit: cover;">
                    </div>
                </div>

                <!-- Teks Pengumuman -->
                <h2 class="mb-2"><?php echo htmlspecialchars($pengumuman['judul_pengumuman']); ?></h2>
                <p><?php echo $pengumuman['tgl_dibuat']->format('d F Y'); ?></p>
                <?php echo $formatted_text; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>