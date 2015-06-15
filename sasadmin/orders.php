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

$filePath="orders.php";

require_once("../config/config.inc.php");

include("../config/class.phpmailer.php");

//require_once("../includes/commonfunc.php");

require_once("../functions.inc.php");

isAdminOn('');

//////////////////////

// Page Title

//////////////////////

$PG_TITLE = 'Orders';

//checking for edit or new one and inserting to database

if(isset($_POST['add_edit']))

{

extract($_POST);

if(isset($act))

{

		 $qEditAdmin = "UPDATE sas_order_amount SET order_status='$order_status' WHERE order_id = $_REQUEST[id]";

			mysql_query($qEditAdmin);

			 /* $qGetInvdet   = "SELECT * FROM m_orders WHERE order_id  ='$_REQUEST[id]'";

			  $rsGetInvdet  = mysql_query($qGetInvdet);

			  $resGetInvdet = mysql_fetch_array($rsGetInvdet);

		if($order_status =='1')

		 {

	$getuser=mysql_query("select user_email,user_id from m_regusers where username='".$resGetInvdet['user_name']."'");

	$resgetuser=mysql_fetch_assoc($getuser);

	$userName=$resgetuser['user_email'];

	$userid=$resgetuser['user_id'];

	

	$sender='saikamal.wings@gmail.com.com';

	$mail = new PHPMailer();

				$mail->IsMail();

				//$mail->IsSMTP();

				//$mail->Host = "";

				//$mail->SMTPAuth = true;

				//$mail->Username = "";

				//$mail->Password = "";

				$mail->Timeout  = 360;

				//$mail->From     = $sender;

				$mail->FromName = $sender;

				$mail->AddReplyTo($userName);

				//$mail->AddAddress("", "Administrator");

				$name = explode('@',$userName);

				$mail->AddAddress($userName,$name[0]);

				$mail->AddCC("");

				$mail->WordWrap = 50;	

				$mail->IsHTML(true);

				$mail->Subject ='Form Details from Movie&TV Contracts';

				$body='Thanks for being with US, this email provides you with a link.<br/>

					   You can click on the link below to download the ordered form <br/><br/>

					   

	<a href="'.$bizConfig['httpPath'].'download.php?id='.$userid.'">Click here to Download</a>

	

					   For any questions you may have please contact xyz@test.com.<br/><br/>

	

					 - The Movie&Tv Contracts Team';

				$mail->Body    = $body;	

				$mail->Send();

		

		}

		elseif($order_status =='2')

		{

		

	$getuser=mysql_query("select user_email,user_id from m_regusers where username='".$resGetInvdet['user_name']."'");

	$resgetuser=mysql_fetch_assoc($getuser);

	$userName=$resgetuser['user_email'];

	$userid=$resgetuser['user_id'];

	

	$sender='';

	$mail = new PHPMailer();

				//$mail->IsMail();

				$mail->IsSMTP();

				$mail->Host = "";

				$mail->SMTPAuth = true;

				$mail->Username = "";

				$mail->Password = "";

				$mail->Timeout  = 360;

				$mail->From     = $sender;

				$mail->FromName = $sender;

				$mail->AddReplyTo($userName);

				//$mail->AddAddress("", "Administrator");

				$name = explode('@',$userName);

				$mail->AddAddress($userName,$name[0]);

				$mail->AddCC("");

				$mail->WordWrap = 50;	

				$mail->IsHTML(true);

				$mail->Subject ='Movie&TV Contracts';

				$body='Thanks for being with US, Your transaction has been denied.

	

					   For any questions you may have please contact xyz@test.com.<br/><br/>

	

					 - The Movie&Tv Contracts Team';

				$mail->Body    = $body;	

				$mail->Send();

		

		

	

		}*/

		header("Location:orders.php?start=$start");

		exit;

	

}}

//function for delete

if(isset($_REQUEST["del"]))

{

 $id=$_REQUEST["del"];

   $delete="delete from sas_order_amount WHERE `order_id`='".$_REQUEST["del"]."'";

 $delete_query=mysql_query($delete);

 $_SESSION['sessionMsg']='Order deleted Successfully';

 

 header("Location: orders.php");

 exit;

 }



