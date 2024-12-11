<?php

require_once __DIR__ . '/../models/PrestasiModel.php';

class PrestasiController
{
    private $prestasiModel;

    public function __construct($conn)
    {
        $this->prestasiModel = new PrestasiModel($conn);
    }
    public function getMahasiswaList()
    {
        return $this->prestasiModel->getAllMahasiswa();
    }

    public function showPrestasi($id_mahasiswa, $filters = [])
    {
        // Ambil daftar prestasi berdasarkan id mahasiswa
        return $this->prestasiModel->getPrestasiByMahasiswa($id_mahasiswa, $filters);
    }

    public function getDosenList()
    {
        return $this->prestasiModel->getAllDosen();
    }

    public function showPrestasiDetail($id_prestasi)
    {
        $prestasi = $this->prestasiModel->getPrestasiById($id_prestasi);
        include '../app/views/dosen/dosen_prestasi_detail.php';
    }


    public function showPrestasiDetailMahasiswa($id_prestasi)
    {
        $mahasiswa = $this->prestasiModel->getPrestasiById($id_prestasi);
        $dosen = $this->prestasiModel->getPrestasiById($id_prestasi);
        $prestasi = $this->prestasiModel->getPrestasiById($id_prestasi);
        include '../app/views/mahasiswa/prestasidetail.php';
    }

    public function submitForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Path direktori upload
            $uploadDir = realpath(__DIR__ . '/../../public/uploads/') . '/';

            // Pastikan folder `uploads` ada
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Menangani file upload
            $file_surat_tugas = $this->handleFileUpload($_FILES['file_surat_tugas'], $uploadDir, 'surat_tugas_');
            $foto_kegiatan = $this->handleFileUpload($_FILES['foto_kegiatan'], $uploadDir, 'foto_kegiatan_');
            $file_sertifikat = $this->handleFileUpload($_FILES['file_sertifikat'], $uploadDir, 'sertifikat_');
            $file_poster = $this->handleFileUpload($_FILES['file_poster'], $uploadDir, 'poster_');
            $lampiran_hasil_kompetisi = $this->handleFileUpload($_FILES['lampiran_hasil_kompetisi'], $uploadDir, 'lampiran_');

            $id_mahasiswa = $_SESSION['user']['id_mahasiswa'];

            // Data input
            $data = [
                'tgl_pengajuan' => date('Y-m-d H:i:s'),
                'thn_akademik' => $_POST['thn_akademik'],
                'jenis_kompetisi' => $_POST['jenis_kompetisi'],
                'juara' => $_POST['juara'],
                'url_kompetisi' => $_POST['url_kompetisi'],
                'program_studi' => $_POST['program_studi'],
                'tingkat_kompetisi' => $_POST['tingkat_kompetisi'],
                'judul_kompetisi' => $_POST['judul_kompetisi'],
                'tempat_kompetisi' => $_POST['tempat_kompetisi'],
                'jumlah_pt' => $_POST['jumlah_pt'],
                'jumlah_peserta' => $_POST['jumlah_peserta'],
                'foto_kegiatan' => $foto_kegiatan,
                'no_surat_tugas' => $_POST['no_surat_tugas'],
                'tgl_surat_tugas' => date('Y-m-d', strtotime($_POST['tgl_surat_tugas'])),
                'file_surat_tugas' => $file_surat_tugas,
                'file_sertifikat' => $file_sertifikat,
                'file_poster' => $file_poster,
                'lampiran_hasil_kompetisi' => $lampiran_hasil_kompetisi,
                'id_mahasiswa' => $id_mahasiswa
            ];

            // Data Mahasiswa (Multi-input)
            $mahasiswaData = [];
            if (isset($_POST['id_mahasiswa']) && is_array($_POST['id_mahasiswa'])) {
                foreach ($_POST['id_mahasiswa'] as $index => $id_mahasiswa) {
                    $mahasiswaData[] = [
                        'id_mahasiswa' => $id_mahasiswa,
                        'peran_mahasiswa' => $_POST['peran_mahasiswa'][$index] ?? null,
                    ];
                }
            }

