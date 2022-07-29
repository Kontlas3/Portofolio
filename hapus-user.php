<?php

session_start();

include 'config/app.php';

// Menerima Id User Yang Dipilih

$id_user = (int)$_GET['id_user'];

if (delete_user($id_user) > 0) {
    echo "<script>
        alert('Data User Berhasil Di Hapus');
        document.location.href = 'user.php';
        </script>";
} else {
    echo "<script>
        alert('Data User Gagal Di Hapus');
        document.location.href = 'user.php';
        </script>";
}
