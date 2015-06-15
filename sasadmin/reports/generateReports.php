<?php
  require_once("../sasadmin/config/config.inc.php");

  $reportdata=mysql_query("select * from sas_userqtnansws where uid='$_REQUEST[uid]'");
  
  $count=mysql_num_rows();
  
  if($count>0){
	  while( $rslt=mysql_fetch_array($reportdata)){
	  
	     print_r($rslt);
	  }
  }
  
?>