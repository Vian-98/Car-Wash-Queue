<?php
include '../config.php';
include '../includes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    /* cek apakah data ada */
    $cek = mysqli_query($conn, "SELECT * FROM t_queue WHERE queue_id = $id");
    if (mysqli_num_rows($cek) > 0) {
        /* hapus data antrian */
        mysqli_query($conn, "DELETE FROM t_queue WHERE queue_id = $id");
        echo "<h2>Data antrian berhasil dihapus.</h2>";
    } else {
        echo "<h2 style='color:red'>Data antrian tidak ditemukan.</h2>";
    }
    echo "<a href='queue_report.php'>Kembali ke Laporan</a>";
} else {
    header('Location: queue_report.php');
    exit;
}

include '../includes/footer.php';
?>
