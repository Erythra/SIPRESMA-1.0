<?php include 'partials/header.php'; ?>
<?php include 'partials/sidenav.php'; ?>

<div class="" style="margin-left: 317px; margin-right: 32px; margin-top: 90px;">
    <div style="margin-bottom: 17.5px;">
        <h4 class="fw-semibold">Dashboard</h4>
        <h6 class="fw-medium text-muted">Home</h6>
    </div>
    <div class="d-flex justify-content-start gap-2">
        <div class="card" style="width: 40%; padding: 18px 24px; border-top: solid 4px #212529;">
            <p class="fw-semibold mb-0" style="margin-bottom: 10px;">Prestasi Belum Diverifikasi</p>
            <p class="fw-semibold fs-2 mb-0">100</p>
        </div>
        <div class="card" style="width: 40%; padding: 18px 24px; border-top: solid 4px #15803D;">
            <p class="fw-semibold mb-0" style="margin-bottom: 10px;">Prestasi Diverifikasi</p>
            <p class="fw-semibold fs-2 mb-0">100</p>
        </div>
        <div class="card" style="width: 40%; padding: 18px 24px; border-top: solid 4px #B91C1C;">
            <p class="fw-semibold mb-0" style="margin-bottom: 10px;">Prestasi Ditolak</p>
            <p class="fw-semibold fs-2 mb-0">100</p>
        </div>
    </div>
    

    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center"
                style="margin-left: 24px; margin-right: 24px;">
                <h4 class="fw-semibold mb-0">Total Upload Data Prestasi</h4>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio1" id="btnradio1" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="btnradio1">Hari</label>

                    <input type="radio" class="btn-check" name="btnradio1" id="btnradio2" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio2">Bulan</label>

                    <input type="radio" class="btn-check" name="btnradio1" id="btnradio3" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio3">Tahun</label>
                </div>
            </div>
        </div>

        <div style="padding: 5px 24px 24px 24px;">
            <canvas class="my-4 w-100" id="totalupload" width="900" height="380"></canvas>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center"
                style="margin-left: 24px; margin-right: 24px;">
                <h4 class="fw-semibold mb-0">Rata-rata IPK Mahasiswa</h4>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Angkatan 2023
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            2023 - 2024 Ganjil
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div style="padding: 5px 24px 24px 24px;">
            <canvas class="my-4 w-100" id="rataipk" width="900" height="380"></canvas>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center"
                style="margin-left: 24px; margin-right: 24px;">
                <h4 class="fw-semibold mb-0">Prestasi Mahasiswa</h4>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio2" id="btnradio4" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="btnradio4">Hari</label>

                    <input type="radio" class="btn-check" name="btnradio2" id="btnradio5" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio5">Bulan</label>

                    <input type="radio" class="btn-check" name="btnradio2" id="btnradio6" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio6">Tahun</label>
                </div>
            </div>
        </div>

        <div style="padding: 5px 24px 24px 24px;">
            <canvas id="prestasiChart"></canvas>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center"
                style="margin-left: 24px; margin-right: 24px;">
                <h4 class="fw-semibold mb-0">Papan Peringkat</h4>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            2024
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-primary btn-peringkat">Lihat Papan Peringkat</button>
                </div>
            </div>
        </div>

        <div style="padding: 30px 87px 20px 87px;">
            <div class="d-flex justify-content-start gap-3">
                <div class="text-center align-items-center" style="width: 40%; padding: 18px 24px;">
                    <div class="mb-3">
                        <img src="../../assets/img/profile.png" alt="" style="width: 64px; height: 87px;">
                    </div>
                    <div class="mb-3">
                        <p class="fw-semibold mb-0" style="margin-bottom: 10px;">Daniel Levi</p>
                        <p class="fw-light mb-0 text-muted">DIV-Teknik Informatika</p>
                    </div>
                    <div class="rectangle d-flex justify-content-start align-items-center" style="padding-left: 6px;">
                        <img src="../../assets/img/piala.png" alt="" style="width: 36.4px; height: 37.22px; margin-right: 10px;">
                        <div class="d-flex justify-content-start align-items-center">
                            <p class="mb-0" style="color: #212529;"><span class="fw-semibold fs-5" style="color: #244282;">50</span> Prestasi</p>
                        </div>
                    </div>
                </div>
                <div class="text-center align-items-center" style="width: 40%; padding: 18px 24px;">
                    <div class="mb-3">
                        <img src="../../assets/img/profile 1.png" alt="" style="width: 64px; height: 87px;">
                    </div>
                    <div class="mb-3">
                        <p class="fw-semibold mb-0" style="margin-bottom: 10px;">Daniel Levi</p>
                        <p class="fw-light mb-0 text-muted">DIV-Teknik Informatika</p>
                    </div>
                    <div class="rectangle d-flex justify-content-start align-items-center" style="padding-left: 6px;">
                        <img src="../../assets/img/piala.png" alt="" style="width: 36.4px; height: 37.22px; margin-right: 10px;">
                        <div class="d-flex justify-content-start align-items-center">
                            <p class="mb-0" style="color: #212529;"><span class="fw-semibold fs-5" style="color: #244282;">50</span> Prestasi</p>
                        </div>
                    </div>
                </div>
                <div class="text-center align-items-center" style="width: 40%; padding: 18px 24px;">
                    <div class="mb-3">
                        <img src="../../assets/img/profile 3.png" alt="" style="width: 64px; height: 87px;">
                    </div>
                    <div class="mb-3">
                        <p class="fw-semibold mb-0" style="margin-bottom: 10px;">Daniel Levi</p>
                        <p class="fw-light mb-0 text-muted">DIV-Teknik Informatika</p>
                    </div>
                    <div class="rectangle d-flex justify-content-start align-items-center" style="padding-left: 6px;">
                        <img src="../../assets/img/piala.png" alt="" style="width: 36.4px; height: 37.22px; margin-right: 10px;">
                        <div class="d-flex justify-content-start align-items-center">
                            <p class="mb-0" style="color: #212529;"><span class="fw-semibold fs-5" style="color: #244282;">50</span> Prestasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js"
    integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp"
    crossorigin="anonymous"></script>
<script src="././../assets/js/totalupload.js"></script>
<script src="././../assets/js/rataipk.js"></script>
<script src="././../assets/js/prestasi.js"></script>

</body>

</html>