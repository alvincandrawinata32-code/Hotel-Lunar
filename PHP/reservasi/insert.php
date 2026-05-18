<?php
require_once "../db.php";

if (count($_POST) > 0) {

    try {
        // Ambil data dari form
        $nama       = $_POST['nama'];
        $telp       = $_POST['telp'];
        $email      = $_POST['email'];
        $checkin    = $_POST['checkin'];
        $checkout   = $_POST['checkout'];
        $tipe_kamar = $_POST['kamar'];

        // Insert tamu
        $stmt = $conn->prepare("
            INSERT INTO tamu (nama, telp, email) 
            VALUES (?, ?, ?)
        ");

        $stmt->execute([
            $nama,
            $telp,
            $email
        ]);

        $id_tamu = $conn->lastInsertId();

        // Cari kamar berdasarkan tipe kamar
        $stmt = $conn->prepare("
            SELECT id_kamar 
            FROM kamar 
            WHERE tipe_kamar = ? 
            LIMIT 1
        ");

        $stmt->execute([$tipe_kamar]);

        $kamar = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$kamar) {
            die("Kamar tidak ditemukan");
        }

        $id_kamar = $kamar['id_kamar'];

        // Insert reservasi
        $stmt = $conn->prepare("
            INSERT INTO reservasi
            (id_tamu, id_kamar, tanggal_checkin, tanggal_checkout)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([
            $id_tamu,
            $id_kamar,
            $checkin,
            $checkout
        ]);

        $id_reservasi = $conn->lastInsertId();

        header("Location: view.php?id=" . $id_reservasi);
        exit;

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>