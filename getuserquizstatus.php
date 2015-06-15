<?php
 session_start();
 error_reporting(0);
 require_once("config/config.inc.php");
  
 $uid=$_SESSION['uid'];	
 
 if(isset($_REQUEST['vcid'])){  	   
 
   $vcid=$_REQUEST['vcid'];	
 }
 if(isset($_REQUEST['vid'])){  	   
 
   $vid=$_REQUEST['vid'];	
 }
 if(isset($_REQUEST['cpvid'])){  	   
 
   $cpvid=$_REQUEST['cpvid'];	
 }
 if(isset($_REQUEST['vtype'])){  	   
 
   $vtype=$_REQUEST['vtype'];	
 }
 if($vtype=='svideo'){
   $qdata=mysql_query("SELECT * FROM sas_userquiz WHERE uid='$uid' and vcid='$vcid' and vid='$vid' ");
 }
 if($vtype=='cvideo'){
   $qdata=mysql_query("SELECT * FROM sas_userquiz WHERE uid='$uid' and vcid='$vcid' and cpvid='$cpvid' ");
 }
 
 $rows=mysql_num_rows($qdata);
 $qrslt=mysql_fetch_array($qdata);
 //print_r($qrslt);
 extract($qrslt); 		 
  
 if($rows > 0){
 
  if($status==0){
   echo 0; 
  }
  if($status==1){
   echo 1; 
  }
  
 }else{
 
 echo 1;
 
 }
 
 ?>