<?php
// Ambil semua data pegawai dari database
// Dipanggil dari halaman back-office manager3.php (Daftar Karyawan)

require_once __DIR__ . '/../db.php';

$stmt = $conn->query("SELECT id_pegawai, nama_pegawai, jabatan FROM pegawai ORDER BY jabatan");
$data_karyawan = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
