<?php
require_once "../db.php";
if (count($_POST) > 0){
    try{
        $sql = "INSERT INTO reservasi VALUES ('$_POST[reservasi]')";

        $conn->exec($sql);
        $id_terakhir=$conn->lastInsertID();
        header("Location: view.php?id=".$id_terakhir);
    } catch (PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}
?>