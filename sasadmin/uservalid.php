<?php
require_once("../config/config.inc.php");
$name=$_GET['uname'];
$qry="select username from e_users WHERE username='$name'";
$query=mysql_query($qry);
$num=mysql_num_rows($query);

if($num==0)
  echo "false";
else
  echo "true";  
?>