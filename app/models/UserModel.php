<?php

class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function validateLogin($username, $password)
    {
        $sqlMahasiswa = "SELECT * FROM mahasiswa WHERE NIM = ? AND password_mahasiswa = ?";
        $stmt = sqlsrv_prepare($this->conn, $sqlMahasiswa, array(&$username, &$password));

        if (sqlsrv_execute($stmt)) {
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if ($result) {
                $result['role'] = 'mahasiswa';
                return $result;
            }
        }

        $sqlDosen = "SELECT id_dosen, NIDN, role_dosen, nama_dosen FROM dosen WHERE NIDN = ? AND password_dosen = ?";
        $stmt = sqlsrv_prepare($this->conn, $sqlDosen, array(&$username, &$password));

        if (sqlsrv_execute($stmt)) {
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if ($result) {
                $result['role'] = $result['role_dosen'];
                return $result;
            }
        }

        return false;
    }
}
