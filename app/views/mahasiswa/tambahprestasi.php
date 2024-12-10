<?php
include 'partials/header.php';
date_default_timezone_set('Asia/Jakarta');

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

   

?>
<div class="mb-5">
    <p class="info-text fw-light">Home - Prestasi - Tambah Prestasi</p>
</div>

<div class="form-section card container container-form mb-5" style="padding:24px 30px 24px 30px;">
    <h5 style="color: #475261;; font-size: 20px; margin-bottom: 20px;" class="fw-semibold">
        Form
    </h5>
    <h5 class="fw-semibold mb-3">Data Prestasi</h5>
    <form action="index.php?action=submit_prestasi" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="thnAkademik">Tahun Akademik<span
                        class="text-danger">*</span></label>
                <select class="form-select" id="thnAkademik" name="thn_akademik" required>
                    <option value="">Pilih Tahun Akademik</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="jenisKompetisi">Jenis Kompetisi<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="jenisKompetisi" type="text" name="jenis_kompetisi"
                    placeholder="Jenis Kompetisi" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="juara">Juara</label>
                <input class="form-control" id="juara" type="text" name="juara" placeholder="Juara">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="programStudi">Program Studi<span
                        class="text-danger">*</span></label>
                <select class="form-select" id="programStudi" name="program_studi" required>
                    <option value="">Pilih Program Studi</option>
                    <option value="Informatika">Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Teknik Elektro">Teknik Elektro</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="urlKompetisi">URL Kompetisi</label>
                <input class="form-control" id="urlKompetisi" type="url" name="url_kompetisi"
                    placeholder="URL Kompetisi">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="tingkatKompetisi">Tingkat Kompetisi<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="tingkatKompetisi" type="text" name="tingkat_kompetisi"
                    placeholder="Tingkat Kompetisi" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="judulKompetisi">Judul Kompetisi<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="judulKompetisi" type="text" name="judul_kompetisi"
                    placeholder="Judul Kompetisi" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="tempatKompetisi">Tempat Kompetisi<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="tempatKompetisi" type="text" name="tempat_kompetisi"
                    placeholder="Tempat Kompetisi" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="jumlahPT">Jumlah PT (Berpartisipasi)<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="jumlahPT" type="number" name="jumlah_pt" placeholder="Jumlah PT"
                    required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="jumlahPeserta">Jumlah Peserta<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="jumlahPeserta" type="number" name="jumlah_peserta"
                    placeholder="Jumlah Peserta" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="noSuratTugas">No. Surat Tugas<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="noSuratTugas" type="text" name="no_surat_tugas"
                    placeholder="Nomor Surat Tugas" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="tanggalSuratTugas">Tanggal Surat Tugas<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="tanggalSuratTugas" type="date" name="tgl_surat_tugas" required>
            </div>
        </div>

        <hr class="separator my-3">

        <div class="mb-3">
            <label class="form-label fw-medium" for="fileSuratTugas">Upload Surat Tugas</label>
            <input class="form-control" id="fileSuratTugas" type="file" name="file_surat_tugas" accept=".pdf,.jpg,.png">
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium" for="fotoKegiatan">Foto Kegiatan</label>
            <input class="form-control" id="fotoKegiatan" type="file" name="foto_kegiatan" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium" for="fileSertifikat">File Sertifikat</label>
            <input class="form-control" id="fileSertifikat" type="file" name="file_sertifikat" accept=".pdf,.jpg,.png">
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium" for="fileLampiranHasilKompetisi">File Karya</label>
            <input class="form-control" id="fileLampiranHasilKompetisi" type="file" name="lampiran_hasil_kompetisi"
                accept=".pdf,.jpg,.png">
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium" for="filePoster">File Poster</label>
            <input class="form-control" id="filePoster" type="file" name="file_poster" accept=".pdf,.jpg,.png">
        </div>

        <hr class="separator my-3">

        <div class="mb-3">
            <!-- Mahasiswa Section -->
            <div class="row">
                <h5 class="fw-semibold mb-3">Mahasiswa berpartisipasi</h5>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered" id="mahasiswa-table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Mahasiswa</th>
                                <th>Peran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Baris default -->
                            <tr class="text-center">
                                <td>1</td>
                                <td>
                                    <select class="form-select" name="id_mahasiswa[]" required>
                                        <option value="">Pilih Mahasiswa</option>
                                        <?php 
                                $mahasiswa_names = [];
                                foreach ($mahasiswaList as $mahasiswa):
                                    if (!in_array($mahasiswa['nama_mahasiswa'], $mahasiswa_names)):
                                        $mahasiswa_names[] = $mahasiswa['nama_mahasiswa'];
                                ?>
                                        <option value="<?php echo $mahasiswa['id_mahasiswa']; ?>">
                                            <?php echo $mahasiswa['nama_mahasiswa']; ?>
                                        </option>
                                        <?php endif; endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="peran_mahasiswa[]" required>
                                        <option value="Peserta">Peserta</option>
                                        <option value="Ketua Tim">Ketua Tim</option>
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-danger" type="button" onclick="hapusMahasiswa(this)">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-outline-primary mb-3" type="button" onclick="tambahMahasiswa()">
                        Tambah Mahasiswa
                    </button>
                </div>
            </div>

            <!-- Dosen Section -->
            <div class="row">
                <h5 class="fw-semibold mb-3">Dosen Pembimbing</h5>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered" id="dosen-table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Pembimbing</th>
                                <th>Peran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Baris default -->
                            <tr class="text-center">
                                <td>1</td>
                                <td>
                                    <select class="form-select" name="id_dosen[]" required>
                                        <option value="">Pilih Dosen</option>
                                        <?php 
                                        $dosen_names = [];
                                        foreach ($dosenList as $dosen):
                                            // Filter hanya dosen dengan role 'kajur' dan 'dosen'
                                            if (in_array($dosen['role_dosen'], ['ketua jurusan', 'dosen']) && !in_array($dosen['nama_dosen'], $dosen_names)):
                                                $dosen_names[] = $dosen['nama_dosen'];
                                        ?>
                                        <option value="<?php echo $dosen['id_dosen']; ?>">
                                            <?php echo $dosen['nama_dosen']; ?>
                                        </option>
                                        <?php 
                                            endif; 
                                        endforeach; 
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="peran_pembimbing[]" required>
                                        <option value="Pembimbing Utama">Pembimbing Utama</option>
                                        <option value="Pendamping">Pendamping</option>
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-danger" type="button" onclick="hapusDosen(this)">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-outline-primary mb-3" type="button" onclick="tambahDosen()">
                        Tambah Dosen
                    </button>
                </div>
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>

<?php include 'partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
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

    // Dropdown Mahasiswa
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

    // Dropdown Dosen
    var dosenDropdown = `<select class="form-select" name="id_dosen[]" required>`;
    dosenDropdown += `<option value="">Pilih Dosen</option>`;
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