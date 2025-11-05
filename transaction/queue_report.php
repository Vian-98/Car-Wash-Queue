<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}
include '../includes/header.php';

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$safe_date = mysqli_real_escape_string($conn, $date);

$sql = "SELECT 
               q.queue_id,
               q.queue_number,
               q.status,
               c.customer_name,
               c.plate_number,
               s.service_name,
               s.price
        FROM t_queue q
        JOIN m_customer c ON q.customer_id = c.customer_id
        JOIN m_service s ON q.service_id = s.service_id
        WHERE q.queue_date = '$safe_date'
        ORDER BY q.queue_number";

$result = mysqli_query($conn, $sql);
$total = 0;
?>
<h2>Laporan Antrian</h2>
<form method="get">
    <label>Tanggal</label>
    <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>">
    <button type="submit">Tampilkan</button>
</form>
<br>
<table class="data-table">
    <tr>
        <th>No</th>
        <th>Pelanggan</th>
        <th>Plat</th>
        <th>Layanan</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi Status</th> <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <?php $total += (int)$row['price']; ?>
        <tr>
            <td><?php echo htmlspecialchars($row['queue_number']); ?></td>
            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
            <td><?php echo htmlspecialchars($row['plate_number']); ?></td>
            <td><?php echo htmlspecialchars($row['service_name']); ?></td>
            <td><?php echo htmlspecialchars($row['price']); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            
            <td>
                <?php
                $current_status = $row['status'];
                $queue_id = $row['queue_id'];
                
                // Tampilkan tombol berdasarkan status saat ini
                if ($current_status == 'waiting') {
                    echo "<a class='btn-aksi btn-start' href='queue_update_status.php?id=$queue_id&status=in_service&date=$date'>Mulai</a>";
                    echo "<a class='btn-aksi btn-cancel' href='queue_update_status.php?id=$queue_id&status=cancelled&date=$date'>Batal</a>";
                } elseif ($current_status == 'in_service') {
                    echo "<a class='btn-aksi btn-done' href='queue_update_status.php?id=$queue_id&status=done&date=$date'>Selesai</a>";
                    echo "<a class='btn-aksi btn-cancel' href='queue_update_status.php?id=$queue_id&status=cancelled&date=$date'>Batal</a>";
                } else {
                    // Jika status 'done' atau 'cancelled', tidak ada aksi
                    echo "-";
                }
                ?>
            </td>

            <td>
                <a href="queue_delete.php?id=<?php echo $row['queue_id']; ?>" onclick="return confirm('Hapus antrian ini?')">Hapus</a>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="5"><strong>Total</strong></td>
        <td><strong><?php echo htmlspecialchars($total); ?></strong></td>
        <td colspan="2"></td> </tr>
</table>
<?php
include '../includes/footer.php';
?>