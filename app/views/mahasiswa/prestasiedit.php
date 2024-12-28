<?php
// Pada halaman prestasiedit.php

// var_dump($_GET['id_prestasi']);  // Periksa apakah ID diterima dengan benar

include 'partials/header.php';

$_SESSION['id_prestasi'] = $_GET['id_prestasi'] ?? null;

if (!isset($_SESSION['user'])) {
    echo "<div class='alert alert-danger text-center' role='alert'>
            Data pengguna tidak ditemukan. Silakan login kembali.
          </div>";
    exit;
}
$id_mahasiswa = $_SESSION['user']['id_mahasiswa'];


$prestasiController = new PrestasiController($conn);
// Ambil daftar dosen dari controller
$dosenList = $prestasiController->getDosenList();
// Ambil daftar mahasiswa dari controller
$mahasiswaList = $prestasiController->getMahasiswaList();
// Peran Mahasiswa
$peranMahasiswa = $prestasiController->getPeranMahasiswa($id_mahasiswa);
$prestasi = $prestasiController->showDataMahasiswa($_GET['id_prestasi']);

$mahasiswaTabel = $prestasiController->getPeranMahasiswa($_GET['id_prestasi']);

$dosenTabel = $prestasiController->getPeranDosen($_GET['id_prestasi']);


