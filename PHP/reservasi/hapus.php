<?php
session_start();
if (!isset($_SESSION['id_pegawai'])) {
    header('Location: /Hotel_Lunar/login_office/html/login1.php');
    exit;
}
require_once __DIR__ . '/../db.php';

$id_reservasi = $_GET['id'] ?? null;

if (!$id_reservasi) {
    echo "<script>alert('ID reservasi tidak ditemukan!'); window.history.back();</script>";
    exit;
}

try {
    // Hapus pembayaran dulu karena ada foreign key
    $stmtPay = $conn->prepare("DELETE FROM pembayaran WHERE id_reservasi = :id");
    $stmtPay->bindParam(':id', $id_reservasi);
    $stmtPay->execute();

    // Hapus reservasi
    $stmtRes = $conn->prepare("DELETE FROM reservasi WHERE id_reservasi = :id");
    $stmtRes->bindParam(':id', $id_reservasi);
    $stmtRes->execute();

    echo "<script>alert('Reservasi berhasil dihapus!'); window.history.back();</script>";
} catch (PDOException $e) {
    echo "<script>alert('Gagal hapus: " . $e->getMessage() . "'); window.history.back();</script>";
}
?>
