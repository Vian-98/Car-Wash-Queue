<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

// 1. Ambil parameter dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$new_status = isset($_GET['status']) ? $_GET['status'] : '';
$date_redirect = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); // Untuk redirect

// 2. Validasi status
$allowed_statuses = ['in_service', 'done', 'cancelled'];

if ($id > 0 && in_array($new_status, $allowed_statuses)) {
    
    $safe_status = mysqli_real_escape_string($conn, $new_status);
    
    // 3. Tambahkan logika timestamp berdasarkan status
    $sql_time_part = "";
    if ($new_status == 'in_service') {
        // Setel waktu mulai saat status 'in_service'
        $sql_time_part = ", started_at = NOW()";
    } elseif ($new_status == 'done' || $new_status == 'cancelled') {
        // Setel waktu selesai saat status 'done' atau 'cancelled'
        $sql_time_part = ", finished_at = NOW()";
    }
    
    // 4. Update database
    $sql = "UPDATE t_queue 
            SET status = '$safe_status' $sql_time_part 
            WHERE queue_id = $id";
            
    mysqli_query($conn, $sql);
}

// 5. Kembalikan pengguna ke halaman laporan
header('Location: queue_report.php?date=' . $date_redirect);
exit;
?>