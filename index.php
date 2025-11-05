<?php
include 'config.php';
include 'includes/header.php';

/* hitung antrian hari ini */
$today = date('Y-m-d');
$q = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM t_queue WHERE queue_date='$today'");
$r = mysqli_fetch_assoc($q);
?>
<h2>Beranda</h2>
<p>Selamat datang di sistem antrian cuci mobil.</p>
<p>Jumlah antrian hari ini: <strong><?php echo $r['jml']; ?></strong></p>
<?php
include 'includes/footer.php';
?>
