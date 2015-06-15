<?php

session_start();

require_once("../config/config.inc.php");

$username = htmlspecialchars(trim($_POST['username_admin']));

$password = htmlspecialchars(trim($_POST['password_admin']));

$sql="SELECT admin_id from sas_moderators where username='$username' and password='$password' and status='1'";

$result = mysql_query($sql);
if (mysql_num_rows($result)>0)
{
	$row=mysql_fetch_array($result);

	$_SESSION['moderatorId']=$row['admin_id'];

    header("Location: admin_desktop.php");

	exit;
}
else
{
	header("Location: index.php?invalid=1");

	exit;
}

?>