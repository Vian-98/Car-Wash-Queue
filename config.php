<?php
session_start(); // TAMBAHKAN INI

/* Definisikan BASE_URL agar path link Anda konsisten.
  Sesuaikan '/carwash_queue' jika path Anda berbeda.
*/
define('BASE_URL', '/carwash_queue'); // TAMBAHKAN INI

/* konfigurasi database */
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'carWash';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die('Koneksi ke database gagal');
}
