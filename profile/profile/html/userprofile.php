<?php
session_start();
if (!isset($_SESSION['id_tamu'])) {
    header('location: ../../login/html/login1.php');
    exit;
}
require_once '../../PHP/db.php';

$stmt = $conn->prepare("SELECT * FROM tamu WHERE id_tamu = ?");
$stmt->execute([$_SESSION['id_tamu']]);
$tamu = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link rel="stylesheet" href="../css/userprofile.css">
    </head>
    <body>
        <div class="page">
            <header class="topbar">
                <h1>User Profile</h1>
            </header>

            <div class="main-layout">
                <aside class="sidebar">
                    <nav class="menu">
                        <a href="../../index.php">About</a>
                        <a href="../../landing-page/html/kamar.php">Kamar</a>
                        <a href="../../landing-page/html/booking.php">Booking</a>
                        <a href="userprofile.php" class="active">User Profile</a>
                        <a href="riwayat.php">Riwayat</a>
                        <a href="../../PHP/logout.php">Logout</a>
                    </nav>
                    <div class="sidebar-image"></div>
                </aside>

                <main class="content">
                    <div class="profile-card">
                        <div class="avatar"><?= strtoupper(substr($tamu['username'], 0, 1)) ?></div>
                        <h2><?= htmlspecialchars($tamu['username']) ?></h2>
                    </div>

                    <div class="info-box">
                        <span class="label">Email</span>
                        <p><?= htmlspecialchars($tamu['email']) ?></p>
                    </div>

                    <div class="info-box">
                        <span class="label">Alamat</span>
                        <p><?= htmlspecialchars($tamu['alamat']) ?></p>
                    </div>

                    <div class="info-box">
                        <span class="label">Password</span>
                        <p>********</p>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>