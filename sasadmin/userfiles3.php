<?php 
error_reporting(0);
ob_start();
session_start();
//pagination starts
if(isset($_GET['start']))
{
 $start=$_GET['start'];
}
else
{

$start=0;

}

$q_limit=20;

$filePath="product_manager.php";

if(isset($_GET['uid']))

{

$uid=$_GET['uid'];

$otherParams="&type=research&uid=".$uid;

$q_limit=20;

}

else

{

$otherParams='';

}

if(isset($_GET['search'])&&(!isset($_POST['search_option'])))

       {

		$_POST['search_option']=$_GET['search'];

		$_POST['search']="";

	 }

elseif(isset($_POST['search_option']))

{

$otherParams="&search=".$_POST['search_option'];

}

elseif(isset($_POST['search']))

{

$otherParams="&search=".$_POST['search_option']."&searchby=".$_POST['search'];

}

//pagination ends

require_once("../config/config.inc.php");

//require_once("../includes/commonfunc.php");

require_once("../functions.inc.php");

//include("FCKeditor/fckeditor.php");



isAdminOn('');

//////////////////////

// Page Title

//////////////////////

$PG_TITLE = 'Theme Manager';

//checking for edit or new one and inserting to database starts

if(isset($_POST['add_edit']))

{

extract($_POST);
print_r($_POST);

$uid=$_POST['uid'];

$type1=$_GET['type1'];

//for updating

if(isset($act))

{

if(is_uploaded_file($_FILES['filepath']['tmp_name']))
{
  $file123=$_FILES['filepath']['name'];

  move_uploaded_file($_FILES['filepath']['tmp_name'],"../user_files/".$file123);
  
  $filepath=$file123;
}
else 
{
  $file123=$prev_prod_image;  
  $filepath=$prev_prod_image;
  }
  
//print_r($_POST);
//echo "ftitle=".addslashes($ftitle);

 $upsql="UPDATE `sas_userfiles` SET 

	`uid`= '$uid',

	`ftitle`='".addslashes($ftitle)."' ,
   
	`filepath`= '$filepath',

    `uid`= '$uid',

	`status`='$status' where `fid`='$fid'";

    mysql_query($upsql) or die(mysql_error());
	
   $_SESSION['sessionMsg']='User file Updated Successfully';

}

//for new 

else
{
 // print_r($_POST);
  
  $selcat=mysql_query("SELECT * FROM sas_userfiles WHERE ftitle='$ftitle' and uid='$uid'");

  if($norows=mysql_num_rows($selcat)<=0)
  {
    $file123=$_FILES['filepath']['name'];
    $photo123  = $_FILES['filepath']['tmp_name'];
  
	$filepath=$file123;
   
	   move_uploaded_file($_FILES['filepath']['tmp_name'],"../productimages/images/".$file123);
	   
       $inssql="INSERT INTO `sas_userfiles` (`uid` , `ftitle` ,`filepath`,`status`,`date_added`)
       VALUES ( '$uid','".addslashes($ftitle)."' ,'$filepath',,'$status',now()')";

       mysql_query($inssql);

       $_SESSION['sessionMsg']='File Inserted Successfully';

  }
  else
  { 
    header("Location:userfiles.php?uid=$ud&error=1");
    exit;
    //echo "File name already exits";
  }

}

 header("Location:userfiles.php?uid=$uid");

exit;
}
//deleting a course
if(isset($_REQUEST["del"]))
{
 $id=$_REQUEST["del"];
 $uid=$_REQUEST["uid"];
 
 $delete="delete from sas_userfiles WHERE uid=".$_REQUEST['del']; 
 $delete_query=mysql_query($delete);

 $_SESSION['sessionMsg']='File Deleted Successfully';
 header("Location: userfiles.php?uid='$uid'");
 exit;
 }
?>
<html>
<head>
<title><?php echo $bizConfig['siteName']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<SCRIPT language="JavaScript1.2" src="../includes/main.js"type="text/javascript"></SCRIPT>
<script language="javascript" src="../includes/validation.js"></script>
<script language="javascript1.1">
//function for delete alert
function delete_record(fid,uid)
{
	if(confirm("Are you sure to delete this File?"))
	{
		document.location.href='product_manager.php?del='+fid+'&uid='+uid;
	}

}
function formsubmit(id)
{
document.par.pid.value=id;
document.par.submit();
}
function validateForm(f)
{

/*if(!GenValidation(f.product_name,'Product Name','','') || !GenValidation(f.price,'Price','','') || !SelectValidation(f.pid,'Category','0') || !GenValidation(f.price,'Price','','') )

{

		return false;

}else return true;*/

if(document.frm_add_edit.product_name.value=='')
{

alert('please enter the product name');
document.frm_add_edit.product_name.focus();
return false;

}

if(document.frm_add_edit.pid.value=='0')

{

alert('please Select the parent Category');

document.frm_add_edit.pid.focus();

return false;

}

if(document.frm_add_edit.small_image.value=='' && document.frm_add_edit.prev_image.value=='')
{

alert('please Select the Image');

document.frm_add_edit.small_image.focus();

return false;

}

if(document.frm_add_edit.description.value=='')

{
alert('please Select the description');

document.frm_add_edit.description.focus();

return false;

}

if(document.frm_add_edit.price.value=='')

{

alert('please enter the price');

document.frm_add_edit.price.focus();

return false;

}

}
</script>
</head>
<body topmargin="0" leftmargin="0" rightmargin="0">
<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100"></DIV>
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
	<?php 
	if((!isset($_REQUEST['fid']))&&(!isset($_REQUEST['Call'])) )
     {	
        if(isset($_GET['uid'])){
		 $uid=$_GET['uid'];
		
		$rs = mysql_query("select * from sas_users where user_id='$uid'");	
        	
		$res = mysql_fetch_array($rs);														
		}
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
	<tr>
     <td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1"><!--this display first-->
 	 <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
       <form name="search" id="search" action="" method="post">
	   <tr>
	   <td width="39%" class="h2">
       <span class="verdana_small_white"><?php echo '<font color="red">'.$res['username'].'</i></font>';?></span>													</td>
      <!--	<td width="43%" align="center" class="gray_txt">Search By Theme Code: <input type="text" name="book_code"><input type="submit" name="codesearch" value="Search">
		  </td>-->						
		<td width="18%" align="right">
		<table cellspacing=2 cellpadding=1 id=toplinks>
        <tr>
    	  <td>
		  <a href="userfiles.php?Call=edit&uid=<?=$uid?>" class="blue_txt">Add New File </a>
  		  </td>
        </tr>
		</table>
	  </td>
	</tr>
</form>
</table>
</td>
</tr>
<tr><td align="center" valign="top" bgcolor="#EEEEEE">
<?php
 if(isset($_REQUEST['uid'])){
 
?>
<table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">
  <TD width="24%" align="center"  class="header_row"><a class="whiteTxtlink">File Name</a></TD>
 <!--  <TD width="10%" align="center"  class="header_row"><a class="whiteTxtlink">Reading Name</a></TD>  -->
  
  <td  width="10%" align="center"   class="header_row" ><a class="whiteTxtlink" >Status </a></td>
 <!-- <td  width="15%" align="center"   class="header_row" ><a class="whiteTxtlink" ></a></td> -->
  <td  width="30%" align="center"  class="header_row" >Action</td>
</tr>
	<?php
	//sorting of data 
	//echo "hi";
	//if(isset($_POST['uid'])&&($_POST['uid']!=""))
	//{ 
	 $sql="SELECT * FROM  sas_userfiles where uid='$uid' order by fid desc";
	 $no_rows= mysql_num_rows(mysql_query($sql));


     $rs=mysql_query($sql);
     $i=0;
	 	
	while($line=mysql_fetch_array($rs))
	{
	if(isset($bgcolor)=="#FFFFFF") $bgcolor="#F7F7F7";
	else $bgcolor="#FFFFFF";
	$i++;
 ?>
 <tr bgcolor = <?php echo $bgcolor?>>
	<TD align="center" class="gray_txt" ><?php echo stripslashes($line['ftitle']);?></TD>
	<TD class="gray_txt" align="center" ><?php if($line['status']=='1'){echo 'Unread';}else{echo 'Read';}?></TD>
	<td class="gray_txt" width="29%" valign="middle" align="center">
	<a href="userfiles.php?Call=edit&uid=<?php echo $uid?>&fid=<?php echo $line['fid']?>" class="links">Edit</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;<a href="javascript:delete_record('<?php echo $line['fid']; ?>','<?php echo $uid; ?>')" class="links">Delete</a>
	</td>
 </tr>
   <?php  } ?>
	 <tr bgcolor="#F7F7F7">
		<td align="right" colspan="8">&nbsp;</td>
     </tr>
  	 <tr align="center"  bgcolor="#FFFFFF">
  	 <td colspan="8" class="gray_txt" align="right"><?php 

										//pagination

			paginate($start,$q_limit,$no_rows,$filePath,$otherParams);?></td>
   	</tr>
	<?php if($i==0){ ?>
    <tr align="center"  bgcolor="#FFFFFF">
     <td colspan="8" class="gray_txt"><?php print "Records are not Available." ?></td>
    </tr>
	<?php }?></table>	
	</td></tr></table>
 <?php }
  //if the admin wants to edit/create  one record
  else { 
    if(isset($_GET['uid'])){
		 $uid=$_GET['uid'];
		
		$rs = mysql_query("select * from sas_userfiles where uid='$uid'");	
        	
		$res = mysql_fetch_array($rs);														
		}
  ?>
  <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
	<tr>
	<td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1"><!--this display first-->

	<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>

	<td width="65%" class="h2">
	<img src="images/heading_icon.gif" width="16" height="16" hspace="5">
    <span class="verdana_small_white"><?php echo '<i><font color="red">'.$res['ftitle'].'</i></font>';?></span>													</td>
		<td width="17%" align="center"><table width="60" border="0" align="right" cellspacing="1">
    <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td width="37" align="center" valign="middle">&nbsp;</td>
  </tr>
  </table></td>
	</tr>
	</table>

     </td>
	</tr>
		<?php
		  userfilesediting($_REQUEST['fid']);
		?>

<?php }
   }
?>
        <br>
			</table>
	</td>

    </tr>
</table>

<br>

</td>

</tr>

<tr>

<td height="1" colspan="2"><?php include ("footer.inc.php")?></td>

</tr>

</table>

</body>

</html>
