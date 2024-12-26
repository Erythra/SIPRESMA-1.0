<?php
include 'partials/header.php';
$id_mahasiswa = $_SESSION['user']['id_mahasiswa'];
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.8"></script>
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


<div class="container" style="margin-top: 6rem;">
    <!-- Informasi & Bantuan Section -->
    <div class="border-0 mb-4" style=" padding: 20px;">
        <h5 class="fw-bold" style="color: #1a2a6c; font-size: 32px;">Informasi & Bantuan</h5>

        <div class="list-group mt-3">
            <!-- Panduan -->
            <a href="index.php?page=panduan" class="list-group-item list-group-item-action d-flex align-items-center gap-3" style="border-radius: 12px !important; padding: 20px;">
                <i class="bi bi-book text-warning fs-4"></i>
                <div>
                    <h6 class="mb-1 fw-bold" style="color: #1a2a6c ;">Panduan</h6>
                    <p class="mb-0 text-muted">
                        Temukan semua informasi yang Anda butuhkan untuk menggunakan platform pencatatan prestasi mahasiswa dengan mudah.
                    </p>
                </div>
                <i class="bi bi-chevron-right ms-auto text-secondary"></i>
            </a>
            <br>
            <!-- Pertanyaan yang Sering Diajukan -->
            <a href="index.php?page=faq" class="list-group-item list-group-item-action d-flex align-items-center gap-3" style="border-radius: 12px !important; padding: 20px;">
                <i class="bi bi-question-circle text-warning fs-4"></i>
                <div>
                    <h6 class="mb-1 fw-bold" style="color: #1a2a6c;">Pertanyaan yang sering diajukan</h6>
                    <p class="mb-0 text-muted">
                        Punya pertanyaan? Temukan jawabannya di sini! Kami telah mengumpulkan pertanyaan yang sering diajukan oleh mahasiswa.
                    </p>
                </div>
                <i class="bi bi-chevron-right ms-auto text-secondary"></i>
            </a>
        </div>
    </div>
</div>
<?php include 'partials/footer.php';  ?>