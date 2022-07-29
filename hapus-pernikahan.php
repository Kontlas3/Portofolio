<?php

session_start();

include 'config/app.php';

// Menerima Id Pernikahan Yang Dipilih

$id_pernikahan = (int)$_GET['id_pernikahan'];

if (delete_pernikahan($id_pernikahan) > 0) {
    echo "<script>
        alert('Data Pernikahan Berhasil Di Hapus');
        document.location.href = 'pernikahan.php';
        </script>";
} else {
    echo "<script>
        alert('Data Pernikahan Gagal Di Hapus');
        document.location.href = 'pernikahan.php';
        </script>";
}
