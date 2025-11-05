<?php
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
        
        <a href="<?php echo BASE_URL; ?>/transaction/queue_add_form.php" style="color: #ffc;"><strong>+ Antrian Baru</strong></a>
        <a href="<?php echo BASE_URL; ?>/transaction/queue_report.php">Laporan Antrian</a>
        <a href="<?php echo BASE_URL; ?>/master/customer_list.php">Master Pelanggan</a>
        <a href="<?php echo BASE_URL; ?>/master/service_list.php">Master Layanan</a>
        
        <?php
        if (isset($_SESSION['user_id'])) {
            echo '<a href="'.BASE_URL.'/logout.php" style="float:right; color: #ffcccc;">Logout</a>';
        }
        ?>
    </nav>
</header>
<main>