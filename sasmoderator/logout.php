<?php
session_start();
unset($_SESSION['moderatorId']);
header("Location:index.php");
?>
