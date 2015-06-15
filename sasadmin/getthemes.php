<?php
error_reporting(0);
 //session_start();
require_once("../config/config.inc.php");;
/**** Pagination ********/
  $qs=$_REQUEST['qs'];
  
  $data=mysql_query("SELECT * FROM sas_themes WHERE cat_id='$qs' order by prod_id ");
  
  while($row = mysql_fetch_object($data)){
       $prod_id.= $row->prod_id.',';
       $prod_name.= $row->prod_name.',';
          
   }
    echo $prod_id.'-'.$prod_name;
    //echo $eventname;
	
  // return $eventname;
  
?>  

  