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

 $PG_TITLE = 'Upload New Users File';
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
	if(isset($_REQUEST['status'])) 
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

			$firstName = trim($allDataInSheet[$i]["A"]);
			$lastName = trim($allDataInSheet[$i]["B"]);
			$userEmail = trim($allDataInSheet[$i]["C"]);
			$userName = trim($allDataInSheet[$i]["D"]);
			$password = trim($allDataInSheet[$i]["E"]);

			$query = "SELECT username FROM sas_users WHERE username = '".$userName."' and email = '".$userEmail."'";

			$sql = mysql_query($query);
			$recResult = mysql_fetch_array($sql);

			$existName = $recResult["username"];

			if($existName=="") {
                
				$query = "insert into sas_users(first_name,last_name,email,username,password,subscribe_status,date_added,status) values('".$firstName."','".$lastName."','".$userEmail."','".$userName."','".$password."',1,now(),1)";
						
				$insertTable= mysql_query($query);

				$_SESSION['sessionMsg'] = 'Users have been added successfully.';
			
			} else {
			    
			    $str='User Name ='.$existName.' and E-Mail = '.$userEmail.' already exist.'; echo "<br>";
			     
			    array_push($errarray,$str);
			}
			
			if(!empty($errarray)){
			
			}else{
			   header('location:manage_users.php');
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
              <a href="uploadusers.php?Call=edit" class="blue_txt">Add&nbsp;New&nbsp;File&nbsp;</a>															</td>
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

		<td  width="90%" align="center"   class="header_row" >Error<a/></td>
	
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
			<tr class="header_row">
				<td colspan="3" align="left"> Upload File </td>
			</tr>
			<?if(isset($uploadedStatus) && $uploadedStatus == 1){ ?>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>Status<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				  <span style="color:green">File Uploaded Successfully</span> &nbsp;&nbsp;&nbsp;<b>Do you want to upload the data <a href='uploadusers.php?status=Upload'>Click Here</a> </b>
				</td>
			</tr>
			<?php }?>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>File<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="filepath" type="file" class="textbox" id="prod_image" size="30" value=""/>
				
				</td>
			</tr>
            
			<tr>
				<td align="right" bgcolor="#FFFFFF" height="40"></td>
				<td width="70%" align="left" bgcolor="#FFFFFF">
					<input type="submit" name="add_edit" value="Save Data" class="buttons" onClick="return validate1();" />&nbsp;&nbsp;
					<input type="reset" name="cancel" value="Reset" class="buttons" />
					<input type="button" name="back" value="Back" class="buttons" onClick="javascript:history.back()">					</td>
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


