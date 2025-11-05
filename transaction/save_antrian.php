<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

$customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
$plate_number  = mysqli_real_escape_string($conn, $_POST['plate_number']);
$vehicle_type  = mysqli_real_escape_string($conn, $_POST['vehicle_type']);
$service_id    = (int)$_POST['service_id'];
$queue_date    = mysqli_real_escape_string($conn, $_POST['queue_date']); // Amankan juga
$queue_number  = (int)$_POST['queue_number'];

/* PERBAIKAN BUG: Tambahkan $customer_name ke query */
$sql = "INSERT INTO t_queue(queue_date, queue_number, service_id, status, created_at, plate_number, vehicle_type, customer_name)
        VALUES('$queue_date', $queue_number, $service_id, 'waiting', NOW(), '$plate_number', '$vehicle_type', '$customer_name')";

mysqli_query($conn, $sql);

echo "<h2>Data Antrian Berhasil Disimpan!</h2>";
echo "<p>Nomor Antrian Anda: <strong>$queue_number</strong></p>";
echo "<a href='input_antrian.php'>Input Lagi</a> | <a href='view_antrian.php'>Lihat Daftar Antrian</a>";
?>