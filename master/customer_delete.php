<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    /* Cek apakah customer_id sedang dipakai di t_queue */
    $cek = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM t_queue WHERE customer_id = $id");
    $r = mysqli_fetch_assoc($cek);

    if ($r['jml'] > 0) {
        /* Tampilkan pesan kalau sedang dipakai */
        include '../includes/header.php'; // Butuh header/footer untuk pesan error
        echo "<h2 style='color:red'>Data tidak bisa dihapus</h2>";
        echo "<p>Pelanggan ini masih digunakan dalam <strong>{$r['jml']}</strong> transaksi antrian.</p>";
        echo "<a href='customer_list.php'>Kembali ke Daftar Pelanggan</a>";
        include '../includes/footer.php';
    } else {
        /* Aman untuk dihapus */
        mysqli_query($conn, "DELETE FROM m_customer WHERE customer_id=$id");
        header('Location: customer_list.php');
        exit;
    }
} else {
    header('Location: customer_list.php');
    exit;
}
?>