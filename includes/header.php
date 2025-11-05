<?php
/* header template sederhana */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistem Antrian Cuci Mobil</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
<header>
    <h1>Sistem Antrian Cuci Mobil</h1>
    <nav>
        <a href="<?php echo BASE_URL; ?>/index.php">Beranda</a>
        <a href="<?php echo BASE_URL; ?>/master/service_list.php">Master Layanan</a>
        <a href="<?php echo BASE_URL; ?>/master/customer_list.php">Master Pelanggan</a>
        <a href="<?php echo BASE_URL; ?>/transaction/queue_form.php">Input Antrian (Admin)</a>
        <a href="<?php echo BASE_URL; ?>/transaction/input_antrian.php">Input Antrian (Publik)</a>
        <a href="<?php echo BASE_URL; ?>/transaction/queue_report.php">Laporan Antrian</a>
        
        <?php // TAMBAHKAN BLOK INI
        if (isset($_SESSION['user_id'])) {
            echo '<a href="'.BASE_URL.'/logout.php" style="float:right; color: #ffcccc;">Logout</a>';
        }
        ?>
    </nav>
</header>
<main>