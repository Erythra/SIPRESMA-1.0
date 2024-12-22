<?php include 'partials/header.php'; ?>
<?php include 'partials/sidenav.php'; ?>

<div class="" style="margin-left: 317px; margin-right: 32px; margin-top: 90px;">
    <div style="margin-bottom: 17.5px;">
        <h4 class="fw-semibold">Tambah Prestasi</h4>
        <h6 class="fw-medium text-muted">Home - Prestasi</h6>
    </div>
    <div class="form-section card container container-form mb-5" style="padding:24px 30px 24px 30px;">
        <h5 style="color: #475261;; font-size: 20px; margin-bottom: 20px;" class="fw-semibold">
            Form
        </h5>
        <h5 class="fw-semibold mb-3">Data Prestasi</h5>
        <form method="POST" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="tgl_pengajuan">
                        Tanggal Pengajuan<span class="text-danger">*</span>
                    </label>
                    <input type="datetime-local" class="form-control" id="tglpengajuan" name="tgl_pengajuan" />
                </div>

            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="programStudi">
                        Program Studi<span class="text-danger">*</span>
                    </label>
                    <select class="form-select" name="program_studi" id="programStudi" required>
                        <option value="Informatika">
                            D-IV Informatika
                        </option>
                        <option value=" Sistem Informasi Bisnis">
                            D-IV Sistem Informasi Bisnis
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="tingkatKompetisi">
                        Tahun Akademik<span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="thn_akademik" name="thn_akademik" required>
                        <option value="2022">
                            2022
                        </option>
                        <option value="2023">
                            2023
                        </option>
                        <option value="2024">
                            2024
                        </option>
                        <option value="2025">
                            2025
                        </option>
                    </select>
                </div>
            </div>
            <hr class="separator my-3" />
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="urlKompetisi">
                        URL Kompetisi<span class="text-danger">*</span>
                    </label>
                    <input class="form-control" id="urlKompetisi" name="url_kompetisi" placeholder="URL" type="url" />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="juara">
                        Juara<span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="juara" name="juara" required>
                        <option value="1">
                            1
                        </option>
                        <option value=" 2">
                            2
                        </option>
                        <option value=" 3">
                            3
                        </option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="jenisKompetisi">
                        Jenis Kompetisi<span class="text-danger">*</span>
                    </label>
                    <input class="form-control" an id="jenisKompetisi" placeholder="Jenis Kompetisi" type="text"
                        name="jenis_kompetisi" required />
                    <small class="form-text text-muted">
                        contoh: Desain UI/UX, Olah Raga, Sains
                    </small>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="tingkatKompetisi">
                        Tingkat Kompetisi<span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="tingkatKompetisi" name="tingkat_kompetisi" required>
                        <option value="Kota">
                            Kota
                        </option>
                        <option value=" Nasional">
                            Nasional
                        </option>
                        <option value=" Internasional">
                            Internasional
                        </option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="judulKompetisi">
                        Judul Kompetisi<span class="text-danger">*</span>
                    </label>
                    <input class="form-control" id="judulKompetisi" placeholder="" type="text" name="judul_kompetisi"
                        required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="tempatKompetisi">
                        Tempat Kompetisi<span class="text-danger">*</span>
                    </label>
                    <input class="form-control" id="tempatKompetisi" placeholder="" type="text" name="tempat_kompetisi"
                        required />
                </div>
            </div>
            <!-- <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="tanggalMulai">
                        Tanggal Mulai<span class="text-danger">*</span>
                    </label>
                    <input class="form-control" id="tanggalMulai" type="date" name="tanggal_mulai" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="tanggalAkhir">
                        Tanggal Akhir<span class="text-danger">*</span>
                    </label>
                    <input class="form-control" id="tanggalAkhir" type="date" name="tanggal_akhir" required />
                </div>
            </div> -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="jumlahPT">
                        Jumlah PT (Berpartisipasi)<span class="text-danger">*</span>
                    </label>
                    <input class="form-control" id="jumlahPT" placeholder="" type="number" name="jumlah_pt" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="jumlahPeserta">
                        Jumlah Peserta<span class="text-danger">*</span>
                    </label>
                    <input class="form-control" id="jumlahPeserta" placeholder="" type="number" name="jumlah_peserta"
                        required />
                </div>
            </div>
            <hr class="separator my-3" />
            <h5 class="fw-semibold mb-3">
                Surat Tugas
            </h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="noSuratTugas">
                        No Surat Tugas<span class="text-danger">*</span>
                    </label>
                    <input class="form-control" id="noSuratTugas" placeholder="" type="text" name="no_surat_tugas"
                        required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="tanggalSuratTugas">
                        Tanggal Surat Tugas<span class="text-danger">*</span>
                    </label>
                    <input class="form-control" id="tanggalSuratTugas" type="date" name="tgl_surat_tugas"
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
                        <input type="file" id="customFile" name="file_surat_tugas" style="display: none;" onchange="updateFileName()">
                        <span id="fileName" class="ms-2 text-muted fs-6">No file chosen</span>
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
                            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf|\.docx)$/i;

                            if (file.size > maxSize) {
                                alert('Ukuran file terlalu besar. Maksimal 5000 KB.');
                                fileInput.value = ''; // Reset file input
                                fileName.textContent = "No file chosen";
                            } else if (!allowedExtensions.exec(file.name)) {
                                alert('Ekstensi file tidak valid. Hanya file .jpg, .jpeg, .png, .pdf, .docx yang diperbolehkan.');
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
                            <input type="file" id="customFileSertifikat" name="file_sertifikat" style="display: none;" onchange="updateFileNameSertifikat()">
                            <span id="fileNameSertifikat" class="ms-2 text-muted fs-6">No file chosen</span>
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
                                    alert('Ekstensi file tidak valid. Hanya file .jpg, .jpeg, .png, .pdf, .docx yang diperbolehkan.');
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
                            <input type="file" id="customFileFotoKegiatan" name="foto_kegiatan" style="display: none;" onchange="updateFileNameFotoKegiatan()">
                            <span id="fileNameFotoKegiatan" class="ms-2 text-muted fs-6">No file chosen</span>
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
                            <input type="file" id="customFilePoster" name="file_poster" style="display: none;" onchange="updateFileNamePoster()">
                            <span id="fileNamePoster" class="ms-2 text-muted fs-6">No file chosen</span>
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
                            <input type="file" id="customFileHasilKompetisi" name="lampiran_hasil_kompetisi" style="display: none;" onchange="updateFileNameHasilKompetisi()">
                            <span id="fileNameHasilKompetisi" class="ms-2 text-muted fs-6">No file chosen</span>
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

            <hr class="separator my-3" />
            <h5 class="fw-semibold mb-3">Mahasiswa berpartisipasi</h5>
            <div class="table-responsive mb-3">
                <table id="mahasiswa-table" class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>Peran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>1</td>
                            <td>
                                <select class="form-select" name="id_mahasiswa[]" required>
                                    <option value="">Pilih Mahasiswa</option>
                                    <?php foreach ($mahasiswaList as $mahasiswa): ?>
                                        <option value="<?php echo $mahasiswa['id_mahasiswa']; ?>">
                                            <?php echo $mahasiswa['nama_mahasiswa']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-select" name="peran_mahasiswa[]" required>
                                    <option value="Peserta">Anggota</option>
                                    <option value="Ketua Tim">Ketua Tim</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-danger" type="button" onclick="hapusBaris(this)">Hapus</button>
                            </td>
                        </tr>
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
                            <th>No</th>
                            <th>Pembimbing</th>
                            <th>Peran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>1</td>
                            <td>
                                <select class="form-select" name="id_dosen[]" required>
                                    <option value="">Pilih Pembimbing</option>
                                    <?php foreach ($dosenList as $dosen): ?>
                                        <option value="<?php echo $dosen['id_dosen']; ?>">
                                            <?php echo $dosen['nama_dosen']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-select" name="peran_pembimbing[]" required>
                                    <option value="Pembimbing Utama">Pembimbing Utama</option>
                                    <option value="Pendamping">Pendamping</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-danger" type="button" onclick="hapusBaris(this)">Hapus</button>
                            </td>
                        </tr>
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
                    var mahasiswaDropdown = `<select class="form-select" name="id_mahasiswa[]" required>`;
                    mahasiswaDropdown += `<option value="">Pilih Mahasiswa</option>`;
                    mahasiswaList.forEach(mahasiswa => {
                        mahasiswaDropdown += `<option value="${mahasiswa.id_mahasiswa}">${mahasiswa.nama_mahasiswa}</option>`;
                    });
                    mahasiswaDropdown += `</select>`;
                    cell2.innerHTML = mahasiswaDropdown;

                    // Dropdown Peran
                    cell3.innerHTML = `
                            <select class="form-select" name="peran_mahasiswa[]" required>
                                <option value="Peserta">Peserta</option>
                                <option value="Ketua Tim">Ketua Tim</option>
                            </select>
                            `;

                    // Tombol Hapus
                    cell4.innerHTML = `<button class="btn btn-danger" type="button" onclick="hapusBaris(this)">Hapus</button>`;
                    cell4.classList.add('text-center'); // Menambahkan text-center
                }

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
                    var dosenDropdown = `<select class="form-select" name="id_dosen[]" required>`;
                    dosenDropdown += `<option value="">Pilih Pembimbing</option>`;
                    dosenList.forEach(dosen => {
                        dosenDropdown += `<option value="${dosen.id_dosen}">${dosen.nama_dosen}</option>`;
                    });
                    dosenDropdown += `</select>`;
                    cell2.innerHTML = dosenDropdown;

                    // Dropdown Peran
                    cell3.innerHTML = `
                        <select class="form-select" name="peran_pembimbing[]" required>
                            <option value="Pembimbing Utama">Pembimbing Utama</option>
                            <option value="Pendamping">Pendamping</option>
                        </select>
                        `;

                    // Tombol Hapus
                    cell4.innerHTML = `<button class="btn btn-danger" type="button" onclick="hapusBaris(this)">Hapus</button>`;
                    cell4.classList.add('text-center'); // Menambahkan text-center
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>