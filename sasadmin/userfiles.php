<?php 
 ob_start();
 session_start();
 error_reporting(0);
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
			
 require_once("../config/awsKeys.php");
			
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
				
				mysql_query("UPDATE `sas_readings` SET `cid`= '$cid',`vid`= '$vid',`rtitle`='".addslashes($rtitle)."',`rfilepath`= '$fileName',`addedon`=now(),`status`='$Status' where `rid`='$rid'");
                /*
				$fsql=mysql_query("select * from sas_readings where addedon=now() and cid='".$_REQUEST["cid"]."' and vid='".$_REQUEST["vid"]."'");
			    $fressql=mysql_fetch_array($fsql);
				
				$usql=mysql_query("select * from sas_users");
			    while( $uressql=mysql_fetch_array($usql)){
				 
				  mysql_query("INSERT INTO `sas_userreadings` (`rid`,`uid`,`status`) values('$fressql[rid]','$uressql[user_id]',0)"); 
				  mysql_query("UPDATE `sas_userreadings` SET `rid`= '$rid' where `rid`='$rid'");
				}
				*/
				$_SESSION['sessionMsg']='File Updated successfully';				
				
			 }else{
				//echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
				$_SESSION['sessionMsg']="Sorry, Image Name should not contain white spaces.";
			}
			
		 } else {
		 
			    $fileName = $prev_file;
			
			    //$upsql="UPDATE `sas_userfiles` SET `uid`= '$uid',`rtitle`='".addslashes($rtitle)."',`filepath`= '$fileName',`uid`= '$uid',`date_added`=now(),`status`='$Status' where `rid`='$rid'";
          
				//mysql_query($upsql);

				$_SESSION['sessionMsg']='File Updated successfully';
		 } 
 
          header("Location:userfiles.php");

          exit;
 
   } else{
             		  
		  $fileName ='file'.date("His").'_'.$_FILES['filepath']['name'];
		  $fileTempName=$_FILES['filepath']['tmp_name'];
		  //move the file
		  if ($s3->putObjectFile($fileTempName, "sas-userfiles", $fileName, S3::ACL_PUBLIC_READ)) {
			  //echo "<strong>We successfully uploaded your file.</strong>";					
		      if(mysql_num_rows(mysql_query("select * from sas_readings  where rtitle='$rtitle' and cid='".$_REQUEST["cid"]."' and vid='".$_REQUEST["vid"]."'"))==0)
			  {			    
			    mysql_query("INSERT INTO `sas_readings` (`rtitle`,`rfilepath`,`cid`,`vid`,`addedon`, `status` ) VALUES ('$rtitle','$fileName','$cid','$vid',now(),'$Status')");
			    
				$fsql=mysql_query("select * from sas_readings where addedon=now() and cid='".$_REQUEST["cid"]."' and vid='".$_REQUEST["vid"]."'");
			    $fressql=mysql_fetch_array($fsql);
				
				$usql=mysql_query("select * from sas_users");
			    while( $uressql=mysql_fetch_array($usql)){
				 
				  mysql_query("INSERT INTO `sas_userreadings` (`rid`,`uid`,`status`) values('$fressql[rid]','$uressql[user_id]',0)"); 
				}
				
				$_SESSION['sessionMsg']='File uploaded created';
			   
			  }else {
			  
			    $_SESSION['sessionMsg']='File Name Exists';
			  }
		  
		  }else{
			//echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
			$_SESSION['sessionMsg']="Sorry, Image Name should not contain white spaces.";
		  }     
        
          header("Location:userfiles.php?start=$start");
		
          exit;
    }

 }

