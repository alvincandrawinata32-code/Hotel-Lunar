<?php
session_start();
if (!isset($_SESSION['id_tamu'])) {
    header('Location: /Hotel_Lunar/login/html/login1.php');
    exit;
}
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_reservasi = $_POST['id_reservasi'];
    $total_bayar = $_POST['total_bayar'];
    $metode_bayar = $_POST['metode_bayar'];

    try {
        $stmt = $conn->prepare("INSERT INTO pembayaran (id_reservasi, total_bayar, metode_bayar) VALUES (:id_reservasi, :total, :metode)");
        $stmt->bindParam(':id_reservasi', $id_reservasi);
        $stmt->bindParam(':total', $total_bayar);
        $stmt->bindParam(':metode', $metode_bayar);
        $stmt->execute();

        echo "<script>alert('Pembayaran berhasil dicatat!'); window.location='/Hotel_Lunar/index.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Gagal catat pembayaran: " . $e->getMessage() . "'); window.history.back();</script>";
    }
}
?>
