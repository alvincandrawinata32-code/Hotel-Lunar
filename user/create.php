<?php
//require_once '../checkuser.php';
require_once "../db.php";


function encryptPassword($password) {
    $salt1 = "qm&h*";
    $salt2 = "pg!@";
    return sha1($salt1 . $password . $salt2);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $verify_password = $_POST['verify_password'];

    if ($password !== $verify_password) {
        echo "Password dan konfirmasi password tidak cocok.";
        exit;
    }

    $encrypted_password = encryptPassword($password);

    $sql = "INSERT INTO user (username, password, role) VALUES (:username, :password, :role)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $encrypted_password);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        echo "User berhasil ditambahkan";
    } else {
        echo "Error: Gagal menambahkan user.";
    }
}
?>

<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Verify Password: <input type="password" name="verify_password" required><br>
    <input type="submit" value="Tambah User">
</form>
