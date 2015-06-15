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

 $filePath="sas_forum.php";

 require_once("../config/config.inc.php");

 require_once("../functions.inc.php");

 isAdminOn('');

 $PG_TITLE = 'Forum Comment & Replies';
 //checking for edit or new one and inserting to database
 
 //function for delete

 if(isset($_REQUEST["del"]))
 {   
   $rid=$_REQUEST["del"];

   $delete="delete from sas_comment_replies  WHERE rid='".$_REQUEST["del"]."'";

   $delete_query=mysql_query($delete) or die(mysql_error());
    
   $_SESSION['sessionMsg']='Reply deleted Successfully';
   //echo $_REQUEST['cmtid'];
   mysql_query("UPDATE sas_comment SET replystatus='0' where id='$_REQUEST[cmtid]'") or die(mysql_error());
   
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

<script language="javascript1.1">
//alert message for delete
function delete_record(rid,cmtid)
{   //alert(rid)
	if(confirm("Are you sure to delete this Reply?"))
	{
		document.location.href='view-reply.php?del='+rid+'&cmtid='+cmtid;
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
	   // if((!isset($_REQUEST['rid']))&&(!isset($_REQUEST['Call'])) )
		// {
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
	  
 	   <tr><td align="center" valign="top" bgcolor="#EEEEEE">
       <table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">
          <TD width="5%" align="center"  class="header_row"><a class="whiteTxtlink">S.No</a></TD>
          <td  width="20%" align="center"   class="header_row" >Comment<a/></td>		  
          <td  width="20%" align="center"   class="header_row" >Reply<a/></td>
		  <!--
		  <td  width="15%" align="center"   class="header_row" >Status<a/></td>									
		  <td  width="18%" align="center"   class="header_row" >Date<a/></td>
		  -->
		  <td  width="10%" align="center" class="header_row" >Action</td>
       </tr>
         <?php         
		    $sql="SELECT * FROM sas_comment_replies";
			$no=mysql_query($sql);
			$no_rows= mysql_num_rows($no);
			$sql="SELECT * FROM sas_comment_replies where cmtid='$_REQUEST[cmtid]' order by replieddate desc limit $start,$q_limit ";

			$rs=mysql_query($sql);
            $i=$start;
            			  
			while($line=mysql_fetch_array($rs))
			{
			  if(isset($bgcolor) && $bgcolor == "#FFFFFF") $bgcolor="#F7F7F7";
              else $bgcolor="#FFFFFF";
			  $i++;
			  
			  $cmtdtls = mysql_query("select * from sas_comment where id=".$line['cmtid']);
			  $rcmtdtls = mysql_fetch_array($cmtdtls);
			 
			 
	      ?>
			<!--Table displaying all the admin-->
			<tr bgcolor = <?php echo $bgcolor?>>
			<TD align="center" class="gray_txt"><?php print($i);?></TD>
			<TD align="center" class="gray_txt"><?php echo stripslashes($rcmtdtls['comment']);?></TD>			
			<TD align="center" class="gray_txt"><?php echo stripslashes($line['reply']);?></TD>			
			<td class="gray_txt" valign="middle" align="center">
			<?php			 
			  if( isset($line['adminid']) && $_SESSION['adminId'] == $line['adminid'] ){
			?>					
			<a href="javascript:delete_record('<?php echo $line['rid']?>','<?php echo $_REQUEST['cmtid']?>')" class="links">Delete</a>
			<?php
			}else{?>
             --- 
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
	    <?php
		// }

		?>
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