            // Data Dosen (Multi-input)
            $dosenData = [];
            if (isset($_POST['id_dosen']) && is_array($_POST['id_dosen'])) {
                foreach ($_POST['id_dosen'] as $index => $id_dosen) {
                    $dosenData[] = [
                        'id_dosen' => $id_dosen,
                        'peran_pembimbing' => $_POST['peran_pembimbing'][$index] ?? null,
                    ];
                }
            }

            // Gabungkan data ke dalam array final
            $data['mahasiswa_data'] = $mahasiswaData;
            $data['dosen_data'] = $dosenData;

            // Simpan ke database
            $success = $this->prestasiModel->insertPrestasi($data);

            if ($success) {
                header('Location: index.php?page=prestasi');
            } else {
                echo "Error inserting data into database.";
            }
        }
    }

    private function handleFileUpload($file, $uploadDir, $prefix)
    {
        if (isset($file) && $file['error'] == 0) {
            $filePath = $uploadDir . $prefix . uniqid() . '_' . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                return str_replace(realpath($uploadDir), '', $filePath); // Simpan relative path
            }
        }
        return null;
    }


    public function addPrestasi($data_prestasi, $mahasiswa_ids, $dosen_ids, $files)
    {
        try {
            // Validasi tambahan jika file kosong
            foreach ($files as $key => $file) {
                if ($file['size'] == 0 || $file['error'] !== UPLOAD_ERR_OK) {
                    $_SESSION['flash_message'] = [
                        'type' => 'danger',
                        'message' => "File $key tidak di-upload atau kosong!"
                    ];
                    header("Location: index.php?page=dosen_prestasi");
                    exit;
                }
            }

            // Panggil model untuk menyimpan data
            $isInserted = $this->prestasiModel->addPrestasi($data_prestasi, $mahasiswa_ids, $dosen_ids, $files);

            if ($isInserted) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Prestasi berhasil ditambahkan!'
                ];
                header("Location: index.php?page=dosen_prestasi");
                exit;
            } else {
                $_SESSION['flash_message'] = [
                    'type' => 'danger',
                    'message' => 'Gagal menambahkan prestasi.'
                ];
                header("Location: index.php?page=dosen_prestasi");
                exit;
            }
        } catch (Exception $e) {
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ];
            header("Location: index.php?page=dosen_prestasi");
            exit;
        }
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

    public function editPrestasi($id_prestasi, $data_prestasi, $mahasiswa_ids, $dosen_ids)
    {
        $isUpdated = $this->prestasiModel->editPrestasi($id_prestasi, $data_prestasi, $mahasiswa_ids, $dosen_ids);

        if ($isUpdated) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Prestasi berhasil diperbarui!'
            ];
            header("Location: http://localhost/sipresma/public/index.php?page=dosen_prestasi");
            exit;
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Gagal memperbarui prestasi.'
            ];
            header("Location: http://localhost/sipresma/public/index.php?page=dosen_prestasi");
            exit;
        }
    }

    public function setujuiPrestasi($id_prestasi)
    {
        if ($this->prestasiModel->updateStatusPrestasi($id_prestasi, 'disetujui')) {
            $this->prestasiModel->insertHistoryApproval($id_prestasi, 'disetujui');
            $_SESSION['flash_message'] = 'Prestasi telah disetujui.';
            header("Location: ?page=dosen_prestasi_detail&id_prestasi=" . $id_prestasi);
            exit();
        } else {
            echo "Gagal menyetujui prestasi.";
        }
    }

    public function tolakPrestasi($id_prestasi, $alasan)
    {
        if ($this->prestasiModel->updateStatusPrestasi($id_prestasi, 'ditolak')) {
            $this->prestasiModel->insertHistoryApproval($id_prestasi, 'ditolak', $alasan);
            $_SESSION['flash_message'] = 'Prestasi telah ditolak.';
            header("Location: ?page=dosen_prestasi_detail&id_prestasi=" . $id_prestasi);
            exit();
        } else {
            echo "Gagal menolak prestasi.";
        }
    }
}
