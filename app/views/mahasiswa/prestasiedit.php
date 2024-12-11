<?php
// Pada halaman prestasiedit.php

// var_dump($_GET['id_prestasi']);  // Periksa apakah ID diterima dengan benar

include 'partials/header.php';

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
$prestasi = $prestasiController->showDataMahasiswa($_GET['id_prestasi']);



?>
<div class="form-section card container container-form mb-5" style="padding:24px 30px 24px 30px; margin-top: 8rem; ">
    <h5 style="color: #475261;; font-size: 20px; margin-bottom: 20px;" class="fw-semibold">
        Form
    </h5>
    <h5 class="fw-semibold mb-3">Data Prestasi</h5>
    <form action="index.php?action=edit_prestasi" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <!-- Tambahkan ID Prestasi sebagai hidden input -->
                <label class="form-label fw-medium" for="thnAkademik">Tahun Akademik<span
                        class="text-danger">*</span></label>
                <select class="form-select" id="thnAkademik" name="thn_akademik">
                    <option value=""><?php echo $prestasi['thn_akademik']; ?></option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="jenisKompetisi">Jenis Kompetisi<span
                        class="text-danger">*</span></label>
                <input class="form-control" value="<?php echo $prestasi['jenis_kompetisi']; ?>" id="jenisKompetisi" type="text" name="jenis_kompetisi"
                    placeholder="Jenis Kompetisi">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="juara">Juara</label>
                <input class="form-control" id="juara" type="text" name="juara" placeholder="Juara" value="<?php echo $prestasi['juara']; ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="programStudi">Program Studi<span
                        class="text-danger">*</span></label>
                <select class="form-select" id="programStudi" name="program_studi">
                    <option value=""><?php echo $prestasi['program_studi']; ?></option>
                    <option value="Informatika">Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Teknik Elektro">Teknik Elektro</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="urlKompetisi">URL Kompetisi</label>
                <input class="form-control" value="<?php echo $prestasi['url_kompetisi']; ?>" id="urlKompetisi" type="url" name="url_kompetisi"
                    placeholder="URL Kompetisi">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="tingkatKompetisi">Tingkat Kompetisi<span
                        class="text-danger">*</span></label>
                <input class="form-control" value="<?php echo $prestasi['tingkat_kompetisi']; ?>" id="tingkatKompetisi" type="text" name="tingkat_kompetisi"
                    placeholder="Tingkat Kompetisi">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="judulKompetisi">Judul Kompetisi<span
                        class="text-danger">*</span></label>
                <input class="form-control" value="<?php echo $prestasi['judul_kompetisi']; ?>" id="judulKompetisi" type="text" name="judul_kompetisi"
                    placeholder="Judul Kompetisi">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="tempatKompetisi">Tempat Kompetisi<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="tempatKompetisi" value="<?php echo $prestasi['tempat_kompetisi']; ?>" type="text" name="tempat_kompetisi"
                    placeholder="Tempat Kompetisi">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="jumlahPT">Jumlah PT (Berpartisipasi)<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="jumlahPT" value="<?php echo $prestasi['jumlah_pt']; ?>" type="number" name="jumlah_pt" placeholder="Jumlah PT">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="jumlahPeserta">Jumlah Peserta<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="jumlahPeserta" value="<?php echo $prestasi['jumlah_peserta']; ?>" type="number" name="jumlah_peserta"
                    placeholder="Jumlah Peserta">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="noSuratTugas">No. Surat Tugas<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="noSuratTugas" type="text" name="no_surat_tugas"
                    placeholder="Nomor Surat Tugas">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium" for="tanggalSuratTugas">Tanggal Surat Tugas<span
                        class="text-danger">*</span></label>
                <input class="form-control" id="tanggalSuratTugas" type="date" name="tgl_surat_tugas">
            </div>
        </div>

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
        <input type="hidden" name="id_prestasi" value="<?php echo htmlspecialchars($id_prestasi); ?>">
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
                                    <select class="form-select" name="id_mahasiswa[]">
                                        <option value="<?php echo $prestasi['id_mahasiswa']; ?>"><?php echo $prestasi['nama_mahasiswa']; ?></option>
                                        <?php
                                        $mahasiswa_names = [];
                                        foreach ($mahasiswaList as $mahasiswa):
                                            if (!in_array($mahasiswa['nama_mahasiswa'], $mahasiswa_names)):
                                                $mahasiswa_names[] = $mahasiswa['nama_mahasiswa'];
                                        ?>
                                                <option value="<?php echo $mahasiswa['id_mahasiswa']; ?>">
                                                    <?php echo $mahasiswa['nama_mahasiswa']; ?>
                                                </option>
                                        <?php endif;
                                        endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="peran_mahasiswa[]" value="<?php echo $prestasi['peran_mahasiswa']; ?>">
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
                                    <select class="form-select" name="id_dosen[]">
                                        <option><?php echo $prestasi['nama_dosen']; ?></option>
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
                                    <select class="form-select" name="peran_pembimbing[]">
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