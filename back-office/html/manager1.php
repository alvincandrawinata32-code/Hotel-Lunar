<?php
session_start();
if (!isset($_SESSION['id_pegawai']) || $_SESSION['jabatan'] !== 'manager') {
    header('location: ../../login_office/html/login1.php');
    exit;
}
require_once __DIR__ . '/../../PHP/db.php';

$total_reservasi = $conn->query("SELECT COUNT(*) FROM reservasi")->fetchColumn();
$total_kamar = $conn->query("SELECT COUNT(*) FROM kamar")->fetchColumn();
$total_pendapatan = $conn->query("SELECT SUM(total_bayar) FROM pembayaran")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Back Office - Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/manager1.css">
</head>
<body>
<header class="header">Back Office</header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <a href="manager1.php" class="active-menu">Dashboard</a>
                <a href="manager2.php">Data Reservasi</a>
                <a href="manager3.php">Daftar Karyawan</a>
                <a href="manager4.php">Data Pelanggan</a>
                <a href="../../PHP/logout_office.php">Logout</a>
            </div>

            <div class="col-md-10 p-4 content">
                <h3>Back Office Sistem Booking</h3>
                <hr>

                <div class="row mt-4 g-3">
                    <div class="col-md-4">
                        <div class="card-reservasi shadow">
                            <h6>Total Reservasi</h6>
                            <h2><?= $total_reservasi ?></h2>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-kamar shadow">
                            <h6>Total Kamar</h6>
                            <h2><?= $total_kamar ?></h2>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-profit shadow">
                            <h6>Total Pendapatan</h6>
                            <h2>Rp <?= number_format($total_pendapatan ?? 0, 0, ',', '.') ?></h2>
                        </div>
                    </div>
                </div>

                <h4 class="mt-5">Welcome, <?= htmlspecialchars($_SESSION['nama_pegawai']) ?>!</h4>
                <div class="pedoman mt-4 shadow">
                    <h5>Pedoman Penggunaan</h5>
                    <p>Sistem Back Office Booking Hotel digunakan oleh manager untuk melihat data reservasi kamar dan informasi pembayaran tamu.
                        Pegawai harus menggunakan akun yang telah diberikan untuk mengakses sistem dan tidak diperbolehkan membagikan informasi login kepada pihak lain.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
