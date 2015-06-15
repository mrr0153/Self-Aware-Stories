<?php
require_once("config/config.inc.php");
session_start();

if(isset($_POST['vid']) && isset($_POST['rel']))
{   
	$cpvid=mysql_real_escape_string($_POST['vid']);
    $rel=mysql_real_escape_string($_POST['rel']);
	$uid=$_SESSION['uid']; // User login session id
	
	if($rel=='Like')
	{
		//---Like----
		$q=mysql_query("SELECT like_id FROM video_like WHERE uid_fk='$uid' and cpvid_fk='$cpvid' ");
		if(mysql_num_rows($q)==0)
		{  //echo "entered";
			$query=mysql_query("INSERT INTO video_like (cpvid_fk,uid_fk) VALUES('$cpvid','$uid')") ;
			$q=mysql_query("UPDATE sas_copvideos SET like_count=like_count+1 WHERE id='$cpvid'") ;
			$g=mysql_query("SELECT like_count FROM sas_copvideos WHERE id='$cpvid'");
			$d=mysql_fetch_array($g);
			echo $d['like_count'];
		}
	}
	else
	{
		//---Unlike----
		$q=mysql_query("SELECT like_id FROM video_like WHERE uid_fk='$uid' and cpvid_fk='$cpvid' ");
		if(mysql_num_rows($q)>0)
		{
			$query=mysql_query("DELETE FROM video_like WHERE cpvid_fk='$cpvid' and uid_fk='$uid'");
			$q=mysql_query("UPDATE sas_copvideos SET like_count=like_count-1 WHERE id='$cpvid'");
			$g=mysql_query("SELECT like_count FROM sas_copvideos WHERE id='$cpvid'");
			$d=mysql_fetch_array($g);
			echo $d['like_count'];
		}
	} 
}
?>