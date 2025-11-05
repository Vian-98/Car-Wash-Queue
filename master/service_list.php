<?php
include '../config.php';
include '../includes/header.php';

/* ambil data layanan */
$result = mysqli_query($conn, "SELECT * FROM m_service ORDER BY service_name");
?>
<h2>Master Layanan</h2>
<a href="service_form.php">+ Tambah Layanan</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Kode</th>
        <th>Nama Layanan</th>
        <th>Durasi (menit)</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo htmlspecialchars($row['service_code']); ?></td>
        <td><?php echo htmlspecialchars($row['service_name']); ?></td>
        <td><?php echo $row['duration_min']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td>
            <a href="service_form.php?id=<?php echo $row['service_id']; ?>">Edit</a>
            <a href="service_delete.php?id=<?php echo $row['service_id']; ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php
include '../includes/footer.php';
?>
