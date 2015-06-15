<?php
 session_start();
 require_once("config/config.inc.php");
 $uid=$_REQUEST['uid'];
 $rid=$_REQUEST['rid'];
 mysql_query("UPDATE sas_userreadings SET status=1, readon=now() WHERE uid='$uid' and rid='$rid'") ;

?>