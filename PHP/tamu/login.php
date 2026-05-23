<?php

session_start();

if (isset($_SESSION['id_tamu'])) {
    header('Location: /Hotel_Lunar/index.php');
    exit;
}

require_once __DIR__ . '/../db.php';

$login_error = '';

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
            $login_error = 'Email atau Password salah!';
        }
    } catch (PDOException $e) {
        $login_error = "Error: " . $e->getMessage();
    }
}
?>
