
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="80" colspan="2" valign="middle" bgcolor="#FFFFFF" ><a href="admin_desktop.php"><img src="images/logo.png"  alt="<?php echo $bizConfig['siteName']?>" width="110" height="110" border="0"></a> </td>
  </tr>
  <tr>
    <td height="1" colspan="2"></td>
  </tr>
  <tr bgcolor="#92B2D6">
    <td height="5" colspan="2" bgcolor="#003466"></td>
  </tr>
  <tr>
    <td height="1" colspan="2"></td>
  </tr>
<style>
 .arrow_box {
  z-index: 1;
  position: absolute;
  margin-top: 10px;
  border: 1px solid #005292;
  z-index: 1;
  width: 150px;
  height: 20px;
  text-align: center;
  font-size: 11px;
  font-weight: bold;
  font-family: "Roboto", Arial, Verdana;
  background: #005292;
  border-radius: 4px;
  color: #FFF;
  padding: 5px 0 0 0px;
}

.arrow_box:after, .arrow_box:before {
  bottom: 100%;
  left: 21%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}

.arrow_box:after {
  border-color: rgba(136, 183, 213, 0);
  border-bottom-color: #005292;
  border-width: 10px;
  margin-left: -20px;
}
.arrow_box:before {
  /*border-color: rgba(194, 225, 245, 0);  
  border-bottom-color: #005292;*/
  /* border-width: 36px; */
  /* margin-left: -36px; */
}

</style>   
  <tr>
    <td width="27%" height="66" background="images/top_bg.gif"><img src="images/control_penal.gif" alt="Control Panel" width="173" height="66" hspace="20"></td>
    <td width="73%" height="66" valign="top" background="images/top_bg.gif"> 
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">	  
      <tr>
	    <td height="25" align="left" width="70%">
		<?php 
		if(isset($_SESSION['moderatorId'])){ 
		   
		   $sql="SELECT * FROM sas_comment where replystatus=0";			
		   $rs=mysql_query($sql);
		   $newcmts=mysql_num_rows($rs);  
		?>
		  <a href="sas_forum.php" style="margin-right: 40px;text-align:right;">
		   <?php
		     if($newcmts>0){
		   ?>
			 <img src="images/msg_red.png"  title='New Comments ( <?php echo $newcmts;?> )' alt="New Comments ( <?php echo $newcmts;?> )" width="auto" height="25" hspace="10" border="0">
		   <?php 
		     }else{
		   ?>
		     <img src="images/msg3.png"  title='New Comments ( <?php echo $newcmts;?> )' alt="New Comments ( <?php echo $newcmts;?> )" width="auto" height="25" hspace="10" border="0">
		   <?php
		     }
		   ?>
		  </a>
		   <?php
		     if($newcmts>0){
		   ?>
		  <div class="arrow_box">New Comments ( <?php echo $newcmts;?> )</div>
		   <?php
		     } }
		   ?>		   
	    </td>
        <td height="25" align="right" width="20%">				
		<?php
			if(isset($_SESSION['moderatorId'])){ 
        ?>
            <a href="logout.php" style="margin-right: 40px;">
			 <img src="images/log_out.gif" title='Logout' alt="Administrator Logout!" width="136" height="20" hspace="10" border="0">
			</a>
		<?php
			}
		?>	
		</td>
      </tr>
     <form method="get" name="form_top"> <tr>
        <td height="41" align="right"></td>
      </tr></form>
    </table>	</td>
  </tr>
</table>