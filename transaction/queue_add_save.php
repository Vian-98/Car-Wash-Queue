<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

/* 1. Ambil Semua Data dari Form */
$plate_number  = mysqli_real_escape_string($conn, strtoupper($_POST['plate_number']));
$customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
$phone         = mysqli_real_escape_string($conn, $_POST['phone']);
$vehicle_type  = mysqli_real_escape_string($conn, $_POST['vehicle_type']);
$service_id    = (int)$_POST['service_id'];
$queue_date    = mysqli_real_escape_string($conn, $_POST['queue_date']);
$queue_number  = (int)$_POST['queue_number'];

$customer_id = 0;

/* 2. Cek Pelanggan di m_customer berdasarkan Plat Nomor */
if (!empty($plate_number)) {
    $sql_cek = "SELECT customer_id FROM m_customer WHERE plate_number = '$plate_number'";
    $res_cek = mysqli_query($conn, $sql_cek);

    if (mysqli_num_rows($res_cek) > 0) {
        $data_cust = mysqli_fetch_assoc($res_cek);
        $customer_id = $data_cust['customer_id'];
        
        // Update data pelanggan jika ada perubahan
        $sql_update_cust = "UPDATE m_customer SET 
                                customer_name = '$customer_name', 
                                phone = '$phone', 
                                vehicle_type = '$vehicle_type' 
                            WHERE customer_id = $customer_id";
        mysqli_query($conn, $sql_update_cust);

    } else {
        // Pelanggan BARU, buat data baru di m_customer
        $sql_new_cust = "INSERT INTO m_customer (customer_name, phone, plate_number, vehicle_type) 
                         VALUES ('$customer_name', '$phone', '$plate_number', '$vehicle_type')";
        mysqli_query($conn, $sql_new_cust);
        $customer_id = mysqli_insert_id($conn);
    }
}

/* 3. Simpan Antrian ke t_queue */
if ($customer_id > 0 && $service_id > 0) {
    $sql_queue = "INSERT INTO t_queue (queue_date, queue_number, customer_id, service_id, status) 
                  VALUES ('$queue_date', $queue_number, $customer_id, $service_id, 'waiting')";
    mysqli_query($conn, $sql_queue);
}

/* 4. Arahkan ke Laporan */
header('Location: queue_report.php?date=' . $queue_date);
exit;
?>