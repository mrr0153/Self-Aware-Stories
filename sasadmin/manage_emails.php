<?php 
 ob_start();
 error_reporting(0);
 session_start();
 require_once("../config/config.inc.php");

 require_once("../functions.inc.php");

 isAdminOn('');
 
 $filePath="manage_emails.php";
 
 $PG_TITLE = 'Send E-Mail';
 
 if(isset($_POST['add_edit']))
 {       
	//extract($_POST);
    
    $subject=$_POST['subject'];
    $replyto=$_POST['replyto'];
    $message = "
    $_POST[description] 
";
         $mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";
         $headers = "From: Self-Aware Stories<$replyto>\r\n" .
		 "Reply-To: $replyto\r\n" .
         "MIME-Version: 1.0\r\n" .
            "Content-Type: multipart/mixed;\r\n" .
            " boundary=\"{$mime_boundary}\"";
         $message = "This is a multi-part message in MIME format.\n\n" .
            "--{$mime_boundary}\n" .
            "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" .
         $message . "\n\n";
		
		for($i=0;$i<sizeof($_FILES['attachFile']['name']);$i++)
         {		    
            $tmp_name = $_FILES['attachFile']['tmp_name'][$i];
            $type = $_FILES['attachFile']['type'][$i];
            $name = $_FILES['attachFile']['name'][$i];
            $size = $_FILES['attachFile']['size'][$i];
            if (file_exists($tmp_name))
            {
               if(is_uploaded_file($tmp_name))
               {
                  $file = fopen($tmp_name,'rb');
                  $data = fread($file,filesize($tmp_name));
                  fclose($file);
                  $data = chunk_split(base64_encode($data));
               }
               $message .= "--{$mime_boundary}\n" .
                  "Content-Type: {$type};\n" .
                  " name=\"{$name}\"\n" .
                  "Content-Disposition: attachment;\n" .
                  " filename=\"{$name}\"\n" .
                  "Content-Transfer-Encoding: base64\n\n" .
               $data . "\n\n";
            }
         }
		 
         $message.="--{$mime_boundary}--\n";
		 		
	  for($i=0;$i<sizeof($_POST['email']);$i++){ 
		   
		if(mail($_POST['email'][$i],$subject,$message,$headers))
		{
		   $_SESSION['sessionMsg']="Email sent successfully!";
		}else{
		   $_SESSION['sessionMsg']="Email not sent!";
		}    
			
	  }
  
  header("location:manage_emails.php");
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
	
	$( 'textarea#description' ).ckeditor();
	
	$("#selectType").click(function(){
	    		
		var checked = $("#selectType:checked").length;
        		
	    if(checked){
		
		  //alert("checked")
		  $('.toemails').prop('checked',true);
		  
		}else{
		  $('.toemails').prop('checked',false);
		  //alert("un checked")
		}
		
	});
		
  } );

  function validateForm(){
    
	var checked = $(".toemails:checked").length;
    	
    if(checked == 0)
	{
		alert("Please Email(s)");		
        return false; 
	} description
	
	if($("#description").description.value=="")
	{
	  alert("Please Enter Email Body Content");
	  document.form.description.focus();
	  return false;
	}
	
	if(($("#replyto").value.search(/^[a-z A-Z]+[_ .]*[0-9]*[a-z A-Z]+[0-9]*@[a-z A-Z]+\.[a-z A-Z]+[\.]*[a-z A-Z]+$/)==-1))
	{
	  alert("Please Enter Reply To Email Id");
	  document.form.replyto.focus();
	  return false;
	}
	
  }
</script>
<!--- ckeditor ends --->
<style>
 .featured{
   color:red;
 }
</style>
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
			<form name="frm_add_edit" method="post" action="" enctype="multipart/form-data" onSubmit="return validateForm()" >
			<!--Table displaying edit/new part-->
			<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
			<tr class="header_row">
				<td colspan="3" align="left"> &nbsp;</td>
			</tr>
			
			<tr>
				<td width="25%" height="30" align="right" bgcolor="#F7F7F7">
					<!-- <strong> To<span class="featured">*</span> : </strong> -->
					&nbsp;
				</td>
				<td width="75%" align="left" bgcolor="#F7F7F7">
				 Select All <input type="checkbox" id="selectType" name="selectType">
				</td>
			</tr>
			
			<tr>
				<td width="25%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> To<span class="featured">*</span> : </strong>
				</td>
				<td width="75%" align="left" bgcolor="#F7F7F7">
				
				<?php 
				   $toaddresses='';
				   $rusers = mysql_query("select * from sas_users ");
				   $no=mysql_num_rows($rusers);	
				   $i=1;
				   
				   while($rusers && $rowrrs=mysql_fetch_array($rusers)){
					
                ?>
				  <div style="float:left;width:33%;">
				   <input type="checkbox" class="toemails" name="email[]" value="<?php echo $rowrrs['email'];?>" > <?php echo $rowrrs['email'];?><br>
                  </div>
				<?php
				   }
				?>
				
				</td>
			</tr>
			<tr>
				<td width="25%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Subject : </strong>	</td>
				<td width="75%" align="left" bgcolor="#F7F7F7">
				<input name="subject" type="text" class="textbox" id="section_data" size="140" value="" />
				</td>
			</tr>
			<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Compose E-Mail <span class="featured">*</span> :</strong></td>
			  <td align="left" bgcolor="#F7F7F7">
			  <textarea name="description" id="description"  ></textarea>
			  </td>
			</tr>
			
            <tr>
				<td width="25%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Reply To <span class="featured">*</span> : </strong>	</td>
				<td width="75%" align="left" bgcolor="#F7F7F7">
				<input name="replyto" id="replyto" type="text" class="textbox" id="section_data" size="140" value=""  /></td>
			</tr>
			
			<tr>
				<td width="25%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Attachments : </strong>	</td>
				<td width="75%" align="left" bgcolor="#F7F7F7">
				<input name="attachFile[]" type="file" multiple class="textbox" id="section_data" /></td>
			</tr>
            
			<tr>
				<td align="right" bgcolor="#FFFFFF" height="40"></td>
				<td width="70%" align="left" bgcolor="#FFFFFF">
					<input type="submit" name="add_edit" value="Send Email" class="buttons"  />&nbsp;&nbsp;
					
					<input type="button" name="back" value="Back" class="buttons" onClick="javascript:history.back()">
				</td>
		    </tr>
		</table>
		</form>
		
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