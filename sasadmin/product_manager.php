<?php 
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

 $filePath="product_manager.php";

 if(isset($_GET['pcid'])){

    $pcid=$_GET['pcid'];

    $otherParams="&pcid=".$pcid;

    $q_limit=20;
 }
 else{

    $otherParams='';
 }

 //pagination ends

 require_once("../config/config.inc.php");

 require_once("../functions.inc.php");

 isAdminOn('');

 $PG_TITLE = 'Theme Manager';

 //include the S3 class
 if (!class_exists('S3'))require_once('../S3.php');
			
 require_once("../config/awsKeys.php");
			
 //instantiate the class
 $s3 = new S3(awsAccessKey, awsSecretKey);
 
  //checking for edit or new one and inserting to database starts
  
 if(isset($_POST['add_edit'])){

	extract($_POST);
	
	$pcid=$_POST['pcid'];
	
	//for updating

	if(isset($act)){
	
          //echo 'update';
	      if(is_uploaded_file($_FILES['prod_image']['tmp_name'])){
	   
                $fileName = 'prod_'.date("His").'_'.$_FILES['prod_image']['name'];
			   	$fileTempName=$_FILES['prod_image']['tmp_name'];
		        //move the file
				if ($s3->putObjectFile($fileTempName, "sas-productimages", $fileName, S3::ACL_PUBLIC_READ)) {
					//echo "<strong>We successfully uploaded your file.</strong>";					
					
					$upsql="UPDATE `sas_videos` SET 

					`cat_id`= '$pcid',

					`prod_name`='".addslashes($prod_name)."' ,

					`prod_image`= '$fileName',
					
					`vcode`= '$vcode',
					
					`vtype`='$vtype',
					
					`prod_price`='$price1',

					`description`='".addslashes($description)."' ,

					`pagetitle`='$pagetitle' ,
					
					`btopics`='$btopics' ,
					
					`tags`='$tags' ,
					
					`mresources`='$mresources' ,
					
					`mkeywords`='$mkeywords' ,

					`mdescription`='$mdescription' ,
					
					`videono`='$videono' ,

					`status`='$status' where `id`='$id'";

				     mysql_query($upsql) or die(mysql_error());
					
				     $_SESSION['sessionMsg']='Video Updated Successfully';
				  
				}else{
					//echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
				    $_SESSION['sessionMsg']="Sorry, Image Name should not contain white spaces.";
				}	
		  }
		  else{
		  
			  $fileName = $prev_prod_image;
			
			  $upsql="UPDATE `sas_videos` SET 

				`cat_id`= '$pcid',

				`prod_name`='".addslashes($prod_name)."' ,

				`prod_image`= '$fileName',
				
				`vcode`= '$vcode',
				
				`vtype`='$vtype',
				
				`prod_price`='$price1',

				`description`='".addslashes($description)."' ,

				`pagetitle`='$pagetitle' ,
				
				`btopics`='$btopics' ,
				
				`tags`='$tags' ,
				
				`mresources`='$mresources' ,
				
				`mkeywords`='$mkeywords' ,

				`mdescription`='$mdescription' ,
				
				`videono`='$videono' ,

				`status`='$status' where `id`='$id'";

			    mysql_query($upsql) or die(mysql_error());
				
			    $_SESSION['sessionMsg']='Video Updated Successfully';  
          				
		  }		
		   
	}

	//for new 

	else
	{	  
	  $selcat=mysql_query("SELECT * FROM sas_videos WHERE prod_name='$prod_name' and cat_id='$pcid'");

	  if($norows=mysql_num_rows($selcat)<=0)
	  {
		 $fileName = 'prod_'.date("His").'_'.$_FILES['prod_image']['name'];
	     $fileTempName=$_FILES['prod_image']['tmp_name'];
		 		 
		 //move the file
		 if ($s3->putObjectFile($fileTempName, "sas-productimages", $fileName, S3::ACL_PUBLIC_READ)) {
			//echo "<strong>We successfully uploaded your file.</strong>";	
					
			$inssql="INSERT INTO `sas_videos` (`cat_id` , `prod_name` ,`prod_image`,`vcode`,`vtype`,`prod_price`,`description` ,`pagetitle`,`btopics`,`tags`,`mresources`,`mkeywords`,`mdescription`,`status`,`date_added`,`prod_type`,`videono`)
		    VALUES ( '$pcid','".addslashes($prod_name)."' ,'$fileName','$vcode','$vtype','$price1','".addslashes($description)."','$pagetitle','$btopics','$tags','$mresources','$mkeywords','$mdescription','$status',now(),'".$_GET['type1']."','$videono')";

		    mysql_query($inssql) or die(mysql_error());

		    $_SESSION['sessionMsg']='Video Inserted Successfully';
			
		 }else{
			
			//echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
			$_SESSION['sessionMsg']="Sorry, Image Name should not contain white spaces.";
		 }

	  }
	  else
	  { 
	     $_SESSION['sessionMsg']="Video Name already exits";
	     header("Location:product_manager.php?pcid=$pcid&error=1");
		 exit;
		 //echo "Video Name already exits";
	  }

   }

   header("Location:product_manager.php?pcid=$pcid");
   exit;
 }
 
 //deleting a course
 if(isset($_REQUEST["del"])){
    
    $pcid=$_REQUEST["pcid"];
	
    $sqldel = mysql_query("select * from sas_videos WHERE id=".$_REQUEST['del']."'");
    $rowdel = mysql_fetch_array($sqldel); 
    
	$delete="delete from sas_videos WHERE id=".$_REQUEST['del']; 
     	
	if(mysql_query($delete)){
	 
       $s3->deleteObject("sas-productimages", $rowdel['prod_image']);
	}

    $_SESSION['sessionMsg']='Theme Deleted Successfully';
	
    header("Location: product_manager.php?pcid=$pcid");
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

<!--- ckeditor starts --->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>
<script>
$( document ).ready( function() {
	$( 'textarea#desctiption' ).ckeditor();
} );
</script>
<!--- ckeditor ends --->

<script language="javascript1.1">
//function for delete alert
function delete_record(id,pcid)
{
	if(confirm("Are you sure to delete this Product?"))
	{
		document.location.href='product_manager.php?del='+id+'&pcid='+pcid;
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
       <span class="verdana_small_white"><?php echo $PG_TITLE.'&nbsp;::&nbsp;<i><a href="categories.php"><font color="red">'.$res['cat_name'].'</font></a></i>';?></span>													</td>
      <!--	<td width="43%" align="center" class="gray_txt">Search By Theme Code: <input type="text" name="book_code"><input type="submit" name="codesearch" value="Search">
		  </td>-->						
		<td width="18%" align="right">
		<table cellspacing=2 cellpadding=1 id=toplinks>
        <tr>
    	  <td>
		  <a href="product_manager.php?Call=edit&pcid=<?=$pcid?>" class="blue_txt">Add New Situational Video </a>
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
  <TD width="5%" align="center"  class="header_row"><a class="whiteTxtlink">S.No</a></TD>
  <TD width="24%" align="center"  class="header_row"><a class="whiteTxtlink">Video Name</a></TD>
  <TD width="8%" align="center"  class="header_row">Video Type</TD>
  <TD width="8%" align="center"  class="header_row">Video Price</TD> 
  <TD width="10%" align="center"  class="header_row">Vimeo code</TD> 
  <td  width="10%" align="center"   class="header_row" ><a class="whiteTxtlink" >Video Image </a></td>  
  <td  width="5%" align="center"   class="header_row" ><a class="whiteTxtlink" >Status </a></td>
  <td  width="10%" align="center"   class="header_row" ><a class="whiteTxtlink" ></a></td>
  <td  width="30%" align="center"  class="header_row" >Action</td>
  </tr>
	<?php
	  
	  $sql="SELECT * FROM sas_videos where cat_id='$pcid'";
	  $no=mysql_query($sql);
	  $no_rows= mysql_num_rows($no);
	 
	  $sql="SELECT * FROM  sas_videos where cat_id='$pcid' order by id limit $start,$q_limit";

      $rs=mysql_query($sql);
      $i=0;
	  $k=1;
	  
	  $bgcolor="#FFFFFF";
	  
	  while($line=mysql_fetch_array($rs))
	  { 	    
	    if(isset($bgcolor) && $bgcolor =="#FFFFFF") {  $bgcolor="#F7F7F7";	}
	    else {  $bgcolor="#FFFFFF";	}
		
	    $i++;		
    ?>
  <tr bgcolor = <?php echo $bgcolor?>> 
    <TD align="center" class="gray_txt" ><?php echo $k;?></TD>
	<TD align="center" class="gray_txt" ><?php echo stripslashes($line['prod_name']);?></TD>
	<TD align="center" class="gray_txt" ><?php if($line['vtype']==0) echo "Paid"; else echo "Free";?></TD>
	<TD align="center" class="gray_txt" ><?php echo $line['prod_price']?></TD>
	<TD align="center" class="gray_txt" ><?php echo $line['vcode']?></TD>
	<TD align="center" class="gray_txt" ><img src="https://s3-us-west-2.amazonaws.com/sas-productimages/<?php echo $line['prod_image']?>" width="80" height="50" ></TD>
	<TD class="gray_txt" align="center" ><?php if($line['status']=='1'){echo 'active';}else{echo 'inactive';}?></TD>
	<TD class="gray_txt" align="center" ><a href="characters_profile.php?pcid=<?php echo $pcid?>&pid=<?php echo $line['id']?>" class="links">Upload Characters </a></TD>
	<td class="gray_txt" valign="middle" align="center">
	<a href="sas_copingvideos.php?pcid=<?php echo $pcid?>&pid=<?php echo $line['id']?>" class="links">Add/Edit Coping Video</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;
	<a href="product_manager.php?Call=edit&pcid=<?php echo $pcid?>&id=<?php echo $line['id']?>" class="links">Edit</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;<a href="javascript:delete_record('<?php echo $line['id']; ?>','<?php echo $pcid; ?>')" class="links">Delete</a>
	</td>
  </tr>
   <?php  $k++;  } ?>
	 <tr bgcolor="#F7F7F7">
		<td align="right" colspan="9">&nbsp;</td>
     </tr>
  	 <tr align="center"  bgcolor="#FFFFFF">
  	 <td colspan="9" class="gray_txt" align="right">
   <?php
 	     //pagination
         paginate($start,$q_limit,$no_rows,$filePath,$otherParams);
   ?>
	 </td>
   	</tr>
   <?php if($i==0){ ?>
    <tr align="center"  bgcolor="#FFFFFF">
     <td colspan="8" class="gray_txt"><?php print "Records are not Available." ?></td>
    </tr>
   <?php }?></table>	
 <?php
   }
 ?>
  <!--table1 ends-->
  </table></td></tr></table>
 <?php }
  //if the admin wants to edit/create  one record
  else { 
  
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
	  <tr>
		<td width="65%" class="h2">
		<img src="images/heading_icon.gif" width="16" height="16" hspace="5">
		<span class="verdana_small_white"><?php echo $PG_TITLE.'&nbsp;::&nbsp;<i><a href="categories.php"><font color="red">'.$res['cat_name'].'</font></a></i>';?></span>													</td>
		  <td width="17%" align="center">
		     <table width="60" border="0" align="right" cellspacing="1">
			  <tr>
				<td align="right" valign="middle">&nbsp;</td>
				<td width="37" align="center" valign="middle">&nbsp;</td>
			  </tr>
		     </table>
		  </td>
	  </tr>
	 </table>
    </td>
	</tr>
       <?php		
	   //coursecategoriesediting($_REQUEST['pcid'])
  
        if(isset($_REQUEST['id'])) {
            
			$sql = "SELECT * FROM   sas_videos  where id=".$_REQUEST['id'];

		    $rs = mysql_query($sql);

	        $res=mysql_fetch_array($rs);

			extract($res);	

		}  ?>
			<tr><td align="center" valign="top" bgcolor="#EEEEEE">
			<form name="frm_add_edit"  enctype="multipart/form-data" method="post" action=""  onsubmit="return validate1">
			<input type="hidden" name="pcid" value="<?php echo $_GET['pcid'];?>" />
			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
			<!--<input type="hidden" name="task" value="< ?=$_GET['type1'];?>" />-->
			<?php 			
			   if(isset($_REQUEST['id'])){ ?>		  
			      <input type="hidden" name="act" value="edit">
			<?php }?>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
			<tr class="header_row">
				<td colspan="3" align="left">Edit / Add New Video </td>
			</tr>			
			<?php if(isset($_GET['error'])==1){ ?>
			<tr><td colspan="2" align="center" bgcolor="#FFFFFF">			
			<?php echo "<font color=#FF0000>Video Name already exits</font>";?></td>
			</tr>
			<?php  }?>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Video  Name* </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="prod_name" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($prod_name)) print($prod_name);?>"/>	</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Video  Number* </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="videono" type="text" class="textbox" id="section_data" size="15" value="<?php if(isset($videono)) print($videono);?>"/><b><font color="#FF0000"> ( Ex: SV1 )</font></b> </td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>Video Image<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><input name="prod_image" type="file" class="textbox" id="prod_image" size="30" value=""/>&nbsp;<input type="hidden" name="prev_prod_image" value="<?php if(isset($prod_image)) print($prod_image);?>"/>
				<!--<b><font color="#FF0000">(width 400px height 527px)</font></b>--></td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Current Video Image <span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><img src="https://s3-us-west-2.amazonaws.com/sas-productimages/<?php if(isset($prod_image)) print($prod_image);?>" width="150" height="150" border="0"></td>
			</tr>
			<tr>
			 <td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Video Type<span class="featured">*</span> : </strong>
			 </td>
			 <td width="70%" align="left" bgcolor="#F7F7F7">				
				<input name="vtype" type="radio"  value="0" <?php if(isset($vtype) && $vtype =='0'){ echo 'checked'; }?>/>Paid
				<input name="vtype" type="radio"  value="1" <?php if(isset($vtype) && $vtype =='1'){ echo 'checked'; }?>/>Free 
			 </td>
			</tr>
            <tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Price<span class="featured">:</span></strong></td>
			  <td align="left" bgcolor="#F7F7F7"><input name="price1" type="text" class="textbox" id="price1" size="30" value="<?php if(isset($prod_price)) print($prod_price);?>"/> </td>
			  </tr>
              <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Video Vimeo Code* </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="vcode" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($vcode)) print($vcode);?>"/></td>
			</tr>
			 
			<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Video Description<span class="featured">*:</span></strong></td>
			  <td align="left" bgcolor="#F7F7F7">
			      <textarea class="ckeditor" cols="80" id="editor1" name="description" rows="10"><?php if(isset($description)) { echo $description; } ?></textarea>
			  </td>
			  </tr>
			  
			  <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Page Title </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="pagetitle" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($pagetitle)) print($pagetitle);?>"/></td>
			 </tr>
			
			 <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Behaviour Topics </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<textarea name="btopics" rows="4" cols="72"><?php if(isset($btopics)) print($btopics);?></textarea>
				<span style="color:red"><br>*( Separate each item with 3 hyphen Ex. Know what your goals are. --- Have long antenna. --- Know what your goals are.)		</span>			</td>
			    
			 </tr>
			 <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Tags </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="tags" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($tags)) print($tags);?>"/>				</td>
			 </tr>
			 <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Mentor Resources </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="mresources" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($mresources)) print($mresources);?>"/>				</td>
			 </tr>
		 	 <tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Meta KeyWords:</strong></td>
			  <td align="left" bgcolor="#F7F7F7"><textarea name="mkeywords" rows="4" cols="72"><?php if(isset($mkeywords)) print($mkeywords);?></textarea></td>
			  </tr>
			<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Meta Description:</strong></td>
			  <td align="left" bgcolor="#F7F7F7"><textarea name="mdescription" rows="4" cols="72"><?php if(isset($mdescription)) print($mdescription);?></textarea></td>
			  </tr>
			<tr>
			 <td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Status<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="status" type="radio"  value="0" <?php if(isset($status) && $status =='0'){echo 'checked';}?>/>Inactive
				<input name="status" type="radio"  value="1" <?php if(isset($status) && $status =='1'){echo 'checked';}?>/>Active
			    </td>
			</tr>
			<tr>
				<td align="right" bgcolor="#FFFFFF" height="40"></td>
				<td width="70%" align="left" bgcolor="#FFFFFF">
				<input type="submit" name="add_edit" value="Save Data" class="buttons" onclick="return validate1();" />&nbsp;&nbsp;
				<input type="reset" name="cancel" value="Cancel" class="buttons" />
				<a href="product_manager.php"><input type="button" name="back" value="Back" class="buttons" onclick="javascript:history.back();"></a>					</td>

		</tr>

		</table>

		</form>
  

<?php } ?>
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
