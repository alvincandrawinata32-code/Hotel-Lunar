<?php
// Ambil semua data reservasi beserta info tamu, kamar, dan pembayaran
// File ini dipanggil dari halaman back-office (manager2.php dan office2.php)

require_once __DIR__ . '/../db.php';

$stmt = $conn->query("
    SELECT r.id_reservasi, t.username, t.id_tamu, t.alamat, k.tipe_kamar,
           r.tanggal_checkin, r.tanggal_checkout, p.total_bayar, p.metode_bayar
    FROM reservasi r
    JOIN tamu t ON r.id_tamu = t.id_tamu
    JOIN kamar k ON r.id_kamar = k.id_kamar
    LEFT JOIN pembayaran p ON r.id_reservasi = p.id_reservasi
    ORDER BY r.id_reservasi DESC
");
$data_reservasi = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
