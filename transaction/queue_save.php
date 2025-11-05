<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

$queue_date   = mysqli_real_escape_string($conn, $_POST['queue_date']);
$queue_number = (int)$_POST['queue_number'];
$customer_id  = isset($_POST['customer_id']) && $_POST['customer_id'] !== '' ? (int)$_POST['customer_id'] : 'NULL';
$service_id   = (int)$_POST['service_id'];

$sql = "INSERT INTO t_queue(queue_date, queue_number, customer_id, service_id)
        VALUES('$queue_date', $queue_number, $customer_id, $service_id)";

mysqli_query($conn, $sql);

header('Location: queue_report.php?date='.$queue_date);
exit;
?>
