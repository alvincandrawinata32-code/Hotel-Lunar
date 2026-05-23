<?php
session_start();
if (!isset($_SESSION['id_tamu'])) {
    header('Location: /Hotel_Lunar/login/html/login1.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - LUNAR HOTEL</title>
    <link rel="stylesheet" href="../css/booking.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="navbar">
    <div class="nav-kiri">
        <a href="../../index.php">About</a>
        <a href="kamar.php">Kamar</a>
    </div>
    <div class="nav-kanan">
        <a href="../../login_office/html/login1.php" class="login">Masuk Karyawan</a>
        <a href="../../profile/html/userprofile.php" class="login">Halo, <?php echo htmlspecialchars($_SESSION['username']); ?></a>
        <a href="../../PHP/logout.php" class="login">Logout</a>
    </div>
</div>

<div class="page-header">
    <h1>Form Booking</h1>
    <p>Isi data di bawah untuk melakukan reservasi kamar</p>
</div>

<main>
    <div class="container">
        <form class="form-section" action="../../PHP/reservasi/insert.php" method="post">
            <div class="form-card">
                <h3>Detail Reservasi</h3>
                <div class="form-group">
                    <label for="kamar">Pilih Kamar <span class="required">*</span></label>
                    <select name="kamar" id="kamar" required>
                        <option value="Deluxe">Deluxe Room — Rp 850.000</option>
                        <option value="Executive">Executive Room — Rp 1.250.000</option>
                        <option value="Suite">Suite Room — Rp 2.500.000</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="metode_bayar">Metode Pembayaran <span class="required">*</span></label>
                    <select name="metode_bayar" id="metode_bayar" required>
                        <option value="Transfer">Transfer</option>
                        <option value="Tunai">Tunai</option>
                        <option value="QRIS">QRIS</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="checkin">Tanggal Check-In <span class="required">*</span></label>
                        <input type="date" name="checkin" id="checkin" required>
                    </div>
                    <div class="form-group">
                        <label for="checkout">Tanggal Check-out <span class="required">*</span></label>
                        <input type="date" name="checkout" id="checkout" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-submit">Booking Sekarang</button>
        </form>
    </div>
</main>
<footer>
    <p>&copy; 2024 Lunar Hotel - lunarhotel@gmail.com</p>
</footer>

</body>
</html>
