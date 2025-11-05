<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}
include '../includes/header.php';

$service_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

/* default data */
$data = [
    'service_code' => '',
    'service_name' => '',
    'duration_min' => '',
    'price' => ''
];

if ($service_id > 0) {
    $q = mysqli_query($conn, "SELECT * FROM m_service WHERE service_id=".$service_id);
    $data = mysqli_fetch_assoc($q);
}
?>
<h2><?php echo $service_id > 0 ? 'Edit' : 'Tambah'; ?> Layanan</h2>
<form method="post" action="service_save.php">
    <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
    <label>Kode Layanan</label><br>
    <input type="text" name="service_code" value="<?php echo htmlspecialchars($data['service_code']); ?>"><br>
    <label>Nama Layanan</label><br>
    <input type="text" name="service_name" value="<?php echo htmlspecialchars($data['service_name']); ?>"><br>
    <label>Durasi (menit)</label><br>
    <input type="number" name="duration_min" value="<?php echo htmlspecialchars($data['duration_min']); ?>"><br>
    <label>Harga</label><br>
    <input type="number" name="price" value="<?php echo htmlspecialchars($data['price']); ?>"><br><br>
    <button type="submit">Simpan</button>
</form>
<?php
include '../includes/footer.php';
?>
