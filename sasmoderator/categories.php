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

 $filePath="categories.php";

 require_once("../config/config.inc.php");

 //require_once("../includes/commonfunc.php");

 require_once("../functions.inc.php");

 isAdminOn('');

 $PG_TITLE = 'Theme Categories';
 //checking for edit or new one and inserting to database

 if(isset($_POST['add_edit'])){

    extract($_POST);
  
    //print_r($_POST);
  
	if(isset($act)) {
		
		// print_r($act);
		 
		$res_img = $_FILES['res_img']['name'];

		$res_img12=$_FILES['res_img']['tmp_name'];
		/*
		@list($width, $height, $type, $attr) = getimagesize($res_img12);

		  if($width > 40000 )
		  {
			$_SESSION['sessionMsg']='Image should be of width 400 size';
		  }
		  else
		  {
		   */ 
			if(is_uploaded_file($_FILES['res_img']['tmp_name'])){

			    $resimg = 'theme_'.date("His").'_'.$_FILES['res_img']['name'];
			   			    
				move_uploaded_file($_FILES['res_img']['tmp_name'],'../productimages/'.$resimg);
		
			 } else {
				$resimg = $prev_img;
			 }
			
			 $upsql="UPDATE `sas_themecategories` SET `cat_name` = '$cat_name',`imagepath` = '$resimg',`vcode` = '$vcode',`sort_order` = '',`catdesctiption` = '".addslashes($catdesctiption)."',`timeline`='$timeline',date_added='now()',`status` = '$Status' WHERE `cat_id`=$_REQUEST[id]";

			 mysql_query($upsql) or die( mysql_error() );

			 $_SESSION['sessionMsg']='Theme Updated successfully';
	 
			 header("Location:categories.php");

			 exit;

		  // }

	   }else {
	   
		 $res_img = $_FILES['res_img']['name'];
		 $res_img12=$_FILES['res_img']['tmp_name'];
		 /*
		 @list($width, $height, $type, $attr) = getimagesize($res_img12);
		 
		   if($width > 40000 )
			{
				$_SESSION['sessionMsg']='Image should be of 400';
				header("Location:categories.php");
				exit;
			}else
			{
			*/  
			  $img='theme_'.date("His").'_'.$_FILES['res_img']['name'];
			  
			  move_uploaded_file($_FILES['res_img']['tmp_name'],'../productimages/'.$img);	
			 			  
			  if(mysql_num_rows(mysql_query("select * from sas_themecategories  where cat_name='$cat_name'"))==0)
			  {
			     $inssql="INSERT INTO `sas_themecategories` (`cat_name`,`imagepath`,`vcode`,`sort_order`,`catdesctiption`,`timeline`,`date_added`, `status` ) VALUES ('$cat_name','$img','$vcode','$sort_order','$catdesctiption','$timeline','now()','$Status')";
			     //echo $inssql;
			     //exit;
			     mysql_query($inssql);
			   
			     $_SESSION['sessionMsg']='Theme created';
			   
			  }
			  else{
			  
			     $_SESSION['sessionMsg']='Theme Name Exists';			   
			  }
			  
		   // }
			
			header("Location:categories.php?start=$start");
			
			exit;
	  }
 }

  //function for delete

  if(isset($_REQUEST["del"])){

	 $id=$_REQUEST["del"];

	 $delete="delete from sas_themecategories  WHERE cat_id='".$_REQUEST["del"]."'";

	 $delete_query=mysql_query($delete);

	 $_SESSION['sessionMsg']='Theme deleted Successfully';

	 header("Location:categories.php?start=$start");

	 exit;
  }

