<?php
include 'partials/header.php';
include 'partials/sidenav.php';
$conn = require '../config/config.php';

require_once __DIR__ . '/../../controllers/AuthController.php';

$AuthController = new AuthController($conn);
$leaderboard = $AuthController->getLeaderboardMahasiswa();
$leaderboardNonAkademik = $AuthController->getLeaderboardNonAkademik();

$topRanked = array_slice($leaderboard, 0, 3);
$topRankedNonAkademik = array_slice($leaderboardNonAkademik, 0, 3);

$remainingLeaderboard = array_slice($leaderboard, 3);
$remainingLeaderboardNonAkademik = array_slice($leaderboardNonAkademik, 3);

$combinedLeaderboard = [];

foreach ($leaderboard as $mahasiswaAkademik) {
    $foundNonAkademik = false;

    foreach ($leaderboardNonAkademik as $mahasiswaNonAkademik) {
        if ($mahasiswaAkademik['NIM'] == $mahasiswaNonAkademik['NIM']) {

            $ipk = $mahasiswaAkademik['IPK'];

            $ipkPoints = floor($ipk * 10);

            $totalPoin = $ipkPoints + $mahasiswaNonAkademik['totalPoin'];

            $combinedLeaderboard[] = [
                'NIM' => $mahasiswaAkademik['NIM'],
                'nama_mahasiswa' => $mahasiswaAkademik['nama_mahasiswa'],
                'foto_mahasiswa' => $mahasiswaAkademik['foto_mahasiswa'],
                'IPK' => $mahasiswaAkademik['IPK'],
                'totalPoin' => $mahasiswaNonAkademik['totalPoin'],
                'poinTotal' => $totalPoin,
                'program_studi' => $mahasiswaAkademik['program_studi'],
            ];
            $foundNonAkademik = true;
            break;
        }
    }

    if (!$foundNonAkademik) {
        $ipk = $mahasiswaAkademik['IPK'];
        $ipkPoints = floor($ipk * 10);

        $combinedLeaderboard[] = [
            'NIM' => $mahasiswaAkademik['NIM'],
            'nama_mahasiswa' => $mahasiswaAkademik['nama_mahasiswa'],
            'foto_mahasiswa' => $mahasiswaAkademik['foto_mahasiswa'],
            'IPK' => $mahasiswaAkademik['IPK'],
            'totalPoin' => 0,
            'poinTotal' => $ipkPoints,
            'program_studi' => $mahasiswaAkademik['program_studi'],
        ];
    }
}

usort($combinedLeaderboard, function ($a, $b) {

    return $b['poinTotal'] <=> $a['poinTotal'];
});

$topRankedCombined = array_slice($combinedLeaderboard, 0, 3);

?>

