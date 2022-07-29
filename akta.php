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

$title = 'Data Akta Kelahiran';

include "layout/header.php";
include "config/app.php";

$data_akta = select("SELECT * FROM akta");

// Tambah Data Akta Kelahiran
if (isset($_POST['tambah'])) {
    if (create_akta($_POST) > 0) {
        echo "<script>
        alert('Data Akta Kelahiran Berhasil Di Tambah');
        document.location.href = 'akta.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Akta Kelahiran Gagal Di Tambah');
        document.location.href = 'akta.php';
        </script>";
    }
}

// Ubah Data Akta Kelahiran
if (isset($_POST['Ubah'])) {
    if (update_akta($_POST) > 0) {
        echo "<script>
        alert('Data Akta Kelahiran Berhasil Diubah');
        document.location.href = 'akta.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Akta Kelahiran Gagal Diubah');
        document.location.href = 'akta.php';
        </script>";
    }
}

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Akta Kelahiran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Data Akta Kelahiran</div>
            </div>
        </div>

        <div class="section-body">
            <div class="section-body">
                <div class="card card-primary">
                    <div class="card-header" style="margin-top: 5px;">
                        <h4>Data Akta Kelahiran</h4>
                        <div class="card-header-action">
                        </div>
                        <?php if ($_SESSION['level'] != 3) : ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                <i class="fas fa-plus-circle"></i> Tambah Data
                            </button>
                            <a href="download-excel-akta.php" class="btn btn-success" style="margin-left: 5px;">
                                <i class="fas fa-file-excel"></i> Download Excel
                            </a>
                            <a href="pdf/download-pdf-akta.php" class="btn btn-info" style="margin-left: 5px;">
                                <i class="fas fa-file-pdf"></i> Download PDF
                            </a>
                        <?php endif; ?>
                    </div>


                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md" id="table1">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nomor Akta</th>
                                    <th>Nama Anak</th>
                                    <th>Tanggal Akta Kelahiran</th>
                                    <th>Nama Ayah</th>
                                    <th>Nama Ibu</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <?php if ($_SESSION['level'] != 3) : ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <?php foreach ($data_akta as $akta) : ?>
                                    <tr>
                                        <td><?= $no++ . '.'; ?></td>
                                        <td><?= $akta['nik']; ?></td>
                                        <td><?= $akta['no_akta']; ?></td>
                                        <td><?= $akta['nama_anak']; ?></td>
                                        <td><?= date('D, M j Y', strtotime($akta['tanggal_akta'])); ?></td>
                                        <td><?= $akta['nama_ayah']; ?></td>
                                        <td><?= $akta['nama_ibu']; ?></td>
                                        <td><?= $akta['jk']; ?></td>
                                        <td><?= $akta['alamat']; ?></td>
                                        <td>
                                            <?php
                                            if ($akta['status'] == 'Menunggu') {
                                            ?>
                                                <span class="badge badge-info">Menunggu</span>
                                            <?php
                                            } elseif ($akta['status'] == 'Proses') {
                                            ?>
                                                <span class="badge badge-warning">Proses</span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="badge badge-success">Selesai</span>
                                            <?php
                                            }
                                            ?>
                                            <?php if ($_SESSION['level'] != 3) : ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalView<?= $akta['id_akta']; ?>"><i class="fas fa-eye"></i></button>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalUbah<?= $akta['id_akta']; ?>"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus<?= $akta['id_akta']; ?>"><i class="fas fa-trash"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Akta Kelahiran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="no_akta">Nomor Akta Kelahiran</label>
                                <input type="text" class="form-control" id="no_akta" name="no_akta" placeholder="Nomor Akta">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_anak">Nama Anak</label>
                                <input type="text" class="form-control" id="nama_anak" name="nama_anak" placeholder="Nama Anak">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_akta">Tanggal Kelahiran</label>
                                <input type="date" class="form-control" name="tanggal_akta" id="tanggal_akta">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" class="form-control" id="jk">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="">Pilih Status</option>
                                    <option value="Menunggu">Menunggu</option>
                                    <option value="Proses">Proses</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
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

<?php foreach ($data_akta as $akta) : ?>
    <div class="modal fade" id="modalUbah<?= $akta['id_akta']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Akta Kelahiran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_akta" value="<?= $akta['id_akta']; ?>">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $akta['nik']; ?>" placeholder="NIK">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="no_akta">Nomor Akta Kelahiran</label>
                                    <input type="text" class="form-control" id="no_akta" name="no_akta" value="<?= $akta['no_akta']; ?>" placeholder="Nomor Akta">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_anak">Nama Anak</label>
                                    <input type="text" class="form-control" id="nama_anak" name="nama_anak" value="<?= $akta['nama_anak']; ?>" placeholder="Nama Anak">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tanggal_akta">Tanggal Kelahiran</label>
                                    <input type="date" class="form-control" name="tanggal_akta" id="tanggal_akta" value="<?= $akta['tanggal_akta']; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_ayah">Nama Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= $akta['nama_ayah']; ?>" placeholder="Nama Ayah">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= $akta['nama_ibu']; ?>" placeholder="Nama Ibu">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="jk">Jenis Kelamin</label>
                                    <select name="jk" class="form-control" id="jk">
                                        <?php $jk = $akta['jk']; ?>
                                        <option value="Laki-Laki" <?= $jk == 'Laki-Laki' ? 'selected' : null ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $akta['alamat']; ?>" placeholder="Alamat">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <?php $status = $akta['status']; ?>
                                        <option value="Menunggu" <?= $status == 'Menunggu' ? 'selected' : null ?>>Menunggu</option>
                                        <option value="Proses" <?= $status == 'Proses' ? 'selected' : null ?>>Proses</option>
                                        <option value="Selesai" <?= $status == 'Selesai' ? 'selected' : null ?>>Selesai</option>
                                    </select>
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

<?php foreach ($data_akta as $akta) : ?>
    <div class="modal fade" id="modalHapus<?= $akta['id_akta']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Akta Kelahiran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="card-body">
                            <p>Yakin Ingin Menghapus Data Dengan Nama Jenazah Dengan Nama - <?= $akta['nama_anak']; ?> ?</p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <a href="hapus-akta.php?id_akta=<?= $akta['id_akta']; ?>" class="btn btn-danger">Hapus</a>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal View -->

<?php foreach ($data_akta as $akta) : ?>
    <div class="modal fade" id="modalView<?= $akta['id_akta']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">View Data Akta Kelahiran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_akta" value="<?= $akta['id_akta']; ?>">
                        <div class="card-body table-responsive" style="margin: auto;">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="padding-left:10%;">NIK</th>
                                        <th>: <?= $akta['nik']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Nomor Akta Kelahiran</th>
                                        <th>: <?= $akta['no_akta']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Nama Anak</th>
                                        <th>: <?= $akta['nama_anak']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Tanggal Kelahiran</th>
                                        <th>: <?= $akta['tanggal_akta']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Nama Ayah</th>
                                        <th>: <?= $akta['nama_ayah']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Nama Ibu</th>
                                        <th>: <?= $akta['nama_ibu']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Jenis Kelamin</th>
                                        <th>: <?= $akta['jk']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Alamat</th>
                                        <th>: <?= $akta['alamat']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Status</th>
                                        <th>: <?= $akta['status']; ?></th>
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