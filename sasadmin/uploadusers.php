<?php 
 ob_start();
 session_start();
 if(isset($_GET['start']))
 {
  $start=$_GET['start'];
 }
 else
 {
  $start=0;
 }
 $q_limit=25;

 $filePath="uploadusers.php";

 require_once("../config/config.inc.php");

 require_once("../functions.inc.php");

 isAdminOn('');

 $PG_TITLE = "Upload New Users File";
 //checking for edit or new one and inserting to database
 $uploadedStatus = 0;
 
 if(isset($_POST['add_edit']))
 {
     if ( isset($_FILES["filepath"])) {
		//if there was an error uploading the file
		if ($_FILES["filepath"]["error"] > 0) {
		  echo "Return Code: " . $_FILES["filepath"]["error"] . "<br />";
		}
		else {
		
			if (file_exists('../uploadedusers/'.$_FILES["filepath"]["name"])) {
			  unlink('../uploadedusers/'.$_FILES["filepath"]["name"]);
			}
			
		    $storagename = 'users.xls';
		    move_uploaded_file($_FILES["filepath"]["tmp_name"],  '../uploadedusers/'.$storagename);
		    $uploadedStatus = 1;
		}
		
	 } else {
	 
	   echo "No file selected <br />";
	 }
 }
 
?>
<html>
<head>
<title><?php echo $bizConfig['siteName']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../images/favicon.gif"/>
<SCRIPT language="JavaScript1.2" src="../includes/main.js"type="text/javascript"></SCRIPT>
<SCRIPT language="JavaScript1.2" src="../includes/style.js"type="text/javascript"></SCRIPT>
<!--- ckeditor starts --->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>

<!--- ckeditor ends --->
<script language="javascript1.1">
//alert message for delete
function delete_record(fid)
{
	if(confirm("Are you sure to delete this File?"))
	{
		document.location.href='userfiles.php?del='+fid;
	}
}

function validateForm()
{
var count=0;
var msg="";
    for(i=0;i<=4;i++)
    {
        if(document.frm_add_edit.elements[i].value=="")
        {
        count=1;
        msg=msg+"\n"+document.frm_add_edit.elements[i].name;
        }
        else if((i>3) && (count==0))
        {
            return(true);
        }
    }
	
    for(i=0;i<=4;i++)
    {
        if(document.frm_add_edit.elements[i].value=="")
        {
        alert("PLEASE FILL IN THE FOLLOWING FIELD(S)\n "+msg);
        document.frm_add_edit.elements[i].focus();
        
		return(false);
		
        }
    }
}
</script>
<script language="javascript">

function validate1()
{
	var a=document.frm_add_edit.cat_name.value;

	if (a == "") { 

	alert("Please Enter Category Name ");

	document.frm_add_edit.cat_name.focus();

  	return false;
  	}
}
</script>
</head>
<body topmargin="0" leftmargin="0" rightmargin="0">
<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-300"></DIV>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="27%"><?php include ("header.inc.php")?></td>
</tr>	
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr align="center">
<td colspan="2">
	<table width="95%"  border="0" cellspacing="0" cellpadding="0">
 	<tr>
    <td align="right"></td>
    </tr>
    <tr>
    <td align="right" height="30"><table align="center"><tr><td valign="top"><strong class="red_txt"><?php display_session_msg();?></strong></td></tr></table></td>
    </tr>
    </table>
