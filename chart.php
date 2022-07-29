<?php

session_start();

$title = 'Chart Pengeluaran 2022';

include "layout/header.php";
include "config/app.php";

$data_pengeluaran = mysqli_query($db, "SELECT jenis_pengeluaran FROM pengeluaran GROUP BY jenis_pengeluaran");
$pengeluaran = mysqli_query($db, "SELECT SUM(jumlah_pengeluaran) AS sold FROM pengeluaran GROUP BY jumlah_pengeluaran")

?>


<div class="main-content" style="min-height: 874px;">
    <section class="section">
        <div class="section-header">
            <h1>Chart Pengeluaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="pengeluaran.php"> Kembali </a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="section-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Chart Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php

include "layout/footer.php";

?>