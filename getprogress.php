<?php
	  require_once("config/config.inc.php");
      session_start();
      $vcid=$_REQUEST['vcid'];
	  $vsql=mysql_query("select * from sas_uservideos where uid='".$_SESSION['uid']."' and vcid='$vcid'");
	  $vrslt=mysql_fetch_array($vsql);
	  $video_count=$vrslt['video_count'];
	  $totalvideos=20;
	  
	  if($totalvideos > 0){
	  
         $percentageSize= ($video_count * 100) / 20;
         $backgroundSize=$percentageSize*1;
      
	  }else{
         $backgroundSize=0;
      }
	   echo $backgroundSize.'%';
	  	  
	?>