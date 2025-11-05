<?php
include '../config.php';
include '../includes/header.php';

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$sql = "SELECT q.queue_id,
               q.queue_number,
               q.queue_date,
               q.status,
               c.customer_name,
               s.service_name,
               s.price
        FROM t_queue q
        LEFT JOIN m_customer c ON q.customer_id = c.customer_id
        LEFT JOIN m_service s ON q.service_id = s.service_id
        WHERE q.queue_date = '$date'
        ORDER BY q.queue_number";

$result = mysqli_query($conn, $sql);

$total = 0;
?>
<h2>Laporan Antrian</h2>
<form method="get">
    <label>Tanggal</label>
    <input type="date" name="date" value="<?php echo $date; ?>">
    <button type="submit">Tampilkan</button>
</form>
<br>
<table border="1" cellpadding="5" cellspacing="0">
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
            <td><?php echo $row['queue_number']; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['service_name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="queue_delete.php?id=<?php echo $row['queue_id']; ?>" onclick="return confirm('Hapus antrian ini?')">Hapus</a>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="3"><strong>Total</strong></td>
        <td colspan="2"><strong><?php echo $total; ?></strong></td>
    </tr>
</table>
<?php
include '../includes/footer.php';
?>
