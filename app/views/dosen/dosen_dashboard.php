<?php
include 'partials/header.php';
include 'partials/sidenav.php';
include '../config/config.php';

require_once __DIR__ . '/../../controllers/AuthController.php';

// Total Upload Data Prestasi
$timePeriod = 'hari';

if (isset($_POST['btnradio1'])) {
    $timePeriod = $_POST['btnradio1'];
}

function getUploadData($conn, $timePeriod)
{
    $query = '';

    switch ($timePeriod) {
        case 'bulan':
            // Mengambil bulan dengan format nama bulan dalam bahasa Inggris
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
            // Mengambil nama hari dalam bahasa Inggris
            $query = "SELECT DATENAME(weekday, tgl_pengajuan) as day, COUNT(*) as total_uploads 
                      FROM data_prestasi 
                      GROUP BY DATENAME(weekday, tgl_pengajuan) 
                      ORDER BY CASE DATENAME(weekday, tgl_pengajuan)
                               WHEN 'Monday' THEN 1
                               WHEN 'Tuesday' THEN 2
                               WHEN 'Wednesday' THEN 3
                               WHEN 'Thursday' THEN 4
                               WHEN 'Friday' THEN 5
                               WHEN 'Saturday' THEN 6
                               WHEN 'Sunday' THEN 7
                               END";
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
            // Mengonversi nama bulan dari angka menjadi nama bulan dalam bahasa Indonesia
            switch ($row['month']) {
                case 1:
                    $labels[] = 'Januari';
                    break;
                case 2:
                    $labels[] = 'Februari';
                    break;
                case 3:
                    $labels[] = 'Maret';
                    break;
                case 4:
                    $labels[] = 'April';
                    break;
                case 5:
                    $labels[] = 'Mei';
                    break;
                case 6:
                    $labels[] = 'Juni';
                    break;
                case 7:
                    $labels[] = 'Juli';
                    break;
                case 8:
                    $labels[] = 'Agustus';
                    break;
                case 9:
                    $labels[] = 'September';
                    break;
                case 10:
                    $labels[] = 'Oktober';
                    break;
                case 11:
                    $labels[] = 'November';
                    break;
                case 12:
                    $labels[] = 'Desember';
                    break;
            }
            break;
        case 'tahun':
            $labels[] = 'Tahun ' . $row['year'];
            break;
        case 'hari':
        default:
            // Mengonversi nama hari dari bahasa Inggris ke bahasa Indonesia
            switch ($row['day']) {
                case 'Monday':
                    $labels[] = 'Senin';
                    break;
                case 'Tuesday':
                    $labels[] = 'Selasa';
                    break;
                case 'Wednesday':
                    $labels[] = 'Rabu';
                    break;
                case 'Thursday':
                    $labels[] = 'Kamis';
                    break;
                case 'Friday':
                    $labels[] = 'Jumat';
                    break;
                case 'Saturday':
                    $labels[] = 'Sabtu';
                    break;
                case 'Sunday':
                    $labels[] = 'Minggu';
                    break;
            }
            break;
    }
    $uploadData[] = $row['total_uploads'];
}

$selectedAngkatan = isset($_GET['angkatan']) ? $_GET['angkatan'] : null;

// Rata-rata
$query = "SELECT 
        m.NIM, 
        m.nama_mahasiswa, 
        m.foto_mahasiswa, 
        m.program_studi, 
        m.tahun_angkatan,
        n.nilai_mahasiswa, 
        mk.sks, 
        mk.smt
    FROM 
        mahasiswa m
    INNER JOIN 
        nilai_mahasiswa n ON m.id_mahasiswa = n.id_mahasiswa
    INNER JOIN 
        mata_kuliah mk ON n.id_mata_kuliah = mk.id_mata_kuliah
";

if ($selectedAngkatan) {
    $query .= " WHERE m.tahun_angkatan = ?";
    $params = [$selectedAngkatan];
} else {
    $params = [];
}

