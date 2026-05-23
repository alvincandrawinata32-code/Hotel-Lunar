<?php
session_start();
if (!isset($_SESSION['id_pegawai']) || $_SESSION['jabatan'] !== 'manager') {
    header('Location: /Hotel_Lunar/login_office/html/login1.php');
    exit;
}
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kamar = $_POST['id_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga = $_POST['harga'];

    try {
        $stmt = $conn->prepare("UPDATE kamar SET tipe_kamar = :tipe, harga = :harga WHERE id_kamar = :id");
        $stmt->bindParam(':tipe', $tipe_kamar);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':id', $id_kamar);
        $stmt->execute();

        echo "<script>alert('Data kamar berhasil diubah!'); window.history.back();</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Gagal edit kamar: " . $e->getMessage() . "'); window.history.back();</script>";
    }
}
?>
