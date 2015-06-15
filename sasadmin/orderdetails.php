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

$filePath="orderdetails.php";

require_once("../config/config.inc.php");

include("../config/class.phpmailer.php");

//require_once("../includes/commonfunc.php");

require_once("../functions.inc.php");

isAdminOn('');

//////////////////////

// Page Title

//////////////////////

$PG_TITLE = 'Order Details';

//function for delete

if(isset($_REQUEST["del"]))

{

 $id=$_REQUEST["del"];

   $delete="delete from sas_orders WHERE `ref_order_id`='".$_REQUEST["del"]."'";

 $delete_query=mysql_query($delete);

 $_SESSION['sessionMsg']='Order Details deleted Successfully';

 

 header("Location: orderdetails.php");

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

	if(confirm("Are you sure to delete this Order details?"))

	{

		document.location.href='orderdetails.php?del='+id;

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

									

										      <TD width="13%" align="center" class="header_row"><a class="whiteTxtlink">Email Id </a></TD>

											    <td  width="20%" align="center"   class="header_row" >Product Name </td>

										        <td  width="20%" align="center"  class="header_row" >Order Date</td>	

											

											<td  width="12%" align="center"  class="header_row" >No of Items </td>

											<td  width="17%" align="center"  class="header_row" >Action</td>

											

                      					</tr>

										<?php

								//if the user searches a result by using only drop down menu	

									if(isset($_POST[search_option])&&($_POST[search_option]!="")&&($_POST['search']==""))

										{

			                           $sql="SELECT * FROM sas_orders order by $_POST[search_option] limit $start,$q_limit";

									   $no_rows= mysql_num_rows(mysql_query($sql));

										  }

										//if the user searches a result by using only drop down menu and serch field	

		else if ((isset($_POST['search_option'])&&($_POST['search_option']!="")&&($_POST['search']!=""))){

										  

						 $sql="SELECT * FROM sas_orders  where  $_POST[search_option] like '%$_POST[search]%' limit $start,$q_limit";

						  $no_rows= mysql_num_rows(mysql_query($sql));

										  }

										  //it shows all the results

										  else

										  {

										  

			$sql   = "SELECT * FROM sas_orders";

			$no_rows   = mysql_num_rows(mysql_query($sql));

			$sql   = "SELECT * FROM sas_orders LIMIT $start , $q_limit";

						  }

										  $rsGetAdmin  = mysql_query($sql);

			                            // $rs=mysql_query($sql);

										 

										 

				$i = 0;

											while($line=mysql_fetch_array($rsGetAdmin))

											{

												if($bgcolor=="#FFFFFF") $bgcolor="#F7F7F7";

												else $bgcolor="#FFFFFF";

												$i++;

												$details = explode(",", $line["order_details"]);	

												

									    ?>

										<!--Table displaying all the admin-->

									 <tr bgcolor = <?=$bgcolor?>>

										<TD align="center" class="gray_txt"><?=$line["emailid"]?></TD>

											<?php

				for($j=0;$j<count($details);$j++){

					$item = explode("|",$details[$j]);

					$selItemName = "SELECT prod_name,prod_image FROM sas_themes WHERE prod_id='$item[1]'";

					$rsItemName = mysql_query($selItemName) or die(mysql_error());

					$resItemName = mysql_fetch_assoc($rsItemName);

				?>

										<TD align="center" class="gray_txt"><?=$item[0]?></TD>

										<?php }?>

										<TD align="center" class="gray_txt"><?=$line['order_date']?></TD>

										<TD align="center" class="gray_txt"><?=$item[1];?></TD>

										

										<td class="gray_txt" width="17%" valign="middle" align="center">&nbsp;

											<a href="javascript:delete_record('<?=$line['ref_order_id']?>')" class="links">Delete</a></td>

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

				 

		?>

        <br>

</td></tr>

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

