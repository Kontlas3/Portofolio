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

$title = 'Data Pengeluaran';

include "layout/header.php";
include "config/app.php";

$data_pengeluaran = select("SELECT * FROM pengeluaran");

// Tambah Data Pengeluaran
if (isset($_POST['tambah'])) {
    if (create_pengeluaran($_POST) > 0) {
        echo "<script>
        alert('Data Pengeluaran Berhasil Di Tambah');
        document.location.href = 'pengeluaran.php';
        </script>";
    } else {
        echo "<script>
        alert('Data pengeluaran Gagal Di Tambah');
        document.location.href = 'pengeluaran.php';
        </script>";
    }
}

// Ubah Data Pengeluaran
if (isset($_POST['Ubah'])) {
    if (update_pengeluaran($_POST) > 0) {
        echo "<script>
        alert('Data Pengeluaran Berhasil Diubah');
        document.location.href = 'pengeluaran.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Pengeluaran Gagal Diubah');
        document.location.href = 'pengeluaran.php';
        </script>";
    }
}

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pengeluaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Data Pengeluaran</div>
            </div>
        </div>

        <div class="section-body">
            <div class="section-body">
                <div class="card card-primary">
                    <div class="card-header" style="margin-top: 5px;">
                        <h4>Data Pengeluaran</h4>
                        <div class="card-header-action">
                        </div>
                        <?php if ($_SESSION['level'] != 3) : ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                <i class="fas fa-plus-circle"></i> Tambah Data
                            </button>
                            <a href="download-excel-pengeluaran.php" class="btn btn-success" style="margin-left: 10px;">
                                <i class="fas fa-file-excel"></i> Download Excel
                            </a>
                            <a href="pdf/download-pdf-pengeluaran.php" class="btn btn-info" style="margin-left: 5px;">
                                <i class="fas fa-file-pdf"></i> Download PDF
                            </a>
                        <?php endif; ?>
                        <a href="chart.php" class="btn btn-danger" style="margin-left: 5px;">
                            <i class="fas fa-chart-bar"></i> Lihat Chart
                        </a>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengeluaran</th>
                                    <th>Jenis Pengeluaran</th>
                                    <th>Jumlah Pengeluaran</th>
                                    <?php if ($_SESSION['level'] != 3) : ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <?php foreach ($data_pengeluaran as $pengeluaran) : ?>
                                    <tr>
                                        <td><?= $no++ . '.'; ?></td>
                                        <td><?= date('D, M j Y', strtotime($pengeluaran['tanggal_pengeluaran'])); ?></td>
                                        <td><?= $pengeluaran['jenis_pengeluaran']; ?></td>
                                        <td>Rp. <?= number_format($pengeluaran['jumlah_pengeluaran'], 0, ',', '.'); ?></td>
                                        <?php if ($_SESSION['level'] != 3) : ?>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalView<?= $pengeluaran['id_pengeluaran']; ?>"><i class="fas fa-eye"></i></button>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalUbah<?= $pengeluaran['id_pengeluaran']; ?>"><i class="fas fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus<?= $pengeluaran['id_pengeluaran']; ?>"><i class="fas fa-trash"></i></button>
                                            <?php endif; ?>
                                            </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah -->

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tanggal_pengeluaran">Tanggal Pengeluaran</label>
                                <input type="date" class="form-control" id="tanggal_pengeluaran" name="tanggal_pengeluaran">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jenis_pengeluaran">Jenis Pengeluaran</label>
                                <input type="text" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" placeholder="Jenis Pengeluaran">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="jumlah_pengeluaran">Jumlah Pengeluaran</label>
                                <input type="text" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran" placeholder="Jumlah Pengeluaran">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah -->

<?php foreach ($data_pengeluaran as $pengeluaran) : ?>
    <div class="modal fade" id="modalUbah<?= $pengeluaran['id_pengeluaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_pengeluaran" value="<?= $pengeluaran['id_pengeluaran']; ?>">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tanggal_pengeluaran">Tanggal Pengeluaran</label>
                                    <input type="date" class="form-control" id="tanggal_pengeluaran" name="tanggal_pengeluaran" value="<?= $pengeluaran['tanggal_pengeluaran']; ?>" placeholder="Nomor Surat Kematian">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jenis_pengeluaran">Jenis Pengeluaran</label>
                                    <input type="text" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" value="<?= $pengeluaran['jenis_pengeluaran']; ?>" placeholder="Nama Pengantin Pria">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="jumlah_pengeluaran">Jumlah Pengeluaran</label>
                                    <input type="text" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran" value="<?= $pengeluaran['jumlah_pengeluaran']; ?>" placeholder="Nama Pengantin Wanita">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                    <button type="submit" name="Ubah" class="btn btn-success">Ubah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus -->

<?php foreach ($data_pengeluaran as $pengeluaran) : ?>
    <div class="modal fade" id="modalHapus<?= $pengeluaran['id_pengeluaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="card-body">
                            <p>Yakin Ingin Menghapus Data Pengeluaran Dengan Jenis <?= $pengeluaran['jenis_pengeluaran']; ?> ?</p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <a href="hapus-pengeluaran.php?id_pengeluaran=<?= $pengeluaran['id_pengeluaran']; ?>" class="btn btn-danger">Hapus</a>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal View -->

<?php foreach ($data_pengeluaran as $pengeluaran) : ?>
    <div class="modal fade" id="modalView<?= $pengeluaran['id_pengeluaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">View Data Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_pengeluaran" value="<?= $pengeluaran['id_pengeluaran']; ?>">
                        <div class="card-body table-responsive" style="margin: auto;">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="padding-left:10%;">Tanggal Pengeluaran</th>
                                        <th>: <?= $pengeluaran['tanggal_pengeluaran']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Jenis Pengeluaran</th>
                                        <th>: <?= $pengeluaran['jenis_pengeluaran']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Jumlah Pengeluaran</th>
                                        <th>: <?= $pengeluaran['jumlah_pengeluaran']; ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                    <button type="submit" name="Ubah" class="btn btn-success">Ubah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php

include "layout/footer.php";

?>