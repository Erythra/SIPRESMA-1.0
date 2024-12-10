<?php
include 'partials/header.php';

$id_mahasiswa = $_SESSION['user']['id_mahasiswa'];
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.8"></script>
<link rel="stylesheet" href="./../../../assets/css/style.css">

<div class="container mt-4">
    <!-- Informasi & Bantuan Section -->
    <div class="border-0 p-4 rounded-3 shadow-sm mb-4" style="background-color: #f8f9fa;">
        <h5 class="fw-bold" style="color: #1a2a6c; font-size: 32px;">Informasi & Bantuan</h5>

        <div class="list-group mt-3">
            <!-- Panduan -->
            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-3 p-3 rounded-3 mb-2" style="background-color: #fff; border: 1px solid #ddd;">
                <i class="bi bi-book text-warning fs-4"></i>
                <div>
                    <h6 class="mb-1 fw-bold" style="color: #1a2a6c;">Panduan</h6>
                    <p class="mb-0 text-muted">
                        Temukan semua informasi yang Anda butuhkan untuk menggunakan platform pencatatan prestasi mahasiswa dengan mudah.
                    </p>
                </div>
                <i class="bi bi-chevron-right ms-auto text-secondary"></i>
            </a>

            <!-- Pertanyaan yang Sering Diajukan -->
            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-3 p-3 rounded-3 mb-2" style="background-color: #fff; border: 1px solid #ddd;">
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

<?php include 'partials/footer.php'; ?>
