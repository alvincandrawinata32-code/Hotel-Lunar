<?php
require "../db.php";
$stmt = $conn->prepare(statement : "SELECT id,id_kamar,id_tamu");
$stmt->execute();
$result = stmt->setFetchMode(Mode:PD0::FETCH_ASS0C);
?>
