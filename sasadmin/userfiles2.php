<?php 
 ob_start();
 session_start();
 if(isset($_GET['start']))
 {
   $start=$_GET['start'];
 }
 else{
  $start=0;
 }
 $q_limit=25;

 $filePath="userfiles.php";

 require_once("../config/config.inc.php");

 //require_once("../includes/commonfunc.php");

 require_once("../functions.inc.php");

 isAdminOn('');

 $PG_TITLE = 'Readings';

 //include the S3 class
 if (!class_exists('S3'))require_once('../S3.php');
			
 //AWS access info
 if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJTLFEK3XO5LGOJTA');
 if (!defined('awsSecretKey')) define('awsSecretKey', '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');
			
 //instantiate the class
 $s3 = new S3(awsAccessKey, awsSecretKey); 
 
 //checking for edit or new one and inserting to database

 if(isset($_POST['add_edit']))
 {
  extract($_POST);
  
  //print_r($_POST);
  
  if(isset($act))  
  {
        if(is_uploaded_file($_FILES['filepath']['tmp_name'])){
		     
		     $fileName ='file'.date("His").'_'.$_FILES['filepath']['name'];
			 $fileTempName=$_FILES['filepath']['tmp_name'];
			 //move the file
			 if ($s3->putObjectFile($fileTempName, "sas-userfiles", $fileName, S3::ACL_PUBLIC_READ)) {
				//echo "<strong>We successfully uploaded your file.</strong>";					
				$upsql="UPDATE `sas_userfiles` SET `uid`= '$uid',`ftitle`='".addslashes($ftitle)."',`filepath`= '$fileName',`uid`= '$uid',`date_added`=now(),`status`='$Status' where `fid`='$fid'";
          
				mysql_query($upsql);

				$_SESSION['sessionMsg']='File Updated successfully';				
				
			 }else{
				//echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
				$_SESSION['sessionMsg']="Sorry, Image Name should not contain white spaces.";
			}
			
		 } else {
		 
			    $fileName = $prev_file;
			
			    $upsql="UPDATE `sas_userfiles` SET `uid`= '$uid',`ftitle`='".addslashes($ftitle)."',`filepath`= '$fileName',`uid`= '$uid',`date_added`=now(),`status`='$Status' where `fid`='$fid'";
          
				mysql_query($upsql);

				$_SESSION['sessionMsg']='File Updated successfully';
		 } 
 
          header("Location:userfiles.php?uid=$uid");

          exit;
 
   } else{
             		  
		  $fileName ='file'.date("His").'_'.$_FILES['filepath']['name'];
		  $fileTempName=$_FILES['filepath']['tmp_name'];
		  //move the file
		  if ($s3->putObjectFile($fileTempName, "sas-userfiles", $fileName, S3::ACL_PUBLIC_READ)) {
			  //echo "<strong>We successfully uploaded your file.</strong>";					
		      if(mysql_num_rows(mysql_query("select * from sas_userfiles  where ftitle='$ftitle' and uid='".$_REQUEST["uid"]."'"))==0)
			  {
			    $inssql="INSERT INTO `sas_userfiles` (`ftitle`,`filepath`,`uid`,`date_added`, `status` ) VALUES ('$ftitle','$fileName','$uid',now(),'$Status')";
			   
			    mysql_query($inssql);
			   
			    $_SESSION['sessionMsg']='File uploaded created';
			   
			  }else {
			  
			    $_SESSION['sessionMsg']='File Name Exists';
			  }
		  
		  }else{
			//echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
			$_SESSION['sessionMsg']="Sorry, Image Name should not contain white spaces.";
		  }     
        
          header("Location:userfiles.php?uid=$uid&start=$start");
		
          exit;
    }

 }

