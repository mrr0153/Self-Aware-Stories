<?php
require_once("config/config.inc.php");
session_start();

if(isset($_POST['vid']) && isset($_POST['rel']))
{   
    $vid=mysql_real_escape_string($_POST['vid']);
	//$vcid=mysql_real_escape_string($_POST['vcid']);
    $rel=mysql_real_escape_string($_POST['rel']);
	$uid=$_SESSION['uid']; // User login session id
	
	if($rel=='Like')
	{
		//echo "From Like";
		$q=mysql_query("SELECT like_id FROM video_like WHERE uid_fk='$uid' and vid_fk='$vid'  ");
		//echo mysql_num_rows($q);
		if(mysql_num_rows($q)==0)
		{   
			$query=mysql_query("INSERT INTO video_like (vid_fk,uid_fk) VALUES('$vid','$uid')");
			$q=mysql_query("UPDATE sas_videos SET like_count=like_count+1 WHERE id='$vid'") ;
			$g=mysql_query("SELECT like_count FROM sas_videos WHERE id='$vid'");
			$d=mysql_fetch_array($g);
			echo $d['like_count'];
		}
	}
	else
	{
		//echo "From Unlike";
		$q=mysql_query("SELECT like_id FROM video_like WHERE uid_fk='$uid' and vid_fk='$vid' ");
		if(mysql_num_rows($q)>0)
		{   
			$query=mysql_query("DELETE FROM video_like WHERE vid_fk='$vid' and uid_fk='$uid'");
			$q=mysql_query("UPDATE sas_videos SET like_count=like_count-1 WHERE id='$vid'");
			$g=mysql_query("SELECT like_count FROM sas_videos WHERE id='$vid'");
			$d=mysql_fetch_array($g);
			echo $d['like_count'];
		}
	} 
}
?>