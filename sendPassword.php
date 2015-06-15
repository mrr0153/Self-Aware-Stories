<?php
   session_start();
   include('config/config.inc.php');

   $data=mysql_query("select email,username,password from sas_users where email='$_REQUEST[email]'");
   $rc=mysql_num_rows($data);
  
   if($rc==1)
   {
    $data=mysql_query("select email,username,password from sas_users where email='$_REQUEST[email]'");
	$rslt=mysql_fetch_array($data);
	extract($rslt);
	
	$to=$email;
   
    $subject = "Your Self-Aware Stories Account Details";
	
    $message = "
	<html>
	  <body bgcolor='#DCEEFC'>
	   <h4>Your Self-Aware Stories Account Details,</h4>
		<table>
		  <tr><td style='font-weight:bold;'>User Name</td><td style='width:2px;'>:</td><td>$username</td></tr>
		  <tr><td style='font-weight:bold;'>Password</td><td style='width:2px;'>:</td><td>$password</td></tr>
		  <tr><td style='font-weight:bold;'>Login URL</td><td style='width:2px;'>:</td><td><a href='http://selfawarestories.in/login.php'>http://selfawarestories.in/login.php</a></td></tr>
		  <tr><td style='font-weight:bold;'>Website URL</td><td style='width:2px;'>:</td><td><a href='http://selfawarestories.in/' target='_blank'>www.selfawarestories.in</a></td></tr>
		</table>
	  </body>
	</html>";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Self-Aware Stories <support@selfawarestories.in>' . "\r\n"; 
	
    if(mail($to,$subject,$message,$headers)){
	  
	  //$msg="Your login details has been sent to your Email Id";
	  echo "";
	}
    
   }
   else{
      echo "error";
	  //$msg1="Please enter your registered Email Id";   
   }
 
 ?>