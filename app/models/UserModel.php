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
        // mhs
        $sqlMahasiswa = "SELECT * FROM mahasiswa WHERE NIM = ? AND password_mahasiswa = ?";
        $stmt = sqlsrv_prepare($this->conn, $sqlMahasiswa, array(&$username, &$password));

        if (sqlsrv_execute($stmt)) {
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if ($result) {
                $result['role'] = 'mahasiswa';
                return $result;
            }
        }

        // dosen
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

    public function getDaftarMataKuliah($id_mahasiswa)
    {
        $query = "SELECT 
                ROW_NUMBER() OVER (ORDER BY mk.kode_mata_kuliah) AS No,
                mk.kode_mata_kuliah AS Kode_MK,
                mk.nama_mata_kuliah AS Mata_Kuliah,
                mk.sks AS SKS,
                mk.jam AS Jam,
                CASE
                    WHEN n.nilai_mahasiswa >= 80 THEN 'A'
                    WHEN n.nilai_mahasiswa >= 70 THEN 'B'
                    WHEN n.nilai_mahasiswa >= 60 THEN 'C'
                    ELSE 'D'
                END AS Nilai
            FROM 
                nilai_mahasiswa n
            INNER JOIN 
                mahasiswa m ON n.id_mahasiswa = m.id_mahasiswa
            INNER JOIN 
                mata_kuliah mk ON n.id_mata_kuliah = mk.id_mata_kuliah
            WHERE 
                n.id_mahasiswa = :id_mahasiswa
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_mahasiswa', $id_mahasiswa, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
