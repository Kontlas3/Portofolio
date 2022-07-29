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

$title = 'Data Akta Pernikahan';

include "layout/header.php";
include "config/app.php";

$data_pernikahan = select("SELECT * FROM pernikahan");

// Tambah Data Pernikahan
if (isset($_POST['tambah'])) {
    if (create_pernikahan($_POST) > 0) {
        echo "<script>
        alert('Data Pernikahan Berhasil Di Tambah');
        document.location.href = 'pernikahan.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Pernikahan Gagal Di Tambah');
        document.location.href = 'pernikahan.php';
        </script>";
    }
}

// Ubah Data Pernikahan
if (isset($_POST['Ubah'])) {
    if (update_pernikahan($_POST) > 0) {
        echo "<script>
        alert('Data Pernikahan Berhasil Diubah');
        document.location.href = 'pernikahan.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Pernikahan Gagal Diubah');
        document.location.href = 'pernikahan.php';
        </script>";
    }
}

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Akta Pernikahan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Data Akta Pernikahan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="section-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Data Akta Pernikahan</h4>
                        <div class="card-header-action">
                        </div>
                        <?php if ($_SESSION['level'] != 3) : ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                <i class="fas fa-plus-circle"></i> Tambah Data
                            </button>
                            <a href="download-excel-pernikahan.php" class="btn btn-success" style="margin-left: 10px;">
                                <i class="fas fa-file-excel"></i> Download Excel
                            </a>
                            <a href="pdf/download-pdf-pernikahan.php" class="btn btn-info" style="margin-left: 5px;">
                                <i class="fas fa-file-pdf"></i> Download PDF
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md" id="table1">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>No Surat Pernikahan</th>
                                    <th>Nama Pria</th>
                                    <th>Nama Wanita</th>
                                    <th>Tanggal Pernikahan</th>
                                    <th>Tempat Pernikahan</th>
                                    <th>Nama Wali Pria</th>
                                    <th>Nama Wali Wanita</th>
                                    <th>Penghulu</th>
                                    <th>Keterangan</th>
                                    <?php if ($_SESSION['level'] != 3) : ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <?php foreach ($data_pernikahan as $pernikahan) : ?>
                                    <tr align="center">
                                        <td><?= $no++ . '.'; ?></td>
                                        <td><?= $pernikahan['no_pernikahan']; ?></td>
                                        <td><?= $pernikahan['nama_pria']; ?></td>
                                        <td><?= $pernikahan['nama_wanita']; ?></td>
                                        <td><?= date('D, M j Y', strtotime($pernikahan['tanggal_pernikahan'])); ?></td>
                                        <td><?= $pernikahan['tempat_pernikahan']; ?></td>
                                        <td><?= $pernikahan['nama_walip']; ?></td>
                                        <td><?= $pernikahan['nama_waliw']; ?></td>
                                        <td><?= $pernikahan['penghulu']; ?></td>
                                        <td><?= $pernikahan['keterangan']; ?></td>
                                        <?php if ($_SESSION['level'] != 3) : ?>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalView<?= $pernikahan['id_pernikahan']; ?>"><i class="fas fa-eye"></i></button>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalUbah<?= $pernikahan['id_pernikahan']; ?>"><i class="fas fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus<?= $pernikahan['id_pernikahan']; ?>"><i class="fas fa-trash"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pernikahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="no_pernikahan">No Surat Pernikahan</label>
                                <input type="number" class="form-control" id="no_pernikahan" name="no_pernikahan" placeholder="Nomor Surat Pernikahan">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_pria">Nama Pria</label>
                                <input type="text" class="form-control" id="nama_pria" name="nama_pria" placeholder="Nama Pengantin Pria">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_wanita">Nama Wanita</label>
                                <input type="text" class="form-control" id="nama_wanita" name="nama_wanita" placeholder="Nama Pengantin Wanita">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_pernikahan">Tanggal Pernikahan</label>
                                <input type="date" class="form-control" id="tanggal_pernikahan" name="tanggal_pernikahan">
                            </div>
                        </div>
                        <div class=" form-row">
                            <div class="form-group col-md-6">
                                <label for="tempat_pernikahan">Tempat Pernikahan</label>
                                <input type="text" class="form-control" id="tempat_pernikahan" name="tempat_pernikahan" placeholder="Tempat Pernikahan">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_walip">Nama Wali Pria</label>
                                <input type="text" class="form-control" id="nama_walip" name="nama_walip" placeholder="Nama Wali Pria">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_waliw">Nama Wali Wanita</label>
                                <input type="text" class="form-control" id="nama_waliw" name="nama_waliw" placeholder="Nama Wali Wanita">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="penghulu">Nama Penghulu</label>
                                <input type="text" class="form-control" id="penghulu" name="penghulu" placeholder="Nama Penghulu">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" data-height="80" style="height: 80px;" placeholder="Keterangan"></textarea>
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

