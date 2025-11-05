<?php
include '../config.php';
include '../includes/header.php'; // header.php akan otomatis menampilkan menu publik

$today = date('Y-m-d');
$safe_today = mysqli_real_escape_string($conn, $today);

$sql = "SELECT 
               q.queue_number,
               q.status,
               c.plate_number,
               s.service_name
        FROM t_queue q
        JOIN m_customer c ON q.customer_id = c.customer_id
        JOIN m_service s ON q.service_id = s.service_id
        WHERE q.queue_date = '$safe_today'
        AND q.status IN ('waiting', 'in_service')
        ORDER BY q.queue_number ASC";

$result = mysqli_query($conn, $sql);
?>
<h2>Dashboard Antrian Publik (<?php echo date('d-m-Y'); ?>)</h2>
<p>Monitor status antrian Anda di sini.</p>

<table class="data-table">
    <thead>
        <tr>
            <th>No. Antrian</th>
            <th>Plat Kendaraan</th>
            <th>Layanan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><strong><?php echo htmlspecialchars($row['queue_number']); ?></strong></td>
                <td><?php echo htmlspecialchars($row['plate_number']); ?></td>
                <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                <td><strong><?php echo strtoupper(htmlspecialchars($row['status'])); ?></strong></td>
            </tr>
        <?php } ?>
        <?php if (mysqli_num_rows($result) == 0) { ?>
            <tr>
                <td colspan="4" style="text-align: center;">Belum ada antrian aktif saat ini.</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php
include '../includes/footer.php';
?>