?>



<html>

<head>

<title><?=$bizConfig['siteName']?></title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="css/css.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../images/favicon.gif"/>
<SCRIPT language="JavaScript1.2" src="../includes/main.js"type="text/javascript"></SCRIPT>

<script language="javascript1.1">

//alert message for delete

function delete_record(id)

{

	if(confirm("Are you sure to delete this order details?"))

	{

		document.location.href='orders.php?del='+id;

	}

}

function openPOPUP(orderid){

	window.open("invoicedet.php?order_id="+orderid,"INVOICE","width=620,height=600,left=380,top=270,resizable=yes,scrollbars=yes");

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

														<span class="verdana_small_white"><? echo $PG_TITLE;?></span>

													</td>

													<!--<td width="32%" align="right"><table width="61" border="0" align="right" cellspacing="1">

                                                      <tr>

                                                        <td align="right" valign="middle"><img src="images/arrow_top.gif" width="8" height="5" border="0" /></td>

                                                        <td width="37" align="center" valign="middle"><A href="#" class="admin_links" onMouseOver="stm(Text[17],Style[12])" onMouseOut="htm()">Help</a></td>

                                                      </tr>

                                                  </table></td>-->

													

												</tr>

                							</table>

										</td>

									</tr>

									

									<tr><td align="center" valign="top" bgcolor="#EEEEEE">

									<!--form for sorting results by order-->

							

                                    <!--table1 start-->

								    <table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">

									

										    <TD width="13%" align="center"  class="header_row"><a class="whiteTxtlink">Order By</a></TD>

											  <td  width="20%" align="center"   class="header_row" >Order Total</td>

										  <td  width="20%" align="center"   class="header_row" >Order Date</td>	

											

											<td  width="12%" align="center"  class="header_row" >Order Status</td>

											<td  width="17%" align="center" class="header_row">Action</td>

											

                      					</tr>

										<?php

								

										  

			$qGetAdmin   = "SELECT * FROM sas_order_amount";

			$no_rows   = mysql_num_rows(mysql_query($qGetAdmin));

			$qGetAdmin   = "SELECT * FROM sas_order_amount LIMIT $start , $q_limit";

			

		

										   /* $sql="SELECT * FROM fish_categories limit $start,$q_limit";

										    $no=mysql_query($sql);

										  $no_rows= mysql_num_rows($no);

										  $sql="SELECT * FROM fish_categories limit $start,$q_limit";*/

										   

										 

										  $rsGetAdmin  = mysql_query($qGetAdmin);

			                            // $rs=mysql_query($sql);

										 

										 

				$i = 0;

											while($line=mysql_fetch_array($rsGetAdmin))

											{

											

												if($bgcolor=="#FFFFFF") $bgcolor="#F7F7F7";

												else $bgcolor="#FFFFFF";

												$i++;

												/*$details = explode("|", $line["order_details"]);	*/

												

									    ?>

										<!--Table displaying all the admin-->

									 <tr bgcolor = <?=$bgcolor?>>

										<TD align="center" class="gray_txt"><?=$line['emailid']?></TD>

										<TD align="center" class="gray_txt"><?=$line['order_total']?></TD>

										<TD align="center" class="gray_txt"><?=$line['order_date']?></TD>

										<TD align="center" class="gray_txt"><? if($line['order_status']=='2') {echo "Denied"; } elseif($line['order_status']=='1') {echo "Accepted"; } else { echo "Arrived";}?></TD>

										

										<td class="gray_txt" width="17%" valign="middle" align="center">

											

											<a href="javascript:delete_record('<?=$line['order_id']?>')" class="links">Delete</a>

											<span class="links" style="text-decoration:none">&nbsp;|</span><a href="javascript:openPOPUP(<?=$line['order_id']?>);" class="links"> Invoice</a></td>

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

														<span class="verdana_small_white"><? echo $PG_TITLE;?></span>													</td>

													<td width="32%" align="right"><table width="61" border="0" align="right" cellspacing="1">

                                                      <tr>

                                                        <td align="right" valign="middle"><img src="images/arrow_top.gif" width="8" height="5" border="0" /></td>

                                                        <td width="37" align="center" valign="middle"><A href="#" class="admin_links" onMouseOver="stm(Text[44],Style[12])" onMouseOut="htm()">Help</a></td>

                                                      </tr>

                                                  </table></td>

												</tr>

                							</table>

										</td>

									</tr>

				  <?php

				  //checks it is editing 

				  if(isset($_REQUEST['id']))

				  {

			$sql = "SELECT * FROM sas_order_amount WHERE order_id =$_REQUEST[id]";

		    $rs = mysql_query($sql);

	        $res=mysql_fetch_array($rs);

			extract($res);	

			}		

			?>

			<tr><td align="center" valign="top" bgcolor="#EEEEEE">

			<form name="frm_add_edit" method="post" action=""  onSubmit="return validateForm();">

			<?php  if(isset($_REQUEST['id']))

				  {

				  //for edit part only

				   ?>

				  

				  <input type="hidden" name="act" value="edit">

				  <?php }?>

				  <!--Table displaying edit/new part-->

						<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">

			<tr class="header_row">

				<td colspan="3" align="left"><span class="tahoma16boldred">Modify Order Status</span></td>

			</tr>

			

			

			<tr>

			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Order Id  :</strong></td>

			  <td align="left" bgcolor="#F7F7F7"><?=$order_id?></td>

			  </tr>

			

			  <tr>

			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Shipping Address  :</strong></td>

			  <td align="left" bgcolor="#F7F7F7"><?php

				 $selShipAddress = "SELECT * FROM sas_shipping WHERE s_email='$res[emailid]'"; 

				$rsShipAddress  = mysql_query($selShipAddress) or die(mysql_error());

				$resShipAddress = mysql_fetch_assoc($rsShipAddress);

				$Address = strpos($resShipAddress["s_address"],'|');

				if($Address!='') {

					$ship_address =  str_replace("|","<br>",$resShipAddress["s_name"]."&nbsp;".'<br>'.$resShipAddress["s_address"]);

					echo $ship_address.'<br>'.$resShipAddress["s_email"].'<br>'.$resShipAddress["s_postcode"].'<br>'.$resShipAddress["s_state"].'<br>'.$resShipAddress["s_country"].'<br>';

				} else {

					echo $resShipAddress["s_address"];

				}

				?></td>

			  </tr>

			  <tr>

			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Billing Address   :</strong></td>

			  <td align="left" bgcolor="#F7F7F7">&nbsp;	<?php

				$selShipAddress = "SELECT * FROM sas_shipping WHERE s_email='$res[emailid]'"; 

				$rsShipAddress  = mysql_query($selShipAddress) or die(mysql_error());

				$resShipAddress = mysql_fetch_assoc($rsShipAddress);

				$Address = strpos($resShipAddress["b_address"],'|');

				if($Address!='') {

					$ship_address =  str_replace("|","<br>",$resShipAddress["b_name"]."&nbsp;".'<br>'.$resShipAddress["b_address"]);

					echo $ship_address.'<br>'.$resShipAddress["b_email"].'<br>'.$resShipAddress["b_postcode"].'<br>'.$resShipAddress["b_state"].'<br>'.$resShipAddress["b_country"].'<br>';

				} else {

					echo $resShipAddress["b_address"];

				}

				?></td>

			  </tr>

			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">

					<strong> Order Status<span class="featured">*</span> : </strong>	</td>

				<td width="70%" align="left" bgcolor="#F7F7F7"><select name="order_status">

                  <option value="0" selected>Arrived</option>

                  <option value="1" <?php if($order_status == '1'){ echo 'selected';}?>>Accept</option>

                  <option value="2" <?php if($order_status == '2'){ echo 'selected';}?>>Reject</option>

                </select></td>

			</tr>

			<tr>

				<td align="right" bgcolor="#FFFFFF" height="40"></td>

				<td width="70%" align="left" bgcolor="#FFFFFF">

					<input type="submit" name="add_edit" value="Save Data" class="buttons" />&nbsp;&nbsp;

					<input type="reset" name="cancel" value="Cancel" class="buttons" />

					<a href="orders.php"><input type="button" name="back" value="Back" class="buttons"></a>					</td>

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

