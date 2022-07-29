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
$sheet->setCellValue('B2', 'NIK');
$sheet->setCellValue('C2', 'No Akta');
$sheet->setCellValue('D2', 'Nama Anak');
$sheet->setCellValue('E2', 'Tanggal Pembuatan');
$sheet->setCellValue('F2', 'Nama Ayah');
$sheet->setCellValue('G2', 'Nama Ibu');
$sheet->setCellValue('H2', 'Jenis Kelamin');
$sheet->setCellValue('I2', 'Alamat');
$sheet->setCellValue('J2', 'Status');

$data_akta = select("SELECT * FROM akta");

$no = 1;
$start = 3;

foreach ($data_akta as $akta) {
    $sheet->setCellValue('A' . $start, $no++)->getColumnDimension('A')->setAutoSize(true);
    $sheet->setCellValue('B' . $start, $akta['nik'])->getColumnDimension('B')->setAutoSize(true);
    $sheet->setCellValue('C' . $start, $akta['no_akta'])->getColumnDimension('C')->setAutoSize(true);
    $sheet->setCellValue('D' . $start, $akta['nama_anak'])->getColumnDimension('D')->setAutoSize(true);
    $sheet->setCellValue('E' . $start, $akta['tanggal_akta'])->getColumnDimension('E')->setAutoSize(true);
    $sheet->setCellValue('F' . $start, $akta['nama_ayah'])->getColumnDimension('F')->setAutoSize(true);
    $sheet->setCellValue('G' . $start, $akta['nama_ibu'])->getColumnDimension('G')->setAutoSize(true);
    $sheet->setCellValue('H' . $start, $akta['jk'])->getColumnDimension('H')->setAutoSize(true);
    $sheet->setCellValue('I' . $start, $akta['alamat'])->getColumnDimension('I')->setAutoSize(true);
    $sheet->setCellValue('J' . $start, $akta['status'])->getColumnDimension('J')->setAutoSize(true);

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
$writer->save('Laporan Data Akta Kelahiran.xlsx');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreedsheet.sheet');
header('Content-Disposition: attachment;filename="Laporan Data Akta Kelahiran.xlsx"');
readfile('Laporan Data Akta Kelahiran.xlsx');
unlink('Laporan Data Akta Kelahiran.xlsx');
exit;
