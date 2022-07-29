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
$sheet->setCellValue('B2', 'Nomor Surat Pernikahan');
$sheet->setCellValue('C2', 'Nama Pria');
$sheet->setCellValue('D2', 'Nama Wanita');
$sheet->setCellValue('E2', 'Tanggal Pernikahan');
$sheet->setCellValue('F2', 'Tempat Pernikahan');
$sheet->setCellValue('G2', 'Nama Wali Pria');
$sheet->setCellValue('H2', 'Nama Wali Wanita');
$sheet->setCellValue('I2', 'Penghulu');
$sheet->setCellValue('J2', 'Keterangan');

$data_pernikahan = select("SELECT * FROM pernikahan");

$no = 1;
$start = 3;

foreach ($data_pernikahan as $pernikahan) {
    $sheet->setCellValue('A' . $start, $no++)->getColumnDimension('A')->setAutoSize(true);
    $sheet->setCellValue('B' . $start, $pernikahan['no_pernikahan'])->getColumnDimension('B')->setAutoSize(true);
    $sheet->setCellValue('C' . $start, $pernikahan['nama_pria'])->getColumnDimension('C')->setAutoSize(true);
    $sheet->setCellValue('D' . $start, $pernikahan['nama_wanita'])->getColumnDimension('D')->setAutoSize(true);
    $sheet->setCellValue('E' . $start, $pernikahan['tanggal_pernikahan'])->getColumnDimension('E')->setAutoSize(true);
    $sheet->setCellValue('F' . $start, $pernikahan['tempat_pernikahan'])->getColumnDimension('F')->setAutoSize(true);
    $sheet->setCellValue('G' . $start, $pernikahan['nama_walip'])->getColumnDimension('G')->setAutoSize(true);
    $sheet->setCellValue('H' . $start, $pernikahan['nama_waliw'])->getColumnDimension('H')->setAutoSize(true);
    $sheet->setCellValue('I' . $start, $pernikahan['penghulu'])->getColumnDimension('I')->setAutoSize(true);
    $sheet->setCellValue('J' . $start, $pernikahan['keterangan'])->getColumnDimension('J')->setAutoSize(true);

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

$sheet->getStyle('A2:J' . $border)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save('Laporan Data Pernikahan.xlsx');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreedsheet.sheet');
header('Content-Disposition: attachment;filename="Laporan Data Pernikahan.xlsx"');
readfile('Laporan Data Pernikahan.xlsx');
unlink('Laporan Data Pernikahan.xlsx');
exit;
