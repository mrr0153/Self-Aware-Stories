<?php  include('config/config.inc.php');?><?php
  error_reporting(E_ALL);  
  $qs=$_REQUEST['qs']; 
  $data=mysql_query("select email from sas_users where email='$qs'") or die(mysql_error());
  $rc=mysql_num_rows($data);
  if($rc==0){
   echo '';
   }
  else echo 'Email id already existed, Please choose another!'; 
?>  
  