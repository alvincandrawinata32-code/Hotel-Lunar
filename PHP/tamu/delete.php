<?php
include "../koneksi.php";
$db = new Database();
$conn = $db->conn;

$id = $_GET['id'];

$conn->query("DELETE FROM tamu WHERE id_tamu=$id");

header("Location: index.php");
?>