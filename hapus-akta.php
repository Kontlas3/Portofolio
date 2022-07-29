<?php

session_start();

include 'config/app.php';

// Menerima Id Kematian Yang Dipilih

$id_akta = (int)$_GET['id_akta'];

if (delete_akta($id_akta) > 0) {
    echo "<script>
        alert('Data Akta Kelahiran Berhasil Di Hapus');
        document.location.href = 'akta.php';
        </script>";
} else {
    echo "<script>
        alert('Data Akta Kelahiran Gagal Di Hapus');
        document.location.href = 'akta.php';
        </script>";
}
