<?php
require('../vendor/autoload.php');
require('../vendor/setasign/fpdf/fpdf.php');
include_once '../config/config.php';

$id_prestasi = $_GET['id_prestasi'];

$query = "
WITH EliminasiDuplikat AS (
    SELECT 
        dpd.id_prestasi,
        STUFF((
            SELECT DISTINCT ', ' + d.nama_dosen
            FROM dosen d
            INNER JOIN pembimbing_prestasi dpd_inner ON d.id_dosen = dpd_inner.id_dosen
            WHERE dpd_inner.id_prestasi = dpd.id_prestasi
            FOR XML PATH(''), TYPE).value('.', 'NVARCHAR(MAX)'), 1, 2, '') AS nama_dosen
    FROM pembimbing_prestasi dpd
    GROUP BY dpd.id_prestasi
)
SELECT 
    dp.id_prestasi,
    dp.tgl_pengajuan, 
    dp.program_studi, 
    dp.thn_akademik, 
    dp.juara,
    dp.jenis_kompetisi,
    dp.tingkat_kompetisi,
    dp.judul_kompetisi,
    dp.tempat_kompetisi,
    dp.jumlah_pt,
    dp.jumlah_peserta,
    dp.foto_kegiatan,
    dp.no_surat_tugas,
    dp.tgl_surat_tugas,
    dp.file_surat_tugas,
    dp.file_sertifikat,
    dp.file_poster,
    dp.url_kompetisi,
    dp.lampiran_hasil_kompetisi,
    STUFF((
        SELECT DISTINCT ', ' + m.nama_mahasiswa
        FROM mahasiswa m
        INNER JOIN prestasi_mahasiswa mp ON m.id_mahasiswa = mp.id_mahasiswa
        WHERE mp.id_prestasi = dp.id_prestasi
        FOR XML PATH(''), TYPE).value('.', 'NVARCHAR(MAX)'), 1, 2, '') AS nama_mahasiswa,
    ed.nama_dosen
FROM 
    data_prestasi dp
LEFT JOIN 
    EliminasiDuplikat ed ON dp.id_prestasi = ed.id_prestasi
WHERE dp.id_prestasi = ?
";

$params = array($id_prestasi);
$stmt = sqlsrv_query($conn, $query, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(0, 10, 'Laporan Data Prestasi', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Tanggal Pengajuan: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, ($row['tgl_pengajuan'] instanceof DateTime) ? $row['tgl_pengajuan']->format('Y-m-d') : $row['tgl_pengajuan'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Program Studi: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, $row['program_studi'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Tahun Akademik: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, $row['thn_akademik'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Juara: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, $row['juara'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Jenis Kompetisi: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, $row['jenis_kompetisi'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Tingkat Kompetisi: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, $row['tingkat_kompetisi'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Judul Kompetisi: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, $row['judul_kompetisi'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Tempat Kompetisi: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, $row['tempat_kompetisi'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Jumlah PT: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, $row['jumlah_pt'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Jumlah Peserta: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, $row['jumlah_peserta'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Mahasiswa Berpartisipasi: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 7, $row['nama_mahasiswa'], 0, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Dosen Pembimbing: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 7, $row['nama_dosen'], 0, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'Foto Kegiatan: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, empty($row['foto_kegiatan']) ? 'File Tidak Tersedia' : 'File Tersedia', 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'File Surat Tugas: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, empty($row['file_surat_tugas']) ? 'File Tidak Tersedia' : 'File Tersedia', 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, 'File Sertifikat: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, empty($row['file_sertifikat']) ? 'File Tidak Tersedia' : 'File Tersedia', 0, 1, 'L');

$pdf->Output('I', 'Data_Prestasi.pdf');
