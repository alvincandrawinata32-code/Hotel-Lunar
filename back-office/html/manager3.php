<?php
session_start();
if (!isset($_SESSION['id_pegawai']) || $_SESSION['jabatan'] !== 'manager') {
    header('location: ../../login_office/html/login1.php');
    exit;
}
require_once __DIR__ . '/../../PHP/db.php';

$stmt = $conn->query("SELECT id_pegawai, nama_pegawai, jabatan FROM pegawai ORDER BY jabatan");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Back Office - Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/manager3.css">
</head>
<body>
<header class="header">Back Office</header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <a href="manager1.php">Dashboard</a>
                <a href="manager2.php">Data Reservasi</a>
                <a href="manager3.php" class="active-menu">Daftar Karyawan</a>
                <a href="manager4.php">Data Pelanggan</a>
                <a href="../../PHP/logout_office.php">Logout</a>
            </div>

            <div class="col-md-10 p-4 content">
                <h3>Back Office Sistem Booking</h3>
                <hr>

                <div class="isi_konten">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                        </tr>
                        <?php foreach($data as $row): ?>
                        <tr>
                            <td><?= $row['id_pegawai'] ?></td>
                            <td><?= htmlspecialchars($row['nama_pegawai']) ?></td>
                            <td><?= $row['jabatan'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
