<?php
require_once("../config/config.inc.php");
if(isset($_SESSION['moderatorId']) && !empty($_SESSION['moderatorId']) ){
  header("Location: admin_desktop.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $bizConfig['siteName']?></title>
<link rel="shortcut icon" href="../images/favicon.gif"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" leftmargin="0" rightmargin="0">

<div align="right"></div>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="27%"><?php include"header.inc.php"?></td>

  </tr>

  <tr>

    <td height="60" colspan="2">&nbsp;</td>

  </tr>

  <tr align="center">

    <td colspan="2">

	<div style="width:45%"><table width="100%"  border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td align="left"><img src="images/secure_login.gif" alt="Main Administrator Login" width="212" height="42"></td>

        </tr>

      <tr>

        <td valign="top">&nbsp;</td>

      </tr>

      <tr>

        <td><table width="100%"  border="0" cellpadding="15" cellspacing="1" bgcolor="#CFCFCF">

          <tr>

            <td bgcolor="#F5F5F5">
			
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td width="9%" align="left"><img src="images/login_icon.gif" width="32" height="32"></td>

                <td width="91%" align="left" valign="top" class="blue_txt"><font face="Verdana, Arial, Helvetica, sans-serif"><strong>Welcome to <?=$bizConfig['siteName']?></strong></font></td>

              </tr>

              <tr>

                <td align="left">&nbsp;</td>

				<td align="center" valign="top" class="gray_txt">								

				 <?php 
  				   if(isset($_GET['invalid'])=='1'){
				?>
                  <p class="red_txt" align=center>Please check your username or password.</p>
                <?php
					}
                ?>
                </td>

              </tr>

              <tr>

                <td colspan="2" align="left">                 

                <table width="100%"  border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td width="34%" valign="top" class="gray_txt">Please enter a valid username and password to gain access to the administration console.</td>

                    <td width="66%" align="right" valign="top">
                 
                    <table width="80%"  border="0" cellpadding="7" cellspacing="1" bgcolor="#CFCFCF">

                      <tr>

                        <td bgcolor="#EFEFEF">

						<form name="details" method="POST" action="validate_admin.php" target="_top">

						<table width="100%"  border="0" cellspacing="0" cellpadding="1">

                          <tr>

                            <td align="left" class="gray_txt"><strong>Username</strong></td>

                          </tr>

                          <tr>

                            <td align="left"><input name="username_admin" type="text" class="main_txt" size="38" value="<?php if($bizConfig['localMode']) echo"xicom";?>"></td>

                          </tr>

                          <tr>

                            <td align="left" class="gray_txt"><strong>Password</strong></td>

                          </tr>

                          <tr>

                            <td align="left">

                              <input name="password_admin" type="password" class="main_txt" size="38" value="<?php if($bizConfig['localMode']) echo"tech";?>"></td>

                          </tr>

                          <tr>

                            <td height="4"></td>

                          </tr>

                          <tr>

                            <td align="right">

							<input type="hidden" name="login" value="login">

							<input type="image" name="Submit" src="images/submit.gif" alt="Submit" width="82" height="22" border="0">

							</td>

                          </tr>

                        </table>

						</form>

						</td>

                      </tr>

                    </table></td>

                  </tr>

                </table></td>

                </tr>

            </table></td>

          </tr>

        </table></td>

      </tr>

    </table></div>

    <br></td>

  </tr>

   <tr>

