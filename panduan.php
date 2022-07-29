<?php

session_start();

$title = 'Panduan Aplikasi';

include "layout/header.php";

?>


<div class="main-content" style="min-height: 874px;">
    <section class="section">
        <div class="section-header">
            <h1>Panduan Aplikasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Panduan Aplikasi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="section-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Panduan Aplikasi</h4>
                    </div>
                    <div class="card-body">
                        Panduan Pengunaan Aplikasi Dukcapil Kab. Luwu 2022 :
                        <br>
                        <br>
                        <p>1. Jika Ingin Menambahkan Data Baik Data Kelahiran, Data Pernikahan, Dan Data Kematian Silahkan Klik Bagian Master Data Dan Pilih Data Yang Ingin Di Tambahkan</p>
                        <p>2. Klik Pada Bagian Tambah Data Dan Masukkan Data Orang Yang Telah Melapor</p>
                        <p>3. Klik Simpan Data Dan Liat Data Tersebut Pada Data Tabel Baik Di Akta Kelahiran, Data Pernikahan, Dan Data Kematian</p>
                        <p>4. Jika Ingin Melakukan Pengeditan Data Klik Icon Berwarna Hijau Untuk Melakukan Pengeditan Data</p>
                        <p>5. Jika Ingin Menampilkan Data Klik Icon Berwarna Kuning Untuk Melakukan View Data</p>
                        <p>6. Jika Ingin Menghapus Data Klik Icon Berwarna Merah Untuk Melakukan Delete Data Yang Dipilih</p>
                        <p>7. Jika Ingin Melakukan Print Data Dalam Bentuk Excel Silahkan Klik Download Excel</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php

include "layout/footer.php";

?>