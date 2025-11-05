<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}
include '../includes/header.php';

/* ambil layanan */
$services  = mysqli_query($conn, "SELECT * FROM m_service ORDER BY service_name");

/* cari nomor antrian terakhir untuk hari ini */
$today = date('Y-m-d');
$q_last = mysqli_query($conn, "SELECT MAX(queue_number) AS last_no FROM t_queue WHERE queue_date='$today'");
$r_last = mysqli_fetch_assoc($q_last);
$next_no = $r_last['last_no'] ? $r_last['last_no'] + 1 : 1;
?>
<h2>Input Antrian Baru (Admin)</h2>
<p>Formulir ini akan otomatis mencari pelanggan berdasarkan Plat. Jika tidak ada, pelanggan baru akan dibuat.</p>

<form method="post" action="queue_add_save.php">
    <input type="hidden" name="queue_date" value="<?php echo $today; ?>">
    <input type="hidden" name="queue_number" value="<?php echo $next_no; ?>">
    <p>Nomor Antrian Berikutnya: <strong><?php echo $next_no; ?></strong></p>

    <label>Plat Kendaraan (Wajib)</label><br>
    <input type="text" name="plate_number" required style="text-transform: uppercase;"><br>
    
    <label>Nama Pelanggan</label><br>
    <input type="text" name="customer_name" required><br>
    
    <label>No. Telepon</label><br>
    <input type="text" name="phone"><br>
    
    <label>Jenis Kendaraan</label><br>
    <input type="text" name="vehicle_type" placeholder="misal: Sedan, SUV"><br><br>

    <label>Layanan</label><br>
    <select name="service_id" required>
        <option value="">-- Pilih Layanan --</option>
        <?php while ($s = mysqli_fetch_assoc($services)) { ?>
            <option value="<?php echo $s['service_id']; ?>"><?php echo htmlspecialchars($s['service_name']); ?></option>
        <?php } ?>
    </select><br><br>
    
    <button type="submit">Simpan Antrian</button>
</form>
<?php
include '../includes/footer.php';
?>