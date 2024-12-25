<?php
include 'partials/header.php';
include 'partials/sidenav.php';
include '../config/config.php';

$timePeriod = 'hari';

if (isset($_POST['btnradio1'])) {
    $timePeriod = $_POST['btnradio1'];
}

function getUploadData($conn, $timePeriod)
{
    $query = '';

    switch ($timePeriod) {
        case 'bulan':

            $query = "SELECT MONTH(tgl_pengajuan) as month, COUNT(*) as total_uploads 
                      FROM data_prestasi 
                      GROUP BY MONTH(tgl_pengajuan) 
                      ORDER BY month";
            break;
        case 'tahun':

            $query = "SELECT YEAR(tgl_pengajuan) as year, COUNT(*) as total_uploads 
                      FROM data_prestasi 
                      GROUP BY YEAR(tgl_pengajuan) 
                      ORDER BY year";
            break;
        case 'hari':
        default:

            $query = "SELECT DAY(tgl_pengajuan) as day, COUNT(*) as total_uploads 
                      FROM data_prestasi 
                      GROUP BY DAY(tgl_pengajuan) 
                      ORDER BY day";
            break;
    }

    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $data = [];
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }

    return $data;
}

$data = getUploadData($conn, $timePeriod);

$labels = [];
$uploadData = [];
foreach ($data as $row) {
    switch ($timePeriod) {
        case 'bulan':
            $labels[] = 'Bulan ' . $row['month'];
            break;
        case 'tahun':
            $labels[] = 'Tahun ' . $row['year'];
            break;
        case 'hari':
        default:
            $labels[] = 'Hari ' . $row['day'];
            break;
    }
    $uploadData[] = $row['total_uploads'];
}
?>

