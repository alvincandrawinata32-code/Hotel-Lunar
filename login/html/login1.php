<?php
session_start();

// Kalau sudah login, langsung ke index
if (isset($_SESSION['id_tamu'])) {
    header('Location: /Hotel_Lunar/index.php');
    exit;
}

require_once __DIR__ . '/../../PHP/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM tamu WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['id_tamu'] = $user['id_tamu'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['alamat'] = $user['alamat'];
            $_SESSION['email'] = $user['email'];
            header('Location: /Hotel_Lunar/index.php');
            exit;
        } else {
            echo "<script>alert('Email atau Password salah!'); window.location='login1.php';</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/login1.css">
</head>
<body>

<div class="container-fluid">
    <div class="row vh-100">

        <div class="col-md-6 left-side d-flex align-items-center">
            <div class="text-white p-5">
                <h1>Welcome to<br><b>LUNAR HOTEL</b></h1>
                <p>Nikmati suasana yang hangat, kamar yang nyaman, serta layanan yang dirancang untuk memberikan kenyamanan dalam setiap menginap.</p>
            </div>
        </div>

        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="card login-card shadow">

                <h5 class="text-center mb-3">LOGIN</h5>
                <form method="POST">
                    <input type="email" class="form-control mb-2" name="email" placeholder="Email" required>
                    <input type="password" class="form-control mb-3" name="password" placeholder="Password" required>
                    <button type="submit" class="btn btn-primary w-100 mb-2">LOGIN/MASUK</button>
                </form>

                <p class="text-center small">Tidak memiliki akun?</p>
                <a href="login2.php" class="btn btn-secondary w-100">DAFTAR</a>

                <button type="button" class="btn btn-secondary w-100 mt-2" onclick="window.location.href='/Hotel_Lunar/index.php'">kembali ke beranda</button>

            </div>
        </div>

    </div>
</div>
</body>
</html>
