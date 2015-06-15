<?php
    session_start();
    require_once("config/config.inc.php");

	if(isset($_REQUEST['uname']) && $_REQUEST['pwd'] !='')
	 { 
		$uname=mysql_real_escape_string($_REQUEST['uname']);
		$pwd=mysql_real_escape_string($_REQUEST['pwd']);
		$result=mysql_query("select * from sas_users where username='$uname' and password='$pwd'");
		$count=mysql_num_rows($result);
		if($count==1)
		{
		  $rslt=mysql_fetch_array($result);
		  extract($rslt);
		//print_r($rslt);
						 
		  $_SESSION['aut']=true;
						 
		  $_SESSION['uname']=$uname;
						 
		  $_SESSION['uid']=$user_id;
		  
		  echo "correct";
		} 
		else{
		
		  echo "error";
		
		}
	}	
?>