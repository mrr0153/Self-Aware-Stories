<?php
require_once("config/config.inc.php");
session_start();

if(isset($_POST['rid']) && isset($_POST['rel']))
{   
    $rid=mysql_real_escape_string($_POST['rid']);
    $cmtid=mysql_real_escape_string($_POST['cmtid']);    
    $rel=mysql_real_escape_string($_POST['rel']);	
	$uid=$_SESSION['uid']; 
	//echo 'cmtid='.$cmtid.'rid='.$rid.'rel='.$rel;
	
	if($rel=='Like')
	{
		//---Like----
		$q=mysql_query("SELECT like_id FROM reply_comment_like WHERE rplid_fk='$rid' and uid_fk='$uid' ");
		if(mysql_num_rows($q)==0)
		{  //echo "entered";
		    
			$query=mysql_query("INSERT INTO reply_comment_like (rplid_fk,cmtid_fk,uid_fk) VALUES('$rid','$cmtid','$uid')") ;
		    $q=mysql_query("UPDATE sas_comment_replies SET like_count=like_count+1 WHERE rid='$rid'") ;
			$g=mysql_query("SELECT like_count FROM sas_comment_replies WHERE rid='$rid'");
			$d=mysql_fetch_array($g);
			echo $d['like_count'];
		}
	}
	else
	{
		//---Unlike----
		$q=mysql_query("SELECT like_id FROM reply_comment_like WHERE rplid_fk='$rid' and uid_fk='$uid' ");
		if(mysql_num_rows($q)>0)
		{
			$query=mysql_query("DELETE FROM reply_comment_like WHERE rplid_fk='$cmtid' and uid_fk='$uid'");
			$q=mysql_query("UPDATE sas_comment_replies SET like_count=like_count-1 WHERE rid='$rid'");
			$g=mysql_query("SELECT like_count FROM sas_comment_replies WHERE rid='$rid'");
			$d=mysql_fetch_array($g);
			echo $d['like_count'];
		}
	} 
}
?>