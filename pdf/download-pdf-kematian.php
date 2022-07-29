d<?php

    require __DIR__ . '../../vendor/autoload.php';
    require '../config/app.php';

    use Spipu\Html2Pdf\Html2Pdf;

    $data_kematian = select("SELECT * FROM kematian");


    $content .= '
<style type="text/css">
.tabel { border-collapse:collapse; }
.tabel th { padding: 8px 5px; background-color:#6777ef; color:#fff; }
.center { font-size:20px; text-align: center; }
.lapor { font-size:15px; text-align: center; }
</style>
';

    $content .= '
<page>
        <div class="center">
            <b>Dukcapil Kab. Luwu 2022</b>
        </div>
        <br>
        <div class="lapor">
           <b>Laporan Data Kematian</b>
        </div>
    <br>
    <table border="1px" class="tabel" style="margin:auto;">
        <tr align="center">
            <th>No</th>
            <th>Nomor Surat Kematian</th>
            <th>Nama Jenazah</th>
            <th>Penyebab Kematian</th>
            <th>Tanggal Kematian</th>
            <th>Alamat Jenazah</th>
        </tr>';

    $no = 1;
    foreach ($data_kematian as $kematian) {
        $content .= '
        <tr align="center">
            <td>' . $no++ . '</td>
            <td>' . $kematian['surat_kematian'] . '</td>
            <td>' . $kematian['nama_jenazah'] . '</td>
            <td>' . $kematian['surat_pernyataan'] . '</td>
            <td>' . date('D, M j Y', strtotime($kematian['tanggal_kematian'])) . '</td>
            <td>' . $kematian['alamat'] . '</td>
        </tr>
    ';
    }

    $content .= '
    </table>
</page>';

    $html2pdf = new Html2Pdf('L', 'A4', 'en');
    $html2pdf->writeHTML($content);
    ob_start();
    $html2pdf->output('Laporan-PDF-Kematian.pdf');
