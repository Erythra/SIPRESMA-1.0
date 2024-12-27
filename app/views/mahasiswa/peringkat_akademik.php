<?php
include 'partials/header.php';

$semester = isset($_GET['smt']) ? $_GET['smt'] : 3;

require_once __DIR__ . '/../../controllers/AuthController.php';

$AuthController = new AuthController($conn);

if (!isset($_SESSION['user'])) {
    echo "<div class='alert alert-danger text-center' role='alert'>
            Data pengguna tidak ditemukan. Silakan login kembali.
          </div>";
    exit;
}

$AuthController = new AuthController($conn);
$leaderboard = $AuthController->getLeaderboardMahasiswa($semester);

$topRanked = array_slice($leaderboard, 0, 3);
$remainingLeaderboard = array_slice($leaderboard, 3);
?>

<style>
    .table-leaderboard {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
    }

    body {
        background-color: #F5F2FE;
        font-family: Arial, sans-serif;
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
        border-radius: 10px;
        text-align: center;
        padding: 20px;
        background: #fff;
        width: 276px;
        height: 288px;
        margin: 0 auto;
    }

    .card-profile1 {
        border: 2px solid #FEC01A;
    }

    .card-profile2 {
        border: 2px solid #AEAEB2;
    }

    .card-profile3 {
        border: 2px solid #A36D1D;
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
</style>


<body>
    <div class="info">
        <p class="info-text">Home - Papan Peringkat - Akademik</p>
    </div>

    <div class="container-leaderboard">
        <div class="text-center">
            <h3 class="title">Most Accomplished</h3>
            <h3 class="title2">Students</h3>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="d-flex gap-3">
                <button class="btn btn-outline-primary">Akademik</button>
                <button class="btn btn-outline-secondary">Non-Akademik</button>
                <button class="btn btn-outline-secondary">Semua</button>
            </div>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle shadow-sm" style="background-color: #EAEDEF; border: none; color: #212529;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Tahun Ajar
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="index.php?page=peringkat_akademik&smt=3" <?= isset($_GET['smt']) && $_GET['smt'] == 3 ? 'class="active"' : ''; ?>>2024/2025 Ganjil</a></li>
                    <li><a class="dropdown-item" href="index.php?page=peringkat_akademik&smt=2" <?= isset($_GET['smt']) && $_GET['smt'] == 2 ? 'class="active"' : ''; ?>>2024/2025 Genap</a></li>
                </ul>
            </div>
        </div>

        <div class="row mt-4 mb-4 d-flex justify-content-center">
            <?php foreach ($topRanked as $index => $student): ?>
                <div class="col-md-4">
                    <div class="card-profile <?= ($index == 0) ? 'card-profile1' : (($index == 1) ? 'card-profile2' : 'card-profile3'); ?>">
                        <img src="<?= !empty($student['foto_mahasiswa']) ? $student['foto_mahasiswa'] : 'default-image.jpg'; ?>" alt="Profile Image" class="profile-img">
                        <div class="name"><?= $student['nama_mahasiswa']; ?></div>
                        <div class="id"><?= $student['NIM']; ?></div>
                        <div class="ipk">IPK <?= number_format($student['IPK'], 2); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="card p-4">
            <div class="table-container">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th style="text-align: left;">Nama</th>
                            <th>Jurusan</th>
                            <th>IPK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($remainingLeaderboard as $index => $student): ?>
                            <tr class="text-center">
                                <td><?= $index + 4; ?></td>
                                <td>
                                    <div class="profile-container gap-2">
                                        <img src="<?= !empty($student['foto_mahasiswa']) ? $student['foto_mahasiswa'] : 'default-image.jpg'; ?>" alt="Foto Profil" class="profile-img">
                                        <div class="profile-text">
                                            <p class="name"><?= $student['nama_mahasiswa']; ?></p>
                                            <p class="nim"><?= $student['NIM']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $student['program_studi']; ?></td>
                                <td><?= number_format($student['IPK'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <select class="form-select" style="width: 70px;">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a aria-label="Previous" class="page-link" href="#">
                                <span aria-hidden="true">«</span>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">...</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">10</a>
                        </li>
                        <li class="page-item">
                            <a aria-label="Next" class="page-link" href="#">
                                <span aria-hidden="true">»</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <?php include 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>