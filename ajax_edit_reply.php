<?php
  session_start();
  require_once("config/config.inc.php");
  
  if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )){		
   
	if (isset($_SESSION['uid']) AND !empty($_POST['txt-comment']) AND !empty($_POST['rid'])) {

		$comment = mysql_real_escape_string($_POST['txt-comment']);
		$rid = mysql_real_escape_string($_POST['rid']);
			
		mysql_query("update sas_comment_replies set reply='$comment',replieddate=now() where rid='$rid'") or die(mysql_error());	  
	    
		$udtdata=mysql_query("select replieddate from sas_comment_replies where rid='$rid' ");		
		$udtrslt=mysql_fetch_array($udtdata);
		
		echo $rid.'|||'.$comment.'|||'.$udtrslt['replieddate'];
    }
  }
?>