<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUNAR HOTEL - Beranda</title>
    <link rel="stylesheet" href="landing-page/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="navbar">
    <div class="nav-kiri">
        <a href="index.php">About</a>
        <a href="landing-page/html/kamar.php">Kamar</a>
    </div>
    <div class="nav-kanan">
        <a href="login_office/html/login1.php" class="login">Masuk Karyawan</a>
        <?php if (isset($_SESSION['id_tamu'])): ?>
            <a href="profile/html/userprofile.php" class="login">Halo, <?php echo htmlspecialchars($_SESSION['username']); ?></a>
            <a href="PHP/logout.php" class="login">Logout</a>
        <?php endif; ?>
    </div>
</div>

<div class="hero">
    <h1>Selamat Datang di LUNAR HOTEL</h1>
    <p>Kemewahan dan Kenyamanan di Pusat Kota</p>
    <?php if (isset($_SESSION['id_tamu'])): ?>
        <a href="landing-page/html/booking.php" style="background: orange; padding: 10px 20px; text-decoration: none; color: black; border-radius: 5px; margin-top: 15px; display: inline-block;">Booking Sekarang</a>
    <?php else: ?>
        <a href="login/html/login1.php" style="background: orange; padding: 10px 20px; text-decoration: none; color: black; border-radius: 5px; margin-top: 15px; display: inline-block;">Booking Sekarang</a>
    <?php endif; ?>
</div>

<main>
    <div class="about">
        <div class="text">
            <h2>Bagaimana kami dapat membantu anda?</h2>
            <p>
                Lunar Hotel hadir untuk memberikan kenyamanan dan kemewahan bagi para tamu,
                menciptakan pengalaman tak terlupakan bagi setiap tamu yang datang. Dengan
                desain interior yang elegan dan fasilitas modern, kami menjadi pilihan ideal
                bagi mereka yang mencari kenyamanan dan kemewahan di pusat kota.
            </p>
            <p>Fasilitas unggulan meliputi:</p>
            <ul>
                <li>Restoran dengan sajian kuliner internasional</li>
                <li>Kamar tidur nyaman dengan pemandangan kota yang indah</li>
                <li>Pusat kebugaran dan spa untuk relaksasi</li>
                <li>Ruang pertemuan dan area kerja untuk kolaborasi bisnis atau umum</li>
            </ul>
        </div>
        <img src="landing-page/image/front.jpg" alt="Hotel Exterior">
    </div>

    <div class="about">
        <div class="text">
            <h2>Tentang Kami</h2>
            <p>Lunar Hotel menyediakan fasilitas terbaik seperti restoran internasional, kolam renang, dan pusat kebugaran.</p>
        </div>
        <img src="landing-page/image/front2.jpg" alt="Hotel">
    </div>
</main>

<footer>
    <p>&copy; 2024 Lunar Hotel - lunarhotel@gmail.com</p>
</footer>

</body>
</html>
