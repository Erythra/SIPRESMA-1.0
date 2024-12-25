<?php
include 'partials/header.php';
include 'partials/sidenav.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul_pengumuman = $_POST['judul_pengumuman'];
    $isi_pengumuman = $_POST['isi_pengumuman'];
    $tgl_dibuat = $_POST['tgl_dibuat'];
    $tgl_diupdate = $_POST['tgl_diupdate'];

    // Format ulang untuk memastikan hanya tanggal yang dikirim
    try {
        $date = DateTime::createFromFormat('Y-m-d\TH:i', $tgl_dibuat);
        if (!$date) {
            throw new Exception("Format tanggal tidak valid untuk tgl_dibuat.");
        }
        $tgl_dibuat = $date->format('Y-m-d'); // Menyimpan hanya tanggal
    } catch (Exception $e) {
        echo 'Kesalahan format tanggal: ', $e->getMessage();
        exit();
    }

    try {
        $date = DateTime::createFromFormat('Y-m-d\TH:i', $tgl_diupdate);
        if (!$date) {
            throw new Exception("Format tanggal tidak valid untuk tgl_diupdate.");
        }
        $tgl_diupdate = $date->format('Y-m-d');
    } catch (Exception $e) {
        echo 'Kesalahan format tanggal: ', $e->getMessage();
        exit();
    }

    $gambar_path = '';
    if (isset($_FILES['gambar_pengumuman']) && $_FILES['gambar_pengumuman']['error'] === UPLOAD_ERR_OK) {
        $gambar_pengumuman = $_FILES['gambar_pengumuman'];
        $gambar_path = 'uploads/gambar_pengumuman' . basename($gambar_pengumuman['name']);
        if (!move_uploaded_file($gambar_pengumuman['tmp_name'], $gambar_path)) {
            $error_message = 'Gagal mengupload gambar.';
        }
    }

    if (isset($error_message)) {
        $_SESSION['flash_message'] = [
            'type' => 'danger',
            'message' => 'Gagal menambahkan pengumuman. Error: ' . $error_message
        ];
    } else {
        $sql = "INSERT INTO pengumuman (judul_pengumuman, isi_pengumuman, gambar_pengumuman, tgl_dibuat, tgl_diupdate) 
        VALUES (?, ?, ?, ?, ?)";
        $params = array($judul_pengumuman, $isi_pengumuman, $gambar_path, $tgl_dibuat, $tgl_diupdate);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            $errors = sqlsrv_errors();
            $error_message = 'Query gagal dijalankan. Error: ' . $errors[0]['message'];
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => $error_message
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Pengumuman berhasil ditambahkan.'
            ];
        }
    }

    header("Location: http://localhost/sipresma-1.0/public/index.php?page=dosen_pengumuman_list");
    exit();
}
?>

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
                    <label class="form-label fw-medium" for="judulPengumuman">
                        Judul Pengumuman<span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="judulPengumuman" name="judul_pengumuman" required />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label fw-medium" for="isiPengumuman">
                        Isi Pengumuman<span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" id="isiPengumuman" name="isi_pengumuman" rows="5" required></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="gambarPengumuman">
                        Gambar Pengumuman<span class="text-danger">*</span>
                    </label>
                    <div class="border p-3 mb-2">
                        <div class="mb-3">
                            <label for="customFileGambarPengumuman" class="btn btn-outline-primary">
                                Pilih Gambar
                            </label>
                            <input type="file" id="customFileGambarPengumuman" name="gambar_pengumuman" style="display: none;" onchange="updateFileNameGambarPengumuman()">
                            <span id="fileNameGambarPengumuman" class="ms-2 text-muted fs-6">No file chosen</span>
                        </div>
                        <small class="form-text text-muted">
                            Ukuran (Max: 5000KB) Ekstensi (.jpg, .jpeg, .png)
                        </small>
                    </div>

                    <script>
                        function updateFileNameGambarPengumuman() {
                            var fileInput = document.getElementById('customFileGambarPengumuman');
                            var fileName = document.getElementById('fileNameGambarPengumuman');
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
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium" for="tglDibuat">
                        Tanggal Dibuat<span class="text-danger">*</span>
                    </label>
                    <input type="datetime-local" class="form-control" id="tglDibuat" name="tgl_dibuat" required />
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-medium" for="tglDiupdate">
                        Tanggal Diupdate
                    </label>
                    <input type="datetime-local" class="form-control" id="tglDiupdate" name="tgl_diupdate" />
                </div>
            </div>

            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Tambah Pengumuman</button>
            </div>
        </form>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>