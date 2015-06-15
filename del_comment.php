<?php
 require_once("config/config.inc.php");
 
 $id=$_REQUEST['id']; 
 $delete="delete from sas_comment WHERE id='".$_REQUEST["id"]."'";
 if(mysql_query($delete)){
 
   mysql_query("delete from sas_comment_replies WHERE cmtid='".$_REQUEST["id"]."'");
 }
 
?>