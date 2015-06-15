<?php 
 ob_start();
 session_start();

 $start=0;

 $q_limit=10;

 $filePath="admin_manager.php";

 require_once("../config/config.inc.php");

 require_once("../functions.inc.php");

 isAdminOn('');

 $PG_TITLE = 'Admin Home';

 //checking for edit or new one and inserting to database

 if(isset($_POST['add_edit'])){

	extract($_POST);

	if(isset($act)){

	//$_SESSION['adminId'];

	/*if($_SESSION['adminId']==$_REQUEST["id"])

	 {*/

		$upsql="UPDATE `sas_adminusers` SET `username` = '$username',

			`password` = '$password',

			`first_name` = '$firstName',

			`last_name` = '$lastName',

			`email` = '$email',
            
			`date_added` = now(),
			
			`status` = '$status' WHERE `admin_id`=$_REQUEST[id]";

		 mysql_query($upsql);
		 
		 $_SESSION['sessionMsg']='Updated successfully';

		/*else

		{

		$_SESSION['sessionMsg']='You Are not authorised person';

		}

		*/
	}else {

		if(mysql_num_rows(mysql_query("select * from sas_adminusers where username='$username'"))==0){

			$inssql="INSERT INTO `sas_adminusers` (`username` , `password` , `first_name` , `last_name` , `email` , `date_added` , `status` )

			VALUES ('$username','$password','$firstName','$lastName','$email',now(),'$status')";

			mysql_query($inssql);

			$_SESSION['sessionMsg']='Adminstrator created';

		}else {

		    $_SESSION['sessionMsg']='User Name Exists';

		}
	}

    header("Location: admin_manager.php");

    exit;
 }

 //function for delete

 if(isset($_REQUEST["del"])){

	 $id=$_REQUEST["del"];

	 if($_SESSION['adminId']==$_REQUEST["del"]) {

	     $_SESSION['sessionMsg']='you can not delete your self';

	 }else{

		 $delete="delete from sas_adminusers WHERE admin_id='".$_REQUEST["del"]."'";

		 $delete_query=mysql_query($delete);

		 $_SESSION['sessionMsg']='Adminstrator deleted Successfully';
	 }

     header("Location: admin_manager.php");

     exit;
 }

?>
<html>

<head>

<title><?=$bizConfig['siteName']?></title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="../images/favicon.gif"/>
<link href="css/css.css" rel="stylesheet" type="text/css">

<SCRIPT language="JavaScript1.2" src="../includes/main.js"type="text/javascript"></SCRIPT>

<SCRIPT language="JavaScript1.2" src="../includes/style.js"type="text/javascript"></SCRIPT>

<script language="javascript1.1">

