d<?php

    require __DIR__ . '../../vendor/autoload.php';
    require '../config/app.php';

    use Spipu\Html2Pdf\Html2Pdf;

    $data_pernikahan = select("SELECT * FROM pernikahan");


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
           <b>Laporan Data Pernikahan</b>
        </div>
    <br>
    <table border="1px" class="tabel" style="margin:auto;">
        <tr align="center">
            <th>No</th>
            <th>Nomor Surat Pernikahan</th>
            <th>Nama Pria</th>
            <th>Nama Wanita</th>
            <th>Tanggal Kematian</th>
            <th>Tempat Pernikahan</th>
            <th>Nama Wali Pria</th>
            <th>Nama Wali Wanita</th>
            <th>Penghulu</th>
            <th>Keterangan</th>
        </tr>';

    $no = 1;
    foreach ($data_pernikahan as $pernikahan) {
        $content .= '
        <tr align="center">
            <td>' . $no++ . '</td>
            <td>' . $pernikahan['no_pernikahan'] . '</td>
            <td>' . $pernikahan['nama_pria'] . '</td>
            <td>' . $pernikahan['nama_wanita'] . '</td>
            <td>' . date('D, M j Y', strtotime($pernikahan['tanggal_pernikahan'])) . '</td>
            <td>' . $pernikahan['tempat_pernikahan'] . '</td>
            <td>' . $pernikahan['nama_walip'] . '</td>
            <td>' . $pernikahan['nama_waliw'] . '</td>
            <td>' . $pernikahan['penghulu'] . '</td>
            <td>' . $pernikahan['keterangan'] . '</td>
        </tr>
    ';
    }

    $content .= '
    </table>
</page>';

    $html2pdf = new Html2Pdf('L', 'A4', 'en',);
    $html2pdf->writeHTML($content);
    ob_start();
    $html2pdf->output('Laporan-PDF-Pernikahan.pdf');
