<?php
require_once "../db.php";

if (count($_POST) > 0) {
    try {
        $nama  = $_POST['nama'];
        $telp  = $_POST['telp'];
        $email = $_POST['email'];

        $sql = "INSERT INTO tamu (nama, alamar, email, no_telp) 
                VALUES ('$nama', '-', '$email', '$telp')";
        $conn->exec($sql);
        $id_tamu = $conn->lastInsertId();

        header("Location: insert_reservasi.php");
        exit;

    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}
?>