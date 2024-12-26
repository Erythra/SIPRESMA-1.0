<?php

require_once __DIR__ . '/../models/PrestasiModel.php';

class PrestasiController
{
    private $prestasiModel;
    private $dosenPrestasiModel;

    public function __construct($conn)
    {
        $this->prestasiModel = new PrestasiModel($conn);
        $this->dosenPrestasiModel = new dosenPrestasiModel($conn);
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

    public function submitForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Data utama prestasi
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
                'no_surat_tugas' => $_POST['no_surat_tugas'],
                'tgl_surat_tugas' => date('Y-m-d', strtotime($_POST['tgl_surat_tugas'])),
                'foto_kegiatan' => isset($_FILES['foto_kegiatan']['tmp_name']) ? file_get_contents($_FILES['foto_kegiatan']['tmp_name']) : null,
                'file_surat_tugas' => isset($_FILES['file_surat_tugas']['tmp_name']) ? file_get_contents($_FILES['file_surat_tugas']['tmp_name']) : null,
                'file_sertifikat' => isset($_FILES['file_sertifikat']['tmp_name']) ? file_get_contents($_FILES['file_sertifikat']['tmp_name']) : null,
                'file_poster' => isset($_FILES['file_poster']['tmp_name']) ? file_get_contents($_FILES['file_poster']['tmp_name']) : null,
                'lampiran_hasil_kompetisi' => isset($_FILES['lampiran_hasil_kompetisi']['tmp_name']) ? file_get_contents($_FILES['lampiran_hasil_kompetisi']['tmp_name']) : null,
                'id_mahasiswa' => $_SESSION['user']['id_mahasiswa']
            ];

            // Data Mahasiswa (Multi-input)
            $mahasiswaData = [];
            if (!empty($_POST['id_mahasiswa']) && is_array($_POST['id_mahasiswa'])) {
                foreach ($_POST['id_mahasiswa'] as $index => $id_mahasiswa) {
                    $mahasiswaData[] = [
                        'id_mahasiswa' => $id_mahasiswa,
                        'peran_mahasiswa' => $_POST['peran_mahasiswa'][$index] ?? null,
                    ];
                }
            }

