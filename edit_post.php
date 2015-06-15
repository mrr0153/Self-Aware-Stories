<?php

session_start();
require_once("config/config.inc.php");
 $jid=$_REQUEST['jid'];
 $title=$_REQUEST['ttl'];
 
if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )){	
	 //$description=$_POST['description'];	 
	 if ( isset($_SESSION['uid']) AND !empty($jid))  {
		
		$uid = mysql_real_escape_string($_SESSION['uid']);
		$title = mysql_real_escape_string($_REQUEST['ttl']);
		$desc = mysql_real_escape_string($_REQUEST['desc']);
		
		mysql_query("update sas_myjournal set description='$desc',topictitle='$title'  where jid=".$_REQUEST['jid']) or die(mysql_error());			
	    
		echo $_REQUEST['jid'].'|||||'.$title .'|||||'.$desc;
    }	
    
 }
?>