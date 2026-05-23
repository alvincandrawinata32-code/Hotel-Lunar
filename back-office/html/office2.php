<?php
session_start();
if (!isset($_SESSION['id_pegawai'])) {
    header('location: ../../login_office/html/login1.php');
    exit;
}
require_once __DIR__ . '/../../PHP/db.php';

$stmt = $conn->query("
    SELECT r.id_reservasi, t.username, t.id_tamu, t.alamat, k.tipe_kamar,
    r.tanggal_checkin, r.tanggal_checkout, p.total_bayar, p.metode_bayar
    FROM reservasi r
    JOIN tamu t ON r.id_tamu = t.id_tamu
    JOIN kamar k ON r.id_kamar = k.id_kamar
    LEFT JOIN pembayaran p ON r.id_reservasi = p.id_reservasi
    ORDER BY r.id_reservasi DESC
");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Back Office - Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/office2.css">
</head>
<body>
<header class="header">Back Office</header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <a href="office1.php">Dashboard</a>
                <a href="office2.php" class="active-menu">Data Reservasi</a>
                <a href="office3.php">Data Pelanggan</a>
                <a href="../../PHP/logout_office.php">Logout</a>
            </div>

            <div class="col-md-10 p-4 content">
                <h3>Back Office Sistem Booking</h3>
                <hr>

                <div class="isi_konten">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Nama Tamu</th>
                            <th>ID Tamu</th>
                            <th>Alamat</th>
                            <th>Tipe Kamar</th>
                            <th>Tanggal Check-in</th>
                            <th>Tanggal Check-out</th>
                            <th>Total Bayar</th>
                            <th>Metode Bayar</th>
                        </tr>
                        <?php foreach($data as $row): ?>
                        <tr>
                            <td><?= $row['id_reservasi'] ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= $row['id_tamu'] ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                            <td><?= $row['tipe_kamar'] ?></td>
                            <td><?= $row['tanggal_checkin'] ?></td>
                            <td><?= $row['tanggal_checkout'] ?></td>
                            <td><?= $row['total_bayar'] ? 'Rp ' . number_format($row['total_bayar'], 0, ',', '.') : '-' ?></td>
                            <td><?= $row['metode_bayar'] ?? '-' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
