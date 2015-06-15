<?php
   
	set_time_limit(0);
    require_once("../config/config.inc.php");
	
	$cid = $_POST['cid'];    
		
	$sql="SELECT * FROM sas_videos WHERE cat_id = $cid ";
	$result = mysql_query($sql) or die(mysql_error());
		
	$vids='';
	$vtitles='';
	while($row = mysql_fetch_array($result)) {
		
		$vids.=$row['id']. "|||";	
		$vtitles.=stripslashes($row['prod_name']). "|||";			
	}
		
	echo $vids.'@@@'.$vtitles;	   
	
?>