$stmt = sqlsrv_query($conn, $query, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$semesterData = [];

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $semester = $row['smt'];
    if (!isset($semesterData[$semester])) {
        $semesterData[$semester] = [
            'totalPoin' => 0,
            'totalSks' => 0,
            'studentCount' => 0
        ];
    }

    $poin = 0;
    if ($row['nilai_mahasiswa'] >= 80) {
        $poin = 4;
    } elseif ($row['nilai_mahasiswa'] >= 70) {
        $poin = 3;
    } elseif ($row['nilai_mahasiswa'] >= 60) {
        $poin = 2;
    } else {
        $poin = 1;
    }

    $semesterData[$semester]['totalPoin'] += $poin * $row['sks'];
    $semesterData[$semester]['totalSks'] += $row['sks'];
    $semesterData[$semester]['studentCount']++;
}

$averageData = [];
foreach ($semesterData as $semester => $data) {
    $averageIPK = $data['totalSks'] > 0 ? number_format($data['totalPoin'] / $data['totalSks'], 2, '.', '') : 0;
    $averageData[$semester] = (float) $averageIPK;
}

ksort($averageData);

$semesterLabels = array_keys($averageData);
$averageIPKValues = array_values($averageData);

$labelsJson = json_encode($semesterLabels);
$dataValuesJson = json_encode($averageIPKValues);

sqlsrv_free_stmt($stmt);

// Leaderboard
$AuthController = new AuthController($conn);
$leaderboard = $AuthController->getLeaderboardMahasiswa();

$topRanked = array_slice($leaderboard, 0, 3);

$remainingLeaderboard = array_slice($leaderboard, 3);
?>

