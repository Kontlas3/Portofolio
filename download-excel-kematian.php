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
$sheet->setCellValue('B2', 'Nomor Surat Kematian');
$sheet->setCellValue('C2', 'Nama Jenazah');
$sheet->setCellValue('D2', 'Penyebab Kematian');
$sheet->setCellValue('E2', 'Tanggal Kematian');
$sheet->setCellValue('F2', 'Alamat Jenazah');

$data_kematian = select("SELECT * FROM kematian");

$no = 1;
$start = 3;

foreach ($data_kematian as $kematian) {
    $sheet->setCellValue('A' . $start, $no++)->getColumnDimension('A')->setAutoSize(true);
    $sheet->setCellValue('B' . $start, $kematian['surat_kematian'])->getColumnDimension('B')->setAutoSize(true);
    $sheet->setCellValue('C' . $start, $kematian['nama_jenazah'])->getColumnDimension('C')->setAutoSize(true);
    $sheet->setCellValue('D' . $start, $kematian['surat_pernyataan'])->getColumnDimension('D')->setAutoSize(true);
    $sheet->setCellValue('E' . $start, $kematian['tanggal_kematian'])->getColumnDimension('E')->setAutoSize(true);
    $sheet->setCellValue('F' . $start, $kematian['alamat'])->getColumnDimension('F')->setAutoSize(true);

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

$sheet->getStyle('A2:F' . $border)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save('Laporan Data Kematian.xlsx');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreedsheet.sheet');
header('Content-Disposition: attachment;filename="Laporan Data Kematian.xlsx"');
readfile('Laporan Data Kematian.xlsx');
unlink('Laporan Data Kematian.xlsx');
exit;