            // Data Dosen (Multi-input)
            $dosenData = [];
            if (!empty($_POST['id_dosen']) && is_array($_POST['id_dosen'])) {
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

            // Simpan data ke database menggunakan model
            $success = $this->prestasiModel->insertPrestasi($data);

            // Redirect atau tampilkan pesan berdasarkan hasil
            if ($success) {
                header('Location: index.php?page=prestasi');
                exit;
            } else {
                echo "Gagal menyimpan data ke database.";
                header('Location: index.php?page=prestasi');
                exit;
            }
        }
    }


    public function handlePostRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_mahasiswa = $_SESSION['user']['id_mahasiswa'];
            // Data utama prestasi
            $data = [
                'tgl_pengajuan' => date('Y-m-d H:i:s'),
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

            // Simpan data ke model
            $success = $this->prestasiModel->insertPrestasi($data);

            if ($success) {
                echo "Data berhasil disimpan.";
                header('Location: index.php?page=prestasi');
                exit;
            } else {
                echo "Data gagal disimpan.";
            }
            exit;
        }
    }

    public function handleUpdateRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_prestasi = $_POST['id_prestasi'] ?? $_SESSION['id_prestasi'] ?? null;

            if (!$id_prestasi) {
                echo "ID Prestasi tidak ditemukan.";
                exit;
            }

            // Data utama prestasi
            $data = [
                'id_prestasi' => $id_prestasi,
                'tgl_pengajuan' => date('Y-m-d H:i:s'),
                'program_studi' => $_POST['program_studi'],
                'thn_akademik' => $_POST['thn_akademik'],
                'jenis_kompetisi' => $_POST['jenis_kompetisi'],
                'juara' => $_POST['juara'],
                'tingkat_kompetisi' => $_POST['tingkat_kompetisi'],
                'judul_kompetisi' => $_POST['judul_kompetisi'],
                'tempat_kompetisi' => $_POST['tempat_kompetisi'],
                'jumlah_pt' => $_POST['jumlah_pt'],
                'jumlah_peserta' => $_POST['jumlah_peserta'],
                'no_surat_tugas' => $_POST['no_surat_tugas'],
                'tgl_surat_tugas' => date('Y-m-d', strtotime($_POST['tgl_surat_tugas'])),
                'foto_kegiatan' => isset($_FILES['foto_kegiatan']) && $_FILES['foto_kegiatan']['error'] == 0
                    ? file_get_contents($_FILES['foto_kegiatan']['tmp_name'])
                    : $this->prestasiModel->getExistingFile('foto_kegiatan', $id_prestasi),

                'file_surat_tugas' => isset($_FILES['file_surat_tugas']) && $_FILES['file_surat_tugas']['error'] == 0
                    ? file_get_contents($_FILES['file_surat_tugas']['tmp_name'])
                    : $this->prestasiModel->getExistingFile('file_surat_tugas', $id_prestasi),

                'file_sertifikat' => isset($_FILES['file_sertifikat']) && $_FILES['file_sertifikat']['error'] == 0
                    ? file_get_contents($_FILES['file_sertifikat']['tmp_name'])
                    : $this->prestasiModel->getExistingFile('file_sertifikat', $id_prestasi),

                'file_poster' => isset($_FILES['file_poster']) && $_FILES['file_poster']['error'] == 0
                    ? file_get_contents($_FILES['file_poster']['tmp_name'])
                    : $this->prestasiModel->getExistingFile('file_poster', $id_prestasi),

                'lampiran_hasil_kompetisi' => isset($_FILES['lampiran_hasil_kompetisi']) && $_FILES['lampiran_hasil_kompetisi']['error'] == 0
                    ? file_get_contents($_FILES['lampiran_hasil_kompetisi']['tmp_name'])
                    : $this->prestasiModel->getExistingFile('lampiran_hasil_kompetisi', $id_prestasi),
            ];

            // Data Mahasiswa
            $data['mahasiswa_data'] = [];
            if (isset($_POST['id_mahasiswa']) && is_array($_POST['id_mahasiswa'])) {
                foreach ($_POST['id_mahasiswa'] as $index => $id_mahasiswa) {
                    $data['mahasiswa_data'][] = [
                        'id_mahasiswa' => $id_mahasiswa,
                        'peran_mahasiswa' => $_POST['peran_mahasiswa'][$index] ?? null,
                    ];
                }
            }

            // Data Dosen
            $data['dosen_data'] = [];
            if (isset($_POST['id_dosen']) && is_array($_POST['id_dosen'])) {
                foreach ($_POST['id_dosen'] as $index => $id_dosen) {
                    $data['dosen_data'][] = [
                        'id_dosen' => $id_dosen,
                        'peran_pembimbing' => $_POST['peran_pembimbing'][$index] ?? null,
                    ];
                }
            }

            // Simpan data ke model

            $success = $this->prestasiModel->updatePrestasi($data);

            if ($success) {
                echo "Data berhasil diperbarui.";
                header('Location: index.php?page=prestasi');
                exit;
            } else {
                echo "Data gagal diperbarui.";
            }
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

    public function showPrestasi($id_mahasiswa, $filters = [])
    {
        return $this->prestasiModel->getPrestasiByMahasiswa($id_mahasiswa, $filters);
    }

    public function showDataMahasiswa($id_prestasi)
    {
        return $this->prestasiModel->getPrestasiById($id_prestasi);
    }

    public function showPrestasiDetailMahasiswa($id_prestasi)
    {

        $prestasi = $this->prestasiModel->getPrestasiById($id_prestasi);
        $mahasiswa = $this->dosenPrestasiModel->getPrestasiShowMahasiswa($id_prestasi);
        $dosen = $this->dosenPrestasiModel->getPrestasiShowDosen($id_prestasi);
        $historyApproval = $this->dosenPrestasiModel->getHistoryApprovalByPrestasiId($id_prestasi);
        include '../app/views/mahasiswa/prestasidetail.php';
    }

    public function getDosenList()
    {
        return $this->prestasiModel->getAllDosen();
    }

    public function getMahasiswaList()
    {
        return $this->prestasiModel->getAllMahasiswa();
    }

    public function getPeranMahasiswa($id_prestasi)
    {
        return $this->prestasiModel->getMahasiswaPresma($id_prestasi);
    }

    public function getPeranDosen($id_prestasi)
    {
        return $this->prestasiModel->getDosenPresma($id_prestasi);
    }
}
