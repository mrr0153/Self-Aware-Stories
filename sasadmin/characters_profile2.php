<?php 
ob_start();
error_reporting(0);
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

$filePath="characters_profile2.php";

require_once("../config/config.inc.php");

require_once("process2.php");
require_once("../functions.inc2.php");

include("FCKeditor/fckeditor.php");

if($_REQUEST['pcid'])
{
 $pcid=$_REQUEST['pcid'];
}
if($_REQUEST['pid'])
{
 $pid=$_REQUEST['pid'];
}

isAdminOn('');

//////////////////////

// Page Title

//////////////////////

$PG_TITLE = 'Characters Profile';
//checking for edit or new one and inserting to database

if(isset($_POST['add_edit']))
{
extract($_POST);
 //echo "<script>alert(".$id.'---'.$name.'---'.$title.'---'.$imagepath.'---'.$description.'---'.$pid.'---'.$pcid.'---'.$status.")</script>";
//////////////////////////////////Image Uploading//////////
    if($_FILES['photopath']['name']!="")
	{
	  $imagepath='cov'.date("His").'_'.$_FILES['photopath']['name'];
	  
	  if(move_uploaded_file($_FILES['photopath']['tmp_name'],'../character_photos/'.$imagepath))	
	   {
	    $imagepath='cov'.date("His").'_'.$_FILES['photopath']['name']; 
			
		}
		else
		{
			echo "error";
		}
	 }
	else
	{
	 $imagepath=$prev_img;
	}
	
 if(isset($act))
  {
	if($id!='')
	{
	$id=$id;
	}
	else
	{
	$id='';
	}
	
  }
     
 if(manageprofilesdetails($char_name,$title,$imagepath,$description,$pid,$pcid,$status,$id)) {
	
		$msg = "Program Updated Successfully";
	}
     header("location:characters_profile2.php?pid=".$pid."&pcid=".$pcid);
   }
 
//function for delete

if(isset($_REQUEST["del"]))

{

 $id=$_REQUEST["del"];

 $delete="delete from sas_chars  WHERE id='".$_REQUEST["del"]."'";

 $delete_query=mysql_query($delete);

 $_SESSION['sessionMsg']='Profile deleted Successfully';

 header("Location:characters_profile.php?pcid=$pcid&pid=$id");

 }

?>
<html>
<head>
<title><?php echo $bizConfig['siteName']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<SCRIPT language="JavaScript1.2" src="../includes/main.js"type="text/javascript"></SCRIPT>
<SCRIPT language="JavaScript1.2" src="../includes/style.js"type="text/javascript"></SCRIPT>
<script language="javascript1.1">
//alert message for delete
function delete_record(id,pid,pcid)
{
	if(confirm("Are you sure to delete this Profile Section?"))
	{
		document.location.href='characters_profile2.php?del='+id+'&pid='+pid+'&pcid='+pcid;
	}
}

</script>

<script type="text/javascript">
function getthemes(){
      
  var t=document.getElementById("select1").value
  //alert('cat id='+t)
  
  var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		//document.getElementById("select2").innerHTML=xmlhttp.responseText;
		t=xmlhttp.responseText.trim();
		var a = t.split("-") // Delimiter is a string
		//alert(a);
		//var b = a[0] // Delimiter is a string
		var b = a[0].split(",") // Delimiter is a string
		//alert(b);
		//var c = a[1] // Delimiter is a string
		var c = a[1].split(",") // Delimiter is a string
		//alert(c);
		var x=document.getElementById("select2");
			x.options.length=0;
		 for (var i = 0; i < b.length-1; i++)
		   {
			//alert(a[i])
			
			//x=document.getElementById("select2");
			
			var option=document.createElement("option");
			option.text=c[i];
			option.value=b[i];
			
			try
			 {
				 // for IE earlier than version 8
			   x.add(option,x.options[null]);
			 }
			catch (e)
			{
			   x.add(option,null);
			 }
		   }
			
		}
	  }
