<?php
session_start();

require_once "../db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'nama_pegawai' => $_POST['nama_pegawai'],
        'password' => $_POST['password']
    ];

    

    try {
        $pdo = $conn->prepare("INSERT INTO pegawai (nama_pegawai, password) 
                VALUES (:nama_pegawai, :password)");
        $pdo->execute($formData);

        echo "Data berhasil ditambahkan <br>";

        header(
            "Location: index.php"
        )

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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
    <form method="post">
        <label for="nama_pegawai">Nama Pegawai:</label><br>
        <input type="text" id="nama_pegawai" name="nama_pegawai"><br>
        <label for="password">Password:</label><br>
        <input type="text" id="password" name="password"><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>