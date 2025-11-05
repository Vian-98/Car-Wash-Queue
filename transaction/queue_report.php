<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}
include '../includes/header.php';

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$safe_date = mysqli_real_escape_string($conn, $date);

$sql = "SELECT q.queue_id,
               q.queue_number,
               q.queue_date,
               q.status,
               COALESCE(c.customer_name, q.customer_name) AS customer_name_final, 
               s.service_name,
               s.price
        FROM t_queue q
        LEFT JOIN m_customer c ON q.customer_id = c.customer_id
        LEFT JOIN m_service s ON q.service_id = s.service_id
        WHERE q.queue_date = '$safe_date'
        ORDER BY q.queue_number";

$result = mysqli_query($conn, $sql);

$total = 0;
?>
<h2>Laporan Antrian</h2>
<form method="get">
    <label>Tanggal</label>
    <input type="date" name="date" value="<?php echo htmlspecialchars($date); // 3. PERBAIKAN XSS ?>">
    <button type="submit">Tampilkan</button>
</form>
<br>
<table class="data-table">
    <tr>
        <th>No</th>
        <th>Pelanggan</th>
        <th>Layanan</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <?php $total += (int)$row['price']; ?>
        <tr>
            <td><?php echo htmlspecialchars($row['queue_number']); ?></td>
            <td><?php echo htmlspecialchars($row['customer_name_final'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['service_name']); ?></td>
            <td><?php echo htmlspecialchars($row['price']); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td>
                <a href="queue_delete.php?id=<?php echo $row['queue_id']; ?>" onclick="return confirm('Hapus antrian ini?')">Hapus</a>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="3"><strong>Total</strong></td>
        <td colspan="2"><strong><?php echo htmlspecialchars($total); ?></strong></td>
    </tr>
</table>
<?php
include '../includes/footer.php';
?>