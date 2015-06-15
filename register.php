<?php
session_start();
include('config/config.inc.php');
?>
<?php
 if(isset($_POST['sub']))
 {
   extract($_POST);
   //print_r($_POST);
   $fname=$_POST['firstname'];
   $lname=$_POST['lastname'];
   $email=$_POST['email'];
   $uname=$_POST['username'];
   $pwd=$_POST['password'];
   $subscribe_status=$_POST['subscribe'];   
   
   $_SESSION['uname']=$uname;
  
   
   if(is_uploaded_file($_FILES['file1']['tmp_name'])){

	  $filename =date("His").'_'.$_FILES['file1']['name'];
	  	   		   
	  move_uploaded_file($_FILES['file1']['tmp_name'],'user_photos/'.$filename);
	}   
    if(mysql_query("insert into sas_users(user_id,first_name,last_name,email,username,password,photopath,subscribe_status,date_added,status) values('','$fname','$lname','$email','$uname','$pwd','$filename','$subscribe_status',NOW(),'$status')"))
     {
      /*header('location:welcome.php'); */
	
       echo "<script type='text/javascript'>window.location.href='index.php'</script>";
	
    }
    else{
	
       $msg="User name alredy existed !";
       echo "<script type='text/javascript'>window.location.href='signup.php?msg=$msg'</script>";	  
    }		
      
     // echo "<script type='text/javascript'>window.location.href='signup.php'</script>";
  }  

?>