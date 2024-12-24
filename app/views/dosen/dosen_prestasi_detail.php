<?php include 'partials/header.php'; ?>
<?php include 'partials/sidenav.php'; ?>

<div class="" style="margin-left: 317px; margin-right: 32px; margin-top: 90px;">

    <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 20px;">
        <div>
            <h4 class="fw-semibold">Detail Prestasi</h4>
            <h6 class="fw-medium text-muted">Home - Prestasi</h6>
        </div>
        <span style="
                        background-color: <?=
                                            $prestasi['status_pengajuan'] === 'Approved' ? '#DCFCE7' : ($prestasi['status_pengajuan'] === 'Rejected' ? '#FEE2E2' : '#EAEDEF'); ?>; 
                        color: <?=
                                $prestasi['status_pengajuan'] === 'Approved' ? '#166534' : ($prestasi['status_pengajuan'] === 'Rejected' ? '#991B1B' : '#212529'); ?>; 
                        padding: 8px 18px; 
                        border-radius: 4px; 
                        font-size: 14px; 
                        font-weight: bold;
                        display: inline-block;
                    " class="shadow-sm fs-6"><?= htmlspecialchars($prestasi['status_pengajuan']); ?>
        </span>

    </div>

    <div class="row justify-content-between" style="margin-bottom: 120px;">
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
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">No Surat Tugas</p>
                            <p class="mb-0 text-secondary">
                                <?= htmlspecialchars($prestasi['no_surat_tugas']); ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Tanggal Surat Tugas</p>
                            <p class="mb-0 text-secondary">
                                <?= htmlspecialchars(
                                    isset($prestasi['tgl_surat_tugas'])
                                        ? $prestasi['tgl_surat_tugas']->format('d-m-Y')
                                        : '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>
                            </p>
                        </div>
                    </div>

                    <!-- File Surat Tugas -->
                    <div class="row">
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">File Surat Tugas</p>
                            <?php
                            if ($prestasi['file_surat_tugas'] !== null) {
                                $suratTugasFilePath = 'uploads/file_surat_tugas' . $prestasi['id_prestasi'];
                                $extension = '.pdf';

                                if (str_contains($prestasi['file_surat_tugas'], 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
                                    $extension = '.docx';
                                }

                                $suratTugasFilePath .= $extension;

                                file_put_contents($suratTugasFilePath, $prestasi['file_surat_tugas']);

                                echo "<button class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#viewModalFile'>Preview File</button> ";
                                echo "<a href='" . $suratTugasFilePath . "' download><button class='btn btn-primary'>Download File</button></a>";

                                echo "
                                    <div class='modal fade' id='viewModalFile' tabindex='-1' aria-labelledby='viewModalLabelFile' aria-hidden='true'>
                                        <div class='modal-dialog modal-lg'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='viewModalLabelFile'>Preview File</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    ";

                                if ($extension === '.pdf') {
                                    echo "<embed src='$suratTugasFilePath' type='application/pdf' width='100%' height='500px'>";
                                } elseif ($extension === '.docx') {
                                    echo "<p>Pratinjau untuk file DOCX tidak didukung langsung di browser. Silakan <a href='$suratTugasFilePath' download>download file ini</a> untuk melihatnya.</p>";
                                }

                                echo "
                                                </div>
                                                <div class='modal-footer'>
                                                    <a href='$suratTugasFilePath' download><button class='btn btn-success'>Download File</button></a>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Kembali</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                            } else {
                                echo "<p class='text-danger'>File tidak tersedia.</p>";
                            }
                            ?>
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
                            <?php
                            if ($prestasi['file_sertifikat'] !== null) {
                                $fileSertifikatFilePath = 'uploads/file_sertifikat' . $prestasi['id_prestasi'];
                                $extension = '.pdf';

                                if (str_contains($prestasi['file_sertifikat'], 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
                                    $extension = '.docx';
                                }

                                $fileSertifikatFilePath .= $extension;

                                file_put_contents($fileSertifikatFilePath, $prestasi['file_sertifikat']);

                                echo "<button class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#viewModalFile'>Preview File</button> ";
                                echo "<a href='" . $fileSertifikatFilePath . "' download><button class='btn btn-primary'>Download File</button></a>";

                                echo "
                                    <div class='modal fade' id='viewModalFile' tabindex='-1' aria-labelledby='viewModalLabelFile' aria-hidden='true'>
                                        <div class='modal-dialog modal-lg'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='viewModalLabelFile'>Preview File</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    ";

                                if ($extension === '.pdf') {
                                    echo "<embed src='$fileSertifikatFilePath' type='application/pdf' width='100%' height='500px'>";
                                } elseif ($extension === '.docx') {
                                    echo "<p>Pratinjau untuk file DOCX tidak didukung langsung di browser. Silakan <a href='$fileSertifikatFilePath' download>download file ini</a> untuk melihatnya.</p>";
                                }

                                echo "
                                                </div>
                                                <div class='modal-footer'>
                                                    <a href='$fileSertifikatFilePath' download><button class='btn btn-success'>Download File</button></a>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Kembali</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                            } else {
                                echo "<p class='text-danger'>File tidak tersedia.</p>";
                            }
                            ?>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-2">Foto Kegiatan</p>
                            <?php
                            if ($prestasi['foto_kegiatan'] !== null) {
                                $fotoFilePath = 'uploads/foto_kegiatan' . $prestasi['id_prestasi'] . '.jpg';
                                file_put_contents($fotoFilePath, $prestasi['foto_kegiatan']);
                                echo "<button class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#viewModalFotoKegiatan'>View Foto</button> ";
                                echo "<a href='" . $fotoFilePath . "' download><button class='btn btn-primary'>Download Foto</button></a>";

                                echo "
                                <div class='modal fade' id='viewModalFotoKegiatan' tabindex='-1' aria-labelledby='viewModalLabelFotoKegiatan' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='viewModalLabelFotoKegiatan'>Preview Foto Kegiatan</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <img src='$fotoFilePath' alt='Foto Kegiatan' class='img-fluid'>
                                            </div>
                                            <div class='modal-footer'>
                                                <a href='$fotoFilePath' download><button class='btn btn-success'>Download Foto</button></a>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            } else {
                                echo "<td>Tidak ada foto.</td>";
                            }
                            ?>

                        </div>
                    </div>
                    <div class="row ">
                        <!-- File Sertifikat -->
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">File Poster</p>
                            <?php
                            if ($prestasi['file_poster'] !== null) {

                                $filePosterFilePath = 'uploads/file_poster_' . $prestasi['id_prestasi'];
                                $extension = '.pdf';

                                if (str_contains($prestasi['file_poster'], 'image/jpeg')) {
                                    $extension = '.jpg';
                                } elseif (str_contains($prestasi['file_poster'], 'image/png')) {
                                    $extension = '.png';
                                } elseif (str_contains($prestasi['file_poster'], 'application/pdf')) {
                                    $extension = '.pdf';
                                }

                                $filePosterFilePath .= $extension;

                                file_put_contents($filePosterFilePath, $prestasi['file_poster']);

                                echo "<button class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#viewModalFile'>Preview File</button> ";
                                echo "<a href='" . $filePosterFilePath . "' download><button class='btn btn-primary'>Download File</button></a>";

                                echo "
                                    <div class='modal fade' id='viewModalFile' tabindex='-1' aria-labelledby='viewModalLabelFile' aria-hidden='true'>
                                        <div class='modal-dialog modal-lg'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='viewModalLabelFile'>Preview File</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    ";

                                if ($extension === '.pdf') {
                                    echo "<embed src='$filePosterFilePath' type='application/pdf' width='100%' height='500px'>";
                                } elseif ($extension === '.jpg' || $extension === '.png') {
                                    echo "<img src='$filePosterFilePath' alt='File Poster' class='img-fluid'>";
                                } else {
                                    echo "<p>Pratinjau untuk jenis file ini tidak didukung. Silakan <a href='$filePosterFilePath' download>download file ini</a> untuk melihatnya.</p>";
                                }

                                echo "
                                            </div>
                                            <div class='modal-footer'>
                                                <a href='$filePosterFilePath' download><button class='btn btn-success'>Download File</button></a>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Kembali</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
                            } else {
                                echo "<p class='text-danger'>File tidak tersedia.</p>";
                            }
                            ?>
                        </div>

                        <!-- Foto Kegiatan -->
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">Hasil Karya</p>
                            <?php
                            if ($prestasi['lampiran_hasil_kompetisi'] !== null) {
                                $lampiranKompetisiFilePath = 'uploads/lampiran_hasil_kompetisi' . $prestasi['id_prestasi'];
                                $extension = '.pdf';

                                if (str_contains($prestasi['lampiran_hasil_kompetisi'], 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
                                    $extension = '.docx';
                                }

                                $lampiranKompetisiFilePath .= $extension;

                                file_put_contents($lampiranKompetisiFilePath, $prestasi['lampiran_hasil_kompetisi']);

                                echo "<button class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#viewModalFile'>Preview File</button> ";
                                echo "<a href='" . $lampiranKompetisiFilePath . "' download><button class='btn btn-primary'>Download File</button></a>";

                                echo "
                                    <div class='modal fade' id='viewModalFile' tabindex='-1' aria-labelledby='viewModalLabelFile' aria-hidden='true'>
                                        <div class='modal-dialog modal-lg'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='viewModalLabelFile'>Preview File</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    ";

                                if ($extension === '.pdf') {
                                    echo "<embed src='$lampiranKompetisiFilePath' type='application/pdf' width='100%' height='500px'>";
                                } elseif ($extension === '.docx') {
                                    echo "<p>Pratinjau untuk file DOCX tidak didukung langsung di browser. Silakan <a href='$lampiranKompetisiFilePath' download>download file ini</a> untuk melihatnya.</p>";
                                }

                                echo "
                                                </div>
                                                <div class='modal-footer'>
                                                    <a href='$lampiranKompetisiFilePath' download><button class='btn btn-success'>Download File</button></a>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Kembali</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                            } else {
                                echo "<p class='text-danger'>File tidak tersedia.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style="font-size: 16px;">Mahasiswa yang Berpartisipasi</div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php if (!empty($mahasiswa)) : ?>
                            <?php foreach ($mahasiswa as $row) : ?>
                                <li class="list-group-item d-flex align-items-center mb-2">
                                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <p class="mb-0 fw-bold">
                                            <?= htmlspecialchars($row['nama_mahasiswa']); ?>
                                        </p>
                                        <p class="mb-0" style="color: #495057;"><?= htmlspecialchars($row['program_studi']); ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li class="list-group-item">Tidak ada mahasiswa yang ditemukan.</li>
                        <?php endif; ?>
                    </ul>
                    <hr>
                    <div>
                        <div class="bg-white fw-bold mb-2" style="font-size: 16px;">Riwayat Persetujuan</div>
                        <?php if (isset($historyApproval) && !empty($historyApproval)): ?>
                            <div style="max-height: 200px; overflow-y: auto;">
                                <ul class="list-group">
                                    <?php foreach ($historyApproval as $history): ?>
                                        <li class="list-group-item <?php echo ($history['status_approval'] == 'Approved') ? 'list-group-item-success' : 'list-group-item-danger'; ?>">
                                            <?php echo htmlspecialchars($history['status_approval'] ?? 'Status tidak tersedia'); ?> by
                                            <strong><?php echo htmlspecialchars($history['nama_dosen'] ?? 'Tidak diketahui'); ?></strong>
                                            <br>
                                            <?php if ($history['status_approval'] == 'Rejected'): ?>
                                                <small>Alasan: <?php echo htmlspecialchars($history['alasan'] ?? 'Tidak ada alasan'); ?></small>
                                                <br>
                                            <?php endif; ?>
                                            <small>Tanggal: <?php echo isset($history['tgl_approval']) ? $history['tgl_approval']->format('d-m-Y H:i') : 'Tanggal tidak tersedia'; ?></small>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php else: ?>
                            <p>Tidak ada riwayat persetujuan untuk prestasi ini.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Dosen Pembimbing -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style="font-size: 16px;">Dosen Pembimbing</div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php if (!empty($dosen)) : ?>
                            <?php foreach ($dosen as $row) : ?>
                                <li class="list-group-item d-flex align-items-center mb-3">
                                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <p class="mb-0 fw-bold">
                                            <?= htmlspecialchars($row['nama_dosen']); ?>
                                        </p>
                                        <p class="mb-0" style="color: #495057;"><?= htmlspecialchars($row['peran_pembimbing']); ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li class="list-group-item">Tidak ada Dosen yang ditemukan.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar fixed-bottom bg-light d-flex justify-content-end p-3 shadow-sm">
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && in_array($prestasi['status_pengajuan'], ['Waiting for Approval', 'Rejected', 'Approved'])): ?>
        <a href="#" class="btn btn-danger me-3" data-bs-toggle="modal" data-bs-target="#rejectModal<?php echo $prestasi['id_prestasi']; ?>">
            Reject
        </a>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal<?php echo $prestasi['id_prestasi']; ?>">
            Approve
        </button>
    <?php endif; ?>
</nav>

<div class="modal fade" id="rejectModal<?php echo $prestasi['id_prestasi']; ?>" tabindex="-1" aria-labelledby="rejectModalLabel<?php echo $prestasi['id_prestasi']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel<?php echo $prestasi['id_prestasi']; ?>">Konfirmasi Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?page=dosen_prestasi_detail&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>&action=reject" method="POST">
                    <div class="mb-3">
                        <label for="alasan" class="form-label">Alasan Penolakan</label>
                        <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="approveModal<?php echo $prestasi['id_prestasi']; ?>" tabindex="-1" aria-labelledby="approveModalLabel<?php echo $prestasi['id_prestasi']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel<?php echo $prestasi['id_prestasi']; ?>">Konfirmasi Persetujuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menyetujui data prestasi ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="index.php?page=dosen_prestasi_detail&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>&action=approve" class="btn btn-success">Ya, Setujui</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>