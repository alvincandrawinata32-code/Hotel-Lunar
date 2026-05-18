<?php
require_once "../db.php";

$stmt = $conn->prepare("INSERT INTO tamu 
(id_pelanggan, nama, alamat) 
VALUES (?, ?, ?)");

$stmt->execute([
    $_POST['id_tamu'],
    $_POST['nama'],
    $_POST['alamat'],
]);

header("Location: index.php");
exit;
?>
   