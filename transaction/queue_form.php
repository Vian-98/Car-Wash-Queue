<?php
include '../config.php';
include '../includes/header.php';

/* ambil pelanggan */
$customers = mysqli_query($conn, "SELECT * FROM m_customer ORDER BY customer_name");
/* ambil layanan */
$services  = mysqli_query($conn, "SELECT * FROM m_service ORDER BY service_name");

/* cari nomor antrian terakhir untuk hari ini */
$today = date('Y-m-d');
$q_last = mysqli_query($conn, "SELECT MAX(queue_number) AS last_no FROM t_queue WHERE queue_date='$today'");
$r_last = mysqli_fetch_assoc($q_last);
$next_no = $r_last['last_no'] ? $r_last['last_no'] + 1 : 1;
?>
<h2>Input Antrian</h2>
<form method="post" action="queue_save.php">
    <label>Tanggal</label><br>
    <input type="date" name="queue_date" value="<?php echo $today; ?>"><br>
    <label>Nomor Antrian</label><br>
    <input type="number" name="queue_number" value="<?php echo $next_no; ?>" readonly><br>
    <label>Pelanggan</label><br>
    <select name="customer_id">
        <option value="">- tanpa pelanggan -</option>
        <?php while ($c = mysqli_fetch_assoc($customers)) { ?>
            <option value="<?php echo $c['customer_id']; ?>"><?php echo $c['customer_name']; ?></option>
        <?php } ?>
    </select><br>
    <label>Layanan</label><br>
    <select name="service_id">
        <?php while ($s = mysqli_fetch_assoc($services)) { ?>
            <option value="<?php echo $s['service_id']; ?>"><?php echo $s['service_name']; ?></option>
        <?php } ?>
    </select><br><br>
    <button type="submit">Simpan</button>
</form>
<?php
include '../includes/footer.php';
?>
