<?php
require_once "../db.php";

$stmt = $conn->prepare("SELECT * FROM reservasi");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<a href="create.php"> Tambah Data</a>

<table border="1">
<tr>
    <th>ID Reservasi</th>
    <th>ID Tamu</th>
    <th>ID Kamar
    <th>Tanggal Checkin</th>
    <th>Tanggal Checkout</th>
    <th>Status Reservasi</th>
</tr>

<?php foreach($data as $row): ?>
<tr>
    <td><?= $row['id_reservasi'] ?></td>
    <td><?= $row['id_tamu'] ?></td>
    <td><?= $row['id_kamar'] ?></td>
    <td><?= $row['tanggal_checkin'] ?></td>
    <td><?= $row['tanggal_checkout'] ?></td>
    <td><?= $row['status_reservasi'] ?></td>
</tr>
<?php endforeach; ?>
</table>

