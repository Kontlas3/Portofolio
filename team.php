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

$title = 'Data Team';

include "layout/header.php";

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Team</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Data Team</div>
            </div>
        </div>

        <div class="section-body">
            <div class="section-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Data Team</h4>
                        <div class="card-header-action">
                            <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary" href="#"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse hide" id="mycard-collapse">
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                                <li class="media">
                                    <img alt="image" class="mr-3 rounded-circle" width="70" src="assets/img/avatar/avatar-6.png">
                                    <div class="media-body">
                                        <div class="media-title mb-1">Rajiv</div>
                                        <div class="text-time">1904411639</div>
                                        <div class="media-description"><b>Tetaplah Hidup Walau Tidak Berguna.</b></div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img alt="image" class="mr-3 rounded-circle" width="70" src="assets/img/avatar/avatar-7.jpg">
                                    <div class="media-body">
                                        <div class="media-title mb-1">Nining Faradilla</div>
                                        <div class="text-time">1904411649</div>
                                        <div class="media-description"><b>Makanlah Ketika Anda Lapar.</b></div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img alt="image" class="mr-3 rounded-circle" width="70" src="assets/img/avatar/avatar-8.jpg">
                                    <div class="media-body">
                                        <div class="media-title mb-1">Arman</div>
                                        <div class="text-time">1904411643</div>
                                        <div class="media-description"><b>Sholatlah Sebelum Engkau Di Sholatkan.</b></div>
                                    </div>
                                </li>
                            </ul>
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