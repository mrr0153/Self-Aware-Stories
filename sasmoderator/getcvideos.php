<?php
error_reporting(0);
 //session_start();
include("../config/config.inc.php");
/**** Pagination ********/
  $qs=$_REQUEST['qs'];
  
  $data=mysql_query("SELECT * FROM photoevents WHERE gcatid='$qs' order by eventid  ");
  
  while($row = mysql_fetch_object($data)){
       $eventid.= $row->eventid.',';
       $eventname.= $row->eventname.',';
          
   }
    echo $eventid.'-'.$eventname;
    //echo $eventname;
	
  // return $eventname;
  
?>  

  