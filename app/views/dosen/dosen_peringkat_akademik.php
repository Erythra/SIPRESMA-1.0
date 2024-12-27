<?php
include 'partials/header.php';
include 'partials/sidenav.php';
$conn = require '../config/config.php';

if (!$conn) {
    die("Koneksi ke database gagal.");
}

$query = "SELECT TOP 10 
    m.NIM,
    m.nama_mahasiswa,
    m.program_studi,
    COUNT(pm.id_prestasi) AS jumlah_prestasi
    FROM 
        mahasiswa m
    LEFT JOIN 
        prestasi_mahasiswa pm ON m.id_mahasiswa = pm.id_mahasiswa
    LEFT JOIN 
        data_prestasi dp ON pm.id_prestasi = dp.id_prestasi
    GROUP BY 
        m.NIM, m.nama_mahasiswa, m.program_studi
    ORDER BY 
        jumlah_prestasi DESC";

$stmt = sqlsrv_query($conn, $query);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$leaderboard = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $leaderboard[] = $row;
}
?>


<div class="" style="margin-left: 317px; margin-right: 32px; margin-top: 90px;">
    <div style="margin-bottom: 17.5px;">
        <h4 class="fw-semibold">Prestasi</h4>
        <h6 class="fw-medium text-muted">Home - Prestasi</h6>
    </div>
    <div class="card mb-5">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <!-- Tab navigation -->
                <li class="nav-item" role="presentation">
                    <button aria-controls="akademik" aria-selected="true" class="nav-link active" data-bs-target="#akademik"
                        data-bs-toggle="tab" id="akademik-tab" role="tab" type="button">Akademik</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button aria-controls="non-akademik" aria-selected="false" class="nav-link"
                        data-bs-target="#non-akademik" data-bs-toggle="tab" id="non-akademik-tab" role="tab" type="button">Non-Akademik</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button aria-controls="semua" aria-selected="false" class="nav-link" data-bs-target="#semua"
                        data-bs-toggle="tab" id="semua-tab" role="tab" type="button">Semua</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div aria-labelledby="akademik-tab" class="tab-pane fade show active" id="akademik" role="tabpanel">
                    <table class="table mt-3">
                        <thead>
                            <tr class="text-center">
                                <th>Peringkat</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Jumlah Prestasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($leaderboard)) {
                                $rank = 1;
                                foreach ($leaderboard as $row) { ?>
                                    <tr class="text-center">
                                        <td><?= $rank++ ?></td>
                                        <td><?= $row['NIM'] ?></td>
                                        <td><?= $row['nama_mahasiswa'] ?></td>
                                        <td><?= $row['program_studi'] ?></td>
                                        <td><?= $row['jumlah_prestasi'] ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data tersedia.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- Konten untuk tab lainnya -->
                <div aria-labelledby="non-akademik-tab" class="tab-pane fade" id="non-akademik" role="tabpanel">Non-Akademik content</div>
                <div aria-labelledby="semua-tab" class="tab-pane fade" id="semua" role="tabpanel">Semua content</div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>