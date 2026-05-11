<?php
require_once 'db.php';
$salt1 = "qm&h*";
$salt2 = "pg!@";

$username = 'Haikal';
$password = 'haikal123';
$role = 'user';
$token = sha1("$salt1$password$salt2");

try {
  $sql = "INSERT INTO user (username,password,role) 
          VALUES ('$username','$token','$role')";
  $conn->exec($sql);

  echo "Data user pertama telah ditambahkan. <br>";
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
