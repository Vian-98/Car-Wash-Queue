<?php
include '../config.php';
include '../includes/header.php';

$today = date('Y-m-d');
$sql = "SELECT q.queue_number, q.plate_number, q.vehicle_type, s.service_name, q.status
        FROM t_queue q
        LEFT JOIN m_service s ON q.service_id = s.service_id
        WHERE q.queue_date = '$today'
        ORDER BY q.queue_number ASC";
$result = mysqli_query($conn, $sql);
?>
<h2>Daftar Antrian Hari Ini (<?php echo date('d-m-Y'); ?>)</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Plat</th>
        <th>Kendaraan</th>
        <th>Layanan</th>
        <th>Status</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['queue_number']; ?></td>
        <td><?php echo strtoupper($row['plate_number']); ?></td>
        <td><?php echo $row['vehicle_type']; ?></td>
        <td><?php echo $row['service_name']; ?></td>
        <td><?php echo strtoupper($row['status']); ?></td>
    </tr>
    <?php } ?>
</table>
<?php
include '../includes/footer.php';
?>
