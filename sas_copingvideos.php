<?php 
 error_reporting(0);
 ob_start();
 session_start();
 //pagination starts
 if(isset($_GET['start'])){
 
   $start=$_GET['start'];
 }
 else{

   $start=0;
 }
 $q_limit=20;

 $filePath="sas_copingvideos.php";

 if(isset($_GET['pcid']) && isset($_GET['pid'])){

    $pcid=$_GET['pcid'];
    $pid=$_GET['pid'];
    $otherParams="&type=research&pcid=".$pcid."&pid=".$pid;
    $q_limit=20;
 
 }else{

    $otherParams='';
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

 if(isset($_POST['add_edit'])){

    extract($_POST);

    $type1=$_GET['type1'];

    //for updating

   if(isset($act)){

	if(is_uploaded_file($_FILES['prod_image']['tmp_name']))
	{
	  $file123=$_FILES['prod_image']['name'];

	  move_uploaded_file($_FILES['prod_image']['tmp_name'],"../productimages/images/".$file123);
	  
	  $prod_image='productimages/images/'.$file123;
	}
	else 
	{
	  $file123=$prev_prod_image;  
	  $prod_image=$prev_prod_image;
	}
	  
	//print_r($_POST);

	//$fg=print_r($_POST['suggested']);
	 $desc=strip_tags($description);
	 
	 $upsql="UPDATE `sas_copvideos` SET 

		`cat_id`= '$pcid',
		
		`prod_id`= '$pid',
		
		`prod_name`='".addslashes($prod_name)."' ,

		`prod_image`= '$prod_image',
		
		`vcode`= '$vcode',
		
		`cvtype`='$cvtype',
		
		`prod_price`='$price1',

		`description`='".addslashes(stripslashes($desc))."' ,

		`pagetitle`='$pagetitle' ,
		
		`btopics`='$btopics' ,
		
		`tags`='$tags' ,
		
		`mresources`='$mresources' ,
		
		`mkeywords`='$mkeywords' ,

		`mdescription`='$mdescription' ,
		
		`videono`='$videono' ,

		`status`='$status' where `id`='$id'";

		mysql_query($upsql) or die(mysql_error());
		$_SESSION['sessionMsg']='Theme Updated Successfully';
	}
    //for new
    else
    {
	  $selcat=mysql_query("SELECT * FROM sas_copvideos WHERE prod_name='$prod_name' and cat_id='$pcid'");

	  if($norows=mysql_num_rows($selcat)<=0)
	  {
		$file123=$_FILES['prod_image']['name'];
		$photo123  = $_FILES['prod_image']['tmp_name'];
		@list($width, $height, $type, $attr) = getimagesize($photo123);
		
		$prod_image='productimages/images/'.$file123;
	   
		 if($width > 40000) {
		 
			$errMsg=1;
		 } 
		 else { 
		 
		   $desc=strip_tags($description);
	 
		   move_uploaded_file($_FILES['prod_image']['tmp_name'],"../productimages/images/".$file123);
		   $inssql="INSERT INTO `sas_copvideos` (`cat_id` ,`prod_id` , `prod_name` ,`prod_image`,`vcode`,`cvtype`,`prod_price`,`description` ,`pagetitle`,`btopics`,`tags`,`mresources`,`mkeywords`,`mdescription`,`status`,`date_added`,`prod_type`,`videono`)
		   VALUES ( '$pcid','$pid','".addslashes($prod_name)."','$prod_image','$vcode','$cvtype','$price1','".addslashes($desc)."','$pagetitle','$btopics','$tags','$mresources','$mkeywords','$mdescription','$status',now(),'".$_GET['type1']."','$videono')";

		   mysql_query($inssql) or die(mysql_error());

		   $_SESSION['sessionMsg']='Theme Inserted Successfully';

		 }

	  }
	  else
	  { 
		header("Location:sas_copingvideos.php?pcid=$pcid&pid=$pcid&type=$type1&error=1");
		exit;
		//echo "Course name already exits";
	  }

   }

   header("Location:sas_copingvideos.php?pcid=$pcid&pid=$pid");

   exit;
 }
 //deleting a course
 if(isset($_REQUEST["del"])) {
 
    $id=$_REQUEST["del"];
    $pid=$_REQUEST["pid"];
    $pcid=$_REQUEST["pcid"];

    $delete="delete from sas_copvideos WHERE id=".$_REQUEST['del']; 
    $delete_query=mysql_query($delete);

	$_SESSION['sessionMsg']='Theme Deleted Successfully';
	header("Location: sas_copingvideos.php?pcid=$pcid&pid=$pid");
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
<script language="javascript" src="../includes/validation.js"></script>
<script language="javascript1.1">
//function for delete alert
function delete_record(id,pid,pcid)
{  //alert(id,pid,pcid)
	if(confirm("Are you sure to delete this Product?"))
	{
		document.location.href='sas_copingvideos.php?del='+id+'&pid='+pid+'&pcid='+pcid;
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
	 if((!isset($_REQUEST['id']))&&(!isset($_REQUEST['Call'])) )
     {	
        if(isset($_REQUEST['pcid'])){
		
		   $pcid=$_REQUEST['pcid'];
		   
		   $rs = mysql_query("select * from sas_themecategories where cat_id='$pcid'");	        	
		   $res = mysql_fetch_array($rs);	
		   $cat_name=$res['cat_name'];
		}
		
		if(isset($_REQUEST['pid'])){
		
		   $pid=$_REQUEST['pid'];
		   $pcid=$_REQUEST['pcid'];
		   
		   $rs2 = mysql_query("select * from sas_videos where cat_id='$pcid' and id='$pid' ");        	
		   $res2 = mysql_fetch_array($rs2) ;	
		   $prod_name=$res2['prod_name'];
		}
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
	<tr>
     <td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1"><!--this display first-->
 	 <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
       <form name="search" id="search" action="" method="post">
	   <tr>
	   <td width="39%" class="h2">
       <span class="verdana_small_white"><?php echo $PG_TITLE.'&nbsp;::&nbsp;<i><a href="categories.php"><font color="red">'.$res['cat_name'].'</font></a></i>&nbsp;::&nbsp;'.$prod_name;?></span>													</td>
      <!--	<td width="43%" align="center" class="gray_txt">Search By Theme Code: <input type="text" name="book_code"><input type="submit" name="codesearch" value="Search">
		  </td>-->						
		<td width="18%" align="right">
		<table cellspacing=2 cellpadding=1 id=toplinks>
        <tr>
    	  <td>
		  <a href="sas_copingvideos.php?Call=edit&pcid=<?=$pcid?>&pid=<?=$pid?>&type1=<?=$_GET['type']?>" class="blue_txt">Add New Coping Video </a>
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
 if(isset($pcid) && isset($pid) ){
 
?>
<table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">
  <TD width="24%" align="center"  class="header_row"><a class="whiteTxtlink">Video Name</a></TD>
  <TD width="10%" align="center"  class="header_row">Video Type</TD>
  <TD width="10%" align="center"  class="header_row">Video Price</TD>
  <TD width="10%" align="center"  class="header_row">Vimeo Code</TD>
  <TD width="10%" align="center"  class="header_row">Video Image</TD>
  <td  width="5%" align="center"   class="header_row" ><a class="whiteTxtlink" >Status </a></td>
  <td  width="10%" align="center"   class="header_row" ><a class="whiteTxtlink" ></a></td>
  <td  width="30%" align="center"  class="header_row" >Action</td>
</tr>
  <?php
	
	 $sql="SELECT * FROM  sas_copvideos where cat_id='$pcid' and prod_id='$pid' order by prod_name limit $start,$q_limit";
     $rs=mysql_query($sql);
     $i=0;
	 //echo mysql_num_rows($rs);	
	 while($line=mysql_fetch_array($rs))
	 {
	    if(isset($bgcolor)=="#FFFFFF") $bgcolor="#F7F7F7";
	    else $bgcolor="#FFFFFF";
	    $i++;
  ?>
  <tr bgcolor = <?php echo $bgcolor?>>
	<TD align="center" class="gray_txt" ><?php echo $line['prod_name']?></TD>
	<TD align="center" class="gray_txt" ><?php if($line['cvtype']==0) echo "Paid"; else echo "Free";?></TD>
	<TD align="center" class="gray_txt" ><?php echo $line['prod_price']?></TD>
	<TD align="center" class="gray_txt" ><?php echo $line['vcode']?></TD>
	<TD align="center" class="gray_txt" ><img src="../<?php echo $line['prod_image']?>" width="80" height="50" ></TD>
	<TD class="gray_txt" align="center" ><?php if($line['status']=='1'){echo 'active';}else{echo 'inactive';}?></TD>
	<TD class="gray_txt" align="center" ><a href="characters_profile.php?pcid=<?php echo $pcid?>&pid=<?php echo $pid;?>" class="links">Upload Characters </a></TD>
	<td class="gray_txt" width="29%" valign="middle" align="center">
	<a href="sas_copingvideos.php?Call=edit&pcid=<?php echo $pcid?>&pid=<?php echo $line['prod_id']?>&id=<?php echo $line['id']?>" class="links">Edit</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;<a href="javascript:delete_record('<?php echo $line['id']; ?>','<?php echo $line['prod_id'];?>','<?php echo $line['prod_id']; ?>')" class="links">Delete</a>
	</td>
  </tr>
   <?php  } ?>
	 <tr bgcolor="#F7F7F7">
		<td align="right" colspan="8">&nbsp;</td>
     </tr>
  	 <tr align="center"  bgcolor="#FFFFFF">
  	 <td colspan="8" class="gray_txt" align="right">
	 <?php 
			//pagination
			paginate($start,$q_limit,$no_rows,$filePath,$otherParams);
	 ?></td>
   	</tr>
	<?php if($i==0){ ?>
    <tr align="center"  bgcolor="#FFFFFF">
     <td colspan="8" class="gray_txt"><?php print "Records are not Available." ?></td>
    </tr>
	<?php } ?></table>	
	<?php } ?>
  <!--table1 ends-->
  </table></td></tr></table>
  <?php }
  //if the admin wants to edit/create  one record
    else {
  
        if(isset($_REQUEST['pcid'])){
		
		   $pcid=$_REQUEST['pcid'];		
		   $rs = mysql_query("select * from sas_themecategories where cat_id='$pcid'");	        	
		   $res = mysql_fetch_array($rs);	
		   $cat_name=$res['cat_name'];
		}
		
		if(isset($_REQUEST['pid'])){
		
		   $pid=$_REQUEST['pid'];
		   $pcid=$_REQUEST['pcid'];
		   
		   $rs2 = mysql_query("select * from sas_videos where cat_id='$pcid' and id='$pid' ");        	
		   $res2 = mysql_fetch_array($rs2) ;	
		   $prod_name=$res2['prod_name'];
		}
		
  ?>
  <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
	<tr>
	<td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1"><!--this display first-->

	<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>

	<td width="65%" class="h2">
	<img src="images/heading_icon.gif" width="16" height="16" hspace="5">
    <span class="verdana_small_white"><?php echo $PG_TITLE.'&nbsp;::&nbsp;<i><a href="categories.php"><font color="red">'.$cat_name.'</i></a></font>&nbsp;::&nbsp;'.$prod_name;?></span>													</td>
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
		copingvideos($_REQUEST['id']);
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
