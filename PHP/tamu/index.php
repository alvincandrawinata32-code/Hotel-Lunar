<?php
require_once "../db.php";

$stmt = $conn->prepare("SELECT * FROM tamu");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<a href="create.php"> Tambah Data</a>

<table border="1">
<tr>
    <th>ID Pelanggan</th>
    <th>Nama</th>
    <th>Alamat</th>
</tr>

<?php foreach($data as $row): ?>
<tr>
    <td><?= $row['id_pelanggan'] ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['alamat'] ?></td>

</tr>
<?php endforeach; ?>
</table>

