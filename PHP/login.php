<?php
session_start();
require_once('db.php');

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
            header('Location: index.php');
            exit;

        } else {

            echo "<script>
                    alert('Username atau Password salah!');
                    window.location='login.php';
                  </script>";
        }

    } catch (PDOException $e) {

        echo "Error : " . $e->getMessage();
    }

} else {

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Login - Hotel Lunar</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />

    <link href="css/login.css" rel="stylesheet" />
</head>

<body>

<div class="login-container">

    <div class="card shadow login-card p-4">

        <div class="text-center mb-3">
            <h3>Hotel Lunar
            <p class="text-muted">
                Sistem Kesejahteraan Mahasiswa
            </p>
        </div>

        <form method="POST" action="login.php">

            <div class="mb-3">
                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    class="form-control"
                    placeholder="Masukkan username"
                    required
                />
            </div>

            <div class="mb-3">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required
                />
            </div>

            <div class="mb-3 form-check">

                <input
                    type="checkbox"
                    name="rememberme"
                    value="1"
                    class="form-check-input"
                />

                <label class="form-check-label">
                    Remember Me
                </label>

            </div>

            <button
                type="submit"
                class="btn btn-primary w-100"
            >
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>

<?php
}
?>