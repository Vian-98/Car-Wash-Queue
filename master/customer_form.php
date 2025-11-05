<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}
include '../includes/header.php';

$customer_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$data = [
    'customer_name' => '',
    'phone' => '',
    'plate_number' => '',
    'vehicle_type' => '' 
];

if ($customer_id > 0) {
    $q = mysqli_query($conn, "SELECT * FROM m_customer WHERE customer_id=".$customer_id);
    $data = mysqli_fetch_assoc($q);
}
?>
<h2><?php echo $customer_id > 0 ? 'Edit' : 'Tambah'; ?> Pelanggan</h2>
<form method="post" action="customer_save.php">
    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
    <label>Nama Pelanggan</label><br>
    <input type="text" name="customer_name" value="<?php echo htmlspecialchars($data['customer_name']); ?>"><br>
    <label>No. Telepon</label><br>
    <input type="text" name="phone" value="<?php echo htmlspecialchars($data['phone']); ?>"><br>
    
    <label>Plat Kendaraan</label><br>
    <input type="text" name="plate_number" value="<?php echo htmlspecialchars($data['plate_number'] ?? ''); ?>"><br>
    <label>Jenis Kendaraan</label><br>
    <input type="text" name="vehicle_type" value="<?php echo htmlspecialchars($data['vehicle_type'] ?? ''); ?>"><br><br>
    
    <button type="submit">Simpan</button>
</form>
<?php
include '../includes/footer.php';
?>