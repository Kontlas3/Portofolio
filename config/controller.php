<?php


// Fungsi Menampilkan Data

function select($query)
{
    // panggil koneksi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Fungsi Tambah Data Akta

function create_akta($post)
{
    global $db;

    $nik            = $post['nik'];
    $no_akta        = $post['no_akta'];
    $nama_anak      = $post['nama_anak'];
    $tanggal_akta   = $post['tanggal_akta'];
    $nama_ayah      = $post['nama_ayah'];
    $nama_ibu       = $post['nama_ibu'];
    $jk             = $post['jk'];
    $alamat         = $post['alamat'];
    $status         = $post['status'];

    // Query Tambah Data Akta

    $query = "INSERT INTO akta VALUES(null, '$nik', '$no_akta', '$nama_anak', '$tanggal_akta', '$nama_ayah', '$nama_ibu', '$jk', '$alamat', '$status')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Ubah Data Akta

function update_akta($post)
{
    global $db;

    $id_akta        = $post['id_akta'];
    $nik            = $post['nik'];
    $no_akta        = $post['no_akta'];
    $nama_anak      = $post['nama_anak'];
    $tanggal_akta   = $post['tanggal_akta'];
    $nama_ayah      = $post['nama_ayah'];
    $nama_ibu       = $post['nama_ibu'];
    $jk             = $post['jk'];
    $alamat         = $post['alamat'];
    $status         = $post['status'];

    // Query Update Data Akta

    $query = "UPDATE akta SET nik = '$nik', no_akta = '$no_akta', nama_anak = '$nama_anak', tanggal_akta = '$tanggal_akta', nama_ayah = '$nama_ayah', nama_ibu = '$nama_ibu', jk = '$jk', alamat = '$alamat', status = '$status' WHERE id_akta = $id_akta ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Hapus Data Akta

function delete_akta($id_akta)
{
    global $db;

    // Query Hapus Data Akta

    $query = "DELETE FROM akta WHERE id_akta = $id_akta";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Tambah Data Pernikahan

function create_pernikahan($post)
{
    global $db;

    $no_pernikahan          = $post['no_pernikahan'];
    $nama_pria              = $post['nama_pria'];
    $nama_wanita            = $post['nama_wanita'];
    $tanggal_pernikahan     = $post['tanggal_pernikahan'];
    $tempat_pernikahan      = $post['tempat_pernikahan'];
    $nama_walip             = $post['nama_walip'];
    $nama_waliw             = $post['nama_waliw'];
    $penghulu               = $post['penghulu'];
    $keterangan             = $post['keterangan'];

    // Query Tambah Data Akta

    $query = "INSERT INTO pernikahan VALUES(null, '$no_pernikahan', '$nama_pria', '$nama_wanita', '$tanggal_pernikahan', '$tempat_pernikahan', '$nama_walip', '$nama_waliw', '$penghulu', '$keterangan')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Hapus Data Pernikahan

function delete_pernikahan($id_pernikahan)
{
    global $db;

    // Query Hapus Data pernikahan

    $query = "DELETE FROM pernikahan WHERE id_pernikahan = $id_pernikahan";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Ubah Data Pernikahan

function update_pernikahan($post)
{
    global $db;

    $id_pernikahan        = $post['id_pernikahan'];
    $no_pernikahan            = $post['no_pernikahan'];
    $nama_pria        = $post['nama_pria'];
    $nama_wanita      = $post['nama_wanita'];
    $tanggal_pernikahan   = $post['tanggal_pernikahan'];
    $tempat_pernikahan      = $post['tempat_pernikahan'];
    $nama_walip       = $post['nama_walip'];
    $nama_waliw             = $post['nama_waliw'];
    $penghulu         = $post['penghulu'];
    $keterangan     = $post['keterangan'];

    // Query Update Data Akta

    $query = "UPDATE pernikahan SET no_pernikahan = '$no_pernikahan', nama_pria = '$nama_pria', nama_wanita = '$nama_wanita', tanggal_pernikahan = '$tanggal_pernikahan', tempat_pernikahan = '$tempat_pernikahan', nama_walip = '$nama_walip', nama_waliw = '$nama_waliw', penghulu = '$penghulu', keterangan = '$keterangan' WHERE id_pernikahan = $id_pernikahan ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Tambah Data User

function create_user($post)
{
    global $db;

    $nama_user  = $post['nama_user'];
    $username   = $post['username'];
    $email      = $post['email'];
    $password   = $post['password'];
    $level      = $post['level'];

    // Encrype Password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Query Tambah Data Akta

    $query = "INSERT INTO user VALUES(null, '$nama_user', '$username', '$email', '$password', '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Hapus Data user

function delete_user($id_user)
{
    global $db;

    // Query Hapus Data user

    $query = "DELETE FROM user WHERE id_user = $id_user";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Ubah Data user

function update_user($post)
{
    global $db;

    $id_user    = $post['id_user'];
    $nama_user  = $post['nama_user'];
    $username   = $post['username'];
    $email      = $post['email'];
    $password   = $post['password'];
    $level      = $post['level'];

    // Encrype Password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Query Update Data User

    $query = "UPDATE user SET nama_user = '$nama_user', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_user = $id_user ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Tambah Data kematian

function create_kematian($post)
{
    global $db;

    $surat_kematian     = $post['surat_kematian'];
    $nama_jenazah       = $post['nama_jenazah'];
    $surat_pernyataan   = $post['surat_pernyataan'];
    $tanggal_kematian   = $post['tanggal_kematian'];
    $alamat             = $post['alamat'];

    // Query Tambah Data Akta

    $query = "INSERT INTO kematian VALUES(null, '$surat_kematian', '$nama_jenazah', '$surat_pernyataan', '$tanggal_kematian', '$alamat')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Ubah Data kematian

function update_kematian($post)
{
    global $db;

    $id_kematian        = $post['id_kematian'];
    $surat_kematian     = $post['surat_kematian'];
    $nama_jenazah       = $post['nama_jenazah'];
    $surat_pernyataan   = $post['surat_pernyataan'];
    $tanggal_kematian   = $post['tanggal_kematian'];
    $alamat             = $post['alamat'];

    // Query Update Data kematian

    $query = "UPDATE kematian SET surat_kematian = '$surat_kematian', nama_jenazah = '$nama_jenazah', surat_pernyataan = '$surat_pernyataan', tanggal_kematian = '$tanggal_kematian', alamat = '$alamat' WHERE id_kematian = $id_kematian ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Hapus Data Kematian

function delete_kematian($id_kematian)
{
    global $db;

    // Query Hapus Data Kematian

    $query = "DELETE FROM kematian WHERE id_kematian = $id_kematian";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Tambah Data Pengeluaran

function create_pengeluaran($post)
{
    global $db;

    $tanggal_pengeluaran   = $post['tanggal_pengeluaran'];
    $jenis_pengeluaran      = $post['jenis_pengeluaran'];
    $jumlah_pengeluaran       = $post['jumlah_pengeluaran'];

    // Query Tambah Data pengeluaran

    $query = "INSERT INTO pengeluaran VALUES(null, '$tanggal_pengeluaran', '$jenis_pengeluaran', '$jumlah_pengeluaran')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Ubah Data Pengeluaran

function update_pengeluaran($post)
{
    global $db;

    $id_pengeluaran    = $post['id_pengeluaran'];
    $tanggal_pengeluaran  = $post['tanggal_pengeluaran'];
    $jenis_pengeluaran   = $post['jenis_pengeluaran'];
    $jumlah_pengeluaran      = $post['jumlah_pengeluaran'];

    // Query Update Data pengeluaran

    $query = "UPDATE pengeluaran SET tanggal_pengeluaran = '$tanggal_pengeluaran', jenis_pengeluaran = '$jenis_pengeluaran', jumlah_pengeluaran = '$jumlah_pengeluaran' WHERE id_pengeluaran = $id_pengeluaran ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Hapus Data Pengeluaran

function delete_pengeluaran($id_pengeluaran)
{
    global $db;

    // Query Hapus Data pengeluaran

    $query = "DELETE FROM pengeluaran WHERE id_pengeluaran = $id_pengeluaran";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
