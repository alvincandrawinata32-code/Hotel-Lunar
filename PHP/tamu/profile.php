<?php
// Ambil data profil tamu yang sedang login
// Dipanggil oleh profile/html/userprofile.php

session_start();

if (!isset($_SESSION['id_tamu'])) {
    header('location: /Hotel_Lunar/login/html/login1.php');
    exit;
}

require_once __DIR__ . '/../db.php';

$stmt = $conn->prepare("SELECT * FROM tamu WHERE id_tamu = ?");
$stmt->execute([$_SESSION['id_tamu']]);
$tamu = $stmt->fetch(PDO::FETCH_ASSOC);
?>
