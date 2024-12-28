<?php
include 'partials/header.php';

require_once __DIR__ . '/../../controllers/AuthController.php';
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

<div class="container-leaderboard" style="margin-top: 5rem;">
    <div class="text-center">
        <h3 class="title">Most Accomplished</h3>
        <h3 class="title2">Students</h3>
    </div>

    <div class="d-flex justify-content-center mt-3" style="gap: 16px;">
        <div class="d-flex gap-3">
            <button class="btn btn-outline-primary tab-btn active" data-tab="akademik">Akademik</button>
            <button class="btn btn-outline-secondary tab-btn" data-tab="non-akademik">Non-Akademik</button>
            <button class="btn btn-outline-secondary tab-btn" data-tab="semua">Semua</button>
        </div>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle shadow-sm" style="background-color: #EAEDEF; border: none; color: #212529;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Tahun Ajar
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">2024/2025 Ganjil</a></li>
                <li><a class="dropdown-item" href="#">2024/2025 Genap</a></li>
            </ul>
        </div>
    </div>

    <!-- Konten Tab -->
    <div id="tab-content" class="mt-4 mb-4">
        <!-- Tab Akademik -->
        <div id="akademik-content" class="tab-pane">
            <div class="row d-flex justify-content-center align-items-end">
                <!-- Juara 2 -->
                <div class="col-md-3 d-flex justify-content-center">
                    <div class="card-profile card-profile2">
                        <img src="<?= !empty($topRanked[1]['foto_mahasiswa']) ? $topRanked[1]['foto_mahasiswa'] : 'default-image.jpg'; ?>" alt="Profile Image" class="profile-img">
                        <div class="name"><?= $topRanked[1]['nama_mahasiswa']; ?></div>
                        <div class="id"><?= $topRanked[1]['NIM']; ?></div>
                        <div class="ipk">IPK <?= number_format($topRanked[1]['IPK'], 2); ?></div>
                        <div class="prodi"><?= $topRanked[1]['program_studi']; ?></div> <!-- Menampilkan program studi -->
                    </div>
                </div>
                <!-- Juara 1 -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card-profile card-profile1">
                        <img src="<?= !empty($topRanked[0]['foto_mahasiswa']) ? $topRanked[0]['foto_mahasiswa'] : 'default-image.jpg'; ?>" alt="Profile Image" class="profile-img">
                        <div class="name"><?= $topRanked[0]['nama_mahasiswa']; ?></div>
                        <div class="id"><?= $topRanked[0]['NIM']; ?></div>
                        <div class="ipk">IPK <?= number_format($topRanked[0]['IPK'], 2); ?></div>
                        <div class="prodi"><?= $topRanked[0]['program_studi']; ?></div> <!-- Menampilkan program studi -->
                    </div>
                </div>
                <!-- Juara 3 -->
                <div class="col-md-3 d-flex justify-content-center">
                    <div class="card-profile card-profile3">
                        <img src="<?= !empty($topRanked[2]['foto_mahasiswa']) ? $topRanked[2]['foto_mahasiswa'] : 'default-image.jpg'; ?>" alt="Profile Image" class="profile-img">
                        <div class="name"><?= $topRanked[2]['nama_mahasiswa']; ?></div>
                        <div class="id"><?= $topRanked[2]['NIM']; ?></div>
                        <div class="ipk">IPK <?= number_format($topRanked[2]['IPK'], 2); ?></div>
                        <div class="prodi"><?= $topRanked[2]['program_studi']; ?></div> <!-- Menampilkan program studi -->
                    </div>
                </div>

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
                            <?php foreach ($remainingLeaderboard as $index => $student): ?>
                                <tr>
                                    <td><?= $index + 4; ?></td>
                                    <td class="text-start">
                                        <div class="d-flex align-items-center justify-content-start gap-2">
                                            <img src="<?= !empty($student['foto_mahasiswa']) ? $student['foto_mahasiswa'] : 'default-image.jpg'; ?>" alt="Foto Profil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab Non-Akademik -->
        <div id="non-akademik-content" class="tab-pane">
            <div class="row d-flex justify-content-center align-items-end">
                <!-- Juara 2 -->
                <div class="col-md-3 d-flex justify-content-center">
                    <div class="card-profile card-profile2">
                        <img src="default-image.jpg" alt="Profile Image" class="profile-img">
                        <div class="name">Nama Mahasiswa 2</div>
                        <div class="id">NIM 2</div>
                        <div class="ipk">IPK 3.50</div>
                    </div>
                </div>
                <!-- Juara 1 -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card-profile card-profile1">
                        <img src="default-image.jpg" alt="Profile Image" class="profile-img">
                        <div class="name">Nama Mahasiswa 1</div>
                        <div class="id">NIM 1</div>
                        <div class="ipk">IPK 3.75</div>
                    </div>
                </div>
                <!-- Juara 3 -->
                <div class="col-md-3 d-flex justify-content-center">
                    <div class="card-profile card-profile3">
                        <img src="default-image.jpg" alt="Profile Image" class="profile-img">
                        <div class="name">Nama Mahasiswa 3</div>
                        <div class="id">NIM 3</div>
                        <div class="ipk">IPK 3.40</div>
                    </div>
                </div>
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
                            <tr>
                                <td>4</td>
                                <td class="text-start">
                                    <div class="d-flex align-items-center justify-content-start gap-2">
                                        <img src="default-image.jpg" alt="Foto Profil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div>
                                            <p class="mb-0 fw-bold">Nama Mahasiswa 4</p>
                                            <p class="mb-0 text-muted small">NIM 4</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Jurusan A</td>
                                <td>3.20</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td class="text-start">
                                    <div class="d-flex align-items-center justify-content-start gap-2">
                                        <img src="default-image.jpg" alt="Foto Profil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div>
                                            <p class="mb-0 fw-bold">Nama Mahasiswa 5</p>
                                            <p class="mb-0 text-muted small">NIM 5</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Jurusan B</td>
                                <td>3.15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab Semua -->
        <div id="semua-content" class="tab-pane">
            <div class="row d-flex justify-content-center align-items-end">
                <!-- Juara 2 -->
                <div class="col-md-3 d-flex justify-content-center">
                    <div class="card-profile card-profile2">
                        <img src="default-image.jpg" alt="Profile Image" class="profile-img">
                        <div class="name">Nama Mahasiswa 2</div>
                        <div class="id">NIM 2</div>
                        <div class="ipk">IPK 3.50</div>
                    </div>
                </div>
                <!-- Juara 1 -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card-profile card-profile1">
                        <img src="default-image.jpg" alt="Profile Image" class="profile-img">
                        <div class="name">Nama Mahasiswa 1</div>
                        <div class="id">NIM 1</div>
                        <div class="ipk">IPK 3.75</div>
                    </div>
                </div>
                <!-- Juara 3 -->
                <div class="col-md-3 d-flex justify-content-center">
                    <div class="card-profile card-profile3">
                        <img src="default-image.jpg" alt="Profile Image" class="profile-img">
                        <div class="name">Nama Mahasiswa 3</div>
                        <div class="id">NIM 3</div>
                        <div class="ipk">IPK 3.40</div>
                    </div>
                </div>
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
                            <tr>
                                <td>4</td>
                                <td class="text-start">
                                    <div class="d-flex align-items-center justify-content-start gap-2">
                                        <img src="default-image.jpg" alt="Foto Profil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div>
                                            <p class="mb-0 fw-bold">Nama Mahasiswa 4</p>
                                            <p class="mb-0 text-muted small">NIM 4</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Jurusan A</td>
                                <td>3.20</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td class="text-start">
                                    <div class="d-flex align-items-center justify-content-start gap-2">
                                        <img src="default-image.jpg" alt="Foto Profil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div>
                                            <p class="mb-0 fw-bold">Nama Mahasiswa 5</p>
                                            <p class="mb-0 text-muted small">NIM 5</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Jurusan B</td>
                                <td>3.15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<?php include 'partials/footer.php'; ?>