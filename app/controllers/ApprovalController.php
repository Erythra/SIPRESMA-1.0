<?php
ob_start();
require_once __DIR__ . '/../models/ApprovalModel.php';
require_once __DIR__ . '/../models/PrestasiModel.php';

class ApprovalController
{
    private $approvalModel;
    private $dosenPrestasiModel;

    public function __construct($conn)
    {
        $this->dosenPrestasiModel = new PrestasiModel($conn);
        $this->approvalModel = new ApprovalModel($conn);
    }


    public function approve($id_prestasi, $dosen_id)
    {
        $this->approvalModel->approvePrestasi($id_prestasi, $dosen_id);

        $_SESSION['flash_message'] = [
            'type' => 'success',
            'message' => 'Prestasi berhasil disetujui.'
        ];

        header('Location: index.php?page=dosen_prestasi_detail&id_prestasi=' . $id_prestasi);
        exit;
    }

    public function reject($id_prestasi, $dosen_id)
    {
        if (isset($_POST['alasan']) && !empty($_POST['alasan'])) {
            $alasan = $_POST['alasan'];
            $this->approvalModel->rejectPrestasi($id_prestasi, $dosen_id, $alasan);

            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Prestasi berhasil ditolak.'
            ];

            header('Location: index.php?page=dosen_prestasi_detail&id_prestasi=' . $id_prestasi);
            exit;
        } else {
            echo "<script>alert('Alasan penolakan harus diisi.'); window.history.back();</script>";
        }
    }
}
