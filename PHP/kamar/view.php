<?php

require_once __DIR__ . '/../db.php';

$stmt = $conn->query("SELECT id_kamar, tipe_kamar, harga FROM kamar ORDER BY harga ASC");
$data_kamar = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
