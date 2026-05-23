<?php

session_start();
if (!isset($_SESSION['id_tamu'])) {
    header('location: ../../login/html/login1.php');
    exit;
}
require_once '../../PHP/db.php';

$stmt = $conn->prepare("
    SELECT r.id_reservasi, k.tipe_kamar, r.tanggal_checkin, r.tanggal_checkout, r.status_reservasi,
    p.total_bayar, p.metode_bayar,
    DATEDIFF(r.tanggal_checkout, r.tanggal_checkin) AS durasi
    FROM reservasi r
    JOIN kamar k ON r.id_kamar = k.id_kamar
    LEFT JOIN pembayaran p ON r.id_reservasi = p.id_reservasi
    WHERE r.id_tamu = ?
    ORDER BY r.id_reservasi DESC
");
$stmt->execute([$_SESSION['id_tamu']]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Riwayat Transaksi</title>
        <link rel="stylesheet" href="../css/riwayat.css">
    </head>
    <body>
        <aside class="sidebar">
            <nav class="menu">
                <a href="../../index.php">About</a>
                <a href="../../landing-page/html/kamar.php">Kamar</a>
                <a href="../../landing-page/html/booking.php">Booking</a>
                <a href="userprofile.php">User Profile</a>
                <a href="riwayat.php" class="active">Riwayat</a>
                <a href="../../PHP/logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content">
            <?php if (count($data) === 0): ?>
                <p>Belum ada riwayat reservasi.</p>
            <?php else: ?>
                <?php foreach($data as $row): ?>
                    <div class="room-card">
                        <h3><?= htmlspecialchars($row['tipe_kamar']) ?></h3>
                        <p class="duration"><?= $row['durasi'] ?> Malam</p>
                        <p>Check-in: <?= $row['tanggal_checkin'] ?> &nbsp;|&nbsp; Check-out: <?= $row['tanggal_checkout'] ?></p>
                        <p>Status: <?= $row['status_reservasi'] ?></p>
                        <?php if ($row['total_bayar']): ?>
                        <p>Total Bayar: Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?> (<?= $row['metode_bayar'] ?>)</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </main>
    </body>
</html>