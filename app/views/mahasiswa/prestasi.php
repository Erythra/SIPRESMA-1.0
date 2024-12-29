<?php include 'partials/header.php' ?>

<div class="card p-4" style="margin: 50px 84px 50px 84px; margin-top: 8rem;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold mb-0 fs-4" style="color: #475261;">
            List Prestasi
        </h5>
        <div class="d-flex align-items-center gap-3">
            <div class="input-group" style="max-width: 300px;">
                <button class="btn btn-primary" type="button"
                    style="color: white; background-color: #244282; outline: none; border: none;">
                    <i class="bi bi-search"></i>
                </button>
                <input class="form-control" placeholder="Search Prestasi" type="text" />
            </div>
            <button class="btn btn-primary d-flex justify-content-center align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#filterModal"
                style="color: white; background-color: #244282; outline: none; border: none;">
                <i class="bi bi-funnel"></i>
                <p class="mb-0">Filter</p>
            </button>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-primary d-flex justify-content-center align-items-center gap-2"
                    style="color: white; background-color: #244282; outline: none; border: none;">
                    <i class="bi bi-plus-circle"></i>
                    <a href="index.php?page=tambahprestasi" style="text-decoration: none; color: white;">
                        <p class="mb-0">Tambah</p>
                    </a>
                </button>
            </div>
        </div>
    </div>
    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Prestasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="GET" action="index.php">
                    <input type="hidden" name="page" value="prestasi">
                    <div class="modal-body">
                        <!-- Filter Juara -->
                        <div class="mb-3">
                            <label for="filterJuara" class="form-label">Juara</label>
                            <select class="form-select" id="filterJuara" name="juara">
                                <option value="">All</option>
                                <option value="1" <?= isset($_GET['juara']) && $_GET['juara'] === '1' ? 'selected' : '' ?>>1</option>
                                <option value="2" <?= isset($_GET['juara']) && $_GET['juara'] === '2' ? 'selected' : '' ?>>2</option>
                                <option value="3" <?= isset($_GET['juara']) && $_GET['juara'] === '3' ? 'selected' : '' ?>>3</option>
                            </select>
                        </div>

                        <!-- Filter Lomba -->
                        <div class="mb-3">
                            <label for="filterJenisKompetisi" class="form-label">Jenis Kompetisi</label>
                            <input type="text" class="form-control" id="filterJenisKompetisi" name="jenis_kompetisi" placeholder="Informatika"
                                value="<?= isset($_GET['jenis_kompetisi']) ? htmlspecialchars($_GET['jenis_kompetisi']) : '' ?>">
                        </div>

                        <!-- Filter Tingkat -->
                        <div class="mb-3">
                            <label for="filterTingkat" class="form-label">Tingkat Kompetisi</label>
                            <select class="form-select" id="filterTingkat" name="tingkat_kompetisi">
                                <option value="">All</option>
                                <option value="Provinsi" <?= isset($_GET['tingkat_kompetisi']) && $_GET['tingkat_kompetisi'] === 'Provinsi' ? 'selected' : '' ?>>Provinsi</option>
                                <option value="Nasional" <?= isset($_GET['tingkat_kompetisi']) && $_GET['tingkat_kompetisi'] === 'Nasional' ? 'selected' : '' ?>>Nasional</option>
                                <option value="Internasional" <?= isset($_GET['tingkat_kompetisi']) && $_GET['tingkat_kompetisi'] === 'Internasional' ? 'selected' : '' ?>>Internasional</option>
                            </select>
                        </div>

                        <!-- Filter Tempat Kompetisi -->
                        <div class="mb-3">
                            <label for="filterTempatKompetisi" class="form-label">Tempat Kompetisi</label>
                            <input type="text" class="form-control" id="filterTempatKompetisi" name="tempat_kompetisi" placeholder="Tempat Kompetisi"
                                value="<?= isset($_GET['tempat_kompetisi']) ? htmlspecialchars($_GET['tempat_kompetisi']) : '' ?>">
                        </div>

                        <!-- Filter Status -->
                        <div class="mb-3">
                            <label for="filterStatus" class="form-label">Status Pengajuan</label>
                            <select class="form-select" id="filterStatus" name="status_pengajuan">
                                <option value="">All</option>
                                <option value="Approved" <?= isset($_GET['status_pengajuan']) && $_GET['status_pengajuan'] === 'Approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="Cancelled" <?= isset($_GET['status_pengajuan']) && $_GET['status_pengajuan'] === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                                <option value="Waiting for Approval" <?= isset($_GET['status_pengajuan']) && $_GET['status_pengajuan'] === 'Waiting for Approval' ? 'selected' : '' ?>>Waiting for Approval</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <table class="table table-hover ">
        <thead>
            <tr>
                <th>Tanggal Pengajuan</th>
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
                    <tr>
                        <!-- Kolom Juara -->
                        <td class="align-middle text-left">
                            <?= htmlspecialchars($prestasi['tgl_pengajuan']->format('Y-m-d H:i:s')); ?>
                        </td>

                        <td class="align-middle text-left">
                            <?= htmlspecialchars($prestasi['juara']); ?>
                        </td>

                        <!-- Kolom Jenis Kompetisi -->
                        <td class="align-middle text-left">
                            <?= htmlspecialchars($prestasi['jenis_kompetisi']); ?>
                        </td>

                        <!-- Kolom Tingkat Kompetisi -->
                        <td class="align-middle text-left">
                            <?= htmlspecialchars($prestasi['tingkat_kompetisi']); ?>
                        </td>

                        <!-- Kolom Tempat Kompetisi -->
                        <td class="align-middle text-left">
                            <?= htmlspecialchars($prestasi['tempat_kompetisi']); ?>
                        </td>

                        <!-- Kolom Status Pengajuan -->
                        <td class="align-middle text-left">
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
                        <td class="align-middle text-left">
                            <div class="d-flex align-items-center justify-content-start gap-1">
                                <!-- Tombol Detail -->
                                <a href="index.php?page=prestasidetail&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>" class="btn btn-outline-primary btn-xs">
                                    <i class="bi bi-file-earmark-text"></i>
                                </a>

                                <!-- Tombol Edit -->
                                <a href="index.php?page=prestasiedit&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>" class="btn btn-outline-warning btn-xs">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Tombol Delete dengan Modal -->
                                <button class="btn btn-outline-danger btn-xs" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $prestasi['id_prestasi']; ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <!-- Modal Delete -->
                                <div class="modal fade" id="deleteModal<?php echo $prestasi['id_prestasi']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Hapus Prestasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus prestasi ini? Data akan dihapus secara permanen dan tidak dapat dipulihkan.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a href="prestasi_delete.php?id_prestasi=<?php echo $prestasi['id_prestasi']; ?>" class="btn btn-danger">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

<?php include 'partials/footer.php'; ?>