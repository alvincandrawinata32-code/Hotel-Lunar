<?php
session_start();
session_unset();
session_destroy();
header('Location: /Hotel_Lunar/login_office/html/login1.php');
exit;
?>
