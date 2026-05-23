<?php
session_start();
if (!isset($_SESSION['id_pegawai']) || $_SESSION['jabatan'] !== 'manager') {
    header('location: ../../login_office/html/login1.php');
    exit;
}
require_once __DIR__ . '/../../PHP/db.php';

$stmt = $conn->query("SELECT id_tamu, username, alamat FROM tamu ORDER BY id_tamu ASC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Back Office - Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/manager4.css">
</head>
<body>
<header class="header">Back Office</header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <a href="manager1.php">Dashboard</a>
                <a href="manager2.php">Data Reservasi</a>
                <a href="manager3.php">Daftar Karyawan</a>
                <a href="manager4.php" class="active-menu">Data Pelanggan</a>
                <a href="../../PHP/logout_office.php">Logout</a>
            </div>

            <div class="col-md-10 p-4 content">
                <h3>Back Office Sistem Booking</h3>
                <hr>

                <div class="isi_konten">
                    <table class="table table-striped">
                        <tr>
                            <th>ID Tamu</th>
                            <th>Username</th>
                            <th>Alamat</th>
                        </tr>
                        <?php foreach($data as $row): ?>
                        <tr>
                            <td><?= $row['id_tamu'] ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
