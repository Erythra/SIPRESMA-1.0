<?php
require '../vendor/autoload.php';
include_once '../config/config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$query = "SELECT 
            id_prestasi, tgl_pengajuan, program_studi, thn_akademik, jenis_kompetisi, 
            juara, tingkat_kompetisi, judul_kompetisi, tempat_kompetisi, jumlah_pt, 
            jumlah_peserta, no_surat_tugas, tgl_surat_tugas, status_pengajuan
          FROM data_prestasi
          ORDER BY tgl_pengajuan ASC";

$stmt = sqlsrv_query($conn, $query);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Laporan Data Prestasi');
$sheet->mergeCells('A1:M1');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$headers = [
    'ID Prestasi',
    'Tanggal Pengajuan',
    'Prodi',
    'Tahun Akademik',
    'Jenis Kompetisi',
    'Juara',
    'Tingkat Kompetisi',
    'Judul Kompetisi',
    'Tempat Kompetisi',
    'Jumlah PT',
    'Jumlah Peserta',
    'No Surat Tugas',
    'Tanggal Surat Tugas',
    'Status Pengajuan'
];

$columnIndex = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($columnIndex . '2', $header);
    $columnIndex++;
}

$sheet->getColumnDimension('A')->setWidth(15);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(30);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(25);
$sheet->getColumnDimension('F')->setWidth(15);
$sheet->getColumnDimension('G')->setWidth(20);
$sheet->getColumnDimension('H')->setWidth(25);
$sheet->getColumnDimension('I')->setWidth(20);
$sheet->getColumnDimension('J')->setWidth(15);
$sheet->getColumnDimension('K')->setWidth(20);
$sheet->getColumnDimension('L')->setWidth(20);
$sheet->getColumnDimension('M')->setWidth(20);
$sheet->getColumnDimension('N')->setWidth(25);

$sheet->getStyle('A2:N2')->applyFromArray([
    'font' => [
        'bold' => true
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'ADD8E6']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]
]);

$rowIndex = 3;
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $sheet->setCellValue('A' . $rowIndex, $row['id_prestasi'] ?? '');
    $sheet->setCellValue('B' . $rowIndex, ($row['tgl_pengajuan'] instanceof DateTime) ? $row['tgl_pengajuan']->format('Y-m-d') : $row['tgl_pengajuan'] ?? '');
    $sheet->setCellValue('C' . $rowIndex, $row['program_studi'] ?? '');
    $sheet->setCellValue('D' . $rowIndex, $row['thn_akademik'] ?? '');
    $sheet->setCellValue('E' . $rowIndex, $row['jenis_kompetisi'] ?? '');
    $sheet->setCellValue('F' . $rowIndex, $row['juara'] ?? '');
    $sheet->setCellValue('G' . $rowIndex, $row['tingkat_kompetisi'] ?? '');
    $sheet->setCellValue('H' . $rowIndex, $row['judul_kompetisi'] ?? '');
    $sheet->setCellValue('I' . $rowIndex, $row['tempat_kompetisi'] ?? '');
    $sheet->setCellValue('J' . $rowIndex, $row['jumlah_pt'] ?? '');
    $sheet->setCellValue('K' . $rowIndex, $row['jumlah_peserta'] ?? '');
    $sheet->setCellValue('L' . $rowIndex, $row['no_surat_tugas'] ?? '');
    $sheet->setCellValue('M' . $rowIndex, ($row['tgl_surat_tugas'] instanceof DateTime) ? $row['tgl_surat_tugas']->format('Y-m-d') : $row['tgl_surat_tugas'] ?? '');

    // Menambahkan kolom status pengajuan
    $status = $row['status_pengajuan'] ?? '';
    $statusText = '';
    $statusColor = ''; // Variabel untuk warna latar belakang status

    if ($status == 'Waiting for Approval') {
        $statusText = 'Menunggu Persetujuan';
        $statusColor = 'FFFF00'; // Kuning untuk status menunggu
    } elseif ($status == 'Approved') {
        $statusText = 'Disetujui';
        $statusColor = '00FF00'; // Hijau untuk status disetujui
    } elseif ($status == 'Rejected') {
        $statusText = 'Ditolak';
        $statusColor = 'FF0000'; // Merah untuk status ditolak
    }

    $sheet->setCellValue('N' . $rowIndex, $statusText); // Kolom baru untuk status_pengajuan

    // Menambahkan style pada kolom status_pengajuan
    $sheet->getStyle('N' . $rowIndex)
        ->getFill()
        ->setFillType(Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB($statusColor);

    // Opsional: menambahkan warna teks
    $sheet->getStyle('N' . $rowIndex)->getFont()->setBold(true);

    $rowIndex++;
}


$sheet->getStyle('A3:M' . ($rowIndex - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="data_prestasi.xlsx"');
$writer->save('php://output');

sqlsrv_close($conn);
