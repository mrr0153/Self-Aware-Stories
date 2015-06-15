<?php
require_once("config/config.inc.php");
session_start();

if(isset($_POST['cid']) && isset($_POST['rel']))
{   
    $cmtid=mysql_real_escape_string($_POST['cmtid']);
    $cid=mysql_real_escape_string($_POST['cid']);
    $rel=mysql_real_escape_string($_POST['rel']);	
	$uid=$_SESSION['uid']; 
	//echo 'cmtid='.$cmtid.'cid='.$cid.'rel='.$rel;
	
	if($rel=='Like')
	{
		//---Like----
		$q=mysql_query("SELECT like_id FROM comment_like WHERE cmtid_fk='$cmtid' and uid_fk='$uid' ");
		if(mysql_num_rows($q)==0)
		{  //echo "entered";
		    
			$query=mysql_query("INSERT INTO comment_like (cmtid_fk,cid_fk,uid_fk) VALUES('$cmtid','$cid','$uid')") ;
		    
			$q=mysql_query("UPDATE sas_comment SET like_count=like_count+1 WHERE id='$cmtid'") ;
			$g=mysql_query("SELECT like_count FROM sas_comment WHERE id='$cmtid'");
			$d=mysql_fetch_array($g);
			echo $d['like_count'];
		}
	}
	else
	{
		//---Unlike----
		$q=mysql_query("SELECT like_id FROM comment_like WHERE cmtid_fk='$cmtid' and uid_fk='$uid' ");
		if(mysql_num_rows($q)>0)
		{
			$query=mysql_query("DELETE FROM comment_like WHERE cmtid_fk='$cmtid' and uid_fk='$uid'");
			$q=mysql_query("UPDATE sas_comment SET like_count=like_count-1 WHERE id='$cmtid'");
			$g=mysql_query("SELECT like_count FROM sas_comment WHERE id='$cmtid'");
			$d=mysql_fetch_array($g);
			echo $d['like_count'];
		}
	} 
}
?>