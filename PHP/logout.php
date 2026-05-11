<?php
session_start();
$_SESSION = array();
setcookie(session_name(), '', time() - 2592000, '/');
setcookie('username', '', time() - 2592000, '/');
setcookie('role',     '', time() - 2592000, '/');
session_destroy();

header('location: login.php');
exit;
?>