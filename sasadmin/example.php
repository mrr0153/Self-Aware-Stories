<?php
if(isset($_POST['submit']))
{
$to = 'pandubabu2010@gmail.com';
$email="pandubabu2010@gmail.com";
$subject= "Request For Quote from pandu";
$todayis = date("l, F j, Y, g:i a") ;
$message = "
Example Message --------- $_POST[comments]
";
         $mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";
         $headers = "From: $email\r\n" .
         "MIME-Version: 1.0\r\n" .
            "Content-Type: multipart/mixed;\r\n" .
            " boundary=\"{$mime_boundary}\"";
         $message = "This is a multi-part message in MIME format.\n\n" .
            "--{$mime_boundary}\n" .
            "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" .
         $message . "\n\n";
		 //print_r($_FILES['attachFile']); echo "<br>";
        // foreach($_FILES as $userfile)
		//echo sizeof($_FILES['attachFile']['name']);echo "<br>";
		
		for($i=0;$i<sizeof($_FILES['attachFile']['name']);$i++)
         {
		    //echo $_FILES['attachFile']['name'][$i];
			
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
		 
		if (mail($to, $subject, $message, $headers))
		   echo "Mail sent successfully.";
		else
		   echo "Error in mail";
}   
?>
<table width="90%" border="0" cellpadding="0" cellspacing="0" >
  <tr><td align="center" valign="top">&nbsp;</td></tr>
<tr>
    <td align="center" valign="top"><form action="" method="post" name="rfqfrm" id="rfqfrm" enctype="multipart/form-data">
        <table width="500" border="0" cellspacing="0" cellpadding="6">
          <tr>
            <td width="150" align="right" valign="middle">Attach File1:</td>
            <td align="left" valign="middle"><input type="file" name="attachFile[]" multiple></td>
          </tr>
		  <!--
          <tr>
            <td width="150" align="right" valign="middle">Attach File2:</td>
            <td align="left" valign="middle"><input type="file" name="attachFile[]" multiple></td>
          </tr>
		  -->
          <tr>
            <td width="150" align="right" valign="top">* Please describe your project needs: </td>
            <td align="left" valign="middle"><textarea name="comments" cols="30" rows="7" id="comments"></textarea></td>
          </tr>
          <tr>
            <td align="right" valign="middle">&nbsp;</td>
            <td align="left" valign="middle"><input type="reset" name="Reset" value="Clear">
              <input type="submit" name="submit" value="Submit"></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
