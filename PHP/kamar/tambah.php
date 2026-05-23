<?php
session_start();
if (!isset($_SESSION['id_pegawai']) || $_SESSION['jabatan'] !== 'manager') {
    header('Location: /Hotel_Lunar/login_office/html/login1.php');
    exit;
}
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga = $_POST['harga'];

    try {
        $stmt = $conn->prepare("INSERT INTO kamar (tipe_kamar, harga) VALUES (:tipe, :harga)");
        $stmt->bindParam(':tipe', $tipe_kamar);
        $stmt->bindParam(':harga', $harga);
        $stmt->execute();

        echo "<script>alert('Kamar berhasil ditambahkan!'); window.history.back();</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Gagal tambah kamar: " . $e->getMessage() . "'); window.history.back();</script>";
    }
}
?>
