<?php
require_once "../db.php";

// Cek apakah data POST tersedia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $conn->prepare("INSERT INTO reservasi 
    (id_reservasi, id_tamu, id_kamar, tanggal_checkin, tanggal_checkout, status_reservasi) 
    VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $_POST['id_reservasi'],
        $_POST['id_tamu'],
        $_POST['id_kamar'],
        $_POST['tanggal_checkin'],
        $_POST['tanggal_checkout'],
        $_POST['status_reservasi']
    ]);

    header("Location: /Hotel-Lunar/PHP/reservasi/index.php");
    exit;

} else {
    echo "Akses tidak valid!";
}
?>