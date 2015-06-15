<?php
 require_once("config/config.inc.php");
 
 $jid=$_REQUEST['jid'];
 
 $delete="delete from sas_myjournal WHERE jid='".$_REQUEST["jid"]."'";
 $delete_query=mysql_query($delete);
 
?>