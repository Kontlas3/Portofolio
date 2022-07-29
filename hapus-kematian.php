<?php

session_start();

include 'config/app.php';

// Menerima Id Kematian Yang Dipilih

$id_kematian = (int)$_GET['id_kematian'];

if (delete_kematian($id_kematian) > 0) {
    echo "<script>
        alert('Data Kematian Berhasil Di Hapus');
        document.location.href = 'kematian.php';
        </script>";
} else {
    echo "<script>
        alert('Data Kematian Gagal Di Hapus');
        document.location.href = 'kematian.php';
        </script>";
}
