<?php
include '../config.php';

$service_id   = isset($_POST['service_id']) ? (int)$_POST['service_id'] : 0;
$service_code = mysqli_real_escape_string($conn, $_POST['service_code']);
$service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
$duration_min = (int)$_POST['duration_min'];
$price        = (int)$_POST['price'];

if ($service_id > 0) {
    $sql = "UPDATE m_service
            SET service_code='$service_code',
                service_name='$service_name',
                duration_min=$duration_min,
                price=$price
            WHERE service_id=$service_id";
} else {
    $sql = "INSERT INTO m_service(service_code, service_name, duration_min, price)
            VALUES('$service_code', '$service_name', $duration_min, $price)";
}

mysqli_query($conn, $sql);

header('Location: service_list.php');
exit;
?>
