<?php
include 'PHP/db.php';

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];

    $query = "INSERT INTO user(username, password, nama_lengkap, email, role)
            VALUES('$username', '$password', '$nama', '$email', 'user')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Register berhasil";
    } else {
        echo "Register gagal";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

    <h2>Register User</h2>

    <form method="POST">

        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <br><br>

        <input type="email" name="email" placeholder="Email" required>
        <br><br>

        <input type="text" name="username" placeholder="Username" required>
        <br><br>

        <input type="password" name="password" placeholder="Password" required>
        <br><br>

        <button type="submit" name="register">Register</button>

    </form>

</body>
</html>