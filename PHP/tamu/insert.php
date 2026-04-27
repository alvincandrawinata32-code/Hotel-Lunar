<?php 
include "../db.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "INSERT INTO tamu (nama, email, password)
VALUES ('$username', '$email', '$password')";

if ($conn->query($query) === TRUE) {
    echo "Data berhasil ditambahkan <br>";
} else {
    echo "Error: " . $conn->error;
}

echo "<a href='index.php'>Kembali</a>";
?>