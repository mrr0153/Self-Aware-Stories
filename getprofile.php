<?php

session_start();
require_once("config/config.inc.php");
error_reporting(0);

  $qs=$_REQUEST['qs'];
  $charimgqry="select * from sas_characters where id='$qs'";
  $rslt=mysql_query($charimgqry); 

  $rlt=mysql_fetch_array($rslt);
  extract($rlt);	   
 
 echo $title.'---'.$photopath.'---'.$description;
?>
 