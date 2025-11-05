<?php
/* konfigurasi database */
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'carWash';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die('Koneksi ke database gagal');
}

/* set charset */
mysqli_set_charset($conn, 'utf8');

/* set timezone */
date_default_timezone_set('Asia/Jakarta');
?>
