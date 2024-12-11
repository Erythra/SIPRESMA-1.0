<?php
include 'partials/header.php';

$id_mahasiswa = $_SESSION['user']['id_mahasiswa'];
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panduan Pengajuan Prestasi</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
<style>
    body {
        background-color: #F5F2FE;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;

    }

    .row .col .card {
        background-color: #F5F7FF !important;

    }

    .row .col .card p {
        margin-bottom: 0 !important;
        font-size: 14px;
    }

    .content {
        margin-top: 20px;
        margin-bottom: 20px;

    }

    .content .card {
        color: #1a2a6c !important;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .content .card .row .col {
        max-width: 30rems !important;
    }

    .content .card h5 {
        font-size: 16px;
        font-weight: 600;
    }

    .content .card .row .col .card {
        min-width: 28.4375rem !important;
    }

    .main-card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        color: #1a2a6c;


    }

    .content .card .row .col .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="info">
    <p class="info-text">Home - Bantuan - FAQ</p>
</div>
<!-- Content -->
<div class="container content" style="margin-top: 6rem;">
    <div class="card main-card d-flex justify-content-center align-items-center vh-10 p-4">
        <h1 class="text-center" style="font-weight: 600 !important; font-size: 1.5rem;">Pertanyaan yang Sering Diajukan</h1>
        <br>
        <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
            <div class="col">
                <div class="card p-4 text-center shadow-sm">
                    <h5>Bagaimana cara mendaftarkan prestasi saya di SIPRESMA?</h5>
                    <p>Anda dapat mendaftarkan prestasi dengan login ke akun SIPRESMA Anda,
                        lalu pilih menu Prestasi dan klik tambah prestasi. Isi formulir dengan lengkap dan unggah dokumen pendukung.</p>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 text-center shadow-sm">
                    <h5>Bagaimana kita mengetahui data kita divalidasi?</h5>
                    <p>Cara mengetahuinya dengan cara mengecek di fitur list prestasi pada kolom status.</p>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 text-center shadow-sm">
                    <h5>Apa yang harus dilakukan jika data prestasi saya ditolak?</h5>
                    <p>Jika data prestasi ditolak, Anda dapat melihat alasan penolakan di menu Detail Prestasi lalu cek riwayat persetujuan. Setelah itu, perbaiki data Anda sesuai alasan penolakan dan ajukan kembali.</p>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 text-center shadow-sm">
                    <h5>Apakah prestasi yang tidak bersifat akademik bisa didaftarkan?</h5>
                    <p>Ya, SIPRESMA menerima prestasi non-akademik seperti olahraga, seni, dan kegiatan sosial, selama memenuhi kriteria yang telah ditetapkan.</p>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 text-center shadow-sm">
                    <h5>Bagaimana cara mengedit data prestasi yang sudah didaftarkan?</h5>
                    <p>Anda dapat mengedit data selama statusnya masih Belum Disetujui. Klik tombol Edit di menu List Prestasi, lakukan perubahan, lalu simpan data Anda.</p>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 text-center shadow-sm">
                    <h5>Apakah saya dapat mendaftarkan lebih dari satu prestasi dalam waktu bersamaan?</h5>
                    <p>Ya, Anda dapat mendaftarkan lebih dari satu prestasi. Cukup tambahkan setiap prestasi secara terpisah melalui menu Tambah Prestasi dan lengkapi dokumen pendukung untuk masing-masing prestasi.</p>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 text-center shadow-sm">
                    <h5>Apakah saya dapat menghapus prestasi yang sudah didaftarkan?</h5>
                    <p>Prestasi yang sudah didaftarkan tidak dapat dihapus, tetapi Anda dapat mengeditnya jika statusnya masih Belum Disetujui.</p>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Footer -->
<?php include 'partials/footer.php'; ?>