<style>
    .table-leaderboard {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
    }

    .container-leaderboard {
        padding: 40px 20px;
        align-self: stretch;
    }

    .title {
        font-size: 24px;
        font-weight: bold;
        color: #17254E;
        text-align: center;
    }

    .title2 {
        font-size: 24px;
        font-weight: bold;
        color: #FEC01A;
    }

    .card-profile {
        border-radius: 15px;
        text-align: center;
        padding: 20px;
        background: #fff;
        width: 276px;
        height: 288px;
        margin: 0 auto;
    }

    .card-profile1 {
        border: 2px solid #FEC01A;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);

    }

    .card-profile2 {
        border: 2px solid #AEAEB2;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);

    }

    .card-profile3 {
        border: 2px solid #A36D1D;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);

    }

    .card-profile .profile-img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        margin-bottom: 15px;
    }

    .card-profile .name {
        font-size: 18px;
        font-weight: bold;
        color: #343a40;
    }

    .card-profile .id {
        font-size: 14px;
        color: #6c757d;
    }

    .card-profile .ipk {
        font-size: 16px;
        font-weight: bold;
        color: #343a40;
        margin-top: 10px;
    }

    .dropdown-menu {
        min-width: 150px;
    }

    .parent {
        padding: 50px;
    }

    .kon-text {
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .kon-card {
        justify-content: center;
        gap: 200px;
        margin: auto;
        display: flex;
    }

    .profile-container {
        display: flex;
        align-items: center;
    }

    .profile-img {
        border-radius: 8px;
        width: 40px;
        height: 40px;
    }

    .profile-text {
        padding: 2px;
        justify-content: center;
        align-items: center !important;
        gap: 10px;
        text-align: left;
    }

    .profile-text .name {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 0;
    }

    .profile-text .nim {
        font-size: 12px;
        color: #6c757d;
    }

    .card-profile1 .profile-img {
        border: 4px solid #FEC01A;

    }

    .card-profile2 .profile-img {
        border: 4px solid #AEAEB2;

    }

    .card-profile3 .profile-img {
        border: 4px solid #A36D1D;

    }
</style>
<div class="" style="margin-left: 317px; margin-right: 32px; margin-top: 90px;">
    <div style="margin-bottom: 17.5px;">
        <h4 class="fw-semibold">Pengumuman</h4>
        <h6 class="fw-medium text-muted">Home - Pengumuman</h6>
    </div>
    <div class="d-flex justify-content-center mt-3" style="gap: 16px;">
        <div class="d-flex gap-3">
            <button class="btn btn-outline-primary tab-btn active" data-tab="akademik">Akademik</button>
            <button class="btn btn-outline-secondary tab-btn" data-tab="non-akademik">Non-Akademik</button>
            <button class="btn btn-outline-secondary tab-btn" data-tab="semua">Semua</button>
            <!-- Tombol buka Modal -->
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#infoModal">
                <i class="bi bi-info-circle"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="infoModalLabel">Proses Perhitungan Akademik + Non-Akademik</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Perhitungan <strong>Akademik + Non-Akademik</strong> dilakukan dengan logika berikut:</p>
                            <ul>
                                <li><strong>Akademik:</strong> Nilai IPK mahasiswa diubah menjadi poin berdasarkan rentang nilai berikut:
                                    <ul>
                                        <li>IPK 0.00 - 0.10 = 1 poin</li>
                                        <li>IPK 0.11 - 0.20 = 2 poin</li>
                                        <li>IPK 0.21 - 0.30 = 3 poin</li>
                                        <li>IPK 0.31 - 0.40 = 4 poin</li>
                                        <li>IPK 0.41 - 0.50 = 5 poin</li>
                                        <li>IPK 0.51 - 0.60 = 6 poin</li>
                                        <li>IPK 0.61 - 0.70 = 7 poin</li>
                                        <li>IPK 0.71 - 0.80 = 8 poin</li>
                                        <li>IPK 0.81 - 0.90 = 9 poin</li>
                                        <li>IPK 0.91 - 1.00 = 10 poin</li>
                                        <li>... (dan seterusnya hingga IPK 4.00 = 40 poin)</li>
                                    </ul>
                                </li>
                                <li><strong>Non-Akademik:</strong> Poin non-akademik didapat dari prestasi mahasiswa dalam kompetisi yang diikuti. Perhitungan poin didasarkan pada tingkat kompetisi dan juara yang diperoleh, dengan logika berikut:
                                    <ul>
                                        <li><strong>Internasional:</strong>
                                            <ul>
                                                <li>Juara 1 = 8 poin</li>
                                                <li>Juara 2 = 7 poin</li>
                                                <li>Juara 3 = 6 poin</li>
                                            </ul>
                                        </li>
                                        <li><strong>Nasional:</strong>
                                            <ul>
                                                <li>Juara 1 = 6 poin</li>
                                                <li>Juara 2 = 5 poin</li>
                                                <li>Juara 3 = 4 poin</li>
                                            </ul>
                                        </li>
                                        <li><strong>Provinsi:</strong>
                                            <ul>
                                                <li>Juara 1 = 5 poin</li>
                                                <li>Juara 2 = 4 poin</li>
                                                <li>Juara 3 = 3 poin</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <p><strong>Rumus:</strong></p>
                            <pre>Akademik + Non-Akademik = Poin Akademik + Poin Non-Akademik</pre>
                            <p><strong>Contoh:</strong></p>
                            <p>Misalnya, seorang mahasiswa memiliki IPK 3.50, yang sesuai dengan 35 poin akademik, dan menjadi Juara 1 dalam kompetisi tingkat Nasional. Maka perhitungan totalnya adalah:</p>
                            <pre>35 (Akademik) + 6 (Non-Akademik) = 41 poin</pre>
                            <p>Jadi, total Akademik + Non-Akademik mahasiswa tersebut adalah 41 poin.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Konten Tab -->
    <div id="tab-content" class="mt-4 mb-4">
        <!-- Tab Akademik -->
        <div id="akademik-content" class="tab-pane">
            <div class="row d-flex justify-content-center align-items-end">
                <!-- Juara 2 -->
                <?php if (!empty($topRanked[1])): ?>
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="card-profile card-profile2">
                            <img src="<?= !empty($topRanked[1]['foto_mahasiswa']) ? $topRanked[1]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" class="profile-img">
                            <div class="name"><?= $topRanked[1]['nama_mahasiswa']; ?></div>
                            <div class="id"><?= $topRanked[1]['NIM']; ?></div>
                            <div class="prodi"><?= $topRanked[1]['program_studi']; ?></div> <!-- Menampilkan program studi -->
                            <div class="ipk">IPK <?= number_format($topRanked[1]['IPK'], 2); ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Juara 1 -->
                <?php if (!empty($topRanked[0])): ?>
                    <div class="col-md-2 d-flex justify-content-center">
                        <div class="card-profile card-profile1">
                            <img src="<?= !empty($topRanked[0]['foto_mahasiswa']) ? $topRanked[0]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" class="profile-img">
                            <div class="name"><?= $topRanked[0]['nama_mahasiswa']; ?></div>
                            <div class="id"><?= $topRanked[0]['NIM']; ?></div>
                            <div class="prodi"><?= $topRanked[0]['program_studi']; ?></div> <!-- Menampilkan program studi -->
                            <div class="ipk">IPK <?= number_format($topRanked[0]['IPK'], 2); ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Juara 3 -->
                <?php if (!empty($topRanked[2])): ?>
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="card-profile card-profile3">
                            <img src="<?= !empty($topRanked[2]['foto_mahasiswa']) ? $topRanked[2]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" class="profile-img">
                            <div class="name"><?= $topRanked[2]['nama_mahasiswa']; ?></div>
                            <div class="id"><?= $topRanked[2]['NIM']; ?></div>
                            <div class="prodi"><?= $topRanked[2]['program_studi']; ?></div> <!-- Menampilkan program studi -->
                            <div class="ipk">IPK <?= number_format($topRanked[2]['IPK'], 2); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="card p-4 mt-5">
                <div class="table-container">
                    <table class="table table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">Peringkat</th>
                                <th class="text-start">Nama</th>
                                <th class="text-center">Jurusan</th>
                                <th class="text-center">IPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($remainingLeaderboard)): ?>
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data untuk ditampilkan</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($remainingLeaderboard as $index => $student): ?>
                                    <tr>
                                        <td><?= $index + 4; ?></td>
                                        <td class="text-start">
                                            <div class="d-flex align-items-center justify-content-start gap-2">
                                                <img src="<?= !empty($student['foto_mahasiswa']) ? $student['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Foto Profil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                                <div>
                                                    <p class="mb-0 fw-bold"><?= $student['nama_mahasiswa']; ?></p>
                                                    <p class="mb-0 text-muted small"><?= $student['NIM']; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $student['program_studi']; ?></td>
                                        <td><?= number_format($student['IPK'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab Non-Akademik -->
        <div id="non-akademik-content" class="tab-pane">
            <div class="row d-flex justify-content-center align-items-end">
                <!-- Juara 2 -->
                <?php if (!empty($topRankedNonAkademik[1])): ?>
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="card-profile card-profile2">
                            <img src="<?= !empty($topRankedNonAkademik[1]['foto_mahasiswa']) ? $topRankedNonAkademik[1]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" class="profile-img">
                            <div class="name"><?= $topRankedNonAkademik[1]['nama_mahasiswa']; ?></div>
                            <div class="id"><?= $topRankedNonAkademik[1]['NIM']; ?></div>
                            <div class="prodi"><?= $topRankedNonAkademik[1]['program_studi']; ?></div>
                            <div class="ipk">Poin <?= number_format($topRankedNonAkademik[1]['totalPoin'], 0); ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Juara 1 -->
                <?php if (!empty($topRankedNonAkademik[0])): ?>
                    <div class="col-md-2 d-flex justify-content-center">
                        <div class="card-profile card-profile1">
                            <img src="<?= !empty($topRankedNonAkademik[0]['foto_mahasiswa']) ? $topRankedNonAkademik[0]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" class="profile-img">
                            <div class="name"><?= $topRankedNonAkademik[0]['nama_mahasiswa']; ?></div>
                            <div class="id"><?= $topRankedNonAkademik[0]['NIM']; ?></div>
                            <div class="prodi"><?= $topRankedNonAkademik[0]['program_studi']; ?></div> <!-- Menampilkan program studi -->
                            <div class="ipk">Poin <?= number_format($topRankedNonAkademik[0]['totalPoin'], 0); ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Juara 3 -->
                <?php if (!empty($topRankedNonAkademik[2])): ?>
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="card-profile card-profile3">
                            <img src="<?= !empty($topRankedNonAkademik[2]['foto_mahasiswa']) ? $topRankedNonAkademik[2]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" class="profile-img">
                            <div class="name"><?= $topRankedNonAkademik[2]['nama_mahasiswa']; ?></div>
                            <div class="id"><?= $topRankedNonAkademik[2]['NIM']; ?></div>
                            <div class="prodi"><?= $topRankedNonAkademik[2]['program_studi']; ?></div>
                            <div class="ipk">Poin <?= number_format($topRankedNonAkademik[2]['totalPoin'], 0); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="card p-4 mt-5">
                <div class="table-container">
                    <table class="table table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">Peringkat</th>
                                <th class="text-start">Nama</th>
                                <th class="text-center">Program Studi</th>
                                <th class="text-center">Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($remainingLeaderboardNonAkademik)): ?>
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data untuk ditampilkan</td>
                                </tr>
                            <?php else: ?>
                                <?php
                                $rank = 4;
                                $topStudents = array_slice($remainingLeaderboardNonAkademik, 0, 3);
                                foreach ($topStudents as $row):
                                ?>
                                    <tr>
                                        <td><?= $rank++; ?></td>
                                        <td class="text-start">
                                            <div class="d-flex align-items-center justify-content-start gap-2">
                                                <img src="<?= !empty($row['foto_mahasiswa']) ? $row['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Foto Profil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                                <div>
                                                    <p class="mb-0 fw-bold"><?= $row['nama_mahasiswa']; ?></p>
                                                    <p class="mb-0 text-muted small"><?= $row['NIM']; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $row['program_studi']; ?></td>
                                        <td><?= $row['totalPoin']; ?></td>
                                    </tr>
                                <?php endforeach; ?>

                                <?php
                                $remainingStudents = array_slice($remainingLeaderboardNonAkademik, 3);
                                foreach ($remainingStudents as $row):
                                ?>
                                    <tr>
                                        <td><?= $rank++; ?></td>
                                        <td class="text-start">
                                            <div class="d-flex align-items-center justify-content-start gap-2">
                                                <img src="<?= !empty($row['foto_mahasiswa']) ? $row['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Foto Profil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                                <div>
                                                    <p class="mb-0 fw-bold"><?= $row['nama_mahasiswa']; ?></p>
                                                    <p class="mb-0 text-muted small"><?= $row['NIM']; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $row['program_studi']; ?></td>
                                        <td><?= $row['totalPoin']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab Semua -->
        <div id="semua-content" class="tab-pane">
            <div class="row d-flex justify-content-center align-items-end">
                <!-- Juara 2 -->
                <?php if (!empty($topRankedCombined[1])): ?>
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="card-profile card-profile2">
                            <img src="<?= !empty($topRankedCombined[1]['foto_mahasiswa']) ? $topRankedCombined[1]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" class="profile-img">
                            <div class="name"><?= $topRankedCombined[1]['nama_mahasiswa']; ?></div>
                            <div class="id"><?= $topRankedCombined[1]['NIM']; ?></div>
                            <div class="prodi"><?= $topRankedCombined[1]['program_studi']; ?></div>
                            <div class="ipk">Poin: <?= number_format($topRankedCombined[1]['poinTotal'], 0); ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Juara 1 -->
                <?php if (!empty($topRankedCombined[0])): ?>
                    <div class="col-md-2 d-flex justify-content-center">
                        <div class="card-profile card-profile1">
                            <img src="<?= !empty($topRankedCombined[0]['foto_mahasiswa']) ? $topRankedCombined[0]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" class="profile-img">
                            <div class="name"><?= $topRankedCombined[0]['nama_mahasiswa']; ?></div>
                            <div class="id"><?= $topRankedCombined[0]['NIM']; ?></div>
                            <div class="prodi"><?= $topRankedCombined[0]['program_studi']; ?></div>
                            <div class="ipk">Poin: <?= number_format($topRankedCombined[0]['poinTotal'], 0); ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Juara 3 -->
                <?php if (!empty($topRankedCombined[2])): ?>
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="card-profile card-profile3">
                            <img src="<?= !empty($topRankedCombined[2]['foto_mahasiswa']) ? $topRankedCombined[2]['foto_mahasiswa'] : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Profile Image" class="profile-img">
                            <div class="name"><?= $topRankedCombined[2]['nama_mahasiswa']; ?></div>
                            <div class="id"><?= $topRankedCombined[2]['NIM']; ?></div>
                            <div class="prodi"><?= $topRankedCombined[2]['program_studi']; ?></div>
                            <div class="ipk">Poin: <?= number_format($topRankedCombined[2]['poinTotal'], 0); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tabel untuk leaderboard -->
            <div class="card p-4 mt-5">
                <div class="table-container">
                    <table class="table table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">Peringkat</th>
                                <th class="text-start">Nama</th>
                                <th class="text-center">Jurusan</th>
                                <th class="text-center">Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($combinedLeaderboard as $index => $rank) {

                                if ($index < 3) {
                                    continue;
                                }

                                $rankNumber = $index + 1;

                            ?>
                                <tr>
                                    <td><?php echo $rankNumber; ?></td>
                                    <td class="text-start">
                                        <div class="d-flex align-items-center justify-content-start gap-2">
                                            <img src="<?php echo $rank['foto_mahasiswa'] ?? 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; ?>" alt="Foto Profil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <p class="mb-0 fw-bold"><?php echo $rank['nama_mahasiswa']; ?></p>
                                                <p class="mb-0 text-muted small">NIM: <?php echo $rank['NIM']; ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $rank['program_studi']; ?></td>
                                    <td><?php echo $rank['poinTotal']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabButtons = document.querySelectorAll(".tab-btn");

        tabButtons.forEach(button => {
            button.addEventListener("click", () => {

                tabButtons.forEach(btn => {
                    btn.classList.remove("active");
                    btn.classList.add("btn-outline-secondary");
                    btn.classList.remove("btn-primary");
                });

                button.classList.add("active");
                button.classList.remove("btn-outline-secondary");
                button.classList.add("btn-primary");
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabButtons = document.querySelectorAll(".tab-btn");
        const tabContents = document.querySelectorAll(".tab-pane");

        tabContents.forEach(content => content.classList.add("d-none"));
        tabButtons[0].classList.replace("btn-outline-secondary", "btn-primary");
        document.getElementById(tabButtons[0].dataset.tab + "-content").classList.remove("d-none");

        tabButtons.forEach(button => {
            button.addEventListener("click", () => {

                tabButtons.forEach(btn => btn.classList.replace("btn-primary", "btn-outline-secondary"));
                tabContents.forEach(content => content.classList.add("d-none"));

                button.classList.replace("btn-outline-secondary", "btn-primary");
                const targetTab = document.getElementById(button.dataset.tab + "-content");
                if (targetTab) {
                    targetTab.classList.remove("d-none");
                }
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>