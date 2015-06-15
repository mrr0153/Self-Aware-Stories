<?php
  session_start();
  require_once("config/config.inc.php");
  
  if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )){		
   
	if (isset($_SESSION['uname']) AND !empty($_POST['txt-comment']) AND !empty($_POST['cid'])) {

		$comment = mysql_real_escape_string($_POST['txt-comment']);
		$cid = mysql_real_escape_string($_POST['cid']);
			
		mysql_query("update sas_comment set comment='$comment',date=now() where id='$cid'") or die(mysql_error());	  
	    
		echo $cid.'|||'.$comment;
    }
  }
?>