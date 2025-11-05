<?php
include '../config.php';
include '../includes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    /* cek apakah service_id sedang dipakai di t_queue */
    $cek = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM t_queue WHERE service_id = $id");
    $r = mysqli_fetch_assoc($cek);

    if ($r['jml'] > 0) {
        /* tampilkan pesan kalau sedang dipakai */
        echo "<h2 style='color:red'>Data tidak bisa dihapus</h2>";
        echo "<p>Layanan ini masih digunakan dalam <strong>{$r['jml']}</strong> transaksi antrian.</p>";
        echo "<a href='service_list.php'>Kembali ke Daftar Layanan</a>";
    } else {
        /* aman untuk dihapus */
        mysqli_query($conn, "DELETE FROM m_service WHERE service_id=$id");
        echo "<h2>Data layanan berhasil dihapus.</h2>";
        echo "<a href='service_list.php'>Kembali ke Daftar Layanan</a>";
    }
} else {
    header('Location: service_list.php');
    exit;
}

include '../includes/footer.php';
?>
