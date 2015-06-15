<?php 
 ob_start();
 session_start();

 $start=0;

 $q_limit=10;

 $filePath="admin_manager.php";

 require_once("../config/config.inc.php");
 
 require_once("../functions.inc.php");

 //isAdminOn('');
 
 $PG_TITLE = 'Manage Profile';

 
 //include the S3 class
 if (!class_exists('S3'))require_once('../S3.php');
			
 require_once("../config/awsKeys.php");
			
 //instantiate the class
 $s3 = new S3(awsAccessKey, awsSecretKey); 
 
 //checking for edit or new one and inserting to database
 if(isset($_POST['add_edit'])){
		
	extract($_POST);
    
    //////////////////////////////////Image Uploading//////////
    if($_FILES['photopath']['name']!="")
	{
	     $fileName ='mod'.date("His").'_'.$_FILES['photopath']['name'];
		 $fileTempName=$_FILES['photopath']['tmp_name'];
		 //move the file
		 if ($s3->putObjectFile($fileTempName, "moderator-photos", $fileName, S3::ACL_PUBLIC_READ)) {
			//echo "<strong>We successfully uploaded your file.</strong>";					
		    
		 }else{
			//echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
			$_SESSION['sessionMsg']="Sorry, Image Name should not contain white spaces.";
		}	
	}
	else
	{
	   $fileName=$prev_photopath;
	}
		  
		$upsql="UPDATE `sas_moderators` SET 

			`password` = '$password',

			`first_name` = '$firstName',

			`last_name` = '$lastName',

			`email` = '$email',
			
			`photopath` = '$fileName',
            
			`date_added` = now(),
			
			`status` = '$status' WHERE `admin_id`=$_SESSION[moderatorId]";

		 mysql_query($upsql);
		 
		 $_SESSION['sessionMsg']='Profile Updated successfully';		
	    
		 header("Location: admin_manager.php");

         exit;
 }

 
 

?>
<html>

<head>

<title><?=$bizConfig['siteName']?></title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="../images/favicon.gif"/>
<link href="css/css.css" rel="stylesheet" type="text/css">

<SCRIPT language="JavaScript1.2" src="../includes/main.js"type="text/javascript"></SCRIPT>

<SCRIPT language="JavaScript1.2" src="../includes/style.js"type="text/javascript"></SCRIPT>

<script language="javascript1.1">

//alert message for delete

 function delete_record(id){

	if(confirm("Are you sure to delete this Adminstrator?"))
	{
		document.location.href='admin_manager.php?del='+id;
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
				
		<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
		<tr>

		<td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1">

	<!--display when user lands on the page-->									

	    <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">

		<tr>

		<td width="50%" class="h2">

		<img src="images/heading_icon.gif" width="16" height="16" hspace="5">

		<span class="verdana_small_white"><?php echo $PG_TITLE;?></span>													</td>

		</tr>
        
		</table>

		</td>

		</tr>

		<?php

		//checks it is editing 

		if(isset($_SESSION['moderatorId'])){

			$sql = "SELECT * FROM sas_moderators  where admin_id=".$_SESSION['moderatorId'];

		    $rs = mysql_query($sql);

	        $res=mysql_fetch_array($rs);

			extract($res);	

		}		
        ?>

		<tr><td align="center" valign="top" bgcolor="#EEEEEE">

		<form name="frm_add_edit" method="post"  enctype="multipart/form-data" action=""  onSubmit="return validateForm();">
	
		<!--Table displaying edit/new part-->

		<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
            <tr class="header_row">
			 <td colspan="3" align="left">&nbsp; </td>
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> User Name<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<p><?php if(isset($username)){ print($username);}?><p/>
				</td>
			</tr>		

			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Password<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="password" type="password" class="textbox" id="section_data" size="30" value="<?php if(isset($password)){  print($password);}?>"/>
				</td>
			</tr>		

			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> First Name<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="firstName" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($first_name)){  print($first_name);}?>"/>
				</td>
			</tr>

			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Last Name<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="lastName" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($last_name)){  print($last_name);}?>"/>
				</td>
			</tr>

			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Email<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="email" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($email)){  print($email);}?>"/>
				</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>Photo<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7" valign="middle">
				 <input name="photopath" type="file" style=" padding: 15px 5px;"class="textbox" id="prod_image" size="30" />
				 <input type="hidden" name="prev_photopath" value="<?php if(isset($photopath)) print($photopath);?>"/>
				 <img width="100" height="80" src="https://s3-us-west-2.amazonaws.com/moderator-photos/<?php if(isset($photopath) && !empty($photopath) ){  print($photopath);} else{ echo "images/account.png";}?>"/>
				
				</td>
			</tr>
           
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Status<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="status" type="radio"  value="0"<?php if(isset($status)=='0'){echo 'checked';}?>/>Inactive
					<input name="status" type="radio"  value="1"<?php if(isset($status)=='1'){echo 'checked';}?>/>Active
				</td>
			</tr>

			<tr>
				<td align="right" bgcolor="#FFFFFF" height="40"></td>
				<td width="70%" align="left" bgcolor="#FFFFFF">
					<input type="submit" name="add_edit" value="Save Data" class="buttons" />&nbsp;&nbsp;
					<input type="reset" name="cancel" value="Reset" class="buttons" />
					<input type="button" name="back" value="Back" class="buttons" onClick="javascript:history.back()">
					</td>
		    </tr>
		</table>
		</form>
		
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