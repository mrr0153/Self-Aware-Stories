<?php
 require_once("config/config.inc.php");
 session_start();

 if(isset($_POST['uid']))
 {   
    $uid=$_SESSION['uid']; // User login session id
	$vcid=$_POST['vcid'];
	$vno=$_POST['vno'];
	
	$q=mysql_query("SELECT video_count FROM sas_uservideos WHERE uid='$uid' and vcid='$vcid'");
	//echo mysql_num_rows($q);	echo "hi";
	$qrslt=mysql_fetch_array($q);
	//print_r( $qrslt );
	$video_count=$qrslt['video_count'];
	if(mysql_num_rows($q)==0)
	{   
	   // echo "INSERT";
	    $query=mysql_query("INSERT INTO sas_uservideos (uid,vcid,video_count) VALUES('$uid','$vcid','1')") ;		
		$g=mysql_query("SELECT video_count FROM sas_uservideos WHERE uid='$uid' and vcid='$vcid'");
		$d=mysql_fetch_array($g);
		$video_count=$d['video_count'];
		
	}else{
	    
	    if( $video_count < $vno  ){
		  //echo "UPDATE";
		  $q=mysql_query("UPDATE sas_uservideos SET video_count=video_count+0.5 WHERE uid='$uid' and vcid='$vcid'") ;
		  $g=mysql_query("SELECT video_count FROM sas_uservideos WHERE uid='$uid' and vcid='$vcid'");
		  $d=mysql_fetch_array($g);
		  $video_count=$d['video_count'];
		} 
	}
	
	$totalvideos=20;
	  
	if($totalvideos > 0){
	
      $percentageSize= ($video_count * 100) / 20;
      $backgroundSize=$percentageSize*1;
      
	}else{
	
       $backgroundSize=0;
    }
	
	echo $backgroundSize.'%';
 }
	
?>