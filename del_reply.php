<?php
 require_once("config/config.inc.php");
 
 $id=$_REQUEST['id'];
 
 if(isset($_REQUEST['id'])){ 
 
   mysql_query("delete from sas_comment_replies WHERE rid='".$_REQUEST["id"]."'");
 } 
?>