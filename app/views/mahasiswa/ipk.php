<?php
include 'partials/header.php';

$id_mahasiswa = $_SESSION['user']['id_mahasiswa'];

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
    /* Kolom "Mata Kuliah" */
    table thead th:nth-child(3) {
        text-align: left;
    }
</style>


<div class="card p-4" style="margin: 50px 84px 50px 84px; margin-top: 8rem;">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h5 class="card-title fw-semibold mb-0 fs-4" style="color: #475261;">
            List Data IPK
        </h5>
    </div>
    <div class="d-flex align-items-center justify-content-between gap-3">
        <div class="d-flex justify-content-start align-items-center mb-4">
            <h5 class="card-title fw-semibold mb-0 fs-5" style="color: #475261;">
                IPK : 4.0
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
                    <li><a class="dropdown-item" href="index.php?page=profile">2024/2025 Ganjil</a></li>
                    <li><a class="dropdown-item" href="index.php?action=logout">2024/2025 Genap</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div>
        <h5 class="mb-2" style="font-weight: bold; color: #475261;">Indeks Prestasi Semester: 4.00</h5>
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
            <?php if (!empty($ipkList)) : ?>
                <?php foreach ($ipkList as $ipk) : ?>
                    <tr>
                        <td><?= htmlspecialchars($ipk['id_ipk']); ?></td>
                        <td><?= htmlspecialchars($ipk['kode_matakuliah']); ?></td>
                        <td><?= htmlspecialchars($ipk['matakuliah']); ?></td>
                        <td><?= htmlspecialchars($ipk['sks']); ?></td>
                        <td><?= htmlspecialchars($ipk['jam']); ?></td>
                        <td><?= htmlspecialchars($ipk['nilai']); ?></td>
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