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
$q_limit=10;
$filePath="user_manager.php";
require_once("../config/config.inc.php");
include("../config/class.phpmailer.php");
//require_once("../includes/commonfunc.php");
require_once("../functions.inc.php");
isAdminOn('');
//////////////////////
// Page Title
//////////////////////
$PG_TITLE = 'User Manager';
if(isset($_POST['add_edit']))
{
extract($_POST);
if(isset($act))
{
 $upsql="UPDATE `saloon_regusers` SET 
`status` = '$Status' WHERE `user_id`=$_REQUEST[id]";
mysql_query($upsql);
$_SESSION['sessionMsg']='User Updated successfully';

header("Location: user_manager.php");
exit;
}
}
if(isset($_REQUEST["del"]))
{
 $id=$_REQUEST["del"];
 $delete="delete from saloon_regusers WHERE user_id='".$_REQUEST["del"]."'";
 $delete_query=mysql_query($delete);
 $_SESSION['sessionMsg']='user deleted Successfully';
 header("Location: user_manager.php");
 exit;
 }
?>

<html>
<head>
<title><?=$bizConfig['siteName']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../images/favicon.gif"/>
<script language="javascript1.1">
function delete_record(id)
{
	if(confirm("Are you sure to delete this user?"))
	{
		document.location.href='user_manager.php?del='+id;
	}
}
</script>
<SCRIPT language="JavaScript1.2" src="../includes/main.js"type="text/javascript"></SCRIPT>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0">
<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-300"></DIV>
<SCRIPT language="JavaScript1.2" src="../includes/style.js" type="text/javascript"></SCRIPT>
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
	<?php if((!isset($_REQUEST['id']))&&(!isset($_REQUEST['Call'])) )
										{?>
			<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
              						<tr>
                						<td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1">
											<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    							<tr>
													<td width="41%" class="h2">
													<img src="images/heading_icon.gif" width="16" height="16" hspace="5">
														<span class="verdana_small_white"><?php echo $PG_TITLE;?></span>													</td>
												  
													
												</tr>
                							</table>
										</td>
									</tr>
									
									<tr><td align="center" valign="top" bgcolor="#EEEEEE">
									
								    <table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">
									
										<TD width="10%" align="center" class="header_row"><a class="whiteTxtlink">User Name</a></TD>
											<td  width="14%" align="center"   class="header_row" ><a class="whiteTxtlink" >Email</a></td>
											<td  width="14%" align="center"  class="header_row" ><a class="whiteTxtlink" >Date Added </a></td>
											<!--<td  width="14%" align="left"  class='white_bold' ><a class="whiteTxtlink" >Privileges</a></td>-->
											<td  width="9%" align="center" class="header_row" ><a class="whiteTxtlink" >Status</a></td>
											<td  width="14%" align="center"  class="header_row" >Action</td>
											
                      					</tr>
										<?php
									if(isset($_POST[search_option])&&($_POST[search_option]!="")&&($_POST['search']==""))
										{
			                           $sql="SELECT * FROM saloon_regusers order by $_POST[search_option] limit $start,$q_limit";
									   $no_rows= mysql_num_rows(mysql_query($sql));
										  }
		else if ((isset($_POST['search_option'])&&($_POST['search_option']!="")&&($_POST['search']!=""))){
										  
						 $sql="SELECT * FROM saloon_regusers  where  $_POST[search_option] like '%$_POST[search]%' 
						 limit $start,$q_limit";
						  $no_rows= mysql_num_rows(mysql_query($sql));
										  }
										  else
										  {
										  $sql="SELECT * FROM saloon_regusers where user_type='".unpaid."' ";
										  $no=mysql_query($sql);
										  $no_rows= mysql_num_rows($no);
										  $sql="SELECT * FROM saloon_regusers where user_type='".unpaid."'  limit $start,$q_limit";
										  }
			                             $rs=mysql_query($sql);
										 
										     $i=0;
											while($line=mysql_fetch_array($rs))
											{
															
												if($bgcolor=="#FFFFFF") $bgcolor="#F7F7F7";
												else $bgcolor="#FFFFFF";
												$i++;
												
									    ?>
									 <tr bgcolor = <?=$bgcolor?>>
										<TD align="left" class="gray_txt" valign="top"><?=$line['name']?></TD>
										<TD class="gray_txt" valign="top"><?=$line['email']?></TD>
										<TD class="gray_txt" valign="top"><?=$line['date_added']?></TD>
										
										<TD align="center" class="gray_txt" valign="top"><? if($line['status']=='1'){echo 'active';}else{echo 'inactive';}?></TD>
										
										<td class="gray_txt" width="14%" valign="top" align="center">
											<a href="user_manager.php?Call=edit&pri=allow&id=<?=$line['user_id']?>" class="links">Edit</a>
											<span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;
											<a href="javascript:delete_record('<?=$line['user_id']?>')" class="links">Delete</a>
										</td>
										
									 </tr>
									 
									   <?php  } ?>
									 <tr bgcolor="#F7F7F7">
										<td align="right" colspan="8">&nbsp;</td>
									</tr>
									<tr align="center"  bgcolor="#FFFFFF">
                        				<td colspan="8" class="gray_txt" align="right">
										<?php paginate($start,$q_limit,$no_rows,$filePath,"");?></td>
                     				</tr>
									<?php if($i==0){ ?>
                     				 <tr align="center"  bgcolor="#FFFFFF">
                        				<td colspan="8" class="gray_txt"><?php print "Records are not Available." ?></td>
                     				 </tr>
                      						<?php } ?>
                  </form>
				  <!--table1 ends-->
				  </table></td></tr></table>
				  <?php }else { ?>
				  <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
				  <tr>
                						<td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1">
											<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    							<tr>
													<td width="41%" class="h2">
													<img src="images/heading_icon.gif" width="16" height="16" hspace="5">
														<span class="verdana_small_white"><?php echo $PG_TITLE;?></span>													</td>
												 
													
												</tr>
                							</table>
										</td>
									</tr>
				  <?php if(isset($_REQUEST['id']))
				  {
			$sql = "SELECT * FROM saloon_regusers  where user_id=$_REQUEST[id] and user_type='".unpaid."'";
		    $rs = mysql_query($sql);
	        $res=mysql_fetch_array($rs);
			extract($res);	
			}		
			?>
			<tr><td align="center" valign="top" bgcolor="#EEEEEE">
			<form name="frm_add_edit" method="post" action=""  onSubmit="return validateForm();">
			<?php if(isset($_REQUEST['id']))
				  { ?>
				  
				  <input type="hidden" name="act" value="edit">
				  <?php }?>
						<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
			<tr class="header_row">
				<td colspan="3" align="left">User Edit:</td>
			</tr>
			
			<?php if(isset($_GET['msg']) && $_GET['msg']=='error') { ?><tr><td class="red_txt" align="center" valign="middle" colspan="3" bgcolor="#EEEEEE"><strong>User already exists</strong></td></tr><?php } ?>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> First Name<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<?php print($name);?>			</td>
			</tr>
			<!--<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Last Name<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<?php print($lastname);?>			</td>
			</tr>-->
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Email ID<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<?php print($email);?>			</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong>Username<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<?php print($username);?>		</td>
			</tr>
			
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Address1 <span class="featured"></span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><?php print($address1);?></td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Address2 <span class="featured"></span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><?php print($address2);?></td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Address 3<span class="featured"></span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><?php print($address3);?></td>
			</tr>
			
			
			<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Phone No. <span class="featured"></span> :</strong></td>
			  <td align="left" bgcolor="#F7F7F7"><?php print($phone);?></td>
			  </tr>
				<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Zip code <span class="featured"></span> :</strong></td>
			  <td align="left" bgcolor="#F7F7F7"><?php print($zipcode);?></td>
			  </tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Status<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="Status" type="radio"  value="0" <?php if($status =='0'){echo 'checked';} ?>//>Inactive
					<input name="Status" type="radio"  value="1"<?php if($status =='1'){echo 'checked';} ?>/>Active				</td>
			</tr>
			<tr>
				<td align="right" bgcolor="#FFFFFF" height="40"></td>
				<td width="70%" align="left" bgcolor="#FFFFFF">
					<input type="submit" name="add_edit" value="Save Data" class="buttons" />&nbsp;&nbsp;
					<input type="reset" name="cancel" value="Cancel" class="buttons" />
					<a href="user_manager.php"><input type="button" name="back" value="Back" class="buttons" onClick="javascript:history.back();"></a>					</td>
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