?>
<div class="form-section card container container-form mb-5" style="padding:24px 30px 24px 30px; margin-top: 8rem; ">
    <h5 style="color: #475261;; font-size: 20px; margin-bottom: 20px;" class="fw-semibold">
        Form
    </h5>
    <h5 class="fw-semibold mb-3">Data Prestasi</h5>
    <form action="index.php?action=update_prestasi" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <!-- Tambahkan ID Prestasi sebagai hidden input -->
                <label class="form-label fw-medium" for="thnAkademik">Tahun Akademik<span
                        class="text-danger">*</span></label>
                <select class="form-select" id="thnAkademik" name="thn_akademik">
                    <option value="<?php echo $prestasi['thn_akademik']; ?>"><?php echo $prestasi['thn_akademik']; ?>
                    </option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="jenisKompetisi">Jenis Kompetisi<span
                        class="text-danger">*</span></label>
                <input class="form-control" value="<?php echo $prestasi['jenis_kompetisi']; ?>" id="jenisKompetisi"
                    type="text" name="jenis_kompetisi" placeholder="Jenis Kompetisi">
                <small class="form-text text-muted">Contoh: Lomba Coding</small>
            </div>
        </div>

        <hr class="separator my-3">

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="juara">Juara</label>
                <select class="form-select" id="juara" name="juara" required>
                    <option value="<?php echo $prestasi['juara']; ?>"><?php echo $prestasi['juara']; ?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <!-- <input class="form-control" id="juara" type="text" name="juara" placeholder="Juara"
                    value="<?php echo $prestasi['juara']; ?>"> -->
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="programStudi">Program Studi<span
                        class="text-danger">*</span></label>
                <select class="form-select" id="programStudi" name="program_studi" required>
                    <option value="<?php echo $prestasi['program_studi']; ?>"><?php echo $prestasi['program_studi']; ?>
                    </option>
                    <option value="D-IV Teknik Informatika">D-IV Teknik Informatika</option>
                    <option value="D-IV Sistem Informasi Bisnis">D-IV Sistem Informasi Bisnis</option>
                    <option value="D-II Pengembangan Perangkat Lunak Situs">D-II Pengembangan Perangkat Lunak Situs
                    </option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="urlKompetisi">URL Kompetisi</label>
                <input class="form-control" value="<?php echo $prestasi['url_kompetisi']; ?>" id="urlKompetisi"
                    type="url" name="url_kompetisi" placeholder="URL Kompetisi">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="tingkatKompetisi">Tingkat Kompetisi<span
                        class="text-danger">*</span></label>
                <select class="form-select" id="tingkatKompetisi" name="tingkat_kompetisi" required>
                    <option value="<?php echo $prestasi['tingkat_kompetisi']; ?>">
                        <?php echo $prestasi['tingkat_kompetisi']; ?></option>
                    <option value="Provinsi">
                        Provinsi
                    </option>
                    <option value="Nasional">
                        Nasional
                    </option>
                    <option value="Internasional">
                        Internasional
                    </option>
                </select>
                <!-- <input class="form-control" value="<?php echo $prestasi['tingkat_kompetisi']; ?>" id="tingkatKompetisi"
                    type="text" name="tingkat_kompetisi" placeholder="Tingkat Kompetisi"> -->
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="judulKompetisi">Judul Kompetisi<span
                        class="text-danger">*</span></label>
                <input class="form-control" value="<?php echo $prestasi['judul_kompetisi']; ?>" id="judulKompetisi"
                    type="text" name="judul_kompetisi" placeholder="Judul Kompetisi">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="tempatKompetisi">Tempat Kompetisi<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="tempatKompetisi" value="<?php echo $prestasi['tempat_kompetisi']; ?>"
                    type="text" name="tempat_kompetisi" placeholder="Tempat Kompetisi">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="jumlahPT">Jumlah PT (Berpartisipasi)<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="jumlahPT" value="<?php echo $prestasi['jumlah_pt']; ?>" type="number"
                    name="jumlah_pt" placeholder="Jumlah PT">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="jumlahPeserta">Jumlah Peserta<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="jumlahPeserta" value="<?php echo $prestasi['jumlah_peserta']; ?>"
                    type="number" name="jumlah_peserta" placeholder="Jumlah Peserta">
            </div>
        </div>

        <hr class="separator my-3">

        <h5 class="fw-semibold mb-3">
            Surat Tugas
        </h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="noSuratTugas">
                    No Surat Tugas<span class="text-danger">*</span>
                </label>
                <input class="form-control" id="noSuratTugas" placeholder="" type="text" name="no_surat_tugas" required
                    value="<?php echo $prestasi['no_surat_tugas']; ?>" />
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="tanggalSuratTugas">
                    Tanggal Surat Tugas<span class="text-danger">*</span>
                </label>
                <input value="<?= htmlspecialchars(
                                    $prestasi['tgl_surat_tugas'] instanceof DateTime
                                        ? $prestasi['tgl_surat_tugas']->format('Y-m-d')
                                        : $prestasi['tgl_surat_tugas'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>" class="form-control" id="tanggalSuratTugas" type="date" name="tgl_surat_tugas"
                    required />
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-medium" for="uploadSuratTugas">
                Upload Surat Tugas
            </label>
            <div class="border p-3 mb-2">
                <div class="mb-3">
                    <label for="customFile" class="btn btn-outline-primary">
                        Pilih File
                    </label>
                    <input type="file" id="customFile" name="file_surat_tugas" style="display: none;"
                        onchange="updateFileName()">
                    <span id="fileName" class="ms-2 text-muted fs-6">
                        <?php
                // Cek jika file sudah ada
                $suratTugasFilePath = 'uploads/file_surat_tugas' . $prestasi['id_prestasi'] . '.pdf';
                if (file_exists($suratTugasFilePath)) {
                    echo basename($suratTugasFilePath);
                } else {
                    echo "No file chosen";
                }
                ?>
                    </span>
                </div>
                <small class="form-text text-muted">
                    Ukuran (Max: 5000Kb) Ekstensi (.pdf, .docx)
                </small>
            </div>
            <script>
            function updateFileName() {
                var fileInput = document.getElementById('customFile');
                var fileName = document.getElementById('fileName');
                var file = fileInput.files[0];

                if (file) {
                    var maxSize = 5000 * 1024; // 5000 KB
                    var allowedExtensions = /(\.pdf|\.docx)$/i;

                    if (file.size > maxSize) {
                        alert('Ukuran file terlalu besar. Maksimal 5000 KB.');
                        fileInput.value = ''; // Reset file input
                        fileName.textContent = "No file chosen";
                    } else if (!allowedExtensions.exec(file.name)) {
                        alert(
                            'Ekstensi file tidak valid. Hanya file .pdf, .docx yang diperbolehkan.'
                        );
                        fileInput.value = ''; // Reset file input
                        fileName.textContent = "No file chosen";
                    } else {
                        fileName.textContent = file.name;
                    }
                } else {
                    // Jika tidak ada file baru yang dipilih, gunakan nilai dari database
                    fileName.textContent = "<?php echo basename($suratTugasFilePath); ?>";
                }
            }
            </script>
        </div>


        <hr class="separator my-3" />
        <h5 class="fw-semibold mb-3">
            Lampiran
        </h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="fileSertifikat">
                    File Sertifikat
                </label>
                <div class="border p-3 mb-2">
                    <div class="mb-3">
                        <label for="customFileSertifikat" class="btn btn-outline-primary">
                            Pilih File
                        </label>
                        <input type="file" id="customFileSertifikat" name="file_sertifikat" style="display: none;"
                            onchange="updateFileNameSertifikat()">
                        <span id="fileNameSertifikat" class="ms-2 text-muted fs-6">
                            <?php
                        $sertifikatFilePath = 'uploads/file_sertifikat' . $prestasi['id_prestasi'] . '.pdf';
                        if (file_exists($sertifikatFilePath)) {
                            echo basename($sertifikatFilePath);
                        }
                        ?>

                        </span>
                    </div>
                    <small class="form-text text-muted">
                        Ukuran (Max: 5000Kb) Ekstensi (.pdf, .docx)
                    </small>
                </div>

                <script>
                function updateFileNameSertifikat() {
                    var fileInput = document.getElementById('customFileSertifikat');
                    var fileName = document.getElementById('fileNameSertifikat');
                    var file = fileInput.files[0];

                    if (file) {
                        var maxSize = 5000 * 1024; // 5000 KB
                        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf|\.docx)$/i;

                        // Check file size
                        if (file.size > maxSize) {
                            alert('Ukuran file terlalu besar. Maksimal 5000 KB.');
                            fileInput.value = ''; // Reset file input
                            fileName.textContent = "No file chosen";
                        }
                        // Check file extension
                        else if (!allowedExtensions.exec(file.name)) {
                            alert(
                                'Ekstensi file tidak valid. Hanya file .jpg, .jpeg, .png, .pdf, .docx yang diperbolehkan.'
                            );
                            fileInput.value = ''; // Reset file input
                            fileName.textContent = "No file chosen";
                        } else {
                            fileName.textContent = file.name;
                        }
                    } else {
                        fileName.textContent = "No file chosen";
                    }
                }
                </script>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="fileFotoKegiatan">
                    Foto Kegiatan
                </label>
                <div class="border p-3 mb-2">
                    <div class="mb-3">
                        <label for="customFileFotoKegiatan" class="btn btn-outline-primary">
                            Pilih Foto
                        </label>
                        <input type="file" id="customFileFotoKegiatan" name="foto_kegiatan" style="display: none;"
                            onchange="updateFileNameFotoKegiatan()">
                        <span id="fileNameFotoKegiatan" class="ms-2 text-muted fs-6">
                            <?php
                            $fotoFilePath = 'uploads/foto_kegiatan' . $prestasi['id_prestasi'] . '.jpg';
                            if (file_exists($fotoFilePath)) {
                                echo basename($fotoFilePath);
                            }
                            ?>
                        </span>
                    </div>
                    <small class="form-text text-muted">
                        Ukuran (Max: 5000KB) Ekstensi (.jpg, .jpeg, .png)
                    </small>
                </div>

                <script>
                function updateFileNameFotoKegiatan() {
                    var fileInput = document.getElementById('customFileFotoKegiatan');
                    var fileName = document.getElementById('fileNameFotoKegiatan');
                    var file = fileInput.files[0];

                    if (file) {
                        var maxSize = 5000 * 1024; // 5000 KB
                        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

                        // Check file size
                        if (file.size > maxSize) {
                            alert('Ukuran file terlalu besar. Maksimal 5000 KB.');
                            fileInput.value = ''; // Reset file input
                            fileName.textContent = "No file chosen";
                        }
                        // Check file extension
                        else if (!allowedExtensions.exec(file.name)) {
                            alert('Ekstensi file tidak valid. Hanya file .jpg, .jpeg, .png, yang diperbolehkan.');
                            fileInput.value = ''; // Reset file input
                            fileName.textContent = "No file chosen";
                        } else {
                            fileName.textContent = file.name;
                        }
                    } else {
                        fileName.textContent = "No file chosen";
                    }
                }
                </script>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="filePoster">
                    File Poster
                </label>
                <div class="border p-3 mb-2">
                    <div class="mb-3">
                        <label for="customFilePoster" class="btn btn-outline-primary">
                            Pilih File
                        </label>
                        <input type="file" id="customFilePoster" name="file_poster" style="display: none;"
                            onchange="updateFileNamePoster()">
                        <span id="fileNamePoster" class="ms-2 text-muted fs-6">
                            <?php
                            $filePosterFilePath = 'uploads/file_poster_' . $prestasi['id_prestasi'] . '.pdf';
                            if (file_exists($filePosterFilePath)) {
                                echo basename($filePosterFilePath);
                            }
                            ?>
                        </span>
                    </div>
                    <small class="form-text text-muted">
                        Ukuran (Max: 5000KB) Ekstensi (.jpg, .jpeg, .png, .pdf)
                    </small>
                </div>

                <script>
                function updateFileNamePoster() {
                    var fileInput = document.getElementById('customFilePoster');
                    var fileName = document.getElementById('fileNamePoster');
                    var file = fileInput.files[0];

                    if (file) {
                        var maxSize = 5000 * 1024; // 5000 KB
                        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;

                        // Check file size
                        if (file.size > maxSize) {
                            alert('Ukuran file terlalu besar. Maksimal 5000 KB.');
                            fileInput.value = ''; // Reset file input
                            fileName.textContent = "No file chosen";
                        }
                        // Check file extension
                        else if (!allowedExtensions.exec(file.name)) {
                            alert('Ekstensi file tidak valid. Hanya file .jpg, .jpeg, .png yang diperbolehkan.');
                            fileInput.value = ''; // Reset file input
                            fileName.textContent = "No file chosen";
                        } else {
                            fileName.textContent = file.name;
                        }
                    } else {
                        fileName.textContent = "No file chosen";
                    }
                }
                </script>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="fileHasilKompetisi">
                    Lampiran Hasil Kompetisi
                </label>
                <div class="border p-3 mb-2">
                    <div class="mb-3">
                        <label for="customFileHasilKompetisi" class="btn btn-outline-primary">
                            Pilih File
                        </label>
                        <input type="file" id="customFileHasilKompetisi" name="lampiran_hasil_kompetisi"
                            style="display: none;" onchange="updateFileNameHasilKompetisi()" value="">
                        <span id="fileNameHasilKompetisi" class="ms-2 text-muted fs-6">
                            <?php
                            $lampiranKompetisiFilePath = 'uploads/lampiran_hasil_kompetisi' . $prestasi['id_prestasi'] . '.pdf';
                            if (file_exists($lampiranKompetisiFilePath)) {
                                echo basename($lampiranKompetisiFilePath);
                            }
                            ?>
                        </span>
                    </div>
                    <small class="form-text text-muted">
                        Ukuran (Max: 5000KB) Ekstensi (.pdf, .docx)
                    </small>
                </div>

                <script>
                function updateFileNameHasilKompetisi() {
                    var fileInput = document.getElementById('customFileHasilKompetisi');
                    var fileName = document.getElementById('fileNameHasilKompetisi');
                    var file = fileInput.files[0];

                    if (file) {
                        var maxSize = 5000 * 1024; // 5000 KB
                        var allowedExtensions = /(\.pdf|\.docx)$/i;

                        // Check file size
                        if (file.size > maxSize) {
                            alert('Ukuran file terlalu besar. Maksimal 5000 KB.');
                            fileInput.value = ''; // Reset file input
                            fileName.textContent = "No file chosen";
                        }
                        // Check file extension
                        else if (!allowedExtensions.exec(file.name)) {
                            alert('Ekstensi file tidak valid. Hanya file .pdf, .docx yang diperbolehkan.');
                            fileInput.value = ''; // Reset file input
                            fileName.textContent = "No file chosen";
                        } else {
                            fileName.textContent = file.name;
                        }
                    } else {
                        fileName.textContent = "No file chosen";
                    }
                }
                </script>
            </div>
        </div>
        <hr class="separator my-3">

        <hr class="separator my-3" />
        <h5 class="fw-semibold mb-3">Mahasiswa berpartisipasi</h5>
        <div class="table-responsive mb-3">
            <table id="mahasiswa-table" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th style="width: 10%;">No</th>
                        <th style="width: 50%;">Mahasiswa</th>
                        <th style="width: 30%;">Peran</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mahasiswaTabel as $index => $mahasiswa): ?>
                    <tr>
                        <td class="text-center"><?php echo $index + 1; ?></td>
                        <td>
                            <select class="form-select select2" id="select-mahasiswa-<?php echo $index; ?>"
                                name="id_mahasiswa[]">
                                <?php foreach ($mahasiswaList as $mhs): ?>
                                <option value="<?php echo htmlspecialchars($mhs['id_mahasiswa']); ?>"
                                    <?php echo ($mahasiswa['id_mahasiswa'] == $mhs['id_mahasiswa']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($mhs['nama_mahasiswa']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-select" name="peran_mahasiswa[]">
                                <option value="Anggota"
                                    <?php echo ($mahasiswa['peran_mahasiswa'] == 'Anggota') ? 'selected' : ''; ?>>
                                    Anggota
                                </option>
                                <option value="Ketua Tim"
                                    <?php echo ($mahasiswa['peran_mahasiswa'] == 'Ketua Tim') ? 'selected' : ''; ?>>
                                    Ketua Tim
                                </option>
                            </select>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger" type="button" onclick="hapusBaris(this)">Hapus</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <button class="btn btn-outline-primary mb-3" type="button" onclick="tambahMahasiswa()">Tambah Mahasiswa</button>

        <hr class="separator my-3" />

        <h5 class="fw-semibold mb-3">Dosen Pembimbing</h5>
        <div class="table-responsive mb-3">
            <table id="dosen-table" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th style="width: 10%;">No</th>
                        <th style="width: 50%;">Pembimbing</th>
                        <th style="width: 30%;">Peran</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dosenTabel as $index => $dosen): ?>
                    <tr>
                        <td class="text-center"><?php echo $index + 1; ?></td>
                        <td>
                            <select class="form-select select2" id="select-dosen-<?php echo $index; ?>"
                                name="id_dosen[]">
                                <?php foreach ($dosenList as $d): ?>
                                <option value="<?php echo htmlspecialchars($d['id_dosen']); ?>"
                                    <?php echo ($dosen['id_dosen'] == $d['id_dosen']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($d['nama_dosen']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-select" name="peran_pembimbing[]">
                                <option value="Pembimbing Utama"
                                    <?php echo ($dosen['peran_pembimbing'] == 'Pembimbing Utama') ? 'selected' : ''; ?>>
                                    Pembimbing Utama
                                </option>
                                <option value="Pendamping"
                                    <?php echo ($dosen['peran_pembimbing'] == 'Pendamping') ? 'selected' : ''; ?>>
                                    Pendamping
                                </option>
                            </select>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger" type="button" onclick="hapusBaris(this)">Hapus</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
        <button class="btn btn-outline-primary mb-3" type="button" onclick="tambahDosen()">Tambah Dosen</button>
        <script>
        var mahasiswaList = <?php echo json_encode($mahasiswaList); ?>;
        var dosenList = <?php echo json_encode($dosenList); ?>;

        // Fungsi untuk menambah baris mahasiswa
        function tambahMahasiswa() {
            var table = document.getElementById('mahasiswa-table').getElementsByTagName('tbody')[0];
            var rowCount = table.rows.length;
            var newRow = table.insertRow(rowCount);

            var cell1 = newRow.insertCell(0); // Kolom No
            var cell2 = newRow.insertCell(1); // Kolom Mahasiswa
            var cell3 = newRow.insertCell(2); // Kolom Peran
            var cell4 = newRow.insertCell(3); // Kolom Action

            // Nomor
            cell1.innerHTML = rowCount + 1;
            cell1.classList.add('text-center');

            // Dropdown Mahasiswa
            var mahasiswaDropdownId = `mahasiswa-dropdown-${rowCount}`; // ID unik untuk Select2
            var mahasiswaDropdown =
                `<select class="form-select select2" id="${mahasiswaDropdownId}" name="id_mahasiswa[]" required>`;
            mahasiswaDropdown += `<option value="">Pilih Mahasiswa</option>`;
            mahasiswaList.forEach(mahasiswa => {
                mahasiswaDropdown +=
                    `<option value="${mahasiswa.id_mahasiswa}">${mahasiswa.nama_mahasiswa}</option>`;
            });
            mahasiswaDropdown += `</select>`;
            cell2.innerHTML = mahasiswaDropdown;

            // Dropdown Peran
            cell3.innerHTML = `
                    <select class="form-select"  name="peran_mahasiswa[]" required>
                        <option value="Anggota">Anggota</option>
                        <option value="Ketua Tim">Ketua Tim</option>
                    </select>
                `;

            // Tombol Hapus
            cell4.innerHTML =
                `<button class="btn btn-danger" type="button" onclick="hapusBaris(this)">Hapus</button>`;
            cell4.classList.add('text-center');

            // Inisialisasi Select2 untuk dropdown baru
            $(`#${mahasiswaDropdownId}`).select2({
                placeholder: "Pilih Mahasiswa",
                allowClear: true
            });

            // Inisialisasi ulang Select2 untuk dropdown Peran
            $(cell3.querySelector('select')).select2({
                minimumResultsForSearch: -1 // Nonaktifkan pencarian (opsional)
            });
        }

        // Inisialisasi Select2 pada elemen mahasiswa yang sudah ada
        $(document).ready(function() {
            $('#select-dosen, .select2').select2({
                placeholder: "Pilih Pembimbing",
                allowClear: true
            });

            // Inisialisasi untuk dropdown mahasiswa yang sudah ada
            $('select[name="id_mahasiswa[]"]').select2({
                placeholder: "Pilih Mahasiswa",
                allowClear: true
            });

            $('select[name="peran_mahasiswa[]"]').select2({
                minimumResultsForSearch: -1 // Nonaktifkan pencarian (opsional)
            });
        });


        // Fungsi untuk menambah baris dosen
        function tambahDosen() {
            var table = document.getElementById('dosen-table').getElementsByTagName('tbody')[0];
            var rowCount = table.rows.length;
            var newRow = table.insertRow(rowCount);

            var cell1 = newRow.insertCell(0); // Kolom No
            var cell2 = newRow.insertCell(1); // Kolom Dosen
            var cell3 = newRow.insertCell(2); // Kolom Peran
            var cell4 = newRow.insertCell(3); // Kolom Action

            // Nomor
            cell1.innerHTML = rowCount + 1;
            cell1.classList.add('text-center'); // Menambahkan text-center

            // Dropdown Dosen
            var dosenDropdownId = `dosen-dropdown-${rowCount}`; // ID unik untuk Select2
            var dosenDropdown =
                `<select class="form-select select2" id="${dosenDropdownId}" name="id_dosen[]" required>`;
            dosenDropdown += `<option value="">Pilih Pembimbing</option>`;
            dosenList.forEach(dosen => {
                dosenDropdown += `<option value="${dosen.id_dosen}">${dosen.nama_dosen}</option>`;
            });
            dosenDropdown += `</select>`;
            cell2.innerHTML = dosenDropdown;

            // Dropdown Peran
            cell3.innerHTML = `
        <select class="form-select select2" name="peran_pembimbing[]" required>
            <option value="Pembimbing Utama">Pembimbing Utama</option>
            <option value="Pendamping">Pendamping</option>
        </select>
    `;

            // Tombol Hapus
            cell4.innerHTML =
                `<button class="btn btn-danger" type="button" onclick="hapusBaris(this)">Hapus</button>`;
            cell4.classList.add('text-center'); // Menambahkan text-center

            // Inisialisasi Select2 untuk dropdown baru
            $(`#${dosenDropdownId}`).select2({
                placeholder: "Pilih Pembimbing",
                allowClear: true
            });

            // Inisialisasi ulang Select2 untuk dropdown Peran
            $(cell3.querySelector('select')).select2({
                minimumResultsForSearch: -1 // Nonaktifkan pencarian (opsional)
            });
        }


        // Fungsi untuk menghapus baris (berlaku untuk mahasiswa dan dosen)
        function hapusBaris(button) {
            var row = button.closest('tr');
            row.parentNode.removeChild(row);

            // Perbarui nomor setelah penghapusan
            var table = row.closest('table');
            var rows = table.getElementsByTagName('tbody')[0].rows;
            for (var i = 0; i < rows.length; i++) {
                rows[i].cells[0].innerText = i + 1;
            }
        }
        </script>

        <hr>
        <div class="text-end">
            <input type="hidden" name="id_prestasi" value="<?= $_SESSION['id_prestasi'] ?? '' ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<?php include 'partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    <?php for ($i = 0; $i < count($dosenTabel); $i++): ?>
    $('#select-dosen-<?php echo $i; ?>').select2({
        placeholder: "Pilih Pembimbing",
        allowClear: true,
        dropdownCssClass: 'text-start'
    });
    <?php endfor; ?>

    <?php for ($i = 0; $i < count($mahasiswaTabel); $i++): ?>
            $('#select-mahasiswa-<?php echo $i; ?>').select2({
                placeholder: "Pilih Mahasiswa",
                allowClear: true,
                dropdownCssClass: 'text-start'
            });
        <?php endfor; ?>
});
</script>