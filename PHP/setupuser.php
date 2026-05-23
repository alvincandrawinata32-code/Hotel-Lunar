<?php
require_once 'db.php';

$salt1 = "qm&h*";
$salt2 = "pg!@";

$username = $_POST['username'];
$pw_temp  = $_POST['password'];
$confirm  = $_POST['confirm_password'];

// Cek password cocok SEBELUM di-hash
if ($pw_temp !== $confirm) {
    echo "<script>
        alert('Konfirmasi password tidak cocok!');
        window.location.href='/Hotel-Lunar/login/html/register.php';
    </script>";
    exit;
}

$password = sha1("$salt1$pw_temp$salt2");

try {
    $sql = $conn->prepare("INSERT INTO tamu (username, password) VALUES (:username, :password)");
    $sql->bindParam(':username', $username);
    $sql->bindParam(':password', $password);
    $sql->execute();

    header('Location: /Hotel-Lunar/login/html/login1.php');
    exit;

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>