</td>
</tr>
<tr align="center">
<td colspan="2">
	<div style="width:95%"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td width="192" height="42" valign="top"><?php include("left.inc.php");?></td>
    <td width="20"><img src="images/spacer.gif" width="20"></td>
    <td width="100%" valign="top">
	<?php 
	if(isset($_REQUEST['status']) && !empty($_REQUEST['status']) && $_REQUEST['status']=='Upload') 
	{   
	    $errarray=array();
		
	    set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
		include 'PHPExcel/IOFactory.php';

		// This is the file path to be uploaded.
		$inputFileName = '../uploadedusers/users.xls'; 

		try {
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

		for($i=1;$i<=$arrayCount;$i++){

		  $emailFilter ="/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
		  
		  $firstName = trim($allDataInSheet[$i]["A"]);
		  $lastName = trim($allDataInSheet[$i]["B"]);
		  $userEmail = trim($allDataInSheet[$i]["C"]);
		  //$userName = trim($allDataInSheet[$i]["D"]);
		  
		  if( isset($firstName) && $firstName =='' && isset($userEmail) && $userEmail =='' ){		     
			 
		  }
		  else if( isset($firstName) && $firstName =='' || isset($userEmail) && $userEmail =='' ){
		     
			 $str='<span style="color: red;">First Name, Email Id Fields should not be empty!</span>'; echo "<br>";
					 
			 array_push($errarray,$str);
		  }
		  else{
  		   
		    if( !empty($userEmail) && $userEmail !='' && preg_match($emailFilter,$userEmail) ){
									
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$password = substr( str_shuffle( $chars ), 0, 6 );
			 
			$fName = substr( $firstName, 0, 3 );
			$lName = substr( $lastName, 0, 3 );
			
			$usrName = strtolower($fName.$lName); 
						
			$query = "SELECT * FROM sas_users WHERE username = '".$usrName."'";
			$sql = mysql_query($query);
			$recResult = mysql_fetch_array($sql);
            
			if( mysql_num_rows($sql) > 0 ){	
		    
				$uname=substr($recResult["username"],0,6);
				$no = substr($recResult["username"],6);
				$k = intval($no);
				$l=$k;
				$l++;
				if( $k == 1 ){					
				   $k++;
				   $userName =$uname.$k;
				}else{
				   $userName =$uname.$i;
				}
				
				//array_push($errarray,'true ,'.$userName);	
				
			}else{

			    if( strlen( $usrName < 6 ) ){
			
					$randstr = substr( str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 6 );
					$usrName=$usrName.$randstr; 
					$userName = strtolower(substr( $usrName, 0, 6 ));
				}
                //array_push($errarray,'else ,'.$userName);				
            }			
			
			$query2 = "SELECT * FROM sas_users WHERE email = '".$userEmail."'";
			$sql2 = mysql_query($query2);
			$recResult2 = mysql_fetch_array($sql2);
			
			$existEmail = $recResult2["email"];
            
			$query3 = "SELECT * FROM sas_users WHERE username = '".$userName."' and  email = '".$userEmail."'";
			$sql3 = mysql_query($query3);
			$recResult3 = mysql_fetch_array($sql3);
			
			if( mysql_num_rows($sql2) > 0 ){
			
			    $str='<span style="color: red;">Registration failed for User = '.$userName.', E-Mail Id = '.$userEmail.' already exists.</span>'; echo "<br>";
			     
			    array_push($errarray,$str);				
				
			}else if( mysql_num_rows($sql3) > 0 ){
			    
			    $str='<span style="color: red;">Registration failed for User = '.$userName.', User Name = '.$userName.' and E-Mail Id = '.$userEmail.' already exists.</span>'; echo "<br>";
			     
			    array_push($errarray,$str);
				
			}else if( mysql_num_rows($sql2) == 0 && mysql_num_rows($sql3) == 0 ) {
                
				$str='<span style="color: green;">Registration successful for User = '.$userName.', with E-Mail Id= '.$userEmail.'.</span>'; echo "<br>";
			    
				array_push($errarray,$str);
				$passWord=trim($password);
				$query = "insert into sas_users(first_name,last_name,photopath,email,username,password,subscribe_status,date_added,status) values('".$firstName."','".$lastName."','profile.png','".$userEmail."','".$userName."','".$passWord."',1,now(),1)";
						
				if(mysql_query($query)){
				
				  $subject = "Your Self-Aware Stories Account Details";
				  $message = "
					<html>
					  <body bgcolor='#DCEEFC'>					   
					    <p><b>Hello $firstName</b>,<br><br>
						   Thank you for registering with Self-Aware Stories! We hope that your journey with us is long and rewarding.<br> 
                           Below please find your account details.
						</p>
						<table>
						<tr><td style='font-weight:bold;'>User Name</td><td style='width:2px;'>:</td><td>$userName</td></tr>
						<tr><td style='font-weight:bold;'>Password</td><td style='width:2px;'>:</td><td>$passWord</td></tr>						
						<tr><td style='font-weight:bold;'>Login URL</td><td style='width:2px;'>:</td><td><a href='http://selfawarestories.in/login.php' target='_blank'>www.selfawarestories.in/login.php</a></td></tr>
						<tr><td style='font-weight:bold;'>Website URL</td><td style='width:2px;'>:</td><td><a href='http://selfawarestories.in/' target='_blank'>www.selfawarestories.in</a></td></tr>
					  </table>
					  <p>
					     If you run into any issues while using our website please contact us at <b> <a href='mailto:support@selfawarestories.in'>support@selfawarestories.in</a> </b> <br>
                         We are very much looking forward to working with you!
                      </p>
					  <p>
					     Sincerely,<br> 
                         Self-Aware Stories Team
					  </p>	 
					  </body>
					</html>
					";

                 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 // More headers
				 $headers .= 'From: Self-Aware Stories <support@selfawarestories.in>' . "\r\n";
				 				 
			     mail($userEmail,$subject,$message,$headers);	
				
				}

				$_SESSION['sessionMsg'] = 'Users have been added successfully.';
			
			}	
			
			  }else{
				   
				   $str='<span style="color: red;">Invalid Email Id Formate for = '.$userEmail.'</span>'; echo "<br>";
					 
				   array_push($errarray,$str);
			  }		  
		  }
		  
		  if(!empty($errarray)){
			
		  }else{
			   //header('location:manage_users.php');
		  }
			
		  
		  
		}			
		
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
      <tr>
        <td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1">
	<!--display when user lands on the page-->									
		<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
			<td width="50%" class="h2">
			<img src="images/heading_icon.gif" width="16" height="16" hspace="5">
			<span class="verdana_small_white">Uploaded Users</span>
			</td>
			<td width="18%" align="right">
			<table  cellpadding=1 cellspacing=2 id=toplinks>
             <tr>
              <td width="50" >													
              <a href="uploadusers.php?Call=edit" class="blue_txt">Add&nbsp;New&nbsp;Users&nbsp;File</a>															</td>
             </tr>
            </table>
          </td>
        </tr>
      </table>
      </td>
     </tr>
	 <tr><td align="center" valign="top" bgcolor="#EEEEEE">

		<table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">

		<TD width="10%" align="center"  class="header_row"><a class="whiteTxtlink">S.No</a></TD>

		<td  width="90%" align="center"   class="header_row" >Registration Status<a/></td>
	
        </tr>
  	    <?php		  
		  for($j=0;$j<sizeof($errarray);$j++){		 
		?>
		 <tr bgcolor = "#FFF">
			<TD align="center" class="gray_txt"><?php print($j+1);?></TD>
			<TD align="center" class="gray_txt"><?php print_r($errarray[$j]);?></TD>
		</tr>
		<?php } ?>
		</table></td></tr></table>
	<?php }
				  //display for edit or new starts here
		else {
	?>
		<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
          <tr>
            <td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1">
	<!--display when user lands on the page-->									
			<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
				<td width="50%" class="h2">
				<img src="images/heading_icon.gif" width="16" height="16" hspace="5">
				<span class="verdana_small_white"><?php echo $PG_TITLE;?></span></td>
			  </tr>
            </table>
			</td>
		    </tr>		
			<tr><td align="center" valign="top" bgcolor="#EEEEEE">
			<form name="frm_add_edit" method="post" action="" enctype="multipart/form-data" onSubmit="return validate1" >
			<!--Table displaying edit/new part-->
			<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
			<!--
			<tr class="header_row">
				<td colspan="3" align="left"> Upload File </td>
			</tr>
			-->
			<?if(isset($uploadedStatus) && $uploadedStatus == 1){ ?>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>Status<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				  <span style="color:green">File Uploaded Successfully</span> &nbsp;&nbsp;&nbsp;<b>Do you want to upload the data? <a href='uploadusers.php?status=Upload'>Click Here</a> </b>
				</td>
			</tr>
			<?php }?>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>File<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<br><br>
				<input name="filepath" type="file" class="textbox" id="prod_image" size="30" value="" required />
				<br><br>
				<span class="featured" style="color:red;">*</span> ( Upload Excel File data with Column's Values as First Name, Last Name, Email Id )
				</td>
			</tr>
            
			<tr>
				<td align="right" bgcolor="#FFFFFF" height="40"></td>
				<td width="70%" align="left" bgcolor="#FFFFFF">
					<input type="submit" name="add_edit" value="Upload" class="buttons" onClick="return validate1();" />&nbsp;&nbsp;
					<input type="button" name="back" value="Back" class="buttons" onClick="javascript:history.back()">	
				</td>
		    </tr>
		</table>
		</form>
		<?php }?>
        <br>
</td></tr>
			</table>
	</td>
    </tr>
    </table></div>
<br>
<br>
</td>
</tr>
<tr>
<td height="1" colspan="2"><?php include ("footer.inc.php")?></td>
</tr>
</table>
</body>
</html>



		
        <br>
</td></tr>
			</table>
	</td>
    </tr>
    </table></div>
<br>
<br>
</td>
</tr>
<tr>
<td height="1" colspan="2"><?php include ("footer.inc.php")?></td>
</tr>
</table>
</body>
</html>


