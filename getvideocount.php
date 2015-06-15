<?php
 session_start();
 error_reporting(0);
 require_once("config/config.inc.php");
 
 if(isset($_REQUEST['vcid'])){
  	   
	 $uid=$_SESSION['uid'];	
	 $vcid=$_REQUEST['vcid'];	
	 
	 $g=mysql_query("SELECT * FROM sas_uservideos WHERE uid='$uid' and vcid='$vcid'");
	 $rows=mysql_num_rows($g);
	 $d=mysql_fetch_array($g);
	 //print_r($d);
	 extract($d); 		 
	 //echo 'count='.$video_count; 
	 
	 if($rows > 0){
	    echo $rows.'|||'.$video_count; 
	 }else{
	    echo '0|||0';
	 }
 }
 ?>