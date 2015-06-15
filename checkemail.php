<?php
  include('config/config.inc.php');
?>
<?php

  error_reporting(E_ALL);
  
  $qs=$_REQUEST['qs'];
  
  if(!empty($qs)){
     
     $data=mysql_query("select email from sas_users where email='$qs'");

     $rc=mysql_num_rows($data);

     if($rc==0){
         
        echo "";
     }

     else{ 
        echo '<span style="color:red">Email id is already existed, please choose another !</span>';
     }
    }
  else{    
     echo '<span style="color:red">Please enter an email id </span>';
   }    
?>  

  