<?php foreach ($data_pernikahan as $pernikahan) : ?>
    <div class="modal fade" id="modalUbah<?= $pernikahan['id_pernikahan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pernikahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_pernikahan" value="<?= $pernikahan['id_pernikahan']; ?>">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="no_pernikahan">No Surat Pernikahan</label>
                                    <input type="number" class="form-control" id="no_pernikahan" name="no_pernikahan" value="<?= $pernikahan['no_pernikahan']; ?>" placeholder="Nomor Surat Pernikahan">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama_pria">Nama Pria</label>
                                    <input type="text" class="form-control" id="nama_pria" name="nama_pria" value="<?= $pernikahan['nama_pria']; ?>" placeholder="Nama Pengantin Pria">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_wanita">Nama Wanita</label>
                                    <input type="text" class="form-control" id="nama_wanita" name="nama_wanita" value="<?= $pernikahan['nama_wanita']; ?>" placeholder="Nama Pengantin Wanita">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tanggal_pernikahan">Tanggal Pernikahan</label>
                                    <input type="date" class="form-control" id="tanggal_pernikahan" value="<?= $pernikahan['tanggal_pernikahan']; ?>" name="tanggal_pernikahan">
                                </div>
                            </div>
                            <div class=" form-row">
                                <div class="form-group col-md-6">
                                    <label for="tempat_pernikahan">Tempat Pernikahan</label>
                                    <input type="text" class="form-control" id="tempat_pernikahan" value="<?= $pernikahan['tempat_pernikahan']; ?>" name="tempat_pernikahan" placeholder="Tempat Pernikahan">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama_walip">Nama Wali Pria</label>
                                    <input type="text" class="form-control" id="nama_walip" value="<?= $pernikahan['nama_walip']; ?>" name="nama_walip" placeholder="Nama Wali Pria">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_waliw">Nama Wali Wanita</label>
                                    <input type="text" class="form-control" id="nama_waliw" name="nama_waliw" value="<?= $pernikahan['nama_waliw']; ?>" placeholder="Nama Wali Wanita">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="penghulu">Nama Penghulu</label>
                                    <input type="text" class="form-control" id="penghulu" name="penghulu" value="<?= $pernikahan['penghulu']; ?>" placeholder="Nama Penghulu">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" data-height="80" style="height: 80px;" placeholder="Keterangan"><?= $pernikahan['keterangan']; ?></textarea>
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

<?php foreach ($data_pernikahan as $pernikahan) : ?>
    <div class="modal fade" id="modalHapus<?= $pernikahan['id_pernikahan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pernikahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="card-body">
                            <p>Yakin Ingin Menghapus Data Ini - <?= $pernikahan['no_pernikahan']; ?> ?</p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <a href="hapus-pernikahan.php?id_pernikahan=<?= $pernikahan['id_pernikahan']; ?>" class="btn btn-danger">Hapus</a>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal View -->

<?php foreach ($data_pernikahan as $pernikahan) : ?>
    <div class="modal fade" id="modalView<?= $pernikahan['id_pernikahan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">View Data Pernikahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_pernikahan" value="<?= $pernikahan['id_pernikahan']; ?>">
                        <div class="card-body table-responsive" style="margin: auto;">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="padding-left:10%;">No Surat Pernikahan</th>
                                        <th>: <?= $pernikahan['no_pernikahan']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Nama Pria</th>
                                        <th>: <?= $pernikahan['nama_pria']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Nama Wanita</th>
                                        <th>: <?= $pernikahan['nama_wanita']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Tanggal Pernikahan</th>
                                        <th>: <?= $pernikahan['tanggal_pernikahan']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Tempat Pernikahan</th>
                                        <th>: <?= $pernikahan['tempat_pernikahan']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Nama Wali Pria</th>
                                        <th>: <?= $pernikahan['nama_walip']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Nama Wali Wanita</th>
                                        <th>: <?= $pernikahan['nama_waliw']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Penghulu</th>
                                        <th>: <?= $pernikahan['penghulu']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Keterangan</th>
                                        <th>: <?= $pernikahan['keterangan']; ?></th>
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