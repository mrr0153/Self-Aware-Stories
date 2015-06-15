<?php 

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

$filePath="product_manager2.php";

if(isset($_GET['pcid']))

{

$pcid=$_GET['pcid'];

$otherParams="&type=research&pcid=".$pcid;

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

$pcid=$_POST['pcid'];

$type1=$_GET['type1'];

//for updating

if(isset($act))

{

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
echo "prod_name=".addslashes($prod_name);
//$fg=print_r($_POST['suggested']);

 $upsql="UPDATE `sas_videos` SET 

	`cat_id`= '$pcid',

	`prod_name`='".addslashes($prod_name)."' ,

	`prod_image`= '$prod_image',
	
	`vcode`= '$vcode',
	
	`prod_price`='$price1',

	`description`='".addslashes($description)."' ,

    `pagetitle`='$pagetitle' ,
	
	`btopics`='$btopics' ,
	
	`tags`='$tags' ,
	
	`mresources`='$mresources' ,
	
	`mkeywords`='$mkeywords' ,

	`mdescription`='$mdescription' ,

	`status`='$status' where `id`='$id'";

    mysql_query($upsql) or die(mysql_error());
	
   $_SESSION['sessionMsg']='Theme Updated Successfully';

}

//for new 

else
{
 // print_r($_POST);
  
  $selcat=mysql_query("SELECT * FROM sas_videos WHERE prod_name='$prod_name' and cat_id='$pcid'");

  if($norows=mysql_num_rows($selcat)<=0)
  {
    $file123=$_FILES['prod_image']['name'];
    $photo123  = $_FILES['prod_image']['tmp_name'];
    @list($width, $height, $type, $attr) = getimagesize($photo123);
	
	$prod_image='productimages/images/'.$file123;
   
     if($width > 40000) 
	  {
		$errMsg=1;
	 } 
	 else
	 {
	   move_uploaded_file($_FILES['prod_image']['tmp_name'],"../productimages/images/".$file123);
	   
       $inssql="INSERT INTO `sas_videos` (`cat_id` , `prod_name` ,`prod_image`,`vcode`,`prod_price`,`description` ,`pagetitle`,`btopics`,`tags`,`mresources`,`mkeywords`,`mdescription`,`status`,`date_added`,`prod_type`)
       VALUES ( '$pcid','".addslashes($prod_name)."' ,'$prod_image','$vcode','$price1','".addslashes($description)."','$pagetitle','$btopics','$tags','$mresources','$mkeywords','$mdescription','$status',now(),'".$_GET['type1']."')";

       mysql_query($inssql) or die(mysql_error());

       $_SESSION['sessionMsg']='Theme Inserted Successfully';

     }

  }
  else
  { 
    header("Location:product_manager2.php?pcid=$pcid&error=1");
    exit;
    //echo "Course name already exits";
  }

}

 header("Location:product_manager2.php?pcid=$pcid");

exit;
}
//deleting a course
if(isset($_REQUEST["del"]))
{
 $id=$_REQUEST["del"];
 $pcid=$_REQUEST["pcid"];
 
 $delete="delete from sas_videos WHERE id=".$_REQUEST['del']; 
 $delete_query=mysql_query($delete);

 $_SESSION['sessionMsg']='Theme Deleted Successfully';
 header("Location: product_manager2.php?pcid=$pcid");
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
function delete_record(id,pcid)
{
	if(confirm("Are you sure to delete this Product?"))
	{
		document.location.href='product_manager2.php?del='+id+'&pcid='+pcid;
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
	<?php if((!isset($_REQUEST['id']))&&(!isset($_REQUEST['Call'])) )
    {	
        if(isset($_GET['pcid'])){
		 $pcid=$_GET['pcid'];
		
		$rs = mysql_query("select * from sas_themecategories where cat_id='$pcid'");	
        	
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
       <span class="verdana_small_white"><?php echo $PG_TITLE.'&nbsp;::&nbsp;<i><font color="red">'.$res['cat_name'].'</i></font>';?></span>													</td>
      <!--	<td width="43%" align="center" class="gray_txt">Search By Theme Code: <input type="text" name="book_code"><input type="submit" name="codesearch" value="Search">
		  </td>-->						
		<td width="18%" align="right">
		<table cellspacing=2 cellpadding=1 id=toplinks>
        <tr>
    	  <td>
		  <a href="product_manager2.php?Call=edit&pcid=<?=$pcid?>" class="blue_txt">Add New Theme </a>
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
 if(isset($_REQUEST['pcid'])){
 
?>
<table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">
  <TD width="24%" align="center"  class="header_row"><a class="whiteTxtlink">Video Name</a></TD>
  <TD width="10%" align="center"  class="header_row">Video Price</TD>
  <td  width="10%" align="center"   class="header_row" ><a class="whiteTxtlink" >Status </a></td>
  <td  width="22%" align="center"   class="header_row" ><a class="whiteTxtlink" ></a></td>
  <td  width="30%" align="center"  class="header_row" >Action</td>
</tr>
	<?php
	//sorting of data
	if(isset($_POST['search_option'])&&($_POST['search_option']=="2")&&($_POST['search']!=""))
	{
    $sql="SELECT * FROM  sas_videos  where id=$pcid and prod_name like '%$_POST[search]%' order by prod_name";

    $no_rows= mysql_num_rows(mysql_query($sql));
	 $sql="SELECT * FROM sas_videos WHERE id=$pcid and prod_name like %$_POST[search]%' order by prod_name limit $start,$q_limit";
   }
  elseif(isset($_POST['search_option'])&&($_POST['search_option']=="2")&&($_POST['search']==""))
	{

    $sql="SELECT * FROM  sas_videos where cat_id=$pcid ";
    $no_rows= mysql_num_rows(mysql_query($sql));
	$sql="SELECT * FROM  sas_videos where cat_id=$pcid  limit $start,$q_limit";
  }
  //displays all data
  else
  {
	$sql="SELECT * FROM  sas_videos where cat_id='$pcid' order by  prod_name";
	$no_rows= mysql_num_rows(mysql_query($sql));

if(isset($_POST['book_code'])!=''){
	$sql="SELECT * FROM  sas_videos where bookcodenumber='".$_POST['book_code']."'";

} else {

	$sql="SELECT * FROM  sas_videos where cat_id='$pcid'  order by id limit $start,$q_limit";

}
     $rs=mysql_query($sql);
     $i=0;
	 	
	while($line=mysql_fetch_array($rs))
	{
	if(isset($bgcolor)=="#FFFFFF") $bgcolor="#F7F7F7";
	else $bgcolor="#FFFFFF";
	$i++;
 ?>
 <tr bgcolor = <?php echo $bgcolor?>>
	<TD align="center" class="gray_txt" ><?php echo stripslashes($line['prod_name']);?></TD>
	<TD align="center" class="gray_txt" ><?php echo $line['prod_price']?></TD>
	<TD class="gray_txt" align="center" ><?php if($line['status']=='1'){echo 'active';}else{echo 'inactive';}?></TD>
	<TD class="gray_txt" align="center" ><a href="characters_profile2.php?pcid=<?php echo $pcid?>&pid=<?php echo $line['id']?>" class="links">Upload Characters </a></TD>
	<td class="gray_txt" width="29%" valign="middle" align="center">
	<a href="sas_copingvideos.php?pcid=<?php echo $pcid?>&pid=<?php echo $line['id']?>" class="links">Coping Video</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;
	<a href="product_manager2.php?Call=edit&pcid=<?php echo $pcid?>&id=<?php echo $line['id']?>" class="links">Edit</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;<a href="javascript:delete_record('<?php echo $line['id']; ?>','<?php echo $pcid; ?>')" class="links">Delete</a>
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
	<?php }
	}elseif(isset($_POST['search_option'])&&($_POST['search_option']=='2')){

	?>
	<table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">
       <TD width="24%" align="center"  class="header_row"><a class="whiteTxtlink">Theme Name </a></TD>
       <TD width="24%" align="center" class="header_row"><a class="whiteTxtlink">Theme Category Name </a></TD>
       <td  width="22%" align="center"   class="header_row" ><a class="whiteTxtlink" >Status </a></td>
       <td  width="29%" align="center"  class="header_row" >Action</td>
	</tr>
		<?php
						//sorting of data
		if(isset($_POST[search_option])&&($_POST[search_option]=="2")&&($_POST[search]!=""))
  		{
            $sql="SELECT * FROM  sas_videos  where  prod_name like '%$_POST[search]%' order by prod_name";
            $no_rows= mysql_num_rows(mysql_query($sql));
			$sql="SELECT * FROM  sas_videos  WHERE  prod_name like '%$_POST[search]%' order by prod_name limit $start,$q_limit";
    	  }
   	    elseif(isset($_POST[search_option])&&($_POST[search_option]=="2")&&($_POST[search]==""))
		{
            $sql="SELECT * FROM  sas_videos";
	        $no_rows= mysql_num_rows(mysql_query($sql));
			$sql="SELECT * FROM  sas_videos   limit $start,$q_limit";
		  }
			  //displays all data
		else
          {
			$sql="SELECT * FROM  sas_videos";
			$no=mysql_query($sql);
			$no_rows= mysql_num_rows($no);
			$sql="SELECT * FROM  sas_videos  limit $start,$q_limit";
		}
		  $rs=mysql_query($sql);
   		  $i=0;
  		 while($line=mysql_fetch_array($rs))
            {
			if($bgcolor=="#FFFFFF") $bgcolor="#F7F7F7";
			else $bgcolor="#FFFFFF";
			$i++;
			$sqler=mysql_query("SELECT * FROM  sas_themecategories WHERE cat_id='$line[cat_id]'");
			$liner=mysql_fetch_array($sqler);
			?>		
			<tr bgcolor = <?php echo $bgcolor?>>
			<TD align="center" class="gray_txt" ><?php echo $line['prod_name']?></TD>
			<TD align="center" class="gray_txt" ><?php echo $liner['cat_name']?></TD>
			<TD class="gray_txt" align="center" ><? if($line['prod_status']=='1'){echo 'active';}else{echo 'inactive';}?></TD>
			<td class="gray_txt" width="29%" valign="middle" align="center">
			<a href="product_manager2.php?Call=edit&id=<?php echo $line['prod_id']?>" class="links">Edit</a>
			<span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;<a href="javascript:delete_record('<?php echo $line['prod_id']?>')" class="links">Delete</a>										</td>
			</tr>
		   <?php  } ?>
		 <tr bgcolor="#F7F7F7">
			<td align="right" colspan="8">&nbsp;</td>
		</tr>
		<tr align="center"  bgcolor="#FFFFFF">
		<td colspan="8" class="gray_txt" align="right">
		<?php 
		//pagination
					paginate($start,$q_limit,$no_rows,$filePath,$otherParams);?></td>
        </tr>
		<?php if($i==0){ ?>	
		<tr align="center"  bgcolor="#FFFFFF">
		<td colspan="8" class="gray_txt"><?php print "Records are not Available." ?></td>
		</tr>
		<?php }?></table>	
		<?php }
		else{?> 
		 <table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">
        <TD width="24%" align="center"  class="header_row"><a class="whiteTxtlink">Theme Category Name </a></TD>
		<td  width="22%" align="center"   class="header_row" ><a class="whiteTxtlink" >Status </a></td>
     </tr>
	<form name="par" method="post" action="product_manager2.php">
	<?php
	//sorting of data

	if(isset($_POST[search_option])&&($_POST[search_option]=="1")&&($_POST[search]!=""))
			{
            $sql="SELECT * FROM sas_themecategories WHERE cat_name like '%$_POST[search]%'  order by cat_name";
	        $no_rows= mysql_num_rows(mysql_query($sql));
            $sql="SELECT * FROM sas_themecategories WHERE cat_name like '%$_POST[search]%'  order by cat_name  limit $start,$q_limit";
			  }
    elseif(isset($_POST[search_option])&&($_POST[search_option]=="1")&&($_POST[search]==""))
	{
        $sql="SELECT * FROM  sas_themecategories  order by cat_name";
        $no_rows= mysql_num_rows(mysql_query($sql));
	    $sql="SELECT * FROM  sas_themecategories  order by cat_name limit $start,$q_limit";
	  }
	  //serching by options

	  /* elseif(isset($_POST[search_option])&&($_POST[search_option]=="2")&&($_POST[search]!=""))
	{
    $sql="SELECT * FROM fish_categories WHERE course_name like '%$_POST[search]%' and parentid='0' order by course_name";
    $no_rows= mysql_num_rows(mysql_query($sql));
	$sql="SELECT * FROM fish_categories WHERE course_name like '%$_POST[search]%' and parentid='0' order by course_name limit $start,$q_limit";

	  }
 */
	  //displays all data
	  else
	  {
        $sql="SELECT * FROM  sas_themecategories";
	    $no=mysql_query($sql);
  	    $no_rows= mysql_num_rows($no);
		$sql="SELECT * FROM  sas_themecategories   limit $start,$q_limit";
	  }
     $rs=mysql_query($sql);

   $i=0;
	while($line=mysql_fetch_array($rs))
	{

	if(isset($bgcolor)=="#FFFFFF") $bgcolor="#F7F7F7";
	else $bgcolor="#FFFFFF";
	$i++;
   ?>
   <tr bgcolor = <?php echo $bgcolor?>>

	<TD align="left" class="gray_txt" 

		onClick="javascript:document.location.href='product_manager2.php?pcid=<?php echo $line['cat_id']?>'">

    <img src="images/folder.gif">&nbsp;<?php echo $line['cat_name']?></TD>

    <TD class="gray_txt" align="center" ><? if(isset($line['status'])=='1'){echo 'active';}else{echo 'inactive';}?></TD>
   </tr>
	  <?php  } ?>
   <input type="hidden"  name="pid" value="">
   </form>
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
	<?php } }?>
  </form>
  <!--table1 ends-->
  </table></td></tr></table>
 <?php }
  //if the admin wants to edit/create  one record
  else { ?>
  <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
	<tr>
	<td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1"><!--this display first-->

	<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>

	<td width="65%" class="h2">
	<img src="images/heading_icon.gif" width="16" height="16" hspace="5">
    <span class="verdana_small_white"><?php echo $PG_TITLE;?></span>													</td>
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
		  coursecategoriesediting($_REQUEST['id'])
		?>

<?php }?>
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
