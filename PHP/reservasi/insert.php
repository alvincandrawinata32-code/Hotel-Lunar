<?php
session_start();
require_once "../db.php";

if (count($_POST) > 0) {
    try {
        // 1. Ambil data dari form
        $nama       = $_POST['nama'];
        $telp       = $_POST['telp'];
        $email      = $_POST['email'];
        $checkin    = $_POST['checkin'];
        $checkout   = $_POST['checkout'];
        $tipe_kamar = $_POST['kamar'];

        // DEBUG - hapus setelah berhasil
        echo "checkin: $checkin | checkout: $checkout | kamar: $tipe_kamar <br>";

        // 2. Insert tamu
        $sql = "INSERT INTO tamu (nama, alamat, email, no_telp) 
                VALUES ('$nama', '-', '$email', '$telp')";
        $conn->exec($sql);
        $id_tamu = $conn->lastInsertId();
        echo "id_tamu: $id_tamu <br>";

        // 3. Cari id_kamar
        $result = $conn->query("SELECT id_kamar FROM kamar 
                                WHERE tipe_kamar = '$tipe_kamar' LIMIT 1");
        $kamar    = $result->fetch(PDO::FETCH_ASSOC);

        // DEBUG
        echo "hasil query kamar: ";
        var_dump($kamar);

        $id_kamar = $kamar['id_kamar'];
        echo "id_kamar: $id_kamar <br>";

        // 4. Insert reservasi
        $sql = "INSERT INTO reservasi (id_kamar, id_tamu, tanggal_checkin, tanggal_checkout) 
                VALUES ('$id_kamar', '$id_tamu', '$checkin', '$checkout')";
        $conn->exec($sql);
        $id_terakhir = $conn->lastInsertId();

        header("Location: view.php?id=" . $id_terakhir);
        exit;

    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}
?>