//function for delete

 if(isset($_REQUEST["del"]))
 {
   
   $sqldel = mysql_query("select * from sas_readings WHERE rid='".$_REQUEST["del"]."'");
   $rowdel = mysql_fetch_array($sqldel); 
   
   $delete="delete from sas_readings WHERE rid='".$_REQUEST["del"]."'";

   if( $delete_query=mysql_query($delete)){
   
      $s3->deleteObject("sas-userfiles", $rowdel['filepath']);
   }
   
   $_SESSION['sessionMsg']='File deleted Successfully';

   header("Location:userfiles.php?start=$start");

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
function delete_record(uid,rid)
{
	if(confirm("Are you sure to delete this File?"))
	{
		document.location.href='userfiles.php?uid='+uid+'&del='+rid;
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

<script>
  
  function getVideoNames(cid){
  
    if(cid!=''){
	
      $.post('getvideonames.php',{'cid':cid},function(t){
	     
	     var a = t.split("---") 
	
		 var b = a[0].split(",") 
		
		 var c = a[1].split(",") // Delimiter is a string
		
		 var x=document.getElementById("videoname");
			x.options.length=0;
		 for (var i = 0; i < b.length-1; i++)
		 {
						
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
		
	  });
	  
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
 	    if((!isset($_REQUEST['rid']))&&(!isset($_REQUEST['Call'])) )
		 {  		   
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
                        		   <td width="50" >													
                                     <a href="userfiles.php?Call=edit" class="blue_txt">Add&nbsp;New&nbsp;File&nbsp;</a>															</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </table>
                  </td>
                </tr>
		        <tr><td align="center" valign="top" bgcolor="#EEEEEE">
                <table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">
                    
					<TD width="5%" align="center"  class="header_row"><a class="whiteTxtlink">S.No</a></TD>
                    
					<td  width="20%" align="center"   class="header_row" >File Name<a/></td>
                     
					<td  width="25%" align="center"   class="header_row" >Video Name<a/></td>
																  
					<td  width="25%" align="center"  class="header_row" ><a class="whiteTxtlink" >Theme Name</a></td>
                                              
					<td  width="10%" align="center"   class="header_row" >Date<a/></td>
                                           
					<td  width="5%" align="center" class="header_row" >Action</td>
                </tr>

			<?php

			    $sql="SELECT * FROM sas_readings";
				$no=mysql_query($sql);
				$no_rows= mysql_num_rows($no);
				$sql="SELECT * FROM sas_readings order by rid desc limit $start,$q_limit";

			    $rs=mysql_query($sql);

				$i=$start;

				while($line=mysql_fetch_array($rs)){
										
			        $themers=mysql_query("SELECT * FROM sas_themecategories where cat_id=$line[cid]");
					$themerrs=mysql_fetch_array($themers);
					
					$videors=mysql_query("SELECT * FROM sas_videos where id=$line[vid]");
					$videorrs=mysql_fetch_array($videors);
					
					if(isset($bgcolor) && $bgcolor == "#FFFFFF") $bgcolor="#F7F7F7";

   						else $bgcolor="#FFFFFF";
						$i++;
			?>

				<!--Table displaying all the admin-->
				<tr bgcolor = <?php echo $bgcolor?>>
					<TD align="center" class="gray_txt"><?php print($i);?></TD>
					<TD align="center" class="gray_txt"><?php echo $line['rtitle']?></TD>					
					<TD align="center" class="gray_txt"><?php echo $themerrs['cat_name'];?></TD>					
					<TD align="center" class="gray_txt"><?php echo $videorrs['prod_name'];?></TD>
					<TD align="center" class="gray_txt"><?php echo $line['addedon']?></TD>
					<td class="gray_txt" width="21%" valign="middle" align="center">
					<a href="readfile.php?Call=edit&name=<?php echo $line['rfilepath']?>" class="links">View</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;
					<a href="userfiles.php?Call=edit&rid=<?php echo $line['rid']?>" class="links">Edit</a><span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;
					<a href="javascript:delete_record('<?php echo $line['rid']; ?>')" class="links">Delete</a></tr>
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

		 if(isset($_REQUEST['rid']))
		   {

			$sql = "SELECT * FROM sas_readings where rid=".$_REQUEST['rid'];
		    $rs = mysql_query($sql);
	        $res=mysql_fetch_array($rs);
			
			extract($res);	
			
			}		
			?>
			<tr><td align="center" valign="top" bgcolor="#EEEEEE">
			<form name="frm_add_edit" method="post" action="" enctype="multipart/form-data" onSubmit="return validate1" >
			<?php  if(isset($_REQUEST['rid']))
				  {
				  //for edit part only
				   ?>
				  <input type="hidden" name="act" value="edit">
				  
				  <input type="hidden" name="rid" value="<?php echo $_REQUEST['rid']?>">
				  <?php }?>
				  
				  <!--Table displaying edit/new part-->
				<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
			<tr class="header_row">
				<td colspan="3" align="left"> Add /Modify File </td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Theme<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				
				<?php
				   $rscat=mysql_query('select * from sas_themecategories');
						
				   if(isset($vid))
                   { 						   
					 $rrs = mysql_query("select * from sas_themecategories where cat_id='$cid'");									
					 if($rrs && $rowrrs=mysql_fetch_object($rrs))
					 {
					   $cat_id= $rowrrs->cat_id;
					   
					 }
				   }
				 ?>
				 <select id="themename" name="cid" onchange="getVideoNames(this.value)">
				   <option value="<?=stripslashes($cat_name)?>">Select Theme</option>
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
					<strong> Video<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<?php
				  				
				   if(isset($vid))
                   { 				     
                     $rsvideos=mysql_query('select * from sas_videos');
					 
					 $rrs = mysql_query("select * from sas_videos where id='$vid'");
                    			 
					 if($rrs && $rowrrs=mysql_fetch_object($rrs))
					 {  
					    $id= $rowrrs->id;					   
					 }
				   }
				       
				 ?>
				 				
				 <select id="videoname"  name="vid" >
                   <option value="<?=stripslashes($id)?>">Select Video</option>
				   <?php  
				     while($rowvideos = mysql_fetch_object($rsvideos))
					 {  					  
				   ?>
				   <option value="<?php echo $rowvideos->id;?>" <?php if(isset($id) && $rowvideos->id==$id) { ?> selected="selected" <?php } ?>><?php echo stripslashes($rowvideos->prod_name);?></option>
				   <?php
					 }					   
				   ?> 
				 </select>
				</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> File Name<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="rtitle" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($rtitle))print($rtitle);?>"/>				</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>File<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="filepath" type="file" class="textbox" id="prod_image" size="30" value=""/>
				<input type="hidden" name="prev_file" value="<?php if(isset($rfilepath)){ echo $rfilepath;}?>">
				<?php if(isset($rfilepath)){ echo $rfilepath;}?> 
				</td>
			</tr>
            <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Status: </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				  <input name="Status" type="radio"  value="0"<?php if(isset($status)=='0'){echo 'checked';}?>/>Inactive
				  <input name="Status" type="radio"  value="1"<?php if(isset($status)=='1'){echo 'checked';}?>/>Active
				  
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


