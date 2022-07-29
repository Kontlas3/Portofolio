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

$title = 'Data User';

include "layout/header.php";
include "config/app.php";

// Tampil Seluruh Data User
$data_user = select("SELECT * FROM user");

// Tampil Data Berdasarkan User Login
$id_user = $_SESSION['id_user'];
$data_bylogin = select("SELECT * FROM user WHERE id_user = $id_user");

// Tambah Data user
if (isset($_POST['tambah'])) {
    if (create_user($_POST) > 0) {
        echo "<script>
        alert('Data User Berhasil Di Tambah');
        document.location.href = 'user.php';
        </script>";
    } else {
        echo "<script>
        alert('Data User Gagal Di Tambah');
        document.location.href = 'user.php';
        </script>";
    }
}

// Ubah Data User
if (isset($_POST['Ubah'])) {
    if (update_user($_POST) > 0) {
        echo "<script>
        alert('Data User Berhasil Diubah');
        document.location.href = 'user.php';
        </script>";
    } else {
        echo "<script>
        alert('Data User Gagal Diubah');
        document.location.href = 'user.php';
        </script>";
    }
}

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Data User</div>
            </div>
        </div>

        <div class="section-body">
            <div class="section-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Data User</h4>
                        <div class="card-header-action">
                        </div>
                        <?php if ($_SESSION['level'] == 1) : ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                <i class="fas fa-plus"></i> Tambah Data
                            </button>
                        <?php endif; ?>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <!-- Tampil Seluruh Data -->
                                <?php if ($_SESSION['level'] == 1) : ?>
                                    <?php foreach ($data_user as $user) : ?>
                                        <tr>
                                            <td><?= $no++ . '.'; ?></td>
                                            <td><?= $user['nama_user']; ?></td>
                                            <td><?= $user['username']; ?></td>
                                            <td>***********</td>
                                            <td><?= $user['email']; ?></td>
                                            <td><?= $user['level']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalView<?= $user['id_user']; ?>"><i class="fas fa-eye"></i></button>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalUbah<?= $user['id_user']; ?>"><i class="fas fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus<?= $user['id_user']; ?>"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <!-- Tampil Data Berdasarkan User Login -->
                                    <?php foreach ($data_bylogin as $user) : ?>
                                        <tr>
                                            <td><?= $no++ . '.'; ?></td>
                                            <td><?= $user['nama_user']; ?></td>
                                            <td><?= $user['username']; ?></td>
                                            <td>***********</td>
                                            <td><?= $user['email']; ?></td>
                                            <td><?= $user['level']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalView<?= $user['id_user']; ?>"><i class="fas fa-eye"></i></button>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalUbah<?= $user['id_user']; ?>"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_user">Nama User</label>
                                <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Nama User">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class=" form-row">
                            <div class="form-group col-md-12">
                                <label for="level">Level</label>
                                <select name="level" class="form-control" id="level">
                                    <option value="">Pilih Level</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Operator</option>
                                    <option value="3">Pengguna</option>
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

<?php foreach ($data_user as $user) : ?>
    <div class="modal fade" id="modalUbah<?= $user['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_user">Nama User</label>
                                    <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?= $user['nama_user'] ?>" placeholder="Nama User">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password </label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password New/Old ">
                                </div>
                            </div>
                            <?php if ($_SESSION['level'] == 1) : ?>
                                <div class=" form-row">
                                    <div class="form-group col-md-12">
                                        <label for="level">Level</label>
                                        <select name="level" class="form-control" id="level">
                                            <?php $level = $user['level']; ?>
                                            <option value="1" <?= $level == '1' ? 'selected' : null ?>>Admin</option>
                                            <option value="2" <?= $level == '2' ? 'selected' : null ?>>Operator</option>
                                            <option value="3" <?= $level == '3' ? 'selected' : null ?>>Pengguna</option>
                                        </select>
                                    </div>
                                </div>
                            <?php else : ?>
                                <input type="hidden" name="level" value="<?= $user['level'] ?>">
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                            <button type="submit" name="Ubah" class="btn btn-success">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus -->

<?php foreach ($data_user as $user) : ?>
    <div class="modal fade" id="modalHapus<?= $user['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="card-body">
                            <p>Yakin Ingin Menghapus Username <?= $user['username']; ?> ?</p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <a href="hapus-user.php?id_user=<?= $user['id_user']; ?>" class="btn btn-danger">Hapus</a>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal View -->

<?php foreach ($data_user as $user) : ?>
    <div class="modal fade" id="modalView<?= $user['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">View User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">

                        <div class="card-body table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="padding-left:10%;">Nama User</th>
                                        <th>: <?= $user['nama_user']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Username</th>
                                        <th>: <?= $user['username']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Email</th>
                                        <th>: <?= $user['email']; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Password</th>
                                        <th>: ***********</th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:10%;">Level</th>
                                        <th>: <?= $user['level']; ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php

include "layout/footer.php";

?>