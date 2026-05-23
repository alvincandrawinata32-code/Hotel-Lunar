<?php
session_start();
if (!isset($_SESSION['id_pegawai']) || $_SESSION['jabatan'] !== 'manager') {
    header('Location: /Hotel_Lunar/login_office/html/login1.php');
    exit;
}
require_once __DIR__ . '/../db.php';

$id_kamar = $_GET['id'] ?? null;

if (!$id_kamar) {
    echo "<script>alert('ID kamar tidak ditemukan!'); window.history.back();</script>";
    exit;
}

try {
    $stmt = $conn->prepare("DELETE FROM kamar WHERE id_kamar = :id");
    $stmt->bindParam(':id', $id_kamar);
    $stmt->execute();

    echo "<script>alert('Kamar berhasil dihapus!'); window.history.back();</script>";
} catch (PDOException $e) {
    echo "<script>alert('Gagal hapus kamar: " . $e->getMessage() . "'); window.history.back();</script>";
}
?>
