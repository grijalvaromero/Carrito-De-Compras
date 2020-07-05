<?php 
session_start();
unset($_SESSION['datos_login']);
header("Location: ../index.php");

?>