<?php
session_start();
unset($_SESSION['adminId']);
header("Location:index.php");
?>
