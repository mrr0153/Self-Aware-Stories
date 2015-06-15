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

$filePath="users.php";

require_once("../config/config.inc.php");

require_once("../functions.inc.php");

isAdminOn('');

$PG_TITLE = 'User Readings';
//checking for edit or new one and inserting to database

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
		document.location.href='users.php?del='+id;
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
														<table  cellpadding=1 cellspacing=2 >
                        									<tr>
                        									  <td width="150" >													

															<!-- <a href="userfiles.php?Call=edit" class="blue_txt">Add&nbsp;New&nbsp;User&nbsp;Files</a>	-->	</td>

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

											  <td  width="20%" align="center"   class="header_row" >User Name<a/></td>

											  <td  width="15%" align="center"   class="header_row" >User Photo<a/></td>
											  
											  <!-- <td  width="15%" align="center"   class="header_row" >Vimeo Code<a/></td> -->

											  <td  width="10%" align="center"  class="header_row" ><a class="whiteTxtlink" >Status</a></td> 

											<td  width="21%" align="center" class="header_row" >Action</td>

                      					</tr>

										<?php

										 $sql="SELECT * FROM sas_users";
										 $no=mysql_query($sql);
										 $no_rows= mysql_num_rows($no);
										 $sql="SELECT * FROM sas_users order by user_id desc limit $start,$q_limit";

			                             $rs=mysql_query($sql);

										     $i=$start;

											while($line=mysql_fetch_array($rs))

											{  
												if(isset($bgcolor) && $bgcolor == "#FFFFFF") $bgcolor="#F7F7F7";

   											    else $bgcolor="#FFFFFF";
												$i++;
									    ?>

										<!--Table displaying all the admin-->
									 <tr bgcolor = <?php echo $bgcolor?>>
										<TD align="center" class="gray_txt"><?php print($i);?></TD>
										<TD align="center" class="gray_txt"><?php echo $line['username']?></TD>
										<TD align="center" class="gray_txt"><img src="<?php if(isset($line['photopath']) and !empty($line['photopath']) ){echo  "https://s3-us-west-2.amazonaws.com/sas-userphotos/".$line['photopath'];}else{ echo 'images/account.png'; }?>" width="60" height="50" ></TD>
										<TD align="center" class="gray_txt"><?php if($line['status']=='1'){echo 'Active';}else{echo 'Inactive';}?></TD>
										<td class="gray_txt" width="21%" valign="middle" align="center">		
										<a href="userfiles.php?uid=<?php echo $line['user_id']?>" class="links">Add / Edit Files</a></td>
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
				  <?php } ?>
           
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


