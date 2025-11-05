<?php
include 'config.php'; // config.php sudah ada session_start() dari langkah #3

// PERINGATAN: Ini adalah sistem login yang SANGAT TIDAK AMAN untuk produksi.
// Gunakan password_hash() dan password_verify() untuk password asli.
// Ini hanya untuk contoh.
$admin_user = 'admin';
$admin_pass = 'admin123'; // Ganti password ini

if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
        // Login berhasil
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = $admin_user;
        header('Location: index.php');
        exit;
    }
}

// Login gagal
header('Location: login.php?error=1');
exit;
?>