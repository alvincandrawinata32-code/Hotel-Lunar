<?php
require_once "../db.php";

$stmt = $conn->prepare("INSERT INTO reservasi 
(id_reservasi, id_tamu, id_kamar, tanggal_checkin, tanggal_checkout, status_reservasi) 
VALUES (?, ?, ?, ?, ?)");

$stmt->execute([
    $_POST['id_reservasi'],
    $_POST['id_tamu'],
    $_POST['id_kamar'],
    $_POST['tanggal_checkin'],
    $_POST['tanggal_checkout'],
    $_POST['status_reservasi']
]);

header("Location: index.php");
exit;
?>