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

 $filePath="sas_quiz.php";

 require_once("../config/config.inc.php");

 //require_once("../includes/commonfunc.php");

 require_once("../functions.inc.php");

 isAdminOn('');

 $PG_TITLE = 'Questions';
 //checking for edit or new one and inserting to database

 if(isset($_POST['add_edit']))
 {

   extract($_POST);
  
  // print_r($_POST);
  
  if(isset($act))
  {
     // print_r($act);
	 if($vtype=="svideo"){
	
		$upsql="UPDATE `sas_quiz` SET `question` = '".addslashes(stripslashes($question))."',`option1` = '".addslashes(stripslashes($option1))."',`option2` = '".addslashes(stripslashes($option2))."',`option3` = '".addslashes(stripslashes($option3))."',`option4` = '".addslashes(stripslashes($option4))."',`opt1expl` = '".addslashes(stripslashes($opt1expl))."',`opt2expl` = '".addslashes(stripslashes($opt2expl))."',`opt3expl` = '".addslashes(stripslashes($opt3expl))."',`opt4expl` = '".addslashes(stripslashes($opt4expl))."',`answer` = '".addslashes(stripslashes($answer))."',`description` = '".addslashes(stripslashes($description))."',`vtype` = '$vtype',`vid` = '$vid',`cpvid`='',`vcid`='$cat_id',`date_added`=now(),`status` = '$Status' WHERE `qid`=$_REQUEST[qid]";
	   
	 }
	
     if($vtype=="cvideo"){  
   
        $upsql="UPDATE `sas_quiz` SET `question` = '".addslashes(stripslashes($question))."',`option1` = '".addslashes(stripslashes($option1))."',`option2` = '".addslashes(stripslashes($option2))."',`option3` = '".addslashes(stripslashes($option3))."',`option4` = '".addslashes(stripslashes($option4))."',`opt1expl` = '".addslashes(stripslashes($opt1expl))."',`opt2expl` = '".addslashes(stripslashes($opt2expl))."',`opt3expl` = '".addslashes(stripslashes($opt3expl))."',`opt4expl` = '".addslashes(stripslashes($opt4expl))."',`answer` = '".addslashes(stripslashes($answer))."',`description` = '".addslashes(stripslashes($description))."',`vtype` = '$vtype',`vid` = '',`cpvid`='$vid',`vcid`='$cat_id',`date_added`=now(),`status` = '$Status' WHERE `qid`=$_REQUEST[qid]";
    
     }
	
     mysql_query($upsql);

     $_SESSION['sessionMsg']='Updated successfully';
 
     header("Location:sas_quiz.php");

     exit;
  }
  else
  {
     		 
    if(mysql_num_rows(mysql_query("select * from sas_quiz  where question='$question'"))==0)
    { 
	    if($vtype=="svideo"){
	  
           $inssql="INSERT INTO `sas_quiz` (`question`,`option1`,`option2`,`option3`,`option4`,`opt1expl`,`opt2expl`,`opt3expl`,`opt4expl`,`answer`,`description`,`vtype`,`vid`,`cpvid`,`vcid`,`date_added`, `status` ) VALUES ('".addslashes($question)."','".addslashes($option1)."','".addslashes($option2)."','".addslashes($option3)."','".addslashes($option4)."','".addslashes($opt1expl)."','".addslashes($opt2expl)."','".addslashes($opt3expl)."','".addslashes($opt4expl)."','".addslashes($answer)."','".addslashes($description)."','$vtype','$vid','','$cat_id',now(),'$Status')";
        }
	    if($vtype=="cvideo"){
	   
	       $inssql="INSERT INTO `sas_quiz` (`question`,`option1`,`option2`,`option3`,`option4`,`opt1expl`,`opt2expl`,`opt3expl`,`opt4expl`,`answer`,`description`,`vtype`,`vid`,`cpvid`,`vcid`,`date_added`, `status` ) VALUES ('".addslashes($question)."','".addslashes($option1)."','".addslashes($option2)."','".addslashes($option3)."','".addslashes($option4)."','".addslashes($opt1expl)."','".addslashes($opt2expl)."','".addslashes($opt3expl)."','".addslashes($opt4expl)."','".addslashes($answer)."','".addslashes($description)."','$vtype','','$vid','$cat_id',now(),'$Status')";
     	   
	    }
	  
        mysql_query($inssql);
		   
        $_SESSION['sessionMsg']='Question created';
		   
     }
	 else
     {
        $_SESSION['sessionMsg']='Question Exists';
     }
        
     header("Location:sas_quiz.php?start=$start");
		
    exit;
  }

 }
 //function for delete

 if(isset($_REQUEST["del"]))
 {
   //echo "<script>alert(".$_REQUEST['del']." ) </script>";
 
   $qid=$_REQUEST["del"];

   $delete="delete from sas_quiz  WHERE qid='".$_REQUEST["del"]."'";

   $delete_query=mysql_query($delete) or die(mysql_error());

   $_SESSION['sessionMsg']='Question deleted Successfully';

   header("Location:sas_quiz.php?start=$start");

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
	$( 'textarea#catdesctiption' ).ckeditor();
} );
</script>
<!--- ckeditor ends --->
<script language="javascript1.1">
//alert message for delete
function delete_record(qid)
{   //alert(qid)
	if(confirm("Are you sure to delete this Question?"))
	{
		document.location.href='sas_quiz.php?del='+qid;
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
	<?php if((!isset($_REQUEST['qid']))&&(!isset($_REQUEST['Call'])) )
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
		

									<tr><td align="center" valign="top" bgcolor="#EEEEEE">

								    <table width="100%" border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#EFD57E">

										    <TD width="5%" align="center"  class="header_row"><a class="whiteTxtlink">S.No</a></TD>

											  <td  width="30%" align="center"   class="header_row" >Question<a/></td>

											  <td  width="15%" align="center"   class="header_row" >Theme<a/></td>
											  
											  <td  width="18%" align="center"   class="header_row" >Situational Video<a/></td>
											  
											  <td  width="18%" align="center"   class="header_row" >Coping Video<a/></td>

											  <td  width="5%" align="center"  class="header_row" ><a class="whiteTxtlink" >Status</a></td>

											<td  width="10%" align="center" class="header_row" >Action</td>

                      					</tr>

										<?php

										 $sql="SELECT * FROM sas_quiz";
										 $no=mysql_query($sql);
										 $no_rows= mysql_num_rows($no);
										 $sql="SELECT * FROM sas_quiz  limit $start,$q_limit";

			                             $rs=mysql_query($sql);

										     $i=$start;

											while($line=mysql_fetch_array($rs))

											{
												if(isset($bgcolor) && $bgcolor == "#FFFFFF") $bgcolor="#F7F7F7";

   											    else $bgcolor="#FFFFFF";
												$i++;
												
												$rscat=mysql_query("select * from sas_themecategories where cat_id=".$line['vcid']);
						                        $rowcat = mysql_fetch_array($rscat);
												
												$rsvds=mysql_query("select * from sas_videos where id=".$line['vid']);
						                        $rowvds = mysql_fetch_array($rsvds);
												
												$rscpvds=mysql_query("select * from sas_copvideos where id=".$line['cpvid']);
						                        $rowcpvds = mysql_fetch_array($rscpvds);
									    ?>

										<!--Table displaying all the admin-->
									 <tr bgcolor = <?php echo $bgcolor?>>
										<TD align="center" class="gray_txt"><?php print($i);?></TD>
										<TD align="center" class="gray_txt"><?php echo $line['question']?></TD>
										<TD align="center" class="gray_txt"><?php echo $rowcat['cat_name']?></TD>
										<TD align="center" class="gray_txt"><?php echo $rowvds['prod_name']?></TD>
										<TD align="center" class="gray_txt"><?php echo $rowcpvds['prod_name']?></TD>
										<TD align="center" class="gray_txt"><?php if($line['status']=='1'){echo 'Active';}else{echo 'Inactive';}?></TD>
										<td class="gray_txt" width="21%" valign="middle" align="center">
										<a href="sas_quiz.php?start=<?php echo $start?>&Call=edit&qid=<?php echo $line['qid']?>" class="links">Edit</a>
										<span class="links" style="text-decoration:none">&nbsp;|</span>&nbsp;
										<a href="javascript:delete_record('<?php echo $line['qid']?>')" class="links">Delete</a>
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

		  if(isset($_REQUEST['qid']))
		   {

			$sql = "SELECT * FROM sas_quiz where qid=".$_REQUEST['qid'];
		    $rs = mysql_query($sql);
	        $res=mysql_fetch_array($rs);
			
			extract($res);	
			
			}		
			?>
			<tr><td align="center" valign="top" bgcolor="#EEEEEE">
			<form name="frm_add_edit" method="post" action="" enctype="multipart/form-data" onSubmit="return validate1" >
			<?php  if(isset($_REQUEST['qid']))
				  {
				  //for edit part only
				   ?>
				  <input type="hidden" name="act" value="edit">
				  <input type="hidden" name="qid" value="<?php echo $_REQUEST['qid']?>">
				  <?php }?>
				  <!--Table displaying edit/new part-->
						<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">
			<tr class="header_row">
				<td colspan="3" align="left"> Add /Modify Questions </td>				
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Theme<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<?php
				   $rscat=mysql_query('select * from sas_themecategories');
						
				   if(isset($vcid))
                   { 						   
					 $rrs = mysql_query("select * from sas_themecategories where cat_id='$vcid'");									
					 if($rrs && $rowrrs=mysql_fetch_object($rrs))
					 {
					   $cat_id= $rowrrs->cat_id;
					   //print_r($rowrrs);
					   //echo $gcatid;
					 }
				   }
				 ?>
				 <select name="cat_id" class="admin_selectbox" id="select1" >
				   <option value="<?=stripslashes($cat_name)?>">Select</option>
				   <?php
				     while($rowcat = mysql_fetch_object($rscat))
					 {
					?>
				   <option value="<?php echo $rowcat->cat_id;?>" <?php if(isset($cat_id) && $rowcat->cat_id==$cat_id) { ?> selected="selected" <?php } ?>><?php echo $rowcat->cat_name;?></option>
				   <?php
					  }
				   ?>
				  </select>
		     </td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Video Type: </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input id="vtype" name="vtype" type="radio"  value="svideo"<?php if(isset($vtype) and trim($vtype)=="svideo"){echo 'checked';}?> onclick="getVideos('svideo')"/>Situational Video
					<input id="vtype" name="vtype" type="radio"  value="cvideo"<?php if(isset($vtype) and trim($vtype)=="cvideo"){echo 'checked';}?> onclick="getVideos('cvideo')"/>Coping Video
				</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Videos<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
                <?php
				  					
				   if(isset($vid) and $vid>0)
                   { 				     
                     $rsvideos=mysql_query('select * from sas_videos');
					 
					 $rrs = mysql_query("select * from sas_videos where id='$vid'");
                    					 
					 if($rrs && $rowrrs=mysql_fetch_object($rrs))
					 {  
					    $id= $rowrrs->id;					   
					 }
					 
				   }
				   
				   if(isset($cpvid) and $cpvid>0 )
                   {  
                     $rsvideos=mysql_query('select * from sas_copvideos');	
					 
					 $rrs = mysql_query("select * from sas_copvideos where id='$cpvid'");									
					 if($rrs && $rowrrs=mysql_fetch_object($rrs))
					 {
					   $id= $rowrrs->id;
					   
					 }
				   }
				   
					    
				 ?>
				 
				
				 <select id="select2"  name="vid" class="admin_selectbox" >
                   <option value="<?=stripslashes($prod_name)?>">Select</option>
				   <?php  
				     while($rowvideos = mysql_fetch_object($rsvideos))
					 {  					  
					?>
				   <option value="<?php echo $rowvideos->id;?>" <?php if(isset($id) && $rowvideos->id==$id) { ?> selected="selected" <?php } ?>><?php echo stripslashes($rowvideos->prod_name);?></option>
				   <?php
					  }					   
				   ?> 
				 </select>
				 
				</td> 
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Question<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				 <textarea name="question" rows="5" cols="50"><?php if(isset($question))print($question);?></textarea></td>
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Option 1<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<textarea name="option1" rows="3" cols="50"><?php if(isset($option1))print($option1);?></textarea></td>
			</tr> 
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Option 1 explanation<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<textarea name="opt1expl" rows="5" cols="50"><?php if(isset($opt1expl))print($opt1expl);?></textarea></td>
			</tr>
			
            <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Option 2<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<textarea name="option2" rows="3" cols="50"><?php if(isset($option2))print($option2);?></textarea></td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Option 2 explanation<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<textarea name="opt2expl" rows="5" cols="50"><?php if(isset($opt2expl))print($opt2expl);?></textarea></td>
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Option 3<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<textarea name="option3" rows="3" cols="50"><?php if(isset($option3))print($option3);?></textarea></td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Option 3 explanation<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<textarea name="opt3expl" rows="5" cols="50"><?php if(isset($opt3expl))print($opt3expl);?></textarea></td>
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Option 4<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<textarea name="option4" rows="3" cols="50"><?php if(isset($option4))print($option4);?></textarea></td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Option 4 explanation<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">				
			    <textarea name="opt4expl" rows="5" cols="50"><?php if(isset($opt4expl))print($opt4expl);?></textarea></td>
			</tr>
			
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
					<strong> Answer<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				  <textarea name="answer" rows="5" cols="50"><?php if(isset($answer))print($answer);?></textarea>
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


