<?php

session_start();

include 'config/app.php';

// Menerima Id Pengeluaran Yang Dipilih

$id_pengeluaran = (int)$_GET['id_pengeluaran'];

if (delete_pengeluaran($id_pengeluaran) > 0) {
    echo "<script>
        alert('Data Pengeluaran Berhasil Di Hapus');
        document.location.href = 'pengeluaran.php';
        </script>";
} else {
    echo "<script>
        alert('Data Pengeluaran Gagal Di Hapus');
        document.location.href = 'pengeluaran.php';
        </script>";
}
