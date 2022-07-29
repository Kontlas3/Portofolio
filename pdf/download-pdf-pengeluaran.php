d<?php

    require __DIR__ . '../../vendor/autoload.php';
    require '../config/app.php';

    use Spipu\Html2Pdf\Html2Pdf;

    $data_pengeluaran = select("SELECT * FROM pengeluaran");


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
           <b>Laporan Data Pengeluaran</b>
        </div>
    <br>
    <table border="1px" class="tabel" style="margin:auto;">
        <tr align="center">
            <th>No</th>
            <th>Tanggal Pengeluaran</th>
            <th>Jenis Pengeluaran</th>
            <th>Jumlah Pengeluaran</th>
        </tr>';

    $no = 1;
    foreach ($data_pengeluaran as $pengeluaran) {
        $content .= '
        <tr align="center">
            <td>' . $no++ .  '</td>
            <td>' . date('D, M j Y', strtotime($pengeluaran['tanggal_pengeluaran'])) . '</td>
            <td>' . $pengeluaran['jenis_pengeluaran'] . '</td>
            <td>Rp. ' . number_format($pengeluaran['jumlah_pengeluaran'], 0, ',', '.') . '</td>
        </tr>
    ';
    }

    $content .= '
    </table>
</page>';

    $html2pdf = new Html2Pdf('L', 'A4', 'en',);
    $html2pdf->writeHTML($content);
    ob_start();
    $html2pdf->output('Laporan-PDF-Pengeluaran.pdf');
