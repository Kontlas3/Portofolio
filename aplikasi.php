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

// Membatasi Akses Sesuai User Login 

// if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2) {
//     echo "<script>
//     alert('Anda Tidak Punya Akses Disini');
//     document.location.href = 'index.php';
//     </script>";
//     exit;
// }

$title = 'Tentang Aplikasi Dukcapil';

include "layout/header.php";

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tentang Aplikasi Dukcapil</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Tentang Aplikasi Dukcapil</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="col-12 col-sm-12 col-lg-12">

                    <div class="card-header">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">Tujuan Aplikasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact4" role="tab" style="margin-left: 20px;" aria-controls="contact" aria-selected="false">Versi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact5" role="tab" style="margin-left: 20px;" aria-controls="contact" aria-selected="false">Alat Tempur Pengerjaan Aplikasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact7" role="tab" style="margin-left: 20px;" aria-controls="contact" aria-selected="false">Plugin Yang Digunakan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact6" role="tab" style="margin-left: 20px;" aria-controls="contact" aria-selected="false">Spesial Thanks To</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                Tujuan dari pembuatan aplikasi ini yaitu : <br><br>
                                <p>1. Memberikan kemudahan terhadap staf yang melakukan penginputan terhadap data masyarakat sehingga proses pemeriksaan data & maintenance dapat dikerjakan dengan cepat.</p>
                                <p>2. Mempermudah melakukan monitoring atau pengecekan status peralatan yang tersedia baik dalam bentuk report dan yang lainnya.</p>
                            </div>
                            <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab3">
                                Versi Aplikasi Saat Ini yakni V 1.0 sesuai dengan <b>Footer</b> Dibawah
                            </div>
                            <div class="tab-pane fade" id="contact5" role="tabpanel" aria-labelledby="contact-tab3">
                                Alat Tempur Pengerjaan Aplikasi ini yaitu : <br><br>
                                <p>1. Kopi</p>
                                <p>2. Masih Kopi</p>
                                <p>3. Tetep Kopi</p>
                            </div>
                            <div class="tab-pane fade" id="contact7" role="tabpanel" aria-labelledby="contact-tab3">
                                Fitur yang tersedia yakni : <br><br>
                                <p>1. Datatables Client Side</p>
                                <p>2. CRUD Biasa Di <b>Data Akta</b></p>
                                <p>3. CRUD Menggunakan Modal Bootstrap Di <b>Data Pernikahan - Data Kematian - Data User</b></p>
                                <p>4. Menggunakan Fitur Cetak Data Ke Excel & PDF Dengan Composer PhpOffice </p>
                                <p>5. Menggunakan Multi User Login</p>
                                <p>6. Membatasi Setiap Hak Akses Setiap User Level</p>

                            </div>
                            <div class="tab-pane fade" id="contact6" role="tabpanel" aria-labelledby="contact-tab3">
                                Special Thanks : <br><br>
                                <p>1. Stackoverflow Forum</p>
                                <p>2. Google</p>
                                <p>3. Youtube</p>
                                <p>4. Dosen & Teman Kelas 6 Gabungan 1 Web</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php

include "layout/footer.php";

?>