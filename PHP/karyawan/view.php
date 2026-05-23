<?php

require_once __DIR__ . '/../db.php';

$stmt = $conn->query("SELECT id_pegawai, nama_pegawai, jabatan FROM pegawai ORDER BY jabatan");
$data_karyawan = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
