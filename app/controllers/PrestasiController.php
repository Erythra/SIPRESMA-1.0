<?php

require_once __DIR__ . '/../models/PrestasiModel.php';

class PrestasiController
{
    private $prestasiModel;

    public function __construct($conn)
    {
        $this->prestasiModel = new PrestasiModel($conn);
    }

    public function showPrestasiDetail($id_prestasi)
    {
        $prestasi = $this->prestasiModel->getPrestasiForDetail($id_prestasi);

        $historyApproval = $this->prestasiModel->getHistoryApprovalByPrestasiId($id_prestasi);

        include '../app/views/dosen/dosen_prestasi_detail.php';
    }

    public function showPrestasiEdit($id_prestasi)
    {
        $prestasi = $this->prestasiModel->getPrestasiById($id_prestasi);
        return $this->prestasiModel->getPrestasiById($id_prestasi);
    }

    public function addPrestasi($data_prestasi)
    {
        $mahasiswa_ids = isset($_POST['mahasiswa_ids']) ? $_POST['mahasiswa_ids'] : [];
        $dosen_ids = isset($_POST['dosen_ids']) ? $_POST['dosen_ids'] : [];

        try {
            $isInserted = $this->prestasiModel->addPrestasi($data_prestasi, $mahasiswa_ids, $dosen_ids);

            if ($isInserted) {
                echo "Prestasi berhasil ditambahkan!";
            } else {
                print_r($isInserted);
                echo "Gagal menambahkan prestasi. Coba lagi.";
                error_log("Error: Gagal menambahkan prestasi. Data: " . print_r($data_prestasi, true));
            }
        } catch (Exception $e) {
            error_log("Error saat menambahkan prestasi: " . $e->getMessage());
            echo "Terjadi kesalahan saat menambahkan prestasi: " . $e->getMessage();
        }
    }

    public function handlePostRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'tgl_pengajuan' => date('Y-m-d H:i:s', strtotime($_POST['tgl_pengajuan'])),
                'program_studi' => $_POST['program_studi'],
                'thn_akademik' => $_POST['thn_akademik'],
                'jenis_kompetisi' => $_POST['jenis_kompetisi'],
                'juara' => $_POST['juara'],
                'tingkat_kompetisi' => $_POST['tingkat_kompetisi'],
                'judul_kompetisi' => $_POST['judul_kompetisi'],
                'tempat_kompetisi' => $_POST['tempat_kompetisi'],
                'url_kompetisi' => $_POST['url_kompetisi'],
                'jumlah_pt' => $_POST['jumlah_pt'],
                'jumlah_peserta' => $_POST['jumlah_peserta'],
                'no_surat_tugas' => $_POST['no_surat_tugas'],
                'tgl_surat_tugas' => date('Y-m-d', strtotime($_POST['tgl_surat_tugas'])),
                'foto_kegiatan' => isset($_FILES['foto_kegiatan']) && $_FILES['foto_kegiatan']['error'] == 0 ? file_get_contents($_FILES['foto_kegiatan']['tmp_name']) : NULL,
                'file_surat_tugas' => isset($_FILES['file_surat_tugas']) && $_FILES['file_surat_tugas']['error'] == 0 ? file_get_contents($_FILES['file_surat_tugas']['tmp_name']) : NULL,
                'file_sertifikat' => isset($_FILES['file_sertifikat']) && $_FILES['file_sertifikat']['error'] == 0 ? file_get_contents($_FILES['file_sertifikat']['tmp_name']) : NULL,
                'file_poster' => isset($_FILES['file_poster']) && $_FILES['file_poster']['error'] == 0 ? file_get_contents($_FILES['file_poster']['tmp_name']) : NULL,
                'lampiran_hasil_kompetisi' => isset($_FILES['lampiran_hasil_kompetisi']) && $_FILES['lampiran_hasil_kompetisi']['error'] == 0 ? file_get_contents($_FILES['lampiran_hasil_kompetisi']['tmp_name']) : NULL,
                'id_mahasiswa' => $_POST['id_mahasiswa'],
                'peran_mahasiswa' => $_POST['peran_mahasiswa'],
                'id_dosen' => $_POST['id_dosen'],
                'peran_pembimbing' => $_POST['peran_pembimbing']
            ];

            $this->prestasiModel->insertPrestasi($data);

            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Prestasi berhasil ditambahkan!'
            ];

            header('Location: http://localhost/sipresma/public/index.php?page=dosen_prestasi');
            exit;
        }
    }

    public function tampilForm()
    {
        $mahasiswaList = $this->prestasiModel->getAllMahasiswa();
        $dosenList = $this->prestasiModel->getAllDosen();
        include '../app/views/dosen/dosen_prestasi_add.php';
    }
    public function updatePrestasi($id_prestasi, $data_prestasi)
    {
        // Set default date for tgl_pengajuan
        $data_prestasi['tgl_pengajuan'] = date('Y-m-d H:i:s');

        // Call model updatePrestasi and check if it returns true or false
        $isUpdated = $this->prestasiModel->updatePrestasi($id_prestasi, $data_prestasi);

        // Set session flash message based on result
        if ($isUpdated) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Prestasi berhasil diperbarui!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Gagal memperbarui prestasi.'
            ];
        }

        // Redirect ke halaman dosen_prestasi
        header("Location: http://localhost/sipresma/public/index.php?page=dosen_prestasi");
        exit;
    }


    public function deletePrestasi($id_prestasi)
    {
        $isDeleted = $this->prestasiModel->deletePrestasi($id_prestasi);

        if ($isDeleted) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Prestasi berhasil dihapus!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Gagal menghapus prestasi.'
            ];
        }

        header("Location: http://localhost/sipresma/public/index.php?page=dosen_prestasi");
        exit;
    }

    public function showAllPrestasi()
    {
        return $this->prestasiModel->getAllPrestasi();
    }

    public function showPrestasiDosen($id_dosen, $role)
    {
        // Ambil daftar prestasi berdasarkan id dosen
        return $this->prestasiModel->getPrestasiByDosen($id_dosen, $_SESSION['role']);
    }
}