//function for delete

 if(isset($_REQUEST["del"]))
 {
   
   $sqldel = mysql_query("select * from sas_userfiles WHERE fid='".$_REQUEST["del"]."'");
   $rowdel = mysql_fetch_array($sqldel); 
   
   $delete="delete from sas_userfiles WHERE fid='".$_REQUEST["del"]."'";

   if( $delete_query=mysql_query($delete)){
   
      $s3->deleteObject("sas-userfiles", $rowdel['filepath']);
   }
   
   $_SESSION['sessionMsg']='File deleted Successfully';

   header("Location:userfiles.php?uid=$_REQUEST[uid]&start=$start");

   exit;
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
function delete_record(uid,fid)
{
	if(confirm("Are you sure to delete this File?"))
	{
		document.location.href='userfiles.php?uid='+uid+'&del='+fid;
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
	<?php if((!isset($_REQUEST['fid']))&&(!isset($_REQUEST['Call'])) )
		 {  
		   $urslt=mysql_query("select * from sas_users  where  user_id='".$_REQUEST["uid"]."'");
           $urrslt=mysql_fetch_array($urslt);
		   extract($urrslt);
		 ?>
			<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
              						<tr>
                						<td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1">
	<!--display when user lands on the page-->									
											<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    							<tr>
													<td width="50%" class="h2">
													<img src="images/heading_icon.gif" width="16" height="16" hspace="5">
														<span class="verdana_small_white"><?php echo "<i>".$username."'s</i>&nbsp;&nbsp;".$PG_TITLE;?></span>
													</td>
													<td width="18%" align="right">
														<table  cellpadding=1 cellspacing=2 id=toplinks>
                        									<tr>
                        									  <td width="50" >													

															<a href="userfiles.php?Call=edit&uid=<?php echo $_REQUEST['uid'];?>" class="blue_txt">Add&nbsp;New&nbsp;File&nbsp;</a>															</td>

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

											  <td  width="20%" align="center"   class="header_row" >File Name<a/></td>
                                            <!--
											  <td  width="15%" align="center"   class="header_row" >Theme Image<a/></td>
											 -->											  
											  <td  width="10%" align="center"  class="header_row" ><a class="whiteTxtlink" >Status</a></td>
                                              
											  <td  width="15%" align="center"   class="header_row" >Date<a/></td>
                                           
											<td  width="21%" align="center" class="header_row" >Action</td>

                      					</tr>

										<?php

										 $sql="SELECT * FROM sas_userfiles where uid=$_REQUEST[uid]";
										 $no=mysql_query($sql);
										 $no_rows= mysql_num_rows($no);
										 $sql="SELECT * FROM sas_userfiles  where uid='".$_REQUEST['uid']."' order by fid desc limit $start,$q_limit";

			                             $rs=mysql_query($sql);

										     $i=$start;

											while($line=mysql_fetch_array($rs))

											{
												if(isset($bgcolor) && $bgcolor == "#FFFFFF") $bgcolor="#F7F7F7";

   											    else $bgcolor="#FFFFFF";
												$i++;
									    ?>

										<!--Table displaying all the admin-->
									 <tr bgcolor = <?php echo $bgcolor?>>
										<TD align="center" class="gray_txt"><?php print($i);?></TD>
										<TD align="center" class="gray_txt"><?php echo $line['ftitle']?></TD>
										<!--
										<TD align="center" class="gray_txt"><img src="../<?php echo $line['imagepath']?>" width="100" height="50" ></TD>
										<TD align="center" class="gray_txt"><?php echo $line['vcode']?></TD> 
										-->
										<TD align="center" class="gray_txt"><?php if($line['status']=='0'){echo 'Unread';}else{ echo 'Read';}?></TD>
										<TD align="center" class="gray_txt"><?php echo $line['date_added']?></TD>
										<td class="gray_txt" width="21%" valign="middle" align="center">
										<a href="readfile.php?Call=edit&name=<?php echo $line['filepath']?>" class="links">View</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;
										<a href="userfiles.php?Call=edit&uid=<?php echo $_REQUEST['uid']?>&fid=<?php echo $line['fid']?>" class="links">Edit</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;
										<a href="javascript:delete_record('<?php echo $_REQUEST['uid']?>','<?php echo $line['fid']; ?>')" class="links">Delete</a></tr>
									   <?php } ?>
									 <tr bgcolor="#F7F7F7">
										<td align="right" colspan="8">&nbsp;</td>
									</tr>
									<tr align="center"  bgcolor="#FFFFFF">
                        				<td colspan="8" class="gray_txt" align="right">
										<?php
										//pagination file in config.inc.php 
										paginate($start,$q_limit,$no_rows,$filePath,"");?></td>
                     				</tr>
									<?php if($i==0){ ?>
                     				 <tr align="center"  bgcolor="#FFFFFF">
                        				<td colspan="8" class="gray_txt"><?php print "Records are not Available." ?></td>
                     				 </tr>
                      						<?php } ?>
                  </form>
				  <!--table1 ends-->
				  </table></td></tr></table>
				  <?php }

				  //display for edit or new starts here
			  else { ?>
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
		 <?php
			//checks it is editing 

		 if(isset($_REQUEST['fid']))
		   {

			$sql = "SELECT * FROM sas_userfiles where fid=".$_REQUEST['fid'];
		    $rs = mysql_query($sql);
	        $res=mysql_fetch_array($rs);
			
			extract($res);	
			
			}		
			?>
			<tr><td align="center" valign="top" bgcolor="#EEEEEE">
			<form name="frm_add_edit" method="post" action="" enctype="multipart/form-data" onSubmit="return validate1" >
			<?php  if(isset($_REQUEST['fid']))
				  {
				  //for edit part only
				   ?>
				  <input type="hidden" name="act" value="edit">
				  
				  <input type="hidden" name="fid" value="<?php echo $_REQUEST['fid']?>">
				  <?php }?>
				  <input type="hidden" name="uid" value="<?php echo $_REQUEST['uid']?>">
				  <!--Table displaying edit/new part-->
						<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
			<tr class="header_row">
				<td colspan="3" align="left"> Add /Modify File </td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> File Name<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="ftitle" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($ftitle))print($ftitle);?>"/>				</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>File<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="filepath" type="file" class="textbox" id="prod_image" size="30" value=""/>
				<input type="hidden" name="prev_file" value="<?php if(isset($filepath)){ echo $filepath;}?>">
				<?php if(isset($filepath)){ echo $filepath;}?> 
				</td>
			</tr>
            <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Status: </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				  <input name="Status" type="radio"  value="0"<?php if(isset($status)=='0'){echo 'checked';}?>/>Unread
				  <input name="Status" type="radio"  value="1"<?php if(isset($status)=='1'){echo 'checked';}?>/>Read
				  
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


