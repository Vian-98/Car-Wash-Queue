<?php
include '../config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    mysqli_query($conn, "DELETE FROM m_customer WHERE customer_id=$id");
}

header('Location: customer_list.php');
exit;
?>
