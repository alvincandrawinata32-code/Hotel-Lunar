<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATR_ERRMODE, value:PD0::ERRMODE_EXCEPTION);
}
catch(PD0Exception $e){
    echo "Koneksi gagal: ". $e->getMassage();
}
?>