xmlhttp.open("GET","getthemes.php?qs="+t,true);
xmlhttp.send();
  
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
	<?php if((!isset($_REQUEST['id']))&&(!isset($_REQUEST['Call'])) )
		{?>
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

															<a href="characters_profile2.php?Call=edit&pcid=<?=$pcid?>&pid=<?=$pid?>" class="blue_txt">Add&nbsp;New&nbsp;Character</a>															</td>

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

									 <td  width="20%" align="center"   class="header_row" >Character Name</td>

									 <td  width="15%" align="center"   class="header_row" >Character Photo</td>
											 											 
									 <td  width="10%" align="center"  class="header_row" ><a class="whiteTxtlink" >Status</a></td>

									 <td  width="21%" align="center" class="header_row" >Action</td>

                      				</tr>

										<?php
										
                                         $sql="SELECT * FROM sas_chars where prod_id='$pid' and  cat_id='$pcid'";
										 $no=mysql_query($sql);
										 $no_rows= mysql_num_rows($no);
										 $sql="SELECT * FROM sas_chars where prod_id='$pid' and  cat_id='$pcid' limit $start,$q_limit";
                                       
			                             $rs=mysql_query($sql);

										     $i=$start;

											while($line=mysql_fetch_array($rs))

											{
												if(isset($bgcolor)=="#FFFFFF") $bgcolor="#F7F7F7";

   											    else $bgcolor="#FFFFFF";
												$i++;
									    ?>

										<!--Table displaying all the admin-->
									 <tr bgcolor = <?php echo $bgcolor?>>
										<TD align="center" class="gray_txt"><?php print($i);?></TD>
										<TD align="center" class="gray_txt"><?php echo $line['char_name']?></TD>
										<TD align="center" class="gray_txt"><img src="../character_photos/<?php echo $line['photopath'];?>" width="100" height="100"></TD>
										<TD align="center" class="gray_txt"><?php if($line['status']=='1'){echo 'Active';}else{echo 'Inactive';}?></TD>
										<td class="gray_txt" width="21%" valign="middle" align="center">
										<a href="characters_profile2.php?Call=edit&pid=<?php echo $pid;?>&pcid=<?php echo $pcid;?>&id=<?php echo $line['id']?>" class="links">Edit</a>
										<span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;
										<a href="javascript:delete_record('<?php echo $line['id']?>,<?php echo $pid;?>,<?php echo $pcid;?>')" class="links">Delete</a><span class="links" style="text-decoration:none"></tr>
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
		
		  
			<tr><td align="center" valign="top" bgcolor="#EEEEEE">
			<form name="frm_add_edit" method="post" action="" enctype="multipart/form-data" onSubmit="return validate1" >
			<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>">
			<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>">
			<input type="hidden" name="pcid" value="<?php echo $_REQUEST['pcid'];?>">
			<?php
			if(isset($_REQUEST['id']))
			{
			 $rs = getcharacterdetails($_REQUEST['id']);
			 }
			if($rs)
			{
			$row = mysql_fetch_assoc($rs);
			extract($row);
           // print_r($row);
			}
			 ?>
				  <!--Table displaying edit/new part-->
						<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
			<tr class="header_row">
				<td colspan="3" align="left"> Add /Modify Categories </td>
			</tr>         
			   
			<?php 
    			$rscat = getthemecategories();
				 if(isset($_REQUEST['pcid']))
                  { 
				   $pcid=$_REQUEST['pcid'];
				  
					//echo $cid;
				   $rrs = mysql_query("select * from sas_themecategories where cat_id='$pcid' ");									
				   if($rrs && $rowrrs=mysql_fetch_object($rrs))
					{
					 $cat_id= $rowrrs->cat_id;
					 //print_r($rowrrs);
				 	 //echo $cat_id;
					}
				  }
             ?>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Select Theme Category <span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<select id="select1" name="cat_id" class="admin_selectbox" onChange="getthemes(this)">
			   <option value="<?php echo $cat_name?>">Select</option>
			   <?php
				while($rowcat = mysql_fetch_object($rscat))
				 {
				?>
			   <option value="<?php echo $rowcat->cat_id;?>" <?php if(isset($cat_id) && $rowcat->cat_id==$cat_id) { ?> selected="selected" <?php } ?>><?php echo $rowcat->cat_name;?></option>
			   <?php
				 }
			   ?>
			 </select>
			 </td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Select Theme <span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				 <?php
			  if(isset($_REQUEST['pid']))
			  {
   			   $rrs = mysql_query("select * from sas_videos where id='$pid'");
			    if($rrs && $rowres=mysql_fetch_array($rrs))		 
				  {
				    extract($rowres);
					//print_r($rowres);
  				   
				  }
				  
				}   
				 ?>
         <select id="select2"  name="pid" class="admin_selectbox">
           <option  value="<?php if(isset($id)) echo $id;?>" <?php if(isset($id)) { ?> selected="selected" <?php }?>><?php if(isset($prod_name)){echo $prod_name;} else { echo "select";}?></option>
           	 
         </select>

				</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Character Name <span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="char_name" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($char_name))print($char_name);?>"/></td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Profile title <span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="title" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($title))print($title);?>"/>				</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>Character Photo<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><input name="photopath" type="file" class="textbox" id="imagepath" size="30" value=""/>&nbsp;<input type="hidden" name="prev_img" value="<?php if(isset($photopath)) print($photopath);?>"/>
				<b><font color="#FF0000">(width 400px height 527px)</font></b></td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Current Photo <span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><img src="../character_photos/<?php if(isset($photopath)) print($photopath);?>" width="150" height="150" border="0"></td>
			</tr>
			<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Character Profile:</strong></td>
			  <td align="left" bgcolor="#F7F7F7">
			  <?php 

										$sBasePath = 'fckeditor/' ;

										$oFCKeditor = new FCKeditor('description') ;

										$oFCKeditor->BasePath	= $sBasePath ;

										$oFCKeditor->Value		= '' ;

										if(isset($description))

										$oFCKeditor->Value	= $description;

										$oFCKeditor->Width  = '600' ;

										$oFCKeditor->Height = '350' ;	

										$oFCKeditor->Create();

									?>
									</td>
			  </tr>
            
            <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Status: </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="status" type="radio"  value="0"<?php if(isset($status)=='0'){echo 'checked';}?>/>Inactive
					<input name="status" type="radio"  value="1"<?php if(isset($status)=='1'){echo 'checked';}?>/>Active				</td>
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


