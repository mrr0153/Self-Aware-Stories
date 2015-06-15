<?php
  include('config/config.inc.php');
?>
<?php

  error_reporting(E_ALL);
  
  $qs=$_REQUEST['qs'];
  
  if(!empty($qs)){
     $data=mysql_query("select username from sas_users where username='$qs'");

     $rc=mysql_num_rows($data);

     if($rc==0){
         
        return "";
     }

     else{ 
        echo '<span style="color:red">User name is already existed, please choose another !</span>';
     }
    }
  else{    
     echo '<span style="color:red">Please choose user name</span>';
   }    
?>  

  