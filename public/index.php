<?php
session_start();
require_once '../config/config.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/PrestasiController.php';

$authController = new AuthController($conn);
$prestasiController = new PrestasiController($conn);

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

if ($action === 'edit') {
    $authController->editprofilemahasiswa();
}

if ($action === 'submit_prestasi') {
    $prestasiController->submitForm();
}

switch ($page) {
    case 'homepertama':
        include '../app/views/homepertama.php';
        break;

    case 'home':
        include '../app/views/mahasiswa/home.php';
        break;

    case 'profile':
        include '../app/views/mahasiswa/profile.php';
        break;

    case 'edit':
        include '../app/views/mahasiswa/edit.php';
        break;

    case 'dosen_dashboard':
        include '../app/views/dosen/dosen_dashboard.php';
        break;

    case 'dosen_prestasi':
        $prestasiList = $prestasiController->showAllPrestasi();
        include '../app/views/dosen/dosen_prestasi.php';
        break;

    case 'dosen_prestasi_detail':
        $id_prestasi = $_GET['id_prestasi'] ?? 0;
        if ($id_prestasi > 0) {
            $prestasiController->showPrestasiDetail($id_prestasi);
        } else {
            echo "ID Prestasi tidak valid.";
        }
        break;

    case 'prestasi':
        $prestasiList = $prestasiController->showAllPrestasi();
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

    case 'dosen_prestasi_detail':
        $id_prestasi = $_GET['id_prestasi'] ?? 0;
        if ($id_prestasi > 0) {
            $prestasiController->showPrestasiDetailDosen($id_prestasi);
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

    case 'dosen_prestasi_add':
        $mahasiswaList = $prestasiController->getMahasiswaList();
        $dosenList = $prestasiController->getDosenList();
        include '../app/views/dosen/dosen_prestasi_add.php';
        break;
    
    case 'peringkat_akademik':
        include '../app/views/mahasiswa/peringkat_akademik.php';
        break;

    case 'dosen_peringkat_akademik':
        include '../app/views/dosen/dosen_peringkat_akademik.php';
        break;

    case 'ipk':
        include '../app/views/mahasiswa/ipk.php';
        break;
    
    case 'bantuan':
        include '../app/views/mahasiswa/bantuan.php';
        break;

    case 'addPrestasi':
        $data_prestasi = [
            'judul_kompetisi' => $_POST['judul_kompetisi'] ?? '',
            'thn_akademik' => $_POST['thn_akademik'] ?? '',
            'jenis_kompetisi' => $_POST['jenis_kompetisi'] ?? '',
            'juara' => $_POST['juara'] ?? 1,
            'tingkat_kompetisi' => $_POST['tingkat_kompetisi'] ?? '',
            'tempat_kompetisi' => $_POST['tempat_kompetisi'] ?? '',
            'jumlah_pt' => $_POST['jumlah_pt'] ?? 0,
            'jumlah_peserta' => $_POST['jumlah_peserta'] ?? 0,
            'program_studi' => $_POST['program_studi'] ?? '',
            'url_kompetisi' => $_POST['url_kompetisi'] ?? '',
            'no_surat_tugas' => $_POST['no_surat_tugas'] ?? '',
            'tgl_surat_tugas' => $_POST['tgl_surat_tugas'] ?? '',
            'status_pengajuan' => $_POST['status_pengajuan'] ?? 'belum disetujui',
            'tanggal_mulai' => $_POST['tanggal_mulai'] ?? '',
            'tanggal_selesai' => $_POST['tanggal_selesai'] ?? '',
            'tgl_pengajuan' => date('Y-m-d H:i:s')
        ];

        $mahasiswa_ids = $_POST['mahasiswa_ids'];
        $dosen_ids = $_POST['dosen_ids'];

        // Validasi File Upload
        $files = [
            'surat_tugas' => $_FILES['file_surat_tugas'] ?? null,
            'sertifikat' => $_FILES['file_sertifikat'] ?? null,
            'foto_kegiatan' => $_FILES['foto_kegiatan'] ?? null,
            'poster' => $_FILES['file_poster'] ?? null,
            'lampiran_hasil_kompetisi' => $_FILES['lampiran_hasil_kompetisi'] ?? null
        ];

        foreach ($files as $key => $file) {
            if ($file === null || $file['error'] !== UPLOAD_ERR_OK) {
                $_SESSION['flash_message'] = [
                    'type' => 'danger',
                    'message' => "File $key tidak valid atau tidak di-upload!"
                ];
                header("Location: index.php?page=dosen_prestasi");
                exit;
            }
        }

        $prestasiController->addPrestasi($data_prestasi, $mahasiswa_ids, $dosen_ids, $files);
        include '../app/views/dosen/dosen_prestasi.php';
        break;

    default:
        echo "Halaman tidak ditemukan.";
        break;
}

// Actions outside switch
if (isset($_POST['setujui']) && isset($_GET['id_prestasi'])) {
    $id_prestasi = $_GET['id_prestasi'];
    $prestasiController->setujuiPrestasi($id_prestasi);
}

if (isset($_POST['tolak']) && isset($_GET['id_prestasi']) && isset($_POST['alasan'])) {
    $id_prestasi = $_GET['id_prestasi'];
    $alasan = $_POST['alasan'];
    $prestasiController->tolakPrestasi($id_prestasi, $alasan);
}
