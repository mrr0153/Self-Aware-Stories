<?php

  error_reporting(0);
  
  $qs=trim($_REQUEST['qs']);
  //echo $qs;
  if(!empty($qs)){
  
     $data=mysql_query("select username from sas_users where username='$qs' and status='1' ");
     $rslt=mysql_fetch_row($data);
	 //echo $rslt;
     $rc=mysql_num_rows($rslt);
     //echo 'rc='.$rc;
	 
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
