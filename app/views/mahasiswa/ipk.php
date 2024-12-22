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
    $id_mahasiswa = $_SESSION['user']['id_mahasiswa'];
    $mataKuliahData = $AuthController->getDaftarMataKuliah($id_mahasiswa, $semester);
    $ipk = $AuthController->hitungIPK($mataKuliahData);
    $ips = $AuthController->hitungIPS($id_mahasiswa);
    echo "<script>console.log(" . json_encode($mataKuliahData) . ");</script>";
    if (empty($mataKuliahData)) {
        echo "<div class='alert alert-warning text-center' role='alert'>
                tes.
              </div>";
        exit();
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.8"></script>
<link rel="stylesheet" href="./../../../assets/css/style.css">
<style>
table.table-hover tbody tr td {
    color: #6C757D !important;
    font-weight: lighter !important;
}

table.table-hover thead th {
    color: #475261 !important;
}

table tbody td:nth-child(3),
table thead th:nth-child(3) {
    text-align: left;
}
</style>
<div class="info">
    <p class="info-text">Home - IPK</p>
</div>

<div class="card p-4" style="margin: 50px 84px 50px 84px;">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h5 class="card-title fw-semibold mb-0 fs-4" style="color: #475261;">
            List Data IPK
        </h5>
    </div>
    <div class="d-flex align-items-center justify-content-between gap-3">
        <div class="d-flex justify-content-start align-items-center mb-4">
            <h5 class="card-title fw-semibold mb-0 fs-5" style="color: #475261;">
                IPK : <?php echo $ips; ?>
            </h5>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle shadow-sm"
                    style="background-color: #EAEDEF; border: none; color: #212529;" type="button"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Tahun Ajar
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="index.php?page=ipk&smt=3">2024/2025 Ganjil</a></li>
                <li><a class="dropdown-item" href="index.php?page=ipk&smt=2">2024/2025 Genap</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div>
        <h5 class="mb-2" style="font-weight: bold; color: #475261;">Indeks Prestasi Semester: <?php echo $ipk; ?>
        </h5></h5>
    </div>
    <br>
    <table class="table table-hover text-center" style="color: #ADB5BD;">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Jam</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($mataKuliahData)) : ?>
            <?php foreach ($mataKuliahData as $ipk) : ?>
                <tr>
            <td><?= isset($ipk['No']) ? htmlspecialchars($ipk['No']) : 'N/A'; ?></td>
            <td><?= isset($ipk['Kode_MK']) ? htmlspecialchars($ipk['Kode_MK']) : 'N/A'; ?></td>
            <td><?= isset($ipk['Mata_Kuliah']) ? htmlspecialchars($ipk['Mata_Kuliah']) : 'N/A'; ?></td>
            <td><?= isset($ipk['SKS']) ? htmlspecialchars($ipk['SKS']) : 'N/A'; ?></td>
            <td><?= isset($ipk['Jam']) ? htmlspecialchars($ipk['Jam']) : 'N/A'; ?></td>
            <td><?= isset($ipk['Nilai']) ? htmlspecialchars($ipk['Nilai']) : 'N/A'; ?></td>
        </tr>
            <?php endforeach; ?>
            <?php else : ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada data ipk tersedia.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php include 'partials/footer.php'; ?>