<?php
include "../db.php";

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE tamu
    SET nama='$nama', email='$email', password='$password' 
    WHERE id_tamu=$id";

    $conn->query($query);
    header("Location: index.php");
}

$result = $conn->query("SELECT * FROM tamu WHERE id_tamu=$id");
$data = $result->fetch_assoc();
?>

<h2>Edit Tamu</h2>

<form method="POST">
    Nama: <input type="text" name="username" value="<?= $data['nama'] ?>"><br>
    Email: <input type="email" name="email" value="<?= $data['email'] ?>"><br>
    Password: <input type="text" name="password" value="<?= $data['password'] ?>"><br>
    <button type="submit">Update</button>
</form>