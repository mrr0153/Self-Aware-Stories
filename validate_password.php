<?php
  include('config/config.inc.php');

  error_reporting(0);
  
  $uname=trim($_REQUEST['qs']);
  
  $pwd=trim($_REQUEST['qs2']);
  
  
  if(!empty($uname) && !empty($pwd) ){
      
     $data=mysql_query("select * from sas_users where username='$uname' and password='$pwd' and status='1' ") or die(mysql_error());
    
     $rc=mysql_num_rows($data);
      
     if($rc==1){
	 
      echo "";
       
     }
     else{    
    
	   echo 'Invalid password';
    }
    
  }  
  else if(!empty($uname) && empty($pwd) ){

       echo 'Invalid password';
  }
  else if(empty($uname) && !empty($pwd) ){

       echo 'Invalid user name';
  } 
  else{    
       echo 'Please enter password';
  }    
?>  
