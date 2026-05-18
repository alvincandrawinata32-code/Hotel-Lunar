<?php 

require_once "../db.php";

try {
    $query = $conn->query("SELECT * FROM pegawai");
    $pegawai = $query->fetchAll();
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Data Karyawan</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pegawai as $row): ?>
            <tr>
                <td><?php echo $row['id_pegawai']; ?></td>
                <td><?php echo $row['nama_pegawai']; ?></td>
                <td><?php echo $row['password']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>