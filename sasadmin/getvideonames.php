<?php
error_reporting(0);
 //session_start();
include("../config/config.inc.php");

  $cid=$_REQUEST['cid'];
  
  if(!empty($cid)){
      
    $data=mysql_query("SELECT * FROM sas_videos WHERE cat_id='$cid' order by id  ");
         
    while($row = mysql_fetch_object($data)){
       $id.= $row->id.',';
       $prod_name.= stripslashes($row->prod_name).',';
          
    }
    echo $id.'---'.$prod_name;
    
   }
?>  

  