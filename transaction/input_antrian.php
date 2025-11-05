<?php
include '../config.php';
include '../includes/header.php';

/* ambil layanan dari master */
$services = mysqli_query($conn, "SELECT * FROM m_service ORDER BY service_name");

/* nomor antrian otomatis */
$today = date('Y-m-d');
$q_last = mysqli_query($conn, "SELECT MAX(queue_number) AS last_no FROM t_queue WHERE queue_date='$today'");
$r_last = mysqli_fetch_assoc($q_last);
$next_no = $r_last['last_no'] ? $r_last['last_no'] + 1 : 1;
?>
<h2>Input Antrian Baru</h2>
<form method="post" action="save_antrian.php">
    <label>Nama Pelanggan</label><br>
    <input type="text" name="customer_name" required><br>

    <label>Plat Kendaraan</label><br>
    <input type="text" name="plate_number" required><br>

    <label>Jenis Kendaraan</label><br>
    <input type="text" name="vehicle_type" placeholder="misal: Mobil Sedan" required><br>

    <label>Layanan</label><br>
    <select name="service_id" required>
        <option value="">-- Pilih Layanan --</option>
        <?php while ($s = mysqli_fetch_assoc($services)) { ?>
            <option value="<?php echo $s['service_id']; ?>"><?php echo $s['service_name']; ?></option>
        <?php } ?>
    </select><br><br>

    <input type="hidden" name="queue_date" value="<?php echo $today; ?>">
    <input type="hidden" name="queue_number" value="<?php echo $next_no; ?>">

    <button type="submit">Simpan Antrian</button>
</form>
<?php
include '../includes/footer.php';
?>
