<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

$customer_id   = isset($_POST['customer_id']) ? (int)$_POST['customer_id'] : 0;
$customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
$phone         = mysqli_real_escape_string($conn, $_POST['phone']);

if ($customer_id > 0) {
    $sql = "UPDATE m_customer
            SET customer_name='$customer_name',
                phone='$phone'
            WHERE customer_id=$customer_id";
} else {
    $sql = "INSERT INTO m_customer(customer_name, phone)
            VALUES('$customer_name', '$phone')";
}

mysqli_query($conn, $sql);

header('Location: customer_list.php');
exit;
?>
