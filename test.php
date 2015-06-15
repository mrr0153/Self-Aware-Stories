<?php
 
 //include the S3 class
 if (!class_exists('S3'))require_once('S3.php');
			
 //AWS access info
 if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJTLFEK3XO5LGOJTA');
 if (!defined('awsSecretKey')) define('awsSecretKey', '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');
			
 //instantiate the class
 $s3 = new S3(awsAccessKey, awsSecretKey);
	
 if(isset($_POST['submit']))
 {
    //extract($_POST);
    
    if(isset($_FILES['files']['name'])){
	        
	     for($i=0;$i<sizeof($_FILES['files']['name']);$i++)
         {		    
            $fileTempName = $_FILES['files']['tmp_name'][$i];
            $type = $_FILES['files']['type'][$i];
            $fileName = $_FILES['files']['name'][$i];
            $size = $_FILES['files']['size'][$i];
			
            
               if(is_uploaded_file($fileTempName))
               {
                    //move the file
					if ($s3->putObjectFile($fileTempName, "sas-test", $fileName, S3::ACL_PUBLIC_READ)) {
						echo "<strong>We successfully uploaded your file.</strong>";
						//mysql_query("update sas_users set first_name='$firstname',last_name='$lastname',email='$email',password='$password',photopath='$fileName',subscribe_status='$subscribe',date_added='now()' where user_id=$_SESSION[uid]");
						
					}else{
						echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
						//$msg="<span style='color:red;'>Sorry, this image format is not supported. Choose another.</span>";	
					}	
               }
             
         }
	 
	 } 
  }
	
?>	

<form method="post" enctype="multipart/form-data">
 <br><br>
 Choose Files : <input type="file" name="files[]" value="Upload" multiple> 
 <br><br>
 <input type="submit" name="submit" value="Submit"  >
</form>