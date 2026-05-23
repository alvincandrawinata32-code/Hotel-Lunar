<?php
session_start();
if (!isset($_SESSION['id_pegawai'])) {
    header('location: ../../login_office/html/login1.php');
    exit;
}
require_once __DIR__ . '/../../PHP/db.php';

$kamar = $conn->query("SELECT tipe_kamar, harga FROM kamar ORDER BY harga")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Back Office - Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/office1.css">
</head>
<body>
<header class="header">Back Office</header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <a href="office1.php" class="active-menu">Dashboard</a>
                <a href="office2.php">Data Reservasi</a>
                <a href="office3.php">Data Pelanggan</a>
                <a href="../../PHP/logout_office.php">Logout</a>
            </div>

            <div class="col-md-10 p-4 content">
                <h3>Back Office Sistem Booking</h3>
                <hr>

                <div class="row mt-4 g-4">
                    <?php foreach($kamar as $k): ?>
                    <div class="col-md-6">
                        <div class="card-kamar shadow">
                            <h5><?= htmlspecialchars($k['tipe_kamar']) ?></h5>
                            <p>Rp <?= number_format($k['harga'], 0, ',', '.') ?> / Malam</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <h4 class="mt-5">Welcome, <?= htmlspecialchars($_SESSION['nama_pegawai']) ?>!</h4>
                <div class="pedoman mt-4 shadow">
                    <h5>Pedoman Penggunaan</h5>
                    <p>Sistem Back Office Booking Hotel digunakan oleh pegawai untuk melihat data reservasi kamar dan informasi pembayaran tamu.
                        Pegawai harus menggunakan akun yang telah diberikan untuk mengakses sistem dan tidak diperbolehkan membagikan informasi login kepada pihak lain.
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
