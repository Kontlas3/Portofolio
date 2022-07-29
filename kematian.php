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

$title = 'Data Akta Kematian';

include "layout/header.php";
include "config/app.php";

$data_kematian = select("SELECT * FROM kematian");

// Tambah Data Kematian
if (isset($_POST['tambah'])) {
    if (create_kematian($_POST) > 0) {
        echo "<script>
        alert('Data kematian Berhasil Di Tambah');
        document.location.href = 'kematian.php';
        </script>";
    } else {
        echo "<script>
        alert('Data kematian Gagal Di Tambah');
        document.location.href = 'kematian.php';
        </script>";
    }
}

// Ubah Data Kematian
if (isset($_POST['Ubah'])) {
    if (update_kematian($_POST) > 0) {
        echo "<script>
        alert('Data kematian Berhasil Diubah');
        document.location.href = 'kematian.php';
        </script>";
    } else {
        echo "<script>
        alert('Data kematian Gagal Diubah');
        document.location.href = 'kematian.php';
        </script>";
    }
}

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Akta Kematian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Data Akta Kematian</div>
            </div>
        </div>

        <div class="section-body">
            <div class="section-body">
                <div class="card card-primary">
                    <div class="card-header" style="margin-top: 5px;">
                        <h4>Data Akta Kematian</h4>
                        <div class="card-header-action">
                        </div>
                        <?php if ($_SESSION['level'] != 3) : ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                <i class="fas fa-plus-circle"></i> Tambah Data
                            </button>
                            <a href="download-excel-kematian.php" class="btn btn-success" style="margin-left: 5px;">
                                <i class="fas fa-file-excel"></i> Download Excel
                            </a>
                            <a href="pdf/download-pdf-kematian.php" class="btn btn-info" style="margin-left: 5px;">
                                <i class="fas fa-file-pdf"></i> Download PDF
                            </a>
                        <?php endif; ?>
                    </div>


                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md" id="table1">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nomor Surat Kematian</th>
                                    <th>Nama Jenazah</th>
                                    <th>Penyebab Kematian</th>
                                    <th>Tanggal Kematian</th>
                                    <th>Alamat Jenazah</th>
                                    <?php if ($_SESSION['level'] != 3) : ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <?php foreach ($data_kematian as $kematian) : ?>
                                    <tr>
                                        <td><?= $no++ . '.'; ?></td>
                                        <td><?= $kematian['surat_kematian']; ?></td>
                                        <td><?= $kematian['nama_jenazah']; ?></td>
                                        <td><?= $kematian['surat_pernyataan']; ?></td>
                                        <td><?= date('D, M j Y', strtotime($kematian['tanggal_kematian'])); ?></td>
                                        <td><?= $kematian['alamat']; ?></td>
                                        <?php if ($_SESSION['level'] != 3) : ?>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalView<?= $kematian['id_kematian']; ?>"><i class="fas fa-eye"></i></button>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalUbah<?= $kematian['id_kematian']; ?>"><i class="fas fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus<?= $kematian['id_kematian']; ?>"><i class="fas fa-trash"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kematian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="surat_kematian">Nomor Surat Kematian</label>
                                <input type="text" class="form-control" id="surat_kematian" name="surat_kematian" placeholder="Nomor Surat Kematian">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_jenazah">Nama Jenazah</label>
                                <input type="text" class="form-control" id="nama_jenazah" name="nama_jenazah" placeholder="Nama Jenazah">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="surat_pernyataan">Penyebab Kematian</label>
                                <input type="text" class="form-control" id="surat_pernyataan" name="surat_pernyataan" placeholder="Alasan Kematian">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_kematian">Tanggal Kematian</label>
                                <input type="date" class="form-control" id="tanggal_kematian" name="tanggal_kematian">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="alamat">Alamat Jenazah</label>
                                <textarea class="form-control" id="alamat" name="alamat" data-height="80" style="height: 80px;" placeholder="Alamat Jenazah"></textarea>
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

<?php foreach ($data_kematian as $kematian) : ?>
    <div class="modal fade" id="modalUbah<?= $kematian['id_kematian']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data kematian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_kematian" value="<?= $kematian['id_kematian']; ?>">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="surat_kematian">Nomor Surat Kematian</label>
                                    <input type="text" class="form-control" id="surat_kematian" name="surat_kematian" value="<?= $kematian['surat_kematian']; ?>" placeholder="Nomor Surat Kematian">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama_jenazah">Nama Jenazah</label>
                                    <input type="text" class="form-control" id="nama_jenazah" name="nama_jenazah" value="<?= $kematian['nama_jenazah']; ?>" placeholder="Nama Pengantin Pria">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="surat_pernyataan">Penyebab Kematian</label>
                                    <input type="text" class="form-control" id="surat_pernyataan" name="surat_pernyataan" value="<?= $kematian['surat_pernyataan']; ?>" placeholder="Nama Pengantin Wanita">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tanggal_kematian">Tanggal Kematian</label>
                                    <input type="date" class="form-control" id="tanggal_kematian" value="<?= $kematian['tanggal_kematian']; ?>" name="tanggal_kematian">
                                </div>
                            </div>
                            <div class=" form-row">
                                <div class="form-group col-md-12">
                                    <label for="alamat">Alamat Jenazah</label>
                                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Jenazah" data-height="150" style="height: 150px;"><?= $kematian['alamat']; ?></textarea>
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

<?php foreach ($data_kematian as $kematian) : ?>
    <div class="modal fade" id="modalHapus<?= $kematian['id_kematian']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kematian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="card-body">
                            <p>Yakin Ingin Menghapus Data Dengan Nama Jenazah - <?= $kematian['nama_jenazah']; ?> ?</p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <a href="hapus-kematian.php?id_kematian=<?= $kematian['id_kematian']; ?>" class="btn btn-danger">Hapus</a>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal View -->

<?php foreach ($data_kematian as $kematian) : ?>
    <div class="modal fade" id="modalView<?= $kematian['id_kematian']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">View Data kematian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_kematian" value="<?= $kematian['id_kematian']; ?>">
                        <div class="card-body table-responsive" style="margin: auto;">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="padding-left:10%;">No Surat Kematian</th>
                                        <th>: <?= $kematian['surat_kematian']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Nama Jenazah</th>
                                        <th>: <?= $kematian['nama_jenazah']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Penyebab Kematian</th>
                                        <th>: <?= $kematian['surat_pernyataan']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Tanggal Kematian</th>
                                        <th>: <?= $kematian['tanggal_kematian']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Alamat Jenazah</th>
                                        <th>: <?= $kematian['alamat']; ?></th>
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