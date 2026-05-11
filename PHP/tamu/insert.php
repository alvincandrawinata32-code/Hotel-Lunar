<?php 
include "../db.php";

$username = $_POST['username'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$password = $_POST['password'];

$query = "INSERT INTO tamu (nama, alamat, email, password) VALUES ('$username', '$alamat', '$email', '$password')";

if ($conn->query($query) === TRUE) {
    echo "Data berhasil ditambahkan <br>";
} else {
    echo "Error: " . $conn->error;
}

echo "<a href='index.php'>Kembali</a>";
?>