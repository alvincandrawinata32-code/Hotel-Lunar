<?php
include "../db.php";

$result = $conn->query("SELECT * FROM tamu");
?>

<h2>Data Tamu</h2>
<a href="view.php">Tambah Data</a>

<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>Email</th>
    <th>Password</th>
    <th>Aksi</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['password'] ?></td>
    <td>
        <a href="update.php?id=<?= $row['id_tamu'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $row['id_tamu'] ?>">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>