<?php session_start();

require_once("../config/config.inc.php");

//require_once("../includes/commonfunc.php");

require_once("../functions.inc.php");

//checking if the admin is logged in

isAdminOn('');
//////////////////////

// Page Title

//////////////////////

$PG_TITLE = 'Admin Home';

?>
<html>

<head>

<title><?php echo $bizConfig['siteName']?></title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="../images/favicon.gif"/>
<link href="css/css.css" rel="stylesheet" type="text/css">

<script>

</script>

</head>

<body topmargin="0" leftmargin="0" rightmargin="0">

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

    <td align="right" height="30">&nbsp;</td>

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

			<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#B1B1B1">

          	<tr>

            <td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1">

					<table width="99%"  border="0" cellspacing="0" cellpadding="0">

              		<tr>

		           	<td width="47%" class="h2"><img src="images/heading_icon.gif" width="16" height="16" hspace="5"><?php echo $PG_TITLE; ?></td>

                	<td width="53%" align="right">&nbsp;</td>

              		</tr>

            		</table>			
			</td>

          	</tr>

          	<tr>

            <td height="300" align="center" valign="center" bgcolor="#EEEEEE"><br>

              		<table width="85%" border="0" cellspacing="0" cellpadding="5">

                	<tr align="center">

                  	<td class="gray_txt" align="left" valign="top"><p style="text-align:center">
					
					<b>Welcome to <?php  $bizConfig['siteName']?> Administrative Suite </b>

                  	<br>

                  	</p></td>

                	</tr>

              		</table>

			</td>

          	</tr>

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