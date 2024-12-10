<?php

class PrestasiModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function getAllPrestasi()
    {
        $query = "SELECT * FROM data_prestasi ORDER BY tgl_pengajuan DESC";

        $stmt = sqlsrv_query($this->conn, $query);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $result = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $result[] = $row;
        }

        return $result;
    }

    public function getPrestasiForDetail($id_prestasi)
    {
        $query = "SELECT * FROM 
            data_prestasi dp
          WHERE dp.id_prestasi = ?";

        $stmt = sqlsrv_query($this->conn, $query, array($id_prestasi));

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $prestasi = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        $queryMahasiswa = "SELECT m.nama_mahasiswa FROM mahasiswa m INNER JOIN prestasi_mahasiswa mp ON m.id_mahasiswa = mp.id_mahasiswa WHERE mp.id_prestasi = ?";
        $stmtMahasiswa = sqlsrv_query($this->conn, $queryMahasiswa, array($id_prestasi));

        if ($stmtMahasiswa === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $mahasiswa = [];
        while ($row = sqlsrv_fetch_array($stmtMahasiswa, SQLSRV_FETCH_ASSOC)) {
            $mahasiswa[] = $row['nama_mahasiswa'];
        }

        $queryDosen = "SELECT d.nama_dosen FROM dosen d INNER JOIN pembimbing_prestasi dpd ON d.id_dosen = dpd.id_dosen WHERE dpd.id_prestasi = ?";
        $stmtDosen = sqlsrv_query($this->conn, $queryDosen, array($id_prestasi));

        if ($stmtDosen === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $dosen = [];
        while ($row = sqlsrv_fetch_array($stmtDosen, SQLSRV_FETCH_ASSOC)) {
            $dosen[] = $row['nama_dosen'];
        }

        return $prestasi;
    }

    public function getHistoryApprovalByPrestasiId($id_prestasi)
    {
        $query = "SELECT 
                ha.status_approval,
                ha.alasan,
                ha.tgl_approval,
                d.nama_dosen
              FROM 
                history_approval ha
              LEFT JOIN 
                dosen d ON ha.dosen_id = d.id_dosen
              WHERE 
                ha.id_prestasi = ?
              ORDER BY 
                ha.tgl_approval DESC";

        // Execute the query using sqlsrv_query
        $stmt = sqlsrv_query($this->conn, $query, array($id_prestasi));

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true)); // Handle query execution failure
        }

        // Fetch all results as an associative array
        $historyApproval = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $historyApproval[] = $row;
        }

        return $historyApproval; // Return all history approval records
    }

    public function getAllMahasiswa()
    {
        $query = "SELECT * FROM mahasiswa";

        // Execute the query using sqlsrv_query
        $stmt = sqlsrv_query($this->conn, $query);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true)); // Handle query execution failure
        }

        // Fetch all results as an associative array
        $mahasiswa = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $mahasiswa[] = $row;
        }

        return $mahasiswa; // Return all mahasiswa records
    }

    public function getAllDosen()
    {
        $query = "SELECT * FROM dosen";

        // Execute the query using sqlsrv_query
        $stmt = sqlsrv_query($this->conn, $query);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true)); // Handle query execution failure
        }

        // Fetch all results as an associative array
        $dosen = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $dosen[] = $row;
        }

        return $dosen; // Return all dosen records
    }


    public function getMahasiswaByPrestasi($id_prestasi)
    {
        try {
            // Query untuk mendapatkan mahasiswa berdasarkan id_prestasi
            $query = "SELECT mahasiswa.id_mahasiswa, 
                         mahasiswa.nama_mahasiswa, 
                         mahasiswa.email_mahasiswa, 
                         mahasiswa_prestasi.id_prestasi
                  FROM mahasiswa
                  JOIN prestasi_mahasiswa ON mahasiswa.id_mahasiswa = mahasiswa_prestasi.id_mahasiswa
                  WHERE mahasiswa_prestasi.id_prestasi = ?";

            // Menyiapkan parameter untuk query
            $params = [$id_prestasi];

            // Eksekusi query
            $stmt = sqlsrv_query($this->conn, $query, $params);

            if ($stmt === false) {
                throw new Exception(print_r(sqlsrv_errors(), true));
            }

            // Menyimpan hasil query ke array
            $mahasiswaData = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $mahasiswaData[] = $row;
            }

            // Mengembalikan data
            return $mahasiswaData;
        } catch (Exception $e) {
            // Tangani error jika terjadi
            error_log("Error in getMahasiswaByPrestasi: " . $e->getMessage());
            return false;
        }
    }


    public function getDosenByPrestasi($id_prestasi)
    {
        try {
            $query = "SELECT dosen.id_dosen, dosen.nama_dosen, dosen.email_dosen 
                      FROM dosen 
                      JOIN pembimbing_prestasi ON dosen.id_dosen = pembimbing_prestasi.id_dosen 
                      WHERE pembimbing_prestasi.id_prestasi = :id_prestasi";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_prestasi', $id_prestasi, PDO::PARAM_INT);
            $stmt->execute();

            $dosenData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $dosenData;
        } catch (Exception $e) {
            return false;
        }
    }

    public function addPrestasi($data_prestasi, $mahasiswa_ids, $dosen_ids)
    {
        try {
            $this->conn->beginTransaction();

            // Ensure the current date is assigned to tgl_pengajuan
            $data_prestasi['tgl_pengajuan'] = date('Y-m-d H:i:s');

            // Validate file upload (ensure it's a valid file)
            if (isset($data_prestasi['foto_kegiatan']) && is_array($data_prestasi['foto_kegiatan'])) {
                // Ensure file is uploaded correctly
                if ($data_prestasi['foto_kegiatan']['error'] == 0) {
                    // Read file content as binary data
                    $foto_kegiatan = file_get_contents($data_prestasi['foto_kegiatan']['tmp_name']);
                } else {
                    // Handle file upload error
                    throw new Exception('File upload error: ' . $data_prestasi['foto_kegiatan']['error']);
                }
            } else {
                throw new Exception('No file uploaded.');
            }

            // Prepare query for inserting data_prestasi
            $query = "INSERT INTO [dbo].[data_prestasi]
                    ([tgl_pengajuan], [thn_akademik], [jenis_kompetisi], [juara], 
                        [tingkat_kompetisi], [judul_kompetisi], [tempat_kompetisi], 
                        [jumlah_pt], [jumlah_peserta], [status_pengajuan], [foto_kegiatan]) 
                    VALUES 
                    (:tgl_pengajuan, :thn_akademik, :jenis_kompetisi, :juara, 
                        :tingkat_kompetisi, :judul_kompetisi, :tempat_kompetisi, 
                        :jumlah_pt, :jumlah_peserta, 'Waiting for Approval', :foto_kegiatan)";

            // Prepare and execute the query
            $stmt = $this->conn->prepare($query);

            // Binding all parameters and execute the query
            $stmt->execute([
                ':tgl_pengajuan' => $data_prestasi['tgl_pengajuan'],
                ':thn_akademik' => $data_prestasi['thn_akademik'],
                ':jenis_kompetisi' => $data_prestasi['jenis_kompetisi'],
                ':juara' => $data_prestasi['juara'],
                ':tingkat_kompetisi' => $data_prestasi['tingkat_kompetisi'],
                ':judul_kompetisi' => $data_prestasi['judul_kompetisi'],
                ':tempat_kompetisi' => $data_prestasi['tempat_kompetisi'],
                ':jumlah_pt' => $data_prestasi['jumlah_pt'],
                ':jumlah_peserta' => $data_prestasi['jumlah_peserta'],
                ':foto_kegiatan' => $foto_kegiatan // Use the binary file data here
            ]);

            // Get the ID of the last inserted record
            $id_prestasi = $this->conn->lastInsertId();

            // Insert related mahasiswa_ids
            foreach ($mahasiswa_ids as $id_mahasiswa) {
                $query_mahasiswa = "INSERT INTO mahasiswa_prestasi (id_mahasiswa, id_prestasi) 
                                VALUES (:id_mahasiswa, :id_prestasi)";
                $stmt_mahasiswa = $this->conn->prepare($query_mahasiswa);
                $stmt_mahasiswa->execute(['id_mahasiswa' => $id_mahasiswa, 'id_prestasi' => $id_prestasi]);
            }

            // Insert related dosen_ids
            foreach ($dosen_ids as $id_dosen) {
                $query_dosen = "INSERT INTO dosen_prestasi (id_dosen, id_prestasi) 
                            VALUES (:id_dosen, :id_prestasi)";
                $stmt_dosen = $this->conn->prepare($query_dosen);
                $stmt_dosen->execute(['id_dosen' => $id_dosen, 'id_prestasi' => $id_prestasi]);
            }

            // Commit the transaction
            $this->conn->commit();

            return true;
        } catch (Exception $e) {
            // Rollback on error
            $this->conn->rollBack();
            // Optionally, log the error message for debugging purposes
            error_log($e->getMessage());
            return false;
        }
    }
    public function insertPrestasi($data)
    {
        sqlsrv_begin_transaction($this->conn);

        try {
            $sql = "INSERT INTO [dbo].[data_prestasi] 
                ([tgl_pengajuan], [program_studi], [thn_akademik], [jenis_kompetisi], [juara], 
                 [tingkat_kompetisi], [judul_kompetisi], [tempat_kompetisi], [url_kompetisi], 
                 [jumlah_pt], [jumlah_peserta], [status_pengajuan], [foto_kegiatan],
                 [no_surat_tugas], [tgl_surat_tugas], [file_surat_tugas],
                 [file_sertifikat], [file_poster], [lampiran_hasil_kompetisi]) 
            VALUES 
                (?, ?, ?, ?, ?, 
                 ?, ?, ?, ?,
                 ?, ?, 'Waiting for Approval', 
                 CONVERT(VARBINARY(MAX), ?),
                 ?, ?, 
                 CONVERT(VARBINARY(MAX), ?),
                 CONVERT(VARBINARY(MAX), ?),
                 CONVERT(VARBINARY(MAX), ?),
                 CONVERT(VARBINARY(MAX), ?));";

            $params = [
                $data['tgl_pengajuan'],
                $data['program_studi'],
                $data['thn_akademik'],
                $data['jenis_kompetisi'],
                $data['juara'],
                $data['tingkat_kompetisi'],
                $data['judul_kompetisi'],
                $data['tempat_kompetisi'],
                $data['url_kompetisi'],
                $data['jumlah_pt'],
                $data['jumlah_peserta'],
                $data['foto_kegiatan'],
                $data['no_surat_tugas'],
                $data['tgl_surat_tugas'],
                $data['file_surat_tugas'],
                $data['file_sertifikat'],
                $data['file_poster'],
                $data['lampiran_hasil_kompetisi']
            ];

            $stmt = sqlsrv_query($this->conn, $sql, $params);
            if (!$stmt) {
                die('Insert ke data_prestasi gagal: ' . print_r(sqlsrv_errors(), true));
            }

            $query = "SELECT @@IDENTITY AS id_prestasi";
            $stmt = sqlsrv_query($this->conn, $query);
            if (!$stmt) {
                die('Gagal menjalankan @@IDENTITY: ' . print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

            $id_prestasi = $row['id_prestasi'];

            $id_mahasiswa = $_POST['id_mahasiswa'];
            $peran_mahasiswa = $_POST['peran_mahasiswa'];

            if (count($id_mahasiswa) === count($peran_mahasiswa)) {
                foreach ($id_mahasiswa as $index => $id) {
                    $peran = $peran_mahasiswa[$index];

                    $sql_mahasiswa = "INSERT INTO [dbo].[prestasi_mahasiswa] ([id_mahasiswa], [id_prestasi], [peran_mahasiswa]) VALUES (?, ?, ?)";
                    $stmt_mahasiswa = sqlsrv_query($this->conn, $sql_mahasiswa, [$id, $id_prestasi, $peran]);

                    if (!$stmt_mahasiswa) {
                        error_log(print_r(sqlsrv_errors(), true));
                        throw new Exception("Terjadi kesalahan saat menyimpan data mahasiswa.");
                    }
                }
            } else {
                throw new Exception("Jumlah data id_mahasiswa dan peran_mahasiswa tidak cocok.");
            }

            $id_dosen = $_POST['id_dosen'];
            $peran_pembimbing = $_POST['peran_pembimbing'];

            if (count($id_dosen) === count($peran_pembimbing)) {
                foreach ($id_dosen as $index => $id) {
                    $peran = $peran_pembimbing[$index];

                    $sql_dosen = "INSERT INTO [dbo].[pembimbing_prestasi] ([id_dosen], [id_prestasi], [peran_pembimbing]) VALUES (?, ?, ?)";
                    $stmt_dosen = sqlsrv_query($this->conn, $sql_dosen, [$id, $id_prestasi, $peran]);

                    if (!$stmt_dosen) {
                        error_log(print_r(sqlsrv_errors(), true));
                        throw new Exception("Terjadi kesalahan saat menyimpan data dosen.");
                    }
                }
            } else {
                throw new Exception("Jumlah data id_dosen dan peran_pembimbing tidak cocok.");
            }

            sqlsrv_commit($this->conn);

            return true;
        } catch (Exception $e) {
            sqlsrv_rollback($this->conn);
            die('SQL Error: ' . $e->getMessage());
        }
    }

    public function updatePrestasi($id_prestasi, $data_prestasi)
    {
        $sql = "UPDATE [dbo].[data_prestasi] 
            SET 
                [tgl_pengajuan] = ?,
                [thn_akademik] = ?,
                [program_studi] = ?,
                [jenis_kompetisi] = ?,
                [juara] = ?,
                [tingkat_kompetisi] = ?,
                [judul_kompetisi] = ?,
                [tempat_kompetisi] = ?,
                [url_kompetisi] = ?,
                [jumlah_pt] = ?,
                [jumlah_peserta] = ?,
                [status_pengajuan] = ?          
            WHERE [id_prestasi] = ?";

        $params = [
            $data_prestasi['tgl_pengajuan'],
            $data_prestasi['program_studi'],
            $data_prestasi['thn_akademik'],
            $data_prestasi['jenis_kompetisi'],
            $data_prestasi['juara'],
            $data_prestasi['tingkat_kompetisi'],
            $data_prestasi['judul_kompetisi'],
            $data_prestasi['tempat_kompetisi'],
            $data_prestasi['url_kompetisi'],
            $data_prestasi['jumlah_pt'],
            $data_prestasi['jumlah_peserta'],
            $data_prestasi['status_pengajuan'],
            $id_prestasi
        ];

        $stmt = sqlsrv_query($this->conn, $sql, $params);

        // Check for execution errors
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Commit transaction if using transaction handling, otherwise omit this
        sqlsrv_commit($this->conn);

        return true;
    }

    public function deletePrestasi($id_prestasi)
    {
        $sql = "DELETE FROM data_prestasi WHERE id_prestasi = ?";

        // Prepare and execute the statement using sqlsrv_query
        $stmt = sqlsrv_query($this->conn, $sql, [$id_prestasi]);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true)); // Handle query failure
        }

        return true; // Return true if the query executed successfully
    }

    public function getPrestasiById($id_prestasi)
    {
        // Query untuk mendapatkan data prestasi
        $query = "SELECT 
        dp.id_prestasi, 
        dp.tgl_pengajuan,
        dp.program_studi,
        dp.url_kompetisi,
        dp.thn_akademik, 
        dp.jenis_kompetisi, 
        dp.juara, 
        dp.tingkat_kompetisi, 
        dp.judul_kompetisi, 
        dp.tempat_kompetisi, 
        dp.jumlah_pt, 
        dp.jumlah_peserta, 
        dp.status_pengajuan,
        dp.no_surat_tugas,
        dp.tgl_surat_tugas,
        dp.file_surat_tugas,
        dp.file_sertifikat,
        dp.foto_kegiatan,
        dp.file_poster,
        dp.lampiran_hasil_kompetisi

        FROM 
            data_prestasi dp
        WHERE dp.id_prestasi = :id_prestasi";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_prestasi', $id_prestasi, PDO::PARAM_INT);
        $stmt->execute();

        $prestasi = $stmt->fetch(PDO::FETCH_ASSOC);

        $queryMahasiswa = "SELECT m.nama_mahasiswa
                       FROM mahasiswa m
                       INNER JOIN prestasi_mahasiswa mp ON m.id_mahasiswa = mp.id_mahasiswa
                       WHERE mp.id_prestasi = :id_prestasi";
        $stmtMahasiswa = $this->conn->prepare($queryMahasiswa);
        $stmtMahasiswa->bindParam(':id_prestasi', $id_prestasi, PDO::PARAM_INT);
        $stmtMahasiswa->execute();
        $mahasiswa = $stmtMahasiswa->fetchAll(PDO::FETCH_COLUMN);

        $queryDosen = "SELECT d.nama_dosen
                   FROM dosen d
                   INNER JOIN pembimbing_prestasi dpd ON d.id_dosen = dpd.id_dosen
                   WHERE dpd.id_prestasi = :id_prestasi";
        $stmtDosen = $this->conn->prepare($queryDosen);
        $stmtDosen->bindParam(':id_prestasi', $id_prestasi, PDO::PARAM_INT);
        $stmtDosen->execute();
        $dosen = $stmtDosen->fetchAll(PDO::FETCH_COLUMN);

        $prestasi['nama_mahasiswa'] = implode('<br>', $mahasiswa);
        $prestasi['nama_dosen'] = implode('<br>', $dosen);

        return $prestasi;
    }

    public function getPrestasiByDosen($id_dosen, $role)
    {
        if ($role === 'admin') {
            // Query untuk admin: Menampilkan semua data prestasi
            $query = "SELECT * FROM data_prestasi dp 
                  INNER JOIN pembimbing_prestasi pp 
                  ON dp.id_prestasi = pp.id_prestasi 
                  ORDER BY dp.tgl_pengajuan DESC";
            $stmt = $this->conn->prepare($query);
        } else {
            // Query untuk dosen atau ketua jurusan: Filter berdasarkan id_dosen
            $query = "SELECT * FROM data_prestasi dp 
                  INNER JOIN pembimbing_prestasi pp 
                  ON dp.id_prestasi = pp.id_prestasi 
                  WHERE pp.id_dosen = :id_dosen 
                  ORDER BY dp.tgl_pengajuan DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_dosen', $id_dosen, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
