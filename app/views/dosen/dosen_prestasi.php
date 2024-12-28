<?php
include 'partials/header.php';
include 'partials/sidenav.php';
include '../config/config.php';

$query = "SELECT * FROM data_prestasi ORDER BY tgl_pengajuan DESC";

// Eksekusi query menggunakan sqlsrv_query
$result = sqlsrv_query($conn, $query);

// Jika query berhasil, ambil data ke dalam array $prestasiList
if ($result === false) {
    die(print_r(sqlsrv_errors(), true)); // Jika ada error dalam query
}

$prestasiList = [];
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $prestasiList[] = $row;
}

// Jika tidak ada data, set menjadi array kosong
if (empty($prestasiList)) {
    $prestasiList = [];
}
?>


<div class="" style="margin-left: 317px; margin-right: 32px; margin-top: 90px;">
    <div style="margin-bottom: 17.5px;">
        <h4 class="fw-semibold">Prestasi</h4>
        <h6 class="fw-medium text-muted">Home - Prestasi</h6>
    </div>

    <?php if (isset($_SESSION['flash_message'])): ?>
    <div class="alert alert-<?= $_SESSION['flash_message']['type']; ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['flash_message']['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <div class="card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group" style="max-width: 300px;">
                <button class="btn btn-primary" type="button"
                    style="color: white; background-color: #244282; outline: none; border: none;">
                    <i class="fas fa-search"></i>
                </button>
                <input class="form-control" placeholder="Search Prestasi" type="text" />
            </div>
            <div class="">
                <?php if (isset($_SESSION['role_dosen']) && ($_SESSION['role_dosen'] === 'admin' || $_SESSION['role_dosen'] === 'ketua jurusan')): ?>
                <div class="d-flex justify-content-center align-items-center gap-3">
                    <a href="javascript:void(0);" class="btn btn-primary align-items-center gap-2"
                        style="color: white; background-color:rgb(36, 130, 64); outline: none; border: none; height: 100%;"
                        onclick="submitForm();">
                        <i class="fas fa-file-excel"></i>
                        Export Excel
                    </a>

                    <form id="exportForm" method="POST" action="export_excel.php" style="display: none;">
                    </form>

                    <script>
                    function submitForm() {
                        document.getElementById('exportForm').submit(); 
                    }
                    </script>

                    <?php if ($_SESSION['role_dosen'] === 'admin'): ?>
                    <button class="btn btn-primary d-flex justify-content-center align-items-center gap-2"
                        style="color: white; background-color: #244282; outline: none; border: none; height: 100%;">
                        <i class="fas fa-plus"></i>
                        <a href="index.php?page=dosen_prestasi_add" style="text-decoration: none; color: white;">
                            <p class="mb-0">Tambah</p>
                        </a>
                    </button>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <table class="table table-hover " id="prestasiTable">
            <thead>
                <tr class="text-center">
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
                    <!-- Kolom Juara -->
                    <td class="align-middle text-center">
                        <?= htmlspecialchars($prestasi['juara']); ?>
                    </td>

                    <!-- Kolom Jenis Kompetisi -->
                    <td class="align-middle text-center">
                        <?= htmlspecialchars($prestasi['jenis_kompetisi']); ?>
                    </td>

                    <!-- Kolom Tingkat Kompetisi -->
                    <td class="align-middle text-center">
                        <?= htmlspecialchars($prestasi['tingkat_kompetisi']); ?>
                    </td>

                    <!-- Kolom Waktu Pelaksanaan -->


                    <!-- Kolom Tempat Kompetisi -->
                    <td class="align-middle text-center">
                        <?= htmlspecialchars($prestasi['tempat_kompetisi']); ?>
                    </td>



                    <!-- Kolom Status Pengajuan -->
                    <td class="align-middle text-center">
                        <span style="
                                    background-color: <?=
                                                        $prestasi['status_pengajuan'] === 'Approved' ? '#DCFCE7' : ($prestasi['status_pengajuan'] === 'Rejected' ? '#FEE2E2' : '#EAEDEF'); ?>; 
                                    color: <?=
                                            $prestasi['status_pengajuan'] === 'Approved' ? '#166534' : ($prestasi['status_pengajuan'] === 'Rejected' ? '#991B1B' : '#212529'); ?>; 
                                    padding: 4px 8px; 
                                    border-radius: 4px; 
                                    font-size: 14px; 
                                    font-weight: bold;
                                    display: inline-block;
                                ">
                            <?= htmlspecialchars($prestasi['status_pengajuan']); ?>
                        </span>
                    </td>

                    <!-- Kolom Actions -->
                    <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <!-- Tombol Export -->
                            <a href="export_pdf_fpdf.php?id_prestasi=<?php echo $prestasi['id_prestasi']; ?>"
                                class="btn btn-outline-danger btn-xs" target="_blank">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <!-- Tombol Detail -->
                            <a href="index.php?page=dosen_prestasi_detail&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>"
                                class="btn btn-outline-primary btn-xs">
                                <i class="fas fa-file-alt"></i>
                            </a>
                            <!-- Tombol Delete -->
                            <a href="#" class="btn btn-outline-danger btn-xs deleteButton"
                                data-id="<?php echo $prestasi['id_prestasi']; ?>" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <!-- Modal Konfirmasi -->
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1"
                                aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Penghapusan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                            <p class="text-danger fw-bold">Data yang sudah dihapus tidak dapat
                                                dikembalikan!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="#" id="confirmDeleteButton" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const deleteButtons = document.querySelectorAll('.deleteButton');
                                const confirmDeleteButton = document.getElementById('confirmDeleteButton');

                                deleteButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        const prestasiId = this.getAttribute('data-id');
                                        confirmDeleteButton.setAttribute('href',
                                            `index.php?page=dosen_prestasi&action=delete&id_prestasi=${prestasiId}`
                                            );
                                    });
                                });
                            });
                            </script>
                        </div>
                    </td>

                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <!-- Pesan Jika Tidak Ada Data -->
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
                    <option value="5">5</option>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                    pageItem.addEventListener('click', function() {
                        currentPage = i;
                        renderTable();
                        renderPagination();
                    });
                }

                document.getElementById('prevPage').addEventListener('click', function() {
                    if (currentPage > 1) {
                        currentPage--;
                        renderTable();
                        renderPagination();
                    }
                });

                document.getElementById('nextPage').addEventListener('click', function() {
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

            pageSizeSelect.addEventListener('change', function() {
                pageSize = parseInt(pageSizeSelect.value);
                totalPages = Math.ceil(totalRows / pageSize);
                currentPage = 1;
                renderTable();
                renderPagination();
            });

            searchInput.addEventListener('input', function() {
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