//alert message for delete

 function delete_record(id){

	if(confirm("Are you sure to delete this Adminstrator?"))
	{
		document.location.href='admin_manager.php?del='+id;
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
	
	<?php if((!isset($_REQUEST['id']))&&(!isset($_REQUEST['Call'])) ){ ?>
	
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
					<td width="32%" align="right">
					<table width="61" border="0" align="right" cellspacing="1">
					<!--<tr>                         
						 <td align="right" valign="middle"><img src="images/arrow_top.gif" width="8" height="5" border="0" /></td>

						 <td width="37" align="center" valign="middle"><A href="#" class="admin_links" onMouseOver="stm(Text[17],Style[12])" onMouseOut="htm()">Help</a></td>

						 </tr>-->					
					</table>
					</td>
					<td width="18%" align="right">
                    <table width="92" cellpadding=1 cellspacing=2 id=toplinks>
					<tr>
					<td width="105">
					<a href="admin_manager.php?Call=edit" class="blue_txt">Add&nbsp;New&nbsp;User</a>
					</tr>
					</table>
					</td>
					</tr>
					</table>
					</td>

					</tr>
					<tr><td align="center" valign="top" bgcolor="#EEEEEE">

					<!--form for sorting results by order-->

					<form name="form_search" method="post" action="">

					<!--<table width="80%"  border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#D8D8D8">

					<tr class="header_row">                      
					  <td colspan="2" align="left" class="white_bold">Search</td>

					  </tr>

					  <tr bgcolor="#FFFFFF">

					  <td align="center" width="75%" class="gray_txt"><strong>Show:</strong>

					  <select name="search_option" class="textbox">

					  <option value="">---Select---</option>
						
					  <option value="username">User Name</option>

					  <option value="First_Name">First Name</option>

					  <option value="Last_Name">Last Name</option>

					  </select>
					
					&nbsp;  

					<input type="text" name="search" size="30" class="textbox">

					</td>
                    
					<td align="left" width="25%"><input type="submit" name="Go" value="&nbsp;&nbsp;&nbsp;&nbsp;Go&nbsp;&nbsp;&nbsp;&nbsp;" class="buttons"></td>

					</tr>

					</table>-->	

					</form>								

					<!--table1 start-->

					<table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">

					<TD width="10%" align="center"  class="header_row"><a class="whiteTxtlink">S.No</a></TD>

					<td  width="14%" align="center"   class="header_row" ><a class="whiteTxtlink" >First Name<a/></td>

					<td  width="14%" align="center"  class="header_row" ><a class="whiteTxtlink" >Last Name</a></td>

					<td  width="19%" align="center" class="header_row" ><a class="whiteTxtlink" >Email</a></td>

					<td  width="9%" align="center"  class="header_row" ><a class="whiteTxtlink" >Status</a></td>

					<td  width="14%" align="center"  class="header_row" >Action</td>

				</tr>
				
			<?php

				//if the user searches a result by using only drop down menu	

				$sql="SELECT * FROM sas_adminusers limit $start,$q_limit";

				$no=mysql_query($sql);

				$no_rows= mysql_num_rows($no);

				$sql="SELECT * FROM sas_adminusers limit $start,$q_limit";
				
				$rs=mysql_query($sql);

				$i=0;

				while($line=mysql_fetch_array($rs)){
						
					if(isset($bgcolor) && $bgcolor =="#FFFFFF") $bgcolor="#F7F7F7";
					else $bgcolor="#FFFFFF";
					$i++;
            ?>
				
				<!--Table displaying all the admin-->

				<tr bgcolor = <?=$bgcolor?>>
				
				  <TD align="center" class="gray_txt"><? print($i);?></TD>

				  <TD align="center"  class="gray_txt"><?=$line['first_name']?></TD>

				  <TD align="center"  class="gray_txt"><?=$line['last_name']?></TD>

				  <TD  align="center" class="gray_txt"><?=$line['email']?></TD>

				  <TD align="center" class="gray_txt"><?php if($line['status']=='1'){echo 'active';}else{echo 'inactive';}?></TD>

				  <td class="gray_txt" width="14%" valign="middle" align="center">

				  <a href="admin_manager.php?Call=edit&id=<?=$line['admin_id']?>" class="links">Edit</a>

				  <span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;

				  <a href="javascript:delete_record('<?=$line['admin_id']?>')" class="links">Delete</a></td>

				</tr>

				<?php  } ?>

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

		<span class="verdana_small_white"><?php echo $PG_TITLE;?></span>													</td>

		</tr>
        
		</table>

		</td>

		</tr>

		<?php

		//checks it is editing 

		if(isset($_REQUEST['id'])){

			$sql = "SELECT * FROM sas_adminusers  where admin_id=$_REQUEST[id]";

		    $rs = mysql_query($sql);

	        $res=mysql_fetch_array($rs);

			extract($res);	

			}		
        ?>

		<tr><td align="center" valign="top" bgcolor="#EEEEEE">

		<form name="frm_add_edit" method="post" action=""  onSubmit="return validateForm();">

		<?php  if(isset($_REQUEST['id'])){

				//for edit part only
        ?>

		<input type="hidden" name="act" value="edit">

		<?php }?>

		<!--Table displaying edit/new part-->

		<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
            <tr class="header_row">
			 <td colspan="3" align="left">User Edit/Add New User</td>
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> User Name<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="username" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($username)){ print($username);}?>"/>
				</td>
			</tr>		

			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Password<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="password" type="password" class="textbox" id="section_data" size="30" value="<?php if(isset($password)){  print($password);}?>"/>
				</td>
			</tr>		

			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> First Name<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="firstName" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($first_name)){  print($first_name);}?>"/>
				</td>
			</tr>

			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Last Name<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="lastName" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($last_name)){  print($last_name);}?>"/>
				</td>
			</tr>

			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Email<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="email" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($email)){  print($email);}?>"/>
				</td>
			</tr>

			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Status<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="status" type="radio"  value="0"<?php if(isset($status)=='0'){echo 'checked';}?>/>Inactive
					<input name="status" type="radio"  value="1"<?php if(isset($status)=='1'){echo 'checked';}?>/>Active
				</td>
			</tr>

			<tr>
				<td align="right" bgcolor="#FFFFFF" height="40"></td>
				<td width="70%" align="left" bgcolor="#FFFFFF">
					<input type="submit" name="add_edit" value="Save Data" class="buttons" />&nbsp;&nbsp;
					<input type="reset" name="cancel" value="Reset" class="buttons" />
					<input type="button" name="back" value="Back" class="buttons" onClick="javascript:history.back()">
					</td>
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