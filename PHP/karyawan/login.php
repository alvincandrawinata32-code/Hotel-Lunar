<?php
// Logic login karyawan dan manager
// Dipanggil oleh login_office/html/login1.php

session_start();

require_once __DIR__ . '/../db.php';

$login_office_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pegawai = $_POST['nama_pegawai'];
    $jabatan = $_POST['jabatan'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM pegawai WHERE nama_pegawai = :nama AND jabatan = :jabatan AND password = :password");
    $stmt->bindParam(':nama', $nama_pegawai);
    $stmt->bindParam(':jabatan', $jabatan);
    $stmt->bindParam(':password', $password);

    try {
        $stmt->execute();
        $pegawai = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($pegawai) {
            $_SESSION['id_pegawai'] = $pegawai['id_pegawai'];
            $_SESSION['nama_pegawai'] = $pegawai['nama_pegawai'];
            $_SESSION['jabatan'] = $pegawai['jabatan'];

            if ($pegawai['jabatan'] === 'manager') {
                header('location: /Hotel_Lunar/back-office/html/manager1.php');
            } else {
                header('location: /Hotel_Lunar/back-office/html/office1.php');
            }
            exit;
        } else {
            $login_office_error = 'Nama, Jabatan, atau Password salah!';
        }
    } catch (PDOException $e) {
        $login_office_error = "Error: " . $e->getMessage();
    }
}
?>
