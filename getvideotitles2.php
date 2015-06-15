<?php

    session_start();
	require_once("config/config.inc.php");
	
	$cid = $_POST['cid'];    
		
	if(isset($_POST['q'])){
	    
		$q = addslashes($_POST['q']);
		
		$sql="SELECT * FROM sas_videos WHERE cat_id = $cid and prod_name like '%$q%' ";
		$result = mysql_query($sql) or die(mysql_error());
		
		$vtitles='';
		while($row = mysql_fetch_array($result)) {
			
			$vtitles.=stripslashes($row['prod_name']) . "||||";
			
		}
		
		echo $vtitles;
	
	}else{
	
	    $sql="SELECT * FROM sas_videos WHERE cat_id = $cid ";
		$result = mysql_query($sql) or die(mysql_error());
		
		$vtitles='';
		while($row = mysql_fetch_array($result)) {
			
			$vtitles.=stripslashes($row['prod_name']). "||||";
			
		}
		
		echo $vtitles;	   
	}
?>