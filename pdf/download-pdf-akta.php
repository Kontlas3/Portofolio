d<?php

    require __DIR__ . '../../vendor/autoload.php';
    require '../config/app.php';

    use Spipu\Html2Pdf\Html2Pdf;

    $data_akta = select("SELECT * FROM akta");


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
           <b>Laporan Data Akta Kelahiran</b>
        </div>
    <br>
    <table border="1px" class="tabel" style="margin:auto;">
        <tr align="center">
            <th>No</th>
            <th>NIK</th>
            <th>Nomor Akta Kelahiran</th>
            <th>Nama Anak</th>
            <th>Tanggal Kematian</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Status Akta</th>
        </tr>';

    $no = 1;
    foreach ($data_akta as $akta) {
        $content .= '
        <tr align="center">
            <td>' . $no++ . '</td>
            <td>' . $akta['nik'] . '</td>
            <td>' . $akta['no_akta'] . '</td>
            <td>' . $akta['nama_anak'] . '</td>
            <td>' . date('D, M j Y', strtotime($akta['tanggal_akta'])) . '</td>
            <td>' . $akta['nama_ayah'] . '</td>
            <td>' . $akta['nama_ibu'] . '</td>
            <td>' . $akta['jk'] . '</td>
            <td>' . $akta['alamat'] . '</td>
            <td>' . $akta['status'] . '</td>
        </tr>
    ';
    }

    $content .= '
    </table>
</page>';

    $html2pdf = new Html2Pdf('L', 'A4', 'en',);
    $html2pdf->writeHTML($content);
    ob_start();
    $html2pdf->output('Laporan-PDF-Akta-Kelahiran.pdf');