?>
<html>
<head>
<title><?php echo $bizConfig['siteName']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="../images/favicon.gif"/>
<link href="css/css.css" rel="stylesheet" type="text/css">
<SCRIPT language="JavaScript1.2" src="../includes/main.js"type="text/javascript"></SCRIPT>
<SCRIPT language="JavaScript1.2" src="../includes/style.js"type="text/javascript"></SCRIPT>
<!--- ckeditor starts --->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>
<script>
$( document ).ready( function() {
	$( 'textarea#catdesctiption' ).ckeditor();
} );
</script>
<!--- ckeditor ends --->
<script language="javascript1.1">
//alert message for delete
function delete_record(id)
{
	if(confirm("Are you sure to delete this Categories Section?"))
	{
		document.location.href='categories.php?del='+id;
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
	  if((!isset($_REQUEST['id']))&&(!isset($_REQUEST['Call'])) ){
	?>
	  <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">
         <tr>
           <td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1">
	        <!--display when user lands on the page-->									
			<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
				<td width="50%" class="h2">
				<img src="images/heading_icon.gif" width="16" height="16" hspace="5">
				<span class="verdana_small_white"><?php echo $PG_TITLE;?></span>
				</td>
				<td width="18%" align="right">
				<table  cellpadding=1 cellspacing=2 id=toplinks>
                 <tr>
                  <td width="150" >													
                  <a href="categories.php?Call=edit" class="blue_txt">Add&nbsp;New&nbsp;Theme&nbsp;Categories</a>															</td>
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
            
			<td  width="20%" align="center"   class="header_row" >Theme Title<a/></td>

			<td  width="15%" align="center"   class="header_row" >Theme Image<a/></td>
											  
			<td  width="15%" align="center"   class="header_row" >Vimeo Code<a/></td>

			<td  width="10%" align="center"  class="header_row" ><a class="whiteTxtlink" >Status</a></td>

			<td  width="21%" align="center" class="header_row" >Action</td>
         </tr>

		 <?php

			$sql="SELECT * FROM sas_themecategories";
			$no=mysql_query($sql);
			$no_rows= mysql_num_rows($no);
			
			$sql="SELECT * FROM sas_themecategories  limit $start,$q_limit";
			$rs=mysql_query($sql);
            $i=$start;

			while($line=mysql_fetch_array($rs)){
				
				if(isset($bgcolor) && $bgcolor =="#FFFFFF") {  $bgcolor="#F7F7F7";	}
	            else {  $bgcolor="#FFFFFF";	}
				
				$i++;
		  ?>

			 <!--Table displaying all the admin-->
			 <tr bgcolor = <?php echo $bgcolor;?>>
				<TD align="center" class="gray_txt"><?php print($i);?></TD>
				<TD align="center" class="gray_txt"><?php echo $line['cat_name']?></TD>
				<TD align="center" class="gray_txt"><img src="../productimages/<?php echo $line['imagepath']?>" width="100" height="50" ></TD>
				<TD align="center" class="gray_txt"><?php echo $line['vcode']?></TD>
				<TD align="center" class="gray_txt"><?php if($line['status']=='1'){echo 'Active';}else{echo 'Inactive';}?></TD>
				<td class="gray_txt" width="21%" valign="middle" align="center">
				<a href="product_manager.php?pcid=<?php echo $line['cat_id']?>" class="links">Aadd/Edit Videos</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;
				<a href="categories.php?start=<?php echo $start?>&Call=edit&id=<?php echo $line['cat_id']?>" class="links">Edit</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;
				<a href="javascript:delete_record('<?php echo $line['cat_id']?>')" class="links">Delete</a>
				<!--<span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="addvideo.php?vid=<?=$line['cat_id']?>&type=research" class="links">ADD VIDEO</a>-->											</td>
			 </tr>
		 <?php } ?>
			<tr bgcolor="#F7F7F7">
				<td align="right" colspan="8">&nbsp;</td>
			</tr>
			<tr align="center"  bgcolor="#FFFFFF">
               <td colspan="8" class="gray_txt" align="right">
				<?php
					//pagination file in config.inc.php 
					paginate($start,$q_limit,$no_rows,$filePath,"");
				?></td>
            </tr>
			<?php if($i==0){ ?>
            <tr align="center"  bgcolor="#FFFFFF">
               <td colspan="8" class="gray_txt"><?php print "Records are not Available." ?></td>
            </tr>
            <?php } ?>
        </form>
		<!--table1 ends-->
		</table></td></tr></table>
	<?php 
	  }
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
		 if(isset($_REQUEST['id'])){

			$sql = "SELECT * FROM sas_themecategories where cat_id=$_REQUEST[id]";
		    $rs = mysql_query($sql);
	        $res=mysql_fetch_array($rs);
			
			extract($res);				
		 }		
		?>
		<tr><td align="center" valign="top" bgcolor="#EEEEEE">
		<form name="frm_add_edit" method="post" action="" enctype="multipart/form-data" onSubmit="return validate1" >
		<?php 
		  if(isset($_REQUEST['id'])) {
			//for edit part only
		?>
			<input type="hidden" name="act" value="edit">
			<input type="hidden" name="id" value="<?php echo $_REQUEST['id']?>">
		<?php }?>
			<!--Table displaying edit/new part-->
		<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
			<tr class="header_row">
				<td colspan="3" align="left"> Add /Modify Categories </td>
			</tr>
			<tr>
				<td width="25%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Theme Title<span class="featured">*</span> : </strong>	</td>
				<td width="75%" align="left" bgcolor="#F7F7F7">
				<input name="cat_name" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($cat_name))print($cat_name);?>"/>				</td>
			</tr>
			<!--<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Theme Sort Order<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="sort_order" type="text" class="textbox" id="section_data" size="30" id="sort_order" value="< ?php print($sort_order);?>"/>				</td>
			</tr>-->
			<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Theme Description:</strong></td>
			  <td align="left" bgcolor="#F7F7F7">	
				  <textarea class="ckeditor" cols="80" id="editor1" name="catdesctiption" rows="10">
					 <?php if(isset($catdesctiption)) { echo $catdesctiption; } ?>		
				  </textarea>
			  <?php 
               /*
				$sBasePath = 'fckeditor/' ;

				$oFCKeditor = new FCKeditor('catdesctiption') ;

				$oFCKeditor->BasePath	= $sBasePath ;

				$oFCKeditor->Value		= '' ;

				if(isset($catdesctiption))

				    $oFCKeditor->Value	= $catdesctiption;

				    $oFCKeditor->Width  = '600' ;

					$oFCKeditor->Height = '350' ;	

					$oFCKeditor->Create();  
                */					
			   ?>
			
				</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Timeline Code<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="timeline" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($timeline))print($timeline);?>"/>	</td>
			</tr>
            <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>Theme Image<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><input name="res_img" type="file" class="textbox" id="imagepath" size="30" value=""/>&nbsp;<input type="hidden" name="imagepath" value="<?php if(isset($imagepath)) print($imagepath);?>"/>
				<b><font color="#FF0000">(width 400px height 527px)</font></b></td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Current Image <span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><img src="../productimages/<?php if(isset($imagepath)) print($imagepath);?>" width="150" height="85" border="0"></td>
			</tr>
            <tr>
            <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Vimeo Code (Theme Trailer)<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="vcode" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($vcode))print($vcode);?>"/>	</td>
			</tr>
            <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Status: </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="Status" type="radio"  value="0"<?php if(isset($status)=='0'){echo 'checked';}?>/>Inactive
					<input name="Status" type="radio"  value="1"<?php if(isset($status)=='1'){echo 'checked';}?>/>Active				</td>
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


