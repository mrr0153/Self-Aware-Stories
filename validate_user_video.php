<?php
include('config/config.inc.php');
?>

<?php
  error_reporting(0);
  
  $qs=trim($_REQUEST['qs']);
 
  if(!empty($qs)){
      
     $data=mysql_query("select * from sas_users where username='$qs' and status='1' ");
    
     $rc=mysql_num_rows($data);
      
     if($rc==1){
	 
      echo "";
       
     }
     else{    
    
	   echo '<span style="color:red">Invalid user name </span>';
   }
    
    }
  else{    
     echo '<span style="color:red"> Please enter user name </span>';
   }    
?>  
