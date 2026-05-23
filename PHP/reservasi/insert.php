<?php
session_start();
if (!isset($_SESSION['id_tamu'])) {
    header('Location: /Hotel_Lunar/login/html/login1.php');
    exit;
}
require_once __DIR__ . '/../db.php';

$id_tamu = $_SESSION['id_tamu'];
$tipe_kamar = $_POST['kamar'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$metode = $_POST['metode_bayar'];

// Cari id_kamar berdasarkan tipe
$stmtKamar = $conn->prepare("SELECT id_kamar, harga FROM kamar WHERE tipe_kamar = :tipe LIMIT 1");
$stmtKamar->bindParam(':tipe', $tipe_kamar);
$stmtKamar->execute();
$kamar = $stmtKamar->fetch(PDO::FETCH_ASSOC);

if (!$kamar) {
    echo "<script>alert('Kamar tidak ditemukan!'); window.history.back();</script>";
    exit;
}

$id_kamar = $kamar['id_kamar'];
$harga = $kamar['harga'];

// Hitung total bayar berdasarkan jumlah malam
$tgl_in = new DateTime($checkin);
$tgl_out = new DateTime($checkout);
$malam = $tgl_in->diff($tgl_out)->days;

if ($malam <= 0) {
    echo "<script>alert('Tanggal check-out harus setelah check-in!'); window.history.back();</script>";
    exit;
}

$total = $harga * $malam;

try {
    // Insert reservasi
    $stmtRes = $conn->prepare("INSERT INTO reservasi (id_tamu, id_kamar, tanggal_checkin, tanggal_checkout, status_reservasi) VALUES (:id_tamu, :id_kamar, :checkin, :checkout, 'Menunggu')");
    $stmtRes->bindParam(':id_tamu', $id_tamu);
    $stmtRes->bindParam(':id_kamar', $id_kamar);
    $stmtRes->bindParam(':checkin', $checkin);
    $stmtRes->bindParam(':checkout', $checkout);
    $stmtRes->execute();

    $id_reservasi = $conn->lastInsertId();

    // Insert pembayaran
    $stmtPay = $conn->prepare("INSERT INTO pembayaran (id_reservasi, total_bayar, metode_bayar) VALUES (:id_reservasi, :total, :metode)");
    $stmtPay->bindParam(':id_reservasi', $id_reservasi);
    $stmtPay->bindParam(':total', $total);
    $stmtPay->bindParam(':metode', $metode);
    $stmtPay->execute();

    echo "<script>alert('Booking berhasil! Total: Rp " . number_format($total, 0, ',', '.') . " untuk $malam malam.'); window.location='/Hotel_Lunar/index.php';</script>";
} catch (PDOException $e) {
    echo "<script>alert('Gagal booking: " . $e->getMessage() . "'); window.history.back();</script>";
}
?>
