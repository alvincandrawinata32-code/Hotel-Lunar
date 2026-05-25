<?php
session_start();

if (isset($_SESSION['id_tamu'])) {
    header('Location: /Hotel_Lunar/index.php');
    exit;
}

require_once __DIR__ . '/../../PHP/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $cek = $conn->prepare("SELECT id_tamu FROM tamu WHERE email = :email");
        $cek->bindParam(':email', $email);
        $cek->execute();

        if ($cek->rowCount() > 0) {
            echo "<script>alert('Email sudah terdaftar!'); window.location='login2.php';</script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO tamu (username, alamat, email, password) VALUES (:username, :alamat, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $id = $conn->lastInsertId();
            $_SESSION['id_tamu'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['alamat'] = $alamat;
            $_SESSION['email'] = $email;

            header('Location: /Hotel_Lunar/index.php');
            exit;
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
    <title>Register - Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/login2.css">
</head>
<body>

<div class="container-fluid">
    <div class="row vh-100">

        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="card register-card shadow">

                <h5 class="text-center mb-3">MEMBUAT AKUN</h5>

                <form method="POST" id="passwordForm">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>

                        <input type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            required >
                        <small id="passError"></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>

                        <input type="password"
                            class="form-control"
                            id="confirm_password"
                            required>

                        <small id="confirmError"></small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                </form>

                <p class="text-center small mt-2">Sudah memiliki akun?
                    <a href="login1.php">Masuk</a>
                </p>

                <button type="button" class="btn btn-secondary w-100 mt-2" onclick="window.location.href='/Hotel_Lunar/index.php'">kembali ke beranda</button>

            </div>
        </div>

        <div class="col-md-6 right-side d-flex justify-content-end align-items-center">
            <div class="text-box text-white">
                <h1>Welcome to<br><b>LUNAR HOTEL</b></h1>
                <p>Nikmati suasana yang hangat, kamar yang nyaman, serta layanan yang dirancang untuk memberikan kenyamanan dalam setiap menginap.</p>
            </div>
        </div>

    </div>
</div>

<script src="../../validasi.js"></script>

</body>
</html>
