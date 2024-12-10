<?php
include 'partials/header.php';

$prestasiController = new PrestasiController($conn);
$id_mahasiswa = $_SESSION['user']['id_mahasiswa'];

// Fetch all prestasi data
$prestasiList = $prestasiController->showPrestasi($id_mahasiswa);

?>

<div class="info">
    <p class="info-text">Home - Prestasi</p>
</div>

<div class="card p-4" style="margin: 50px 84px 50px 84px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold mb-0 fs-4" style="color: #475261;">
            List Prestasi
        </h5>
        <div class="d-flex align-items-center gap-3">
            <div class="input-group" style="max-width: 300px;">
                <button class="btn btn-primary" type="button"
                    style="color: white; background-color: #244282; outline: none; border: none;">
                    <i class="fas fa-search"></i>
                </button>
                <input class="form-control" id="searchInput" placeholder="Search Prestasi" type="text" />
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-primary d-flex justify-content-center align-items-center gap-2"
                    style="color: white; background-color: #244282; outline: none; border: none;">
                    <i class="fas fa-plus"></i>
                    <a href="index.php?page=tambahprestasi" style="text-decoration: none; color: white;">
                        <p class="mb-0">Tambah</p>
                    </a>
                </button>
            </div>
        </div>
    </div>
    <table class="table table-hover" id="prestasiTable">
        <thead>
            <tr>
                <th>Juara</th>
                <th>Lomba</th>
                <th>Tingkat</th>
                <th>Tempat Kompetisi</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($prestasiList)) : ?>
            <?php foreach ($prestasiList as $prestasi) : ?>
            <tr class="prestasiRow">
                <td class="align-middle text-left">
                    <?= htmlspecialchars($prestasi['juara']); ?>
                </td>
                <td class="align-middle text-left">
                    <?= htmlspecialchars($prestasi['jenis_kompetisi']); ?>
                </td>
                <td class="align-middle text-left">
                    <?= htmlspecialchars($prestasi['tingkat_kompetisi']); ?>
                </td>
                <td class="align-middle text-left">
                    <?= htmlspecialchars($prestasi['tempat_kompetisi']); ?>
                </td>
                <td class="align-middle text-left">
                    <span style="background-color: <?= 
                        $prestasi['status_pengajuan'] === 'disetujui' ? '#DCFCE7' : 
                        ($prestasi['status_pengajuan'] === 'ditolak' ? '#FEE2E2' : '#EAEDEF'); ?>; 
                        color: <?= 
                        $prestasi['status_pengajuan'] === 'disetujui' ? '#166534' : 
                        ($prestasi['status_pengajuan'] === 'ditolak' ? '#991B1B' : '#212529'); ?>; 
                        padding: 4px 8px; 
                        border-radius: 4px; 
                        font-size: 14px; 
                        font-weight: bold;
                        display: inline-block;">
                        <?= htmlspecialchars($prestasi['status_pengajuan']); ?>
                    </span>
                </td>
                <td class="align-middle text-left">
                    <div class="d-flex align-items-center justify-content-start gap-1">
                        <a href="index.php?page=prestasidetail&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>" class="btn btn-outline-primary btn-xs">
                            <i class="fas fa-file-alt"></i>
                        </a>
                        <a href="edit.php?id=<?= $prestasi['id_prestasi']; ?>" class="btn btn-outline-warning btn-xs">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
            <tr>
                <td colspan="7" class="text-center">
                    Tidak ada data prestasi tersedia.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <select class="form-select" id="pageSize" style="width: 70px;">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination" id="pagination">
                <li class="page-item" id="prevPage">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
                <li class="page-item" id="page1" class="active">
                    <a class="page-link" href="#">1</a>
                </li>
                <!-- Additional pages will be dynamically generated by JavaScript -->
                <li class="page-item" id="nextPage">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('.prestasiRow');
        const pageSizeSelect = document.getElementById('pageSize');
        const pagination = document.getElementById('pagination');
        const searchInput = document.getElementById('searchInput');

        let currentPage = 1;
        let pageSize = parseInt(pageSizeSelect.value);
        let totalRows = rows.length;
        let totalPages = Math.ceil(totalRows / pageSize);

        function renderPagination() {
            pagination.innerHTML = `
                <li class="page-item" id="prevPage">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>`;

            for (let i = 1; i <= totalPages; i++) {
                pagination.innerHTML += `
                    <li class="page-item" id="page${i}">
                        <a class="page-link" href="#">${i}</a>
                    </li>`;
            }

            pagination.innerHTML += `
                <li class="page-item" id="nextPage">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>`;

            // Add event listeners for page navigation
            for (let i = 1; i <= totalPages; i++) {
                const pageItem = document.getElementById(`page${i}`);
                pageItem.addEventListener('click', function () {
                    currentPage = i;
                    renderTable();
                    renderPagination();
                });
            }

            document.getElementById('prevPage').addEventListener('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    renderTable();
                    renderPagination();
                }
            });

            document.getElementById('nextPage').addEventListener('click', function () {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                    renderPagination();
                }
            });
        }

        function renderTable() {
            const startIndex = (currentPage - 1) * pageSize;
            const endIndex = startIndex + pageSize;

            // Show/hide rows based on the current page
            rows.forEach((row, index) => {
                if (index >= startIndex && index < endIndex) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        pageSizeSelect.addEventListener('change', function () {
            pageSize = parseInt(pageSizeSelect.value);
            totalPages = Math.ceil(totalRows / pageSize);
            currentPage = 1;
            renderTable();
            renderPagination();
        });

        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        renderPagination();
        renderTable();
    });
</script>
