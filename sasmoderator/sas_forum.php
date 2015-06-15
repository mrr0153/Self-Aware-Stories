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
 
 if(isset($_REQUEST['sortbyname'])){
 
    if($_REQUEST['sortbyname'] == 'asc'){
	   $sortbyname='desc';
	
	}else{
	   $sortbyname='asc';
	}    
	
 }else{
    $sortbyname='desc';
 }
 
 if(isset($_REQUEST['sortbydate'])){
 
    if($_REQUEST['sortbydate'] == 'asc'){
	   $sortbydate='desc';
	
	}else{
	   $sortbydate='asc';
	}    
	
 }else{
    $sortbydate='desc';
 }
 
 $filePath="sas_forum.php";

 require_once("../config/config.inc.php");

 require_once("../functions.inc.php");

 //isAdminOn('');

 $PG_TITLE = 'Forum Comments & Replies';
 //checking for edit or new one and inserting to database

 if(isset($_POST['add_edit']))
 {
   extract($_POST);
  
   if(isset($act))
   {     	
	 $upsql="UPDATE `sas_comment_replies` SET `reply` = '".addslashes(stripslashes($reply))."',`cmtid` = '$cmtid',`vid` = '$vid',`mdrid`=$mdrid,`replieddate`=now(),`status` = '$Status' WHERE `rid`=$_REQUEST[rid]";	   
	 	    	
     mysql_query($upsql);
     
	 mysql_query("UPDATE `sas_comment` SET replystatus='1' where id=$cmtid");
	 
     $_SESSION['sessionMsg']='Comment Reply Updated successfully';
 
     header("Location:sas_forum.php");

     exit;
  }
  else
  {
	    $inssql="INSERT INTO `sas_comment_replies` (`reply`,`cmtid`,`vid`,`mdrid`,`replieddate`, `status` ) VALUES ('".addslashes($reply)."','$cmtid','$vid','$mdrid',now(),'$Status')";
        
        mysql_query($inssql) or die( mysql_error() );
		 
		mysql_query("UPDATE `sas_comment` SET replystatus='1' where id=$cmtid");
		
        $_SESSION['sessionMsg']='Replied Successfully';
		     
        header("Location:sas_forum.php?start=$start");
		
        exit;
   }

 }
 //function for delete

 if(isset($_REQUEST["del"]))
 {   
   $rid=$_REQUEST["del"];

   $delete="delete from sas_forum  WHERE rid='".$_REQUEST["del"]."'";

   $delete_query=mysql_query($delete) or die(mysql_error());

   $_SESSION['sessionMsg']='Reply deleted Successfully';

   header("Location:sas_forum.php?start=$start");

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
	$( 'textarea#reply' ).ckeditor();
} );
</script>
<!--- ckeditor ends --->
<script language="javascript1.1">
//alert message for delete
function delete_record(rid)
{   //alert(rid)
	if(confirm("Are you sure to delete this Reply?"))
	{
		document.location.href='sas_forum.php?del='+rid;
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

<script language="javascript1.1">

function getVideos(type){
      
  var t=document.getElementById("select1").value
  //alert('cat id='+t)
  //alert('type='+type)
  
  var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //document.getElementById("select2").innerHTML=xmlhttp.responseText;
	t=xmlhttp.responseText.trim();
	//alert(t)
	var a = t.split("---") // Delimiter is a string
	
	var b = a[0].split(",") // Delimiter is a string
	
	var c = a[1].split(",") // Delimiter is a string
	//alert(b);
	//alert(c);
	var x=document.getElementById("select2");
	    x.options.length=0;
     for (var i = 0; i < b.length-1; i++)
       {
	    		
		//var x=document.getElementById("select2");
		
        var option=document.createElement("option");
        option.text=c[i];
		option.value=b[i];
		
		try
         {
             // for IE earlier than version 8
           x.add(option,x.options[null]);
         }
        catch (e)
        {
           x.add(option,null);
         }
       }
		
    }
  }
xmlhttp.open("GET","getsvideos.php?cid="+t+"&type="+type,true);
xmlhttp.send();
  
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
	<?php 
	   if((!isset($_REQUEST['cmtid']))&&(!isset($_REQUEST['Call'])) )
		{
	?>
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
			
           </td>
           </tr>
          </table>		  
         </td>
       </tr>
	   <!----------- Search ------------>
	   <!--
	   <tr>
        <td height="40" align="left" background="images/heading_bg.gif" bgcolor="#FFFFFF" class="h1">										
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
                   <a href="sas_quiz.php?Call=edit" class="blue_txt">Add&nbsp;New&nbsp;Question</a>															</td>
              </tr>
            </table>
           </td>
           </tr>
          </table>		  
         </td>
       </tr>
	   -->
	   <tr><td align="center" valign="top" bgcolor="#EEEEEE">
       <table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">
          <TD width="5%" align="center"  class="header_row"><a class="whiteTxtlink">S.No</a></TD>
          <td  width="30%" align="center"   class="header_row" ><a class="whiteTxtlink">Comment<a/></td>		  
          <td  width="25%" align="center"   class="header_row" >Video &nbsp;&nbsp;&nbsp; <a href="sas_forum.php?start=<?php echo $start;?>&sortbyname=<?php echo $sortbyname; ?>"><img src="images/<?php echo $sortbyname.'.gif';?>"> <a/> </td>
		  <td  width="10%" align="center"   class="header_row" ><a class="whiteTxtlink">Status<a/></td>									
		  <td  width="18%" align="center"   class="header_row" >Commented Date&nbsp;&nbsp;&nbsp; <a href="sas_forum.php?start=<?php echo $start;?>&sortbydate=<?php echo $sortbydate; ?>"><img src="images/<?php echo $sortbydate.'.gif';?>"> <a/></td>
		  <td  width="10%" align="center" class="header_row" ><a class="whiteTxtlink">Action</td>
       </tr>
         <?php         
		    $sql="SELECT * FROM sas_comment";
			$no=mysql_query($sql);			
			$no_rows= mysql_num_rows($no);
			
			if(isset($_REQUEST['sortbyname'])){
			  $sql="SELECT * FROM sas_comment order by vid $_REQUEST[sortbyname] limit $start,$q_limit ";
			}else if(isset($_REQUEST['sortbydate'])){
			  $sql="SELECT * FROM sas_comment order by date $_REQUEST[sortbydate] limit $start,$q_limit ";
			}else{
			  $sql="SELECT * FROM sas_comment order by date desc limit $start,$q_limit ";
			}
			
			$rs=mysql_query($sql);
            $i=$start;
            
			$mddtls=mysql_query("select * from sas_moderators where admin_id=".$_SESSION['moderatorId']);
			$rmddtls = mysql_fetch_array($mddtls);
			//print_r($rmddtls);
			 
			while($line=mysql_fetch_array($rs))
			{
			   if(isset($bgcolor) && $bgcolor == "#FFFFFF") $bgcolor="#F7F7F7";
               else $bgcolor="#FFFFFF";
			   $i++;
			  	
			   $rsvds=mysql_query("select * from sas_videos where id=".$line['vid']);
			   $rowvds = mysql_fetch_array($rsvds);
			   
               $rpldtls=mysql_query("select * from sas_comment_replies where cmtid='$line[id]' and mdrid=".$_SESSION['moderatorId']);
			   $rrpldtls = mysql_fetch_array($rpldtls);                
               	   
	      ?>
			<!--Table displaying all the admin-->
			<tr bgcolor = <?php echo $bgcolor?>>
			<TD align="center" class="gray_txt"><?php print($i);?></TD>
			<TD align="center" class="gray_txt"><?php echo stripslashes($line['comment'])?></TD>
			<TD align="center" class="gray_txt"><?php echo stripslashes($rowvds['prod_name'])?></TD>
			<TD align="center" class="gray_txt"><?php if($line['replystatus']=='1'){echo 'Replied';}else{echo 'Not Replied';}?></TD>
			<TD align="center" class="gray_txt"><?php echo $line['date']?></TD>
			<td class="gray_txt" width="21%" valign="middle" align="center">
			<?php			       
			  if( $rrpldtls['mdrid'] == $_SESSION['moderatorId']){			  
			?>				
				<?php if($line['replystatus']=='0'){ ?>
				  <a href="sas_forum.php?start=<?php echo $start?>&Call=edit&cmtid=<?php echo $line['id']?>" class="links">Reply</a>			
				<?php }else { ?>					
				  <a href="sas_forum.php?start=<?php echo $start?>&Call=edit&cmtid=<?php echo $line['id']?>" class="links">Edit</a>
				  <span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp; 
                  <a href="view-reply.php?start=<?php echo $start?>&cmtid=<?php echo $line['id']?>" class="links" target="_blank">View</a>			
								  
				<?php } ?>
				
			<?php }else{ ?>
			
			<?php if($line['replystatus']=='0'){ ?>
			<a href="sas_forum.php?start=<?php echo $start?>&Call=edit&cmtid=<?php echo $line['id']?>" class="links">Reply</a>&nbsp;|</span>&nbsp; 			
			<?php } ?>
			
			<a href="view-reply.php?start=<?php echo $start?>&cmtid=<?php echo $line['id']?>" class="links" target="_blank">View</a>			
			<?php } ?>
			</td>
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
				<span class="verdana_small_white"><?php echo $PG_TITLE;?></span></td>
			  </tr>
            </table>
			</td>
		  </tr>
	 <?php
		//checks it is editing
		 if(isset($_REQUEST['cmtid']))
		 {
			$csql = "SELECT * FROM sas_comment where id=".$_REQUEST['cmtid'];
		    $crs = mysql_query($csql);
	        $cres=mysql_fetch_array($crs);			
			extract($cres);			
		 
			$sql = "SELECT * FROM sas_comment_replies where cmtid=".$_REQUEST['cmtid'];
		    $rs = mysql_query($sql);
			if(mysql_num_rows($rs)>0){
	             $res=mysql_fetch_array($rs);			
			     extract($res);
            }			
		 }			 
	 ?>
	<tr><td align="center" valign="top" bgcolor="#EEEEEE">
		<form name="frm_add_edit" method="post" action="" enctype="multipart/form-data" onSubmit="return validate1" >
		<?php 
  		 if(isset($rid))
		 {
			//for edit part only
		?>
			<input type="hidden" name="act" value="edit">
			<input type="hidden" name="rid" value="<?php echo $rid;?>">
		<?php
		 }
		?>
		<?php 
  		 if(isset($_REQUEST['cmtid'])) 
		 {
			//for edit part only
		?>			
			<input type="hidden" name="cmtid" value="<?php echo $_REQUEST['cmtid']?>">
			<input type="hidden" name="vid" value="<?php echo $cres['vid']?>">
		<?php
		 }
		?>
		<input type="hidden" name="mdrid" value="<?php echo $_SESSION['moderatorId'];?>">
		<!--Table displaying edit/new part-->
		<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
			<tr class="header_row">
				<td colspan="3" align="left"> Add/Modify Reply </td> 				
			</tr>			
				
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Comment : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				 <p><?php if(isset($comment))print(stripslashes($comment));?></p></td>
			</tr>
									
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Reply<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				  <textarea name="reply" id="reply"  ><?php if(isset($reply))print($reply);?></textarea>
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


