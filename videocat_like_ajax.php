<?php
require_once("config/config.inc.php");
session_start();

if(isset($_POST['vcid']) && isset($_POST['rel']))
{   
	$vcid=mysql_real_escape_string($_POST['vcid']);
    $rel=mysql_real_escape_string($_POST['rel']);
	$uid=$_SESSION['uid']; // User login session id
	
	if($rel=='Like')
	{
		//---Like----
		$q=mysql_query("SELECT like_id FROM video_like WHERE uid_fk='$uid' and vcid_fk='$vcid' ");
		
		if(mysql_num_rows($q)==0)
		{  
			$query=mysql_query("INSERT INTO video_like (vcid_fk,uid_fk) VALUES('$vcid','$uid')");
			$q=mysql_query("UPDATE sas_themecategories SET like_count=like_count+1 WHERE cat_id='$vcid'") ;
			$g=mysql_query("SELECT like_count FROM sas_themecategories WHERE cat_id='$vcid'");
			$d=mysql_fetch_array($g);
			echo $d['like_count'];
		}
	}
	else
	{
		//---Unlike----
		$q=mysql_query("SELECT like_id FROM video_like WHERE uid_fk='$uid' and vcid_fk='$vcid' ");
		if(mysql_num_rows($q)>0)
		{
			$query=mysql_query("DELETE FROM video_like WHERE vcid_fk='$vcid' and uid_fk='$uid'");
			$q=mysql_query("UPDATE sas_themecategories SET like_count=like_count-1 WHERE cat_id='$vcid'");
			$g=mysql_query("SELECT like_count FROM sas_themecategories WHERE cat_id='$vcid'");
			$d=mysql_fetch_array($g);
			echo $d['like_count'];
		}
	} 
}

?>