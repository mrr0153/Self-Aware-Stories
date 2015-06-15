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

$filePath="manage_users.php";

require_once("../config/config.inc.php");

require_once("../functions.inc.php");

isAdminOn('');

$PG_TITLE = 'Manage Users';

//function for delete

 if(isset($_POST['add_edit']))
 {
   extract($_POST);
  
  // print_r($_POST);
  
   if(isset($act))
   {
     // print_r($act);
	 	
	 $upsql="UPDATE `sas_users` SET `first_name` = '$first_name',`last_name` = '$last_name',`email` = '$email',`password`='$password',`status` = '$Status' WHERE `user_id`='$uid'";	   
	 	    	
     mysql_query($upsql);     
	 
     $_SESSION['sessionMsg']='User Profile Updated Successfully';
 
     header("Location:manage_users.php");

     exit;
  }
  
 }

 if(isset($_REQUEST["del"]))
 {   
   $sqldel = mysql_query("select * from sas_users  WHERE user_id='".$_REQUEST["del"]."'");
   $rowdel = mysql_fetch_array($sqldel); 
     
   $delete="delete from sas_users  WHERE user_id='".$_REQUEST["del"]."'";

   if(mysql_query($delete)){
	  
	  if (file_exists("https://s3-us-west-2.amazonaws.com/sas-userphotos/$rowdel[photopath]")) {
        
		$s3->deleteObject("sas-userphotos", $rowdel['photopath']);
	  } 
   }

   $_SESSION['sessionMsg']='User deleted Successfully';

   header("Location:manage_users.php?start=$start");

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
	if(confirm("Are you sure to delete this User?"))
	{
		document.location.href='manage_users.php?del='+id;
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
	<?php if((!isset($_REQUEST['uid']))&&(!isset($_REQUEST['Call'])) )
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
                        <td width="100" >													
                        <a href="uploadusers.php?Call=edit" class="blue_txt">Add&nbsp;New&nbsp;Users</a></td>
                       </tr>
                    </table>
                    </td>
                   </tr>
                </table>
               </td>
              </tr>
		      <tr><td align="center" valign="top" bgcolor="#EEEEEE">
              <table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">
                 <TD width="7%" align="center"  class="header_row"><a class="whiteTxtlink">S.No</a></TD>
                 <td  width="20%" align="center"   class="header_row" ><a class="whiteTxtlink" >User Name<a/></td>
				 <td  width="20%" align="center"   class="header_row" ><a class="whiteTxtlink" >Email<a/></td>
				 <td  width="13%" align="center"   class="header_row" ><a class="whiteTxtlink" >Photo<a/></td>	
                 <td  width="20%" align="center"   class="header_row" ><a class="whiteTxtlink" >Reports for Questionnaire<a/></td>					 
				 <td  width="10%" align="center"  class="header_row" ><a class="whiteTxtlink" >Status</a></td> 
                 <td  width="10%" align="center" class="header_row" >Action</td>
              </tr>
            <?php

				$sql="SELECT * FROM sas_users";
				$no=mysql_query($sql);
				$no_rows= mysql_num_rows($no);
				$sql="SELECT * FROM sas_users order by user_id desc limit $start,$q_limit";
                $rs=mysql_query($sql);
                $i=$start;
                while($line=mysql_fetch_array($rs)){  
					if(isset($bgcolor) && $bgcolor == "#FFFFFF") $bgcolor="#F7F7F7";
                    else $bgcolor="#FFFFFF";
					$i++;
			?>

			<!--Table displaying all the admin-->
			<tr bgcolor = <?php echo $bgcolor?>>
			<TD align="center" class="gray_txt"><?php print($i);?></TD>
			<TD align="center" class="gray_txt"><?php echo $line['username']?></TD>
			<TD align="center" class="gray_txt"><?php echo $line['email']?></TD>
			<TD align="center" class="gray_txt">
			<img src="<?php if(isset($line['photopath']) and !empty($line['photopath']) ){echo  "https://s3-us-west-2.amazonaws.com/sas-userphotos/".$line['photopath'];}else{ echo 'images/account.png'; }?>" width="60" height="50" ></TD>
			<TD align="center" class="gray_txt"><a href="reports.php?Call=edit&uid=<?php echo $line['user_id']?>" target="_blank">Click Here to View Reports</a></TD>
			<TD align="center" class="gray_txt"><?php if($line['status']=='1'){echo 'Active';}else{echo 'Inactive';}?></TD>
			<td class="gray_txt" width="21%" valign="middle" align="center">		
			<a href="manage_users.php?Call=edit&uid=<?php echo $line['user_id']?>" class="links">Edit</a><span class="links" style="text-decoration:none">&nbsp;&nbsp;|&nbsp;</span>
			<a href="javascript:delete_record('<?php echo $line['user_id']?>')" class="links">Delete</a></td>
		</tr>
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
			else {
		?>
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

		    if(isset($_REQUEST['uid']))
		     {
			   $sql = "SELECT * FROM sas_users where user_id=".$_REQUEST['uid'];
		       $rs = mysql_query($sql);
	           $res=mysql_fetch_array($rs);			
			   extract($res);				
			 }		
			?>
			<tr><td align="center" valign="top" bgcolor="#EEEEEE">
			<form name="frm_add_edit" method="post" action="" enctype="multipart/form-data" onSubmit="return validate1" >
			<?php if(isset($_REQUEST['uid']))
				  {
				  //for edit part only
				   ?>
				  <input type="hidden" name="act" value="edit">
				  <input type="hidden" name="uid" value="<?php echo $_REQUEST['uid']?>">
				  <?php }?>
				  <!--Table displaying edit/new part-->
						<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
			<tr class="header_row">
				<td colspan="3" align="left"> Modify User </td>				
			</tr>
									
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> First Name : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				  <input type="text" name="first_name" value="<?php if(isset($first_name)){ print($first_name);}?>" >
				</td>			   
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Last Name : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				  <input type="text" name="last_name" value="<?php if(isset($last_name)){ print($last_name);}?>" >
				</td>			   
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> E-Mail<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				  <input type="text" name="email" value="<?php if(isset($email)){ print($email);}?>" >
				</td>			   
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> User Name : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				  <p><?php if(isset($username)){ print($username);}?></p>
				</td>			   
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Password<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				  <input type="text" name="password" value="<?php if(isset($password)){ print($password);}?>" >
				</td>			   
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


