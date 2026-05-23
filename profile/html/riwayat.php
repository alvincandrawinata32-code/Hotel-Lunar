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
</head>
<body>
  <div class="page">

    <header class="topbar">
      <h1>Riwayat Transaksi</h1>
    </header>

    <div class="main-layout">
      <aside class="sidebar">
        <nav class="menu">
          <a href="../../index.php">About</a>
          <a href="../../landing-page/html/kamar.php">Kamar</a>
          <a href="../../landing-page/html/booking.php">Booking</a>
          <a href="userprofile.php">User Profile</a>
          <a href="riwayat.php" class="active">Riwayat</a>
          <a href="../../PHP/logout.php">Logout</a>
        </nav>
        <div class="sidebar-image"></div>
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
    </div>
  </div>
</body>
</html>

<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; }
body { background: #dfe6ea; }
.page { width: 100%; min-height: 100vh; }
.topbar { background: #062f57; color: white; padding: 20px 28px; }
.topbar h1 { font-size: 22px; font-weight: 700; }
.main-layout { display: flex; min-height: calc(100vh - 76px); margin: 0 18px 0 0; gap: 18px; }
.sidebar { width: 245px; background: #6aa6f8; display: flex; flex-direction: column; justify-content: space-between; }
.menu { display: flex; flex-direction: column; }
.menu a { text-decoration: none; color: white; padding: 18px 20px; text-align: center; font-size: 16px; border-bottom: 1px solid rgba(0,0,0,0.1); background: #5f9ef4; transition: 0.3s; }
.menu a:hover { background: #4b8eea; }
.menu a.active { background: #062f57; }
.sidebar-image { flex: 1; min-height: 360px; background: linear-gradient(rgba(255,255,255,0.35), rgba(255,255,255,0.35)), url('https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center; }
.content { flex: 1; padding: 22px 28px; }
.room-card { background: white; border-radius: 8px; padding: 24px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.12); border-left: 5px solid #4f95f5; }
.room-card h3 { font-size: 16px; font-weight: 700; color: #111; margin-bottom: 8px; }
.room-card .duration { font-size: 18px; font-weight: 700; color: #4f95f5; margin-bottom: 6px; }
.room-card p { font-size: 14px; color: #555; margin-bottom: 4px; }
@media (max-width: 900px) { .main-layout { flex-direction: column; } .sidebar { width: 100%; } .sidebar-image { min-height: 200px; } .content { padding: 16px; } }
</style>
