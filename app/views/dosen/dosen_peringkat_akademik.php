<?php include 'partials/header.php'; ?>
<?php include 'partials/sidenav.php'; ?>


<div class="mt-3" style="margin-left: 317px; margin-right: 32px;">
    <div style="margin-bottom: 17.5px;">
        <h4 class="fw-semibold">Prestasi</h4>
        <h6 class="fw-medium text-muted">Home - Prestasi</h6>
    </div>
    <div class="card mb-5" >
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button aria-controls="akademik" aria-selected="true" class="nav-link active" data-bs-target="#akademik"
                    data-bs-toggle="tab" id="akademik-tab" role="tab" type="button">
                    Akademik
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button aria-controls="non-akademik" aria-selected="false" class="nav-link"
                    data-bs-target="#non-akademik" data-bs-toggle="tab" id="non-akademik-tab" role="tab" type="button">
                    Non-Akademik
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button aria-controls="ipk" aria-selected="false" class="nav-link" data-bs-target="#ipk"
                    data-bs-toggle="tab" id="ipk-tab" role="tab" type="button">
                    IPK
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button aria-controls="semua" aria-selected="false" class="nav-link" data-bs-target="#semua"
                    data-bs-toggle="tab" id="semua-tab" role="tab" type="button">
                    Semua
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div aria-labelledby="akademik-tab" class="tab-pane fade show active" id="akademik" role="tabpanel">
                <div class="d-flex justify-content-end mt-3">
                    <div class="dropdown">
                        <button aria-expanded="false" class="btn btn-outline-secondary dropdown-toggle"
                            data-bs-toggle="dropdown" id="dropdownMenuButton" type="button">
                            2024
                        </button>
                        <ul aria-labelledby="dropdownMenuButton" class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">
                                    2023
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    2022
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    2021
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <table class="table mt-3">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Peringkat
                            </th>
                            <th>
                                NIM
                            </th>
                            <th>
                                Nama
                            </th>
                            <th>
                                Jurusan
                            </th>
                            <th>
                                Jumlah Prestasi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>
                                1
                            </td>
                            <td>
                                1234567890
                            </td>
                            <td>
                                <img alt="Profile picture of Daniel Levi" height="40"
                                    src="https://storage.googleapis.com/a1aa/image/S97ecnhW5jW0QiiW7vDbmbljqn6Zthh9oS6plZrNSeRVBwzTA.jpg"
                                    width="40" />
                                Daniel Levi
                            </td>
                            <td>
                                D-IV Teknik Informatika
                            </td>
                            <td>
                                50
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                2
                            </td>
                            <td>
                                1234567890
                            </td>
                            <td>
                                <img alt="Profile picture of Daniel Levi" height="40"
                                    src="https://storage.googleapis.com/a1aa/image/S97ecnhW5jW0QiiW7vDbmbljqn6Zthh9oS6plZrNSeRVBwzTA.jpg"
                                    width="40" />
                                Daniel Levi
                            </td>
                            <td>
                                D-IV Teknik Informatika
                            </td>
                            <td>
                                50
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                3
                            </td>
                            <td>
                                1234567890
                            </td>
                            <td>
                                <img alt="Profile picture of Daniel Levi" height="40"
                                    src="https://storage.googleapis.com/a1aa/image/S97ecnhW5jW0QiiW7vDbmbljqn6Zthh9oS6plZrNSeRVBwzTA.jpg"
                                    width="40" />
                                Daniel Levi
                            </td>
                            <td>
                                D-IV Teknik Informatika
                            </td>
                            <td>
                                50
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                4
                            </td>
                            <td>
                                1234567890
                            </td>
                            <td>
                                <img alt="Profile picture of Daniel Levi" height="40"
                                    src="https://storage.googleapis.com/a1aa/image/S97ecnhW5jW0QiiW7vDbmbljqn6Zthh9oS6plZrNSeRVBwzTA.jpg"
                                    width="40" />
                                Daniel Levi
                            </td>
                            <td>
                                D-IV Teknik Informatika
                            </td>
                            <td>
                                50
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                5
                            </td>
                            <td>
                                1234567890
                            </td>
                            <td>
                                <img alt="Profile picture of Daniel Levi" height="40"
                                    src="https://storage.googleapis.com/a1aa/image/S97ecnhW5jW0QiiW7vDbmbljqn6Zthh9oS6plZrNSeRVBwzTA.jpg"
                                    width="40" />
                                Daniel Levi
                            </td>
                            <td>
                                D-IV Teknik Informatika
                            </td>
                            <td>
                                50
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <select class="form-select" style="width: 70px;">
                            <option value="10">
                                10
                            </option>
                            <option value="20">
                                20
                            </option>
                            <option value="30">
                                30
                            </option>
                        </select>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a aria-label="Previous" class="page-link" href="#">
                                    <span aria-hidden="true">
                                        «
                                    </span>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">
                                    1
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    2
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    ...
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    10
                                </a>
                            </li>
                            <li class="page-item">
                                <a aria-label="Next" class="page-link" href="#">
                                    <span aria-hidden="true">
                                        »
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div aria-labelledby="non-akademik-tab" class="tab-pane fade" id="non-akademik" role="tabpanel">
                Non-Akademik content
            </div>
            <div aria-labelledby="ipk-tab" class="tab-pane fade" id="ipk" role="tabpanel">
                IPK content
            </div>
            <div aria-labelledby="semua-tab" class="tab-pane fade" id="semua" role="tabpanel">
                Semua content
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
