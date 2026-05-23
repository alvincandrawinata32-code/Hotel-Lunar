<?php

session_start();

if (isset($_SESSION['id_tamu'])) {
    header('Location: /Hotel_Lunar/index.php');
    exit;
}

require_once __DIR__ . '/../db.php';

$register_error = '';

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
            $register_error = 'Email sudah terdaftar!';
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
        $register_error = "Error: " . $e->getMessage();
    }
}
?>
