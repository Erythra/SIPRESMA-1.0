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
        // Query untuk mahasiswa
        $sqlMahasiswa = "SELECT * FROM mahasiswa WHERE NIM = ? AND password_mahasiswa = ?";
        $stmt = sqlsrv_prepare($this->conn, $sqlMahasiswa, array(&$username, &$password));

        if (sqlsrv_execute($stmt)) {
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC); // Mengambil data
            if ($result) {
                $result['role'] = 'mahasiswa'; // Menambahkan role mahasiswa
                return $result;
            }
        }

        // Query untuk dosen
        $sqlDosen = "SELECT id_dosen, NIDN, role_dosen, nama_dosen FROM dosen WHERE NIDN = ? AND password_dosen = ?";
        $stmt = sqlsrv_prepare($this->conn, $sqlDosen, array(&$username, &$password));

        if (sqlsrv_execute($stmt)) {
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC); // Mengambil data
            if ($result) {
                return $result;
            }
        }

        // Jika tidak ditemukan, kembalikan false
        return false;
    }
}
