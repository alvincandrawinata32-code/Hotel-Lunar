<?php
include "../db.php";

$id = $_GET['id'];

$conn->query("DELETE FROM tamu WHERE id_tamu=$id");

header("Location: index.php");
?>