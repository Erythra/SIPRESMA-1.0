<?php

class ApprovalModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function approvePrestasi($id_prestasi, $dosen_id)
    {
        $query = "UPDATE data_prestasi SET status_pengajuan = 'Approved' WHERE id_prestasi = ?";
        $params = array($id_prestasi);
        $stmt = sqlsrv_query($this->conn, $query, $params);

        if (!$stmt) {
            die(print_r(sqlsrv_errors(), true));
        }

        $query = "INSERT INTO history_approval (id_prestasi, dosen_id, status_approval, tgl_approval) 
                  VALUES (?, ?, 'Approved', GETDATE())";
        $params = array($id_prestasi, $dosen_id);
        $stmt = sqlsrv_query($this->conn, $query, $params);

        if (!$stmt) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    public function rejectPrestasi($id_prestasi, $dosen_id, $alasan)
    {
        $query = "UPDATE data_prestasi SET status_pengajuan = 'Rejected' WHERE id_prestasi = ?";
        $params = array($id_prestasi);
        $stmt = sqlsrv_query($this->conn, $query, $params);

        if (!$stmt) {
            die(print_r(sqlsrv_errors(), true));
        }

        $query = "INSERT INTO history_approval (id_prestasi, dosen_id, status_approval, alasan, tgl_approval) 
                  VALUES (?, ?, 'Rejected', ?, GETDATE())";
        $params = array($id_prestasi, $dosen_id, $alasan);
        $stmt = sqlsrv_query($this->conn, $query, $params);

        if (!$stmt) {
            die(print_r(sqlsrv_errors(), true)); // Handle errors
        }
    }
}
