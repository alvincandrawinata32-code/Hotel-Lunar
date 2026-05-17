<?php
require_once "../../db.php";

$stmt = $conn->prepare("INSERT INTO kamar 
(id_alat, tipe_kamar, harga, status)
VALUES (?, ?, ?, ?)");

$stmt->execute([
    $_POST['id_alat'],
    $_POST['nama_alat'],
    $_POST['kondisi_alat'],
    $_POST['status_alat'],
    $_POST['stok_alat'],
    $_POST['harga_sewa']
]);

header("Location: index.php");
exit;
?>