<?php

  error_reporting(0);
  
  $qs=trim($_REQUEST['qs']);
  //echo $qs;
  if(!empty($qs)){
  
     $data=mysql_query("select email from sas_users where email='$qs'");
     $rslt=mysql_fetch_row($data);
	 
     $rc=mysql_num_rows($rslt);
	 
     if($rc==1){
	 
      echo '<span style="color:red"> Please enter user name </span>';
       
     }
     else{    
    
	   echo '<span style="color:red">Invalid user name !</span>';
   }
    
    }
  else{    
     echo '<span style="color:red"> Please enter user name </span>';
   }    
?>  
