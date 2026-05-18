<?php
session_start();
require_once('../../PHP/db.php');

if (isset($_POST['username']) && isset($_POST['password'])) {

    $salt1 = "qm&h*";
    $salt2 = "pg!@";

    $username = $_POST['username'];
    $pw_temp = $_POST['password'];

    // Enkripsi password
    $token = sha1("$salt1$pw_temp$salt2");

    // Query cek user
    $prepared = $conn->prepare("
        SELECT * FROM tamu 
        WHERE username = :username 
        AND password = :password
    ");

    $prepared->bindParam(':username', $username);
    $prepared->bindParam(':password', $token);

    try {

        $prepared->execute();

        $user = $prepared->fetch(PDO::FETCH_ASSOC);

        // Jika user ditemukan
        if ($user) {

            // Simpan session
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $token;

            // Remember me
            if (isset($_POST['rememberme'])) {

                setcookie(
                    'username',
                    $username,
                    time() + (60 * 60 * 24 * 365),
                    '/'
                );

                setcookie(
                    'password',
                    $token,
                    time() + (60 * 60 * 24 * 365),
                    '/'
                );
            }

            // Redirect ke halaman user
            header('Location: /Hotel-Lunar/index.php');
            exit;

        } else {

            echo "<script>
                    alert('Username atau Password salah!');
                    window.location='/Hotel-Lunar/login/html/login1.php';
                  </script>";
        }

    } catch (PDOException $e) {

        echo "Error : " . $e->getMessage();
    }

} else {

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
                <form method="POST" action="login1.php">
                    <input type="text" name="username" class="form-control mb-2" placeholder="Username">        <!-- ← tambah name -->
                    <input type="password" name="password" class="form-control mb-3" placeholder="Password">   <!-- ← tambah name -->

                    <div class="mb-2">
                    <input type="checkbox" name="rememberme" value="1" class="form-check-input">
                    <label class="form-check-label">Remember</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">LOGIN/MASUK</button>
                </form>

                <p class="text-center small">Tidak memiliki akun?</p>
                <a href="register.php" class="btn btn-secondary w-100">DAFTAR</a>

                <button type="button" class="btn btn-secondary w-100 mt-2" onclick="window.location.href='/Hotel-Lunar/index.php'">kembali ke beranda</button>

            </div>
        </div>

    </div>
</div>
</body>
</html>
<?php
}
?>