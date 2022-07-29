<?php

session_start();

// Membatasi Akses Login

if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Login Terlebih Dahulu');
    document.location.href = 'login.php';
    </script>";
    exit;
}

require 'config/app.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A2', 'No');
$sheet->setCellValue('B2', 'Tanggal Pengeluaran');
$sheet->setCellValue('C2', 'Jenis Pengeluaran');
$sheet->setCellValue('D2', 'Jumlah Pengeluaran');

$data_pengeluaran = select("SELECT * FROM pengeluaran");

$no = 1;
$start = 3;

foreach ($data_pengeluaran as $pengeluaran) {
    $sheet->setCellValue('A' . $start, $no++)->getColumnDimension('A')->setAutoSize(true);
    $sheet->setCellValue('B' . $start, $pengeluaran['tanggal_pengeluaran'])->getColumnDimension('B')->setAutoSize(true);
    $sheet->setCellValue('C' . $start, $pengeluaran['jenis_pengeluaran'])->getColumnDimension('C')->setAutoSize(true);
    $sheet->setCellValue('D' . $start, $pengeluaran['jumlah_pengeluaran'])->getColumnDimension('D')->setAutoSize(true);

    $start++;
}

// Table Border
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$border = $start - 1;

$sheet->getStyle('A2:D' . $border)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save('Laporan Data Akta Kelahiran.xlsx');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreedsheet.sheet');
header('Content-Disposition: attachment;filename="Laporan Data Akta Kelahiran.xlsx"');
readfile('Laporan Data Akta Kelahiran.xlsx');
unlink('Laporan Data Akta Kelahiran.xlsx');
exit;
