<?php
session_start();
require_once '../config/config.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/PrestasiController.php';
require_once '../app/controllers/DosenPrestasiController.php';
require_once '../app/controllers/ApprovalController.php';

$authController = new AuthController($conn);
$prestasiController = new PrestasiController($conn);
$dosenPrestasiController = new DosenPrestasiController($conn);
$approvalController = new ApprovalController($conn);

date_default_timezone_set('Asia/Jakarta');

if (isset($_SESSION['user'])) {
    $authController->isSessionActive();
}

$page = $_GET['page'] ?? 'homepertama';
$action = $_GET['action'] ?? '';

if ($action === 'logout') {
    $authController->logout();
}

if ($action === 'login') {
    $authController->login();
}

if ($action === 'submit_prestasi') {
    $prestasiController->handlePostRequest();
}

if ($action === 'update_prestasi') {

    $id_prestasi = $_POST['id_prestasi'] ?? $_SESSION['id_prestasi'] ?? null;

    error_log("ID Prestasi dari GET: " . ($_GET['id_prestasi'] ?? 'Tidak ada'));
    error_log("ID Prestasi dari POST: " . ($_POST['id_prestasi'] ?? 'Tidak ada'));
    error_log("ID Prestasi dari SESSION: " . ($_SESSION['id_prestasi'] ?? 'Tidak ada'));

    if (!$id_prestasi) {
        echo "ID Prestasi tidak ditemukan.";
        error_log("ID Prestasi tidak ditemukan. POST: " . ($_POST['id_prestasi'] ?? 'null') . ", SESSION: " . ($_SESSION['id_prestasi'] ?? 'null'));
        exit;
    }

    if ($id_prestasi < 0) {

        echo "ID Prestasi tidak valid.";
        exit;
    }
    $prestasiController->handleUpdateRequest($id_prestasi);
}

if ($action === 'ganti_password') {
    $authController->changePassword();
}

$page = $_GET['page'] ?? 'homepertama';
$action = $_GET['action'] ?? '';

switch ($page) {
    case 'homepertama':
        include '../app/views/homepertama.php';
        break;

        // DOSEN
    case 'dosen_dashboard':
        $countPrestasi = $dosenPrestasiController->countPrestasiDashboard();
        include '../app/views/dosen/dosen_dashboard.php';
        break;

    case 'dosen_prestasi':
        if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id_prestasi'])) {
            $id_prestasi = $_GET['id_prestasi'];
            $dosenPrestasiController->deletePrestasi($id_prestasi);
        }
        include '../app/views/dosen/dosen_prestasi.php';
        break;

    case 'dosen_prestasi_add':
        $dosenPrestasiController->handlePostRequest();

        $dosenPrestasiController->tampilForm();
        break;

    case 'dosen_prestasi_detail':
        $id_prestasi = $_GET['id_prestasi'] ?? 0;
        if ($id_prestasi > 0) {
            $dosenPrestasiController->showPrestasiDetail($id_prestasi);
        } else {
            echo "ID Prestasi tidak valid.";
        }

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $dosen_id = $_SESSION['user']['id_dosen'];

            if ($action == 'approve') {
                $approvalController->approve($id_prestasi, $dosen_id);
            } elseif ($action == 'reject') {
                $approvalController->reject($id_prestasi, $dosen_id);
            }
        }

        break;

    case 'dosen_prestasi_add':
        $mahasiswaList = $dosenPrestasiController->getMahasiswaList();
        $dosenList = $dosenPrestasiController->getDosenList();
        include '../app/views/dosen/dosen_prestasi_add.php';
        break;

    case 'dosen_pengumuman_list':
        include '../app/views/dosen/dosen_pengumuman_list.php';
        break;

    case 'dosen_pengumuman_add':
        include '../app/views/dosen/dosen_pengumuman_add.php';
        break;

    case 'dosen_pengumuman_detail':
        include '../app/views/dosen/dosen_pengumuman_detail.php';
        break;

    case 'dosen_peringkat_akademik':
        include '../app/views/dosen/dosen_peringkat_akademik.php';
        break;

    case 'dosen_pengumuman_update':
        include '../app/views/dosen/dosen_pengumuman_update.php';
        break;

        // MAHASISWA
    case 'home':
        include '../app/views/mahasiswa/home.php';
        break;

    case 'semua_pengumuman':
        include '../app/views/mahasiswa/mhs_semua_pengumuman.php';
        break;

    case 'detail_pengumuman':
        include '../app/views/mahasiswa/mhs_detail_pengumuman.php';
        break;

    case 'profile':
        include '../app/views/mahasiswa/profile.php';
        break;

    case 'edit':
        include '../app/views/mahasiswa/edit.php';
        break;

    case 'prestasiedit':
        include '../app/views/mahasiswa/prestasiedit.php';
        break;

    case 'prestasi':
        $filters = [
            'juara' => $_GET['juara'] ?? '',
            'jenis_kompetisi' => $_GET['jenis_kompetisi'] ?? '',
            'tingkat_kompetisi' => $_GET['tingkat_kompetisi'] ?? '',
            'tempat_kompetisi' => $_GET['tempat_kompetisi'] ?? '',
            'status_pengajuan' => $_GET['status_pengajuan'] ?? '',
        ];

        $id_mahasiswa = $_SESSION['user']['id_mahasiswa'];
        $prestasiList = $prestasiController->showPrestasi($id_mahasiswa, $filters);

        if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id_prestasi'])) {
            $id_prestasi = $_GET['id_prestasi'];
            $prestasiController->deletePrestasi($id_prestasi);
        }

        include '../app/views/mahasiswa/prestasi.php';
        break;

    case 'prestasidetail':
        $id_prestasi = $_GET['id_prestasi'] ?? 0;
        if ($id_prestasi > 0) {
            $prestasiController->showPrestasiDetailMahasiswa($id_prestasi);
        } else {
            echo "ID Prestasi tidak valid.";
        }
        break;

    case 'login':
        include '../app/views/login.php';
        break;

    case 'tambahprestasi':
        include '../app/views/mahasiswa/tambahprestasi.php';
        break;

    case 'peringkat_akademik':
        include '../app/views/mahasiswa/peringkat_akademik.php';
        break;

    case 'ipk':
        include '../app/views/mahasiswa/ipk.php';
        break;

    case 'bantuan':
        include '../app/views/mahasiswa/bantuan.php';
        break;

    case 'bantuantanpalogin':
        include '../app/views/bantuantanpalogin.php';
        break;

    case 'panduantanpalogin':
        include '../app/views/panduantanpalogin.php';
        break;

    case 'faqtanpalogin':
        include '../app/views/faqtanpalogin.php';
        break;

    case 'faq':
        include '../app/views/mahasiswa/faq.php';
        break;

    case 'panduan':
        include '../app/views/mahasiswa/panduan.php';
        break;

    case 'pengumuman':
        include '../app/views/mahasiswa/mhs_semua_pengumuman.php';
        break;

    case 'detail_pengumuman':
        include '../app/views/mahasiswa/mhs_detail_pengumuman.php';
        break;
}
