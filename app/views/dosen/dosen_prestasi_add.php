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
        <form action="" method="POST" enctype="multipart/form-data">
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
                    <select class="form-select" id="tingkatKompetisi" name="thn_akademik" required>
                        <option value=" 2024">
                            2024
                        </option>
                        <option value=" 2023">
                            2023
                        </option>
                        <option value=" 2022">
                            2022
                        </option>
                        <option value=" 2021">
                            2021
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
                    <input class="form-control" id="urlKompetisi" placeholder="URL" type="url" />
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
                    <input class="form-control" id="jenisKompetisi" placeholder="Jenis Kompetisi" type="text"
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
            <div class="row mb-3">
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
            </div>
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
                    <input class="form-control" id="tanggalSuratTugas" type="date" name="tanggal_surat_tugas"
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
                        <input type="file" id="customFile" name="surat_tugas" style="display: none;">
                        <span id="fileName" class="ms-2 text-muted fs-6">No file chosen</span>
                    </div>
                    <small class="form-text text-muted">
                        Ukuran (Max: 5000Kb) Ekstensi (.jpg,.jpeg,.png,.pdf,.docx)
                    </small>
                </div>
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
                            <label for="customFile" class="btn btn-outline-primary">
                                Pilih File
                            </label>
                            <input type="file" id="customFile" name="sertifikat" style="display: none;">
                            <span id="fileName" class="ms-2 text-muted fs-6">No file chosen</span>
                        </div>
                        <small class="form-text text-muted">
                            Ukuran (Max: 5000Kb) Ekstensi (.jpg,.jpeg,.png,.pdf,.docx)
                        </small>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="fotoKegiatan">
                        Foto Kegiatan
                    </label>
                    <div class="border p-3 mb-2">
                        <div class="mb-3">
                            <label for="customFile" class="btn btn-outline-primary">
                                Pilih File
                            </label>
                            <input type="file" id="customFile" name="foto_kegiatan" style="display: none;">
                            <span id="fileName" class="ms-2 text-muted fs-6">No file chosen</span>
                        </div>
                        <small class="form-text text-muted">
                            Ukuran (Max: 5000Kb) Ekstensi (.jpg,.jpeg,.png,.pdf,.docx)
                        </small>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-medium" for="filePoster">
                    File Poster
                </label>
                <div class="border p-3 mb-2">
                    <div class="mb-3">
                        <label for="customFile" class="btn btn-outline-primary">
                            Pilih File
                        </label>
                        <input type="file" id="customFile" name="poster" style="display: none;">
                        <span id="fileName" class="ms-2 text-muted fs-6">No file chosen</span>
                    </div>
                    <small class="form-text text-muted">
                        Ukuran (Max: 5000Kb) Ekstensi (.jpg,.jpeg,.png,.pdf,.docx)
                    </small>
                </div>
            </div>
            <hr class="separator my-3" />
            <h5 class="fw-semibold mb-3">
                Mahasiswa berpartisipasi
            </h5>
            <div class="table-responsive mb-3">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>
                                No
                            </th>
                            <th>
                                Mahasiswa
                            </th>
                            <th>
                                Peran
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>
                                1
                            </td>
                            <td>
                                <select class="form-select">
                                    <option>
                                        Pilih Mahasiswa
                                    </option>
                                </select>
                            </td>
                            <td>
                                <select class="form-select">
                                    <option>
                                        Pilih Peran
                                    </option>
                                    <option value="ketua">
                                        Ketua
                                    </option>
                                    <option value="anggota">
                                        Anggota
                                    </option>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-danger" type="button">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-outline-primary mb-3" type="button">
                Tambah Mahasiswa
            </button>
            <hr class="separator my-3" />
            <h5 class="fw-semibold mb-3">
            Dosen Pembimbing
        </h5>
        <div class="table-responsive mb-3">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>
                            No
                        </th>
                        <th>
                            Pembimbing
                        </th>
                        <th>
                            Peran
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>
                            1
                        </td>
                        <td>
                            <select class="form-select">
                                <option>
                                    Pilih Pembimbing
                                </option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select">
                                <option>
                                    Pilih Peran
                                </option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger" type="button">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button class="btn btn-outline-primary mb-3" type="button">
            Tambah Dosen
        </button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>