<div style="margin-left: 317px; margin-right: 32px; margin-top: 90px; margin-bottom: 2rem;">
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

        <div class="col-md-6 d-flex">
            <div class="card mt-3 w-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center" style="margin-left: 24px; margin-right: 24px;">
                        <h4 class="fw-semibold mb-0">Rata-rata IPK Mahasiswa</h4>
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="filterAngkatan">
                                    <?php echo $selectedAngkatan ? "Angkatan $selectedAngkatan" : "Pilih Angkatan"; ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    $queryAngkatan = "SELECT DISTINCT tahun_angkatan FROM mahasiswa ORDER BY tahun_angkatan DESC";
                                    $stmtAngkatan = sqlsrv_query($conn, $queryAngkatan);
                                    if ($stmtAngkatan !== false) {
                                        while ($row = sqlsrv_fetch_array($stmtAngkatan, SQLSRV_FETCH_ASSOC)) {
                                            $tahunAngkatan = $row['tahun_angkatan'];

                                            $currentPage = isset($_GET['page']) ? $_GET['page'] : '';
                                            $url = "?page=" . urlencode($currentPage) . "&angkatan=" . urlencode($tahunAngkatan);

                                            echo '<li><a class="dropdown-item" href="' . htmlspecialchars($url) . '">' . htmlspecialchars($tahunAngkatan) . '</a></li>';
                                        }
                                    }
                                    sqlsrv_free_stmt($stmtAngkatan);
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <canvas id="ratarataipk" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 d-flex align-items-stretch">
        <!-- leaderboard -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center"
                        style="margin-left: 24px; margin-right: 24px;">
                        <h4 class="fw-semibold mb-0">Papan Peringkat</h4>
                        <div class="d-flex gap-2">

                            <a href="index.php?page=dosen_peringkat_akademik" class="btn btn-primary btn-peringkat" role="button">
                                Lihat Papan Peringkat
                            </a>
                        </div>
                    </div>
                    <div style="padding: 32px 12px 12px 12px;">
                        <div class="d-flex justify-content-start gap-3">
                            <!-- Juara 2 -->
                            <?php if (!empty($topRanked[1])): ?>
                                <div class="text-center align-items-center" style="width: 40%; padding: 18px 24px;">
                                    <div class="mb-3">
                                        <img src="<?= !empty($topRanked[1]['foto_mahasiswa']) ? $topRanked[1]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" style="max-width: 50%; height: auto; object-fit: cover;">
                                    </div>
                                    <div class="mb-3">
                                        <p class="fw-semibold mb-0" style="margin-bottom: 10px;"><?= $topRanked[1]['nama_mahasiswa']; ?></p>
                                        <p class="fw-light mb-0 text-muted d-flex align-items-center justify-content-center" style="height: 2.4rem; line-height: 1.2rem;">
                                            <?= $topRanked[1]['program_studi']; ?>
                                        </p>
                                    </div>
                                    <div class="rectangle d-flex justify-content-center align-items-center" style="padding-left: 6px;">
                                        <img src="../assets/img/piala.png" alt="" style="width: 36.4px; height: 37.22px; margin-right: 10px;">
                                        <p class="mb-0 text-center" style="color: #212529;">
                                            <span class="fw-semibold fs-5" style="color: #244282;"><?= number_format($topRanked[1]['IPK'], 2); ?></span> IPK
                                        </p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="text-center" style="width: 40%; padding: 18px 24px;">
                                    <p class="fw-semibold">Tidak ada data untuk ditampilkan</p>
                                </div>
                            <?php endif; ?>

                            <!-- Juara 1 -->
                            <?php if (!empty($topRanked[0])): ?>
                                <div class="text-center align-items-center" style="width: 40%; padding: 18px 24px;">
                                    <div class="mb-3">
                                        <img src="<?= !empty($topRanked[0]['foto_mahasiswa']) ? $topRanked[0]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" style="max-width: 50%; height: auto; object-fit: cover;">
                                    </div>
                                    <div class="mb-3">
                                        <p class="fw-semibold mb-0" style="margin-bottom: 10px;"><?= $topRanked[0]['nama_mahasiswa']; ?></p>
                                        <p class="fw-light mb-0 text-muted d-flex align-items-center justify-content-center" style="height: 2.4rem; line-height: 1.2rem;">
                                            <?= $topRanked[0]['program_studi']; ?>
                                        </p>
                                    </div>
                                    <div class="rectangle d-flex justify-content-center align-items-center" style="padding-left: 6px;">
                                        <img src="../assets/img/piala.png" alt="" style="width: 36.4px; height: 37.22px; margin-right: 10px;">
                                        <p class="mb-0 text-center" style="color: #212529;">
                                            <span class="fw-semibold fs-5" style="color: #244282;"><?= number_format($topRanked[0]['IPK'], 2); ?></span> IPK
                                        </p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="text-center" style="width: 40%; padding: 18px 24px;">
                                    <p class="fw-semibold">Tidak ada data untuk ditampilkan</p>
                                </div>
                            <?php endif; ?>

                            <!-- Juara 3 -->
                            <?php if (!empty($topRanked[2])): ?>
                                <div class="text-center align-items-center" style="width: 40%; padding: 18px 24px;">
                                    <div class="mb-3">
                                        <img src="<?= !empty($topRanked[2]['foto_mahasiswa']) ? $topRanked[2]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" style="max-width: 50%; height: auto; object-fit: cover;">
                                    </div>
                                    <div class="mb-3">
                                        <p class="fw-semibold mb-0" style="margin-bottom: 10px;"><?= $topRanked[2]['nama_mahasiswa']; ?></p>
                                        <p class="fw-light mb-0 text-muted d-flex align-items-center justify-content-center" style="height: 2.4rem; line-height: 1.2rem;">
                                            <?= $topRanked[2]['program_studi']; ?>
                                        </p>
                                    </div>
                                    <div class="rectangle d-flex justify-content-center align-items-center" style="padding-left: 6px;">
                                        <img src="../assets/img/piala.png" alt="" style="width: 36.4px; height: 37.22px; margin-right: 10px;">
                                        <p class="mb-0 text-center" style="color: #212529;">
                                            <span class="fw-semibold fs-5" style="color: #244282;"><?= number_format($topRanked[2]['IPK'], 2); ?></span> IPK
                                        </p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="text-center" style="width: 40%; padding: 18px 24px;">
                                    <p class="fw-semibold">Tidak ada data untuk ditampilkan</p>
                                </div>
                            <?php endif; ?>
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('ratarataipk').getContext('2d');

        const labels = <?php echo $labelsJson; ?>;
        const dataValues = <?php echo $dataValuesJson; ?>;

        const ratarataipk = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
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
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Semester'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Rata-rata IPK'
                        },
                        min: 0,
                        max: 4,
                        ticks: {
                            stepSize: 0.5
                        }
                    }
                }
            }
        });
    });
</script>

</body>

</html>