<div style="margin-left: 317px; margin-right: 32px; margin-top: 90px;">
    <div style="margin-bottom: 17.5px;">
        <h4 class="fw-semibold">Dashboard</h4>
        <h6 class="fw-medium text-muted">Home</h6>
    </div>
    <div class="d-flex justify-content-start gap-4">
        <div class="card" style="width: 40%; padding: 18px 24px; border-top: solid 4px #212529; border-radius: 12px;">
            <p class="fw-semibold mb-0" style="margin-bottom: 10px;">Prestasi Menunggu Disetujui</p>
            <p class="fw-semibold fs-2 mb-0"><?php echo isset($countPrestasi['waiting_for_approval']) ? $countPrestasi['waiting_for_approval'] : 0; ?></p>
        </div>
        <div class="card" style="width: 40%; padding: 18px 24px; border-top: solid 4px #15803D; border-radius: 12px;">
            <p class="fw-semibold mb-0" style="margin-bottom: 10px;">Prestasi Disetujui</p>
            <p class="fw-semibold fs-2 mb-0"><?php echo isset($countPrestasi['approved']) ? $countPrestasi['approved'] : 0; ?></p>
        </div>
        <div class="card" style="width: 40%; padding: 18px 24px; border-top: solid 4px #B91C1C; border-radius: 12px;">
            <p class="fw-semibold mb-0" style="margin-bottom: 10px;">Prestasi Ditolak</p>
            <p class="fw-semibold fs-2 mb-0"><?php echo isset($countPrestasi['rejected']) ? $countPrestasi['rejected'] : 0; ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card mt-3 w-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center" style="margin-left: 24px; margin-right: 24px;">
                        <h4 class="fw-semibold mb-0">Total Upload Data Prestasi</h4>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <form method="POST" id="timePeriodForm">
                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio1" value="hari" <?= $timePeriod == 'hari' ? 'checked' : '' ?> autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio1">Hari</label>

                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio2" value="bulan" <?= $timePeriod == 'bulan' ? 'checked' : '' ?> autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2">Bulan</label>

                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio3" value="tahun" <?= $timePeriod == 'tahun' ? 'checked' : '' ?> autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio3">Tahun</label>
                            </form>
                        </div>
                    </div>
                    <canvas class="mt-2" id="totalupload" width="900" height="400"></canvas>
                </div>
            </div>
        </div>

        <!-- Second card -->
        <div class="col-md-6 d-flex">
            <div class="card mt-3 w-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center" style="margin-left: 24px; margin-right: 24px;">
                        <h4 class="fw-semibold mb-0">Rata-rata IPK Mahasiswa</h4>
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Angkatan 2023
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    2023 - 2024 Ganjil
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <canvas id="rataipk" width="900" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center"
                style="margin-left: 24px; margin-right: 24px;">
                <h4 class="fw-semibold mb-0">Prestasi Mahasiswa</h4>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio2" id="btnradio4" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="btnradio4">Hari</label>

                    <input type="radio" class="btn-check" name="btnradio2" id="btnradio5" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio5">Bulan</label>

                    <input type="radio" class="btn-check" name="btnradio2" id="btnradio6" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio6">Tahun</label>
                </div>
            </div>
            <canvas id="prestasiChart" width="900" height="400"></canvas>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center"
                style="margin-left: 24px; margin-right: 24px;">
                <h4 class="fw-semibold mb-0">Papan Peringkat</h4>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            2024
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-primary btn-peringkat">Lihat Papan Peringkat</button>
                </div>
            </div>
        </div>

        <div style="padding: 30px 87px 20px 87px;">
            <div class="d-flex justify-content-start gap-3">
                <div class="text-center align-items-center" style="width: 40%; padding: 18px 24px;">
                    <div class="mb-3">
                        <img src="../assets/img/profile.png" alt="" style="width: 64px; height: 87px;">
                    </div>
                    <div class="mb-3">
                        <p class="fw-semibold mb-0" style="margin-bottom: 10px;">Daniel Levi</p>
                        <p class="fw-light mb-0 text-muted">D-IV Teknik Informatika</p>
                    </div>
                    <div class="rectangle d-flex justify-content-center align-items-center" style="padding-left: 6px;">
                        <img src="../assets/img/piala.png" alt="" style="width: 36.4px; height: 37.22px; margin-right: 10px;">
                        <p class="mb-0 text-center" style="color: #212529;">
                            <span class="fw-semibold fs-5" style="color: #244282;">50</span> Prestasi
                        </p>
                    </div>
                </div>
                <div class="text-center align-items-center" style="width: 40%; padding: 18px 24px;">
                    <div class="mb-3">
                        <img src="../assets/img/profile 1.png" alt="" style="width: 64px; height: 87px;">
                    </div>
                    <div class="mb-3">
                        <p class="fw-semibold mb-0">Daniel Levi</p>
                        <p class="fw-light mb-0 text-muted">D-IV Teknik Informatika</p>
                    </div>
                    <div class="rectangle d-flex justify-content-center align-items-center" style="padding-left: 6px;">
                        <img src="../assets/img/piala.png" alt="" style="width: 36.4px; height: 37.22px; margin-right: 10px;">
                        <p class="mb-0 text-center" style="color: #212529;">
                            <span class="fw-semibold fs-5" style="color: #244282;">50</span> Prestasi
                        </p>
                    </div>
                </div>
                <div class="text-center align-items-center" style="width: 40%; padding: 18px 24px;">
                    <div class="mb-3">
                        <img src="../assets/img/profile 3.png" alt="" style="width: 64px; height: 87px;">
                    </div>
                    <div class="mb-3">
                        <p class="fw-semibold mb-0" style="margin-bottom: 10px;">Daniel Levi</p>
                        <p class="fw-light mb-0 text-muted">D-IV Teknik Informatika</p>
                    </div>
                    <div class="rectangle d-flex justify-content-center align-items-center" style="padding-left: 6px;">
                        <img src="../assets/img/piala.png" alt="" style="width: 36.4px; height: 37.22px; margin-right: 10px;">
                        <p class="mb-0 text-center" style="color: #212529;">
                            <span class="fw-semibold fs-5" style="color: #244282;">50</span> Prestasi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script src="././../assets/js/rataipk.js"></script>

<script src="././../assets/js/prestasi.js"></script>

<script>
    document.querySelectorAll('input[name="btnradio1"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('timePeriodForm').submit();
        });
    });
</script>

<script>
    (() => {
        'use strict'

        const ctx = document.getElementById('totalupload');
        const totalupload = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($uploadData); ?>,
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    borderWidth: 4,
                    pointBackgroundColor: '#007bff'
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        boxPadding: 3
                    }
                }
            }
        });
    })()
</script>

</body>

</html>