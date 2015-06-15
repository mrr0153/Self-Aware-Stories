<?php
/*
 require_once("../config/config.inc.php");

 $query = "SELECT * FROM sas_users WHERE username = 'MegViv'";
 $sql = mysql_query($query);
 $recResult = mysql_fetch_array($sql);

 //echo $existName = $recResult["username"];
 */
 $userName ='use';
 
 if(strlen($userName<6)){
			
	$string = substr( str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 6 );
	$uname=$userName.$string; echo "<br>";
	echo $string = substr( $uname, 0, 6 );
 }

 

 echo $uname = substr("userna",0,6);echo "<br>";
 echo $no = substr("userna",6); echo "<br>";
 echo 'count = '.$k= intval($no);echo "<br>";
 echo $k++;echo "<br>";
 echo $uname.$k;

 
?>