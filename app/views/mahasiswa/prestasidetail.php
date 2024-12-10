<?php include 'partials/header.php' ?>

<div class="mb-5">
    <p class="info-text fw-light">Home - Prestasi - Detail Prestasi</p>
</div>

<div class="container-detail-prestasi">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 31px;">
        <h5 style="color: #475261;" class="align-items-center mb-0">Detail Prestasi</h5>
        <a class="btn btn-warning d-flex align-items-center" href="#" style="color: white;">
            <i class="bi bi-pencil me-2"></i>Edit
        </a>
    </div>

    <!-- Content Section -->
    <div class="row justify-content-between">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Data Kompetisi -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style=" font-size: 16px;">Data Kompetisi</div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Program Studi</p>
                            <p class="mb-0" style="color: #495057;">
                                <?php echo htmlspecialchars($prestasi['program_studi']); ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Tahun Akademik</p>
                            <p class="mb-0" style="color: #495057;">
                                <?php echo htmlspecialchars($prestasi['thn_akademik']); ?>
                            </p>
                        </div>
                    </div>

                    <hr class="separator my-3" />

                    <!-- Baris 2 -->
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">URL Kompetisi</p>
                            <p><a href="#"><?php echo htmlspecialchars($prestasi['url_kompetisi']); ?></a></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Jenis Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['jenis_kompetisi']); ?></p>
                        </div>
                    </div>

                    <!-- Baris 3 -->
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Judul Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['judul_kompetisi']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Jumlah PT</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['jumlah_pt']); ?></p>
                        </div>
                    </div>

                    <!-- Baris 4 -->
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Juara</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['juara']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Tingkat Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['tingkat_kompetisi']); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Baris 5 -->
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Tempat Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['tempat_kompetisi']); ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Jumlah Peserta</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['jumlah_peserta']); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Surat Tugas -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style="font-size: 16px;">Surat Tugas</div>
                <div class="card-body">
                    <!-- Informasi Surat Tugas -->
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-1 fw-bold">Nomor Surat Tugas</p>
                            <p class="mb-0 text-secondary">
                                <?= htmlspecialchars($prestasi['no_surat_tugas']); ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1 fw-bold">Tanggal Surat Tugas</p>
                            <p class="mb-0 text-secondary">
                                <?= htmlspecialchars($prestasi['tgl_surat_tugas'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                        </div>
                    </div>

                    <!-- File Surat Tugas -->
                    <div class="row">
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">File Surat Tugas</p>
                            <?php if (!empty($prestasi['file_surat_tugas'])) : ?>
                            <?php
                    $filePath = '../public/uploads/' . $prestasi['file_surat_tugas']; // Path file relatif
                    $fileName = basename($filePath); // Mendapatkan nama file
                    ?>
                            <!-- Preview Kecil -->
                            <div class="mb-3">
                                <img src="<?= $filePath ?>" alt="Preview File Surat Tugas" class="img-thumbnail"
                                    style="max-width: 150px;">
                            </div>
                            <!-- Nama File -->
                            <p class="text-secondary small mb-3"><?= htmlspecialchars($fileName); ?></p>

                            <!-- Tombol View dan Download -->
                            <div class="d-flex gap-2">
                                <a href="<?= $filePath ?>" target="_blank" class="btn btn-primary btn-sm">
                                    View File
                                </a>
                                <a href="<?= $filePath ?>" download class="btn btn-success btn-sm">
                                    Download File
                                </a>
                            </div>
                            <?php else : ?>
                            <p class="text-danger">File tidak tersedia</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Lampiran -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style=" font-size: 16px;">Lampiran</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- File Sertifikat -->
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">File Sertifikat</p>
                            <?php if (!empty($prestasi['file_sertifikat'])) : ?>
                            <?php
                                $filePathSertifikat = '../public/uploads/' . $prestasi['file_sertifikat']; // Path file relatif
                                $fileNameSertifikat = basename($filePathSertifikat); // Mendapatkan nama file
                                ?>
                            <!-- Preview Kecil -->
                            <div class="mb-3">
                                <img src="<?= $filePathSertifikat ?>" alt="Preview File Sertifikat"
                                    class="img-thumbnail" style="max-width: 150px;">
                            </div>
                            <!-- Nama File -->
                            <p class="text-secondary small mb-3"><?= htmlspecialchars($fileNameSertifikat); ?></p>
                            <!-- Tombol View dan Download -->
                            <div class="d-flex gap-2">
                                <a href="<?= $filePathSertifikat ?>" target="_blank" class="btn btn-primary btn-sm">
                                    View File
                                </a>
                                <a href="<?= $filePathSertifikat ?>" download class="btn btn-success btn-sm">
                                    Download File
                                </a>
                            </div>
                            <?php else : ?>
                            <p class="text-danger">File tidak tersedia</p>
                            <?php endif; ?>
                        </div>

                        <!-- Foto Kegiatan -->
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">Foto Kegiatan</p>
                            <?php if (!empty($prestasi['foto_kegiatan'])) : ?>
                            <?php
                                $filePathFoto = '../public/uploads/' . $prestasi['foto_kegiatan']; // Path file relatif
                                $fileNameFoto = basename($filePathFoto); // Mendapatkan nama file
                                ?>
                            <!-- Preview Kecil -->
                            <div class="mb-3">
                                <img src="<?= $filePathFoto ?>" alt="Preview Foto Kegiatan" class="img-thumbnail"
                                    style="max-width: 150px;">
                            </div>
                            <!-- Nama File -->
                            <p class="text-secondary small mb-3"><?= htmlspecialchars($fileNameFoto); ?></p>
                            <!-- Tombol View dan Download -->
                            <div class="d-flex gap-2">
                                <a href="<?= $filePathFoto ?>" target="_blank" class="btn btn-primary btn-sm">
                                    View File
                                </a>
                                <a href="<?= $filePathFoto ?>" download class="btn btn-success btn-sm">
                                    Download File
                                </a>
                            </div>
                            <?php else : ?>
                            <p class="text-danger">File tidak tersedia</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row ">
                        <!-- File Sertifikat -->
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">File Poster</p>
                            <?php if (!empty($prestasi['file_poster'])) : ?>
                            <?php
                            $filePathSertifikat = '../public/uploads/' . $prestasi['file_poster']; // Path file relatif
                            $fileNameSertifikat = basename($filePathSertifikat); // Mendapatkan nama file
                            ?>
                            <!-- Preview Kecil -->
                            <div class="mb-3">
                                <img src="<?= $filePathSertifikat ?>" alt="Preview File Poster" class="img-thumbnail"
                                    style="max-width: 150px;">
                            </div>
                            <!-- Nama File -->
                            <p class="text-secondary small mb-3"><?= htmlspecialchars($fileNameSertifikat); ?></p>
                            <!-- Tombol View dan Download -->
                            <div class="d-flex gap-2">
                                <a href="<?= $filePathSertifikat ?>" target="_blank" class="btn btn-primary btn-sm">
                                    View File
                                </a>
                                <a href="<?= $filePathSertifikat ?>" download class="btn btn-success btn-sm">
                                    Download File
                                </a>
                            </div>
                            <?php else : ?>
                            <p class="text-danger">File tidak tersedia</p>
                            <?php endif; ?>
                        </div>

                        <!-- Foto Kegiatan -->
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">Hasil Karya</p>
                            <?php if (!empty($prestasi['lampiran_hasil_kompetisi'])) : ?>
                            <?php
                            $filePathFoto = '../public/uploads/' . $prestasi['lampiran_hasil_kompetisi']; // Path file relatif
                            $fileNameFoto = basename($filePathFoto); // Mendapatkan nama file
                            ?>
                            <!-- Preview Kecil -->
                            <div class="mb-3">
                                <img src="<?= $filePathFoto ?>" alt="Preview Hasil Karya" class="img-thumbnail"
                                    style="max-width: 150px;">
                            </div>
                            <!-- Nama File -->
                            <p class="text-secondary small mb-3"><?= htmlspecialchars($fileNameFoto); ?></p>
                            <!-- Tombol View dan Download -->
                            <div class="d-flex gap-2">
                                <a href="<?= $filePathFoto ?>" target="_blank" class="btn btn-primary btn-sm">
                                    View File
                                </a>
                                <a href="<?= $filePathFoto ?>" download class="btn btn-success btn-sm">
                                    Download File
                                </a>
                            </div>
                            <?php else : ?>
                            <p class="text-danger">File tidak tersedia</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-lg-4">
            <!-- Mahasiswa yang Berpartisipasi -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style="font-size: 16px;">Mahasiswa yang Berpartisipasi</div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="../../img/animoji.png" alt="Profile" class="rounded-circle"
                            style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <p class="mb-0 fw-bold">
                                <?php echo htmlspecialchars($prestasi['nama_mahasiswa'] ?? 'null'); ?></p>
                            <p class="mb-0" style="color: #495057;">D-IV Teknik Informatika</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dosen Pembimbing -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style="font-size: 16px;">Dosen Pembimbing</div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-circle"
                            style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <p class="mb-0 fw-bold"><?php echo htmlspecialchars($prestasi['nama_dosen'] ?? 'null'); ?>
                            </p>
                            <p class="mb-0" style="color: #495057;">Dosen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'partials/footer.php'; ?>