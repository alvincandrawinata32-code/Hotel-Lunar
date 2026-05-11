<?php 
include "../db.php";

$username = $_POST['username'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$password = $_POST['password'];

$query = "INSERT INTO tamu (nama, alamat, email, password) 
        VALUES ('$username', '$alamat', '$email', '$password')";

try {
    $conn->exec($query);
    echo "Data berhasil ditambahkan <br>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

echo "<a href='index.php'>Kembali</a>";
?>