<?php
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}
include '../includes/header.php';

$result = mysqli_query($conn, "SELECT * FROM m_customer ORDER BY customer_name");
?>
<h2>Master Pelanggan</h2>
<a href="customer_form.php">+ Tambah Pelanggan</a>
<table class="data-table">
    <tr>
        <th>Nama</th>
        <th>Telp</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
        <td><?php echo htmlspecialchars($row['phone']); ?></td>
        <td>
            <a href="customer_form.php?id=<?php echo $row['customer_id']; ?>">Edit</a>
            <a href="customer_delete.php?id=<?php echo $row['customer_id']; ?>" onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php
include '../includes/footer.php';
?>
