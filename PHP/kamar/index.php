<?php
require_once "../db.php";

$stmt = $conn->prepare("SELECT * FROM kamar");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<a href="create.php"> Tambah Data</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Tipe</th>
    <th>Harga</th>
    <th>Status</th>
    
</tr>

<?php foreach($data as $row): ?>
<tr>
    <td><?= $row['id_alat'] ?></td>
    <td><?= $row['tipe_kamar'] ?></td>
    <td><?= $row['harga'] ?></td>
    <td><?= $row['status'] ?></td>


</tr>
<?php endforeach; ?>
</table>
