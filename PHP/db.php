<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel";

try{
    $conn = new PD0("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PD0::ATR_ERRMODE, value:PD0::ERRMODE_EXCEPTION);
}
catch(PD0Exception $e){
    echo "Koneksi gagal: ". $e->getMassage();
}
?>