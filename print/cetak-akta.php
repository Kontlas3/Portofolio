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

$title = 'Cetak Akta Kelahiran';

include "../config/app.php";


$data_akta = select("SELECT * FROM akta");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="icon" type="image/png" href="../assets/img/stisla-fill.svg" />
    <style>
        table {
            border-collapse: collapse;
        }

        thead>tr {
            background-color: #0070C0;
            color: #f1f1f1;
        }

        thead>tr>th {
            background-color: #0070C0;
            color: #fff;
            padding: 10px;
            border-color: #fff;
        }

        th,
        td {
            padding: 2px;
        }

        th {
            color: #222;
        }

        body {
            font-family: Calibri;
        }
    </style>
</head>
<p>&nbsp;</p>
<p style="text-align: center;"><img src="../assets/img/stisla-fill.svg" alt="" width="125" height="124" /></p>
<p> </p>
<p style="text-align: center;"><strong><span style="text-decoration: underline;">PENCATATAN SIPIL DUKCAPIL LUWU</span></strong></p>
<p style="text-align: center; margin-top:1px;">REGISTRASI OFFICE</p>
<h4 style="margin-top: 0px;" align="center"><u>KUTIPAN AKTA KELAHIRAN</u></h4>
<p>&nbsp;</p>
<table border="0" width="100%">
    <tbody>
        <?php foreach ($data_akta as $akta) : ?>
            <tr>
                <u>BERDASARKAN AKTA KELAHIRAN NOMOR</u> <b> 2022-<?= $akta['no_akta']; ?></b> <u> NAMA ANAK </u> <B><?= $akta['nama_anak']; ?></B>, <u>TANGGAL LAHIR</u> <b> <?= $akta['tanggal_akta']; ?></b>
                , <u> NAMA AYAH</u><b> <?= $akta['nama_ayah']; ?></b>, <U>NAMA IBU</U> <b> <?= $akta['nama_ibu']; ?></b>, <u>JENIS KELAMIN</u> <b> <?= $akta['jk']; ?></b> <u> YANG BERALAMAT DI</u> <b> <?= $akta['alamat']; ?></b>. KUTIPAN INI
                DIKELUARKAN SEBENAR-BENARNYA DARI DINAS DUKCAPIL LUWU

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p>&nbsp;</p>
<div style="float: right; margin-right: 40px;">
    <table style="width: 386px;">
        <tbody>
            <tr>
                <td style="width: 386px; text-align: center;">Sulawesi Selatan, <?= date('d-m') ?> <?= date('Y') ?><br />Dinas Kependudukan Catatasan Sipil Luwu, <br /><br /><br /><br /><br />(.............................................)<p>Ramli Hasnawi S.PD</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>

<script>
    window.print();
</script>
</body>

</html>