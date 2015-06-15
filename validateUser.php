<?php

	   include('config/config.inc.php');
	   session_start();
 
	   $uname=trim($_REQUEST['username']);
	   $pwd=trim($_REQUEST['password']);
	   
	   $result=mysql_query("select * from sas_users where username='$uname' and password='$pwd'") or die(mysql_error());
	   $count=mysql_num_rows($result);
	  
	   if($count==1){
	   
		 $rslt=mysql_fetch_array($result);
		 extract($rslt);
		 //print_r($rslt);
		 
		 $_SESSION['aut']=true;	 
		 $_SESSION['uid']=$rslt['user_id'];
		 $_SESSION['uname']=$uname;
		 
		 echo '';
		 
		}
		else{

		  echo "error";		 
       }		

?>
	  