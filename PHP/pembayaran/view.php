<?php
// Ambil data pembayaran beserta info reservasi dan tamu
// Dipanggil dari halaman back-office yang perlu lihat data pembayaran

require_once __DIR__ . '/../db.php';

$stmt = $conn->query("
    SELECT p.id_pembayaran, p.total_bayar, p.metode_bayar,
           r.id_reservasi, r.tanggal_checkin, r.tanggal_checkout,
           t.username, k.tipe_kamar
    FROM pembayaran p
    JOIN reservasi r ON p.id_reservasi = r.id_reservasi
    JOIN tamu t ON r.id_tamu = t.id_tamu
    JOIN kamar k ON r.id_kamar = k.id_kamar
    ORDER BY p.id_pembayaran DESC
");
$data_pembayaran = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
