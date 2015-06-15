<!--<script language="javascript" src="validation.js"></script>
<script language="javascript">
function validate1()
{
if(!GenValidation(f.product_name,'Product Name','','') || !GenValidation(f.price,'Price','','') || !SelectValidation(f.pid,'Category','0') || !GenValidation(f.price,'Price','','') )
{
return false;
}else return true;
if(document.frm_add_edit.prod_name.value=='')
{
alert('please enter the product name');
document.frm_add_edit.prod_name.focus();
return false;
}
if(document.frm_add_edit.publishername.value=='')

alert('please Select the parent Category');
document.frm_add_edit.publishername.focus();
return false;
}
if(document.frm_add_edit.prod_image.value=='' && document.frm_add_edit.prev_prod_image.value=='')
{
alert('please Select the Image');
document.frm_add_edit.prod_image.focus();
return false;
}
if(document.frm_add_edit.description.value=='')
{
alert('please Select the description');
document.frm_add_edit.description.focus();
return false;
}
if(document.frm_add_edit.price.value=='')
{
alert('please enter the price');
document.frm_add_edit.price.focus();
return false;
}
}
</script>-->
<script language="javascript">
function validate1()
{
	var a=document.frm_add_edit.prod_name.value;
	//var b=document.frm_add_edit.authorname.value;
	var c=document.frm_add_edit.publishername.value;
	//var d=document.frm_add_edit.prod_image.value;
	var e=document.frm_add_edit.discountprice.value;
	var f=document.frm_add_edit.price1.value;
	var g=document.frm_add_edit.shipping.value;
		
	if (a == "") { 
	alert("Please Enter Product Name ");
	document.frm_add_edit.prod_name.focus();
  	return false;
  	}
	
	/*if (b == "") { 
	alert("Please Enter Author Name ");
	document.frm_add_edit.authorname.focus();
  	return false;
  	}*/
	
	if (c == "") { 
	alert("Please Enter Publisher Name ");
	document.frm_add_edit.publishername.focus();
  	return false;
  	}
	
	//if (d == "") { 
//	alert("Please Upload Book Image");
//	document.frm_add_edit.prod_image.focus();
//  	return false;
//  	}
	
	if (e == "") { 
	alert("Please Enter MRP Price");
	document.frm_add_edit.discountprice.focus();
  	return false;
  	}
	
	if (f == "") { 
	alert("Please Enter Our Price");
	document.frm_add_edit.price1.focus();
  	return false;
  	}
	
	if (g == "") { 
	alert("Please Shipping Charges");
	document.frm_add_edit.shipping.focus();
  	return false;
  	}
	
	
}
</script>
<?php 

ob_start();

//include("ouradmin/fckeditor/fckeditor.php") ;

		function isLoggedOn($var)

{

	if(!isset($_SESSION['memberId']))

	{

	  global $bizConfig;



	  $_SESSION['goto'] = ROOT.$_SERVER['REQUEST_URI'];

	  $arrGoto=explode("/",$_SERVER['REQUEST_URI']);

	  

	  if(!$var) header('location:'.$bizConfig['httpPathSsl'].$arrGoto[count($arrGoto)-2].'/login.php');

	  else header('location:'.$bizConfig['httpPathSsl'].$arrGoto[count($arrGoto)-2].'/login.php?'.$var);

	}

}

function display_session_msg()

{

 if($_SESSION['sessionMsg']!='')

 {

  print($_SESSION['sessionMsg']);

 }

  $_SESSION['sessionMsg']='';

}

function isAdminOn($var)

{

	if(!isset($_SESSION['adminId']))

	{

	  $arrGoto=explode("/",$_SERVER['REQUEST_URI']);

	  $goto=$arrGoto[count($arrGoto)-1];

      $_SESSION['goto']=$goto;

	  if($var=='')

	  {

		header("location:index.php");

	  }

	  else

	  {

	    header("location:index.php?".$var);

	  }	

	}

}



function isuserOn($var)

{

	if(!isset($_SESSION['userId']))

	{

	  $arrGoto=explode("/",$_SERVER['REQUEST_URI']);

	  $goto=$arrGoto[count($arrGoto)-1];

      $_SESSION['goto']=$goto;

	  if($var=='')

	  {

		header("location:index.php");

	  }

	  else

	  {

	    header("location:index.php?".$var);

	  }	

	}

}

function getMemberName($memberId)

{

 $memberSql="select concat(firstName,' ',lastName) as name from tblMembers where memberId='".$memberId."'";

 $memberResult=mysql_query($memberSql) or die(mysql_error());

 if($memberInfo=mysql_fetch_array($memberResult))

 {

  $name=$memberInfo['name']; 

 }

 return $name;

}



function timeAgo($timestamp){

   $difference = time() - $timestamp;

   $periods = array("second", "minute", "hour", "day", "week", "month", "years", "decade");

   $lengths = array("60","60","24","7","4.35","12","10");

   for($j = 0; $difference >= $lengths[$j]; $j++)

     $difference /= $lengths[$j];

   $difference = round($difference);

   if($difference != 1) $periods[$j].= "s";

   $text = "$difference $periods[$j] ago";

   return $text;

}



function convert_datetime($str) 

{



	list($date, $time) = explode(' ', $str);

	list($year, $month, $day) = explode('-', $date);

	list($hour, $minute, $second) = explode(':', $time);

	

	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);

	

	return $timestamp;

}

function coursecategoriesediting($cid)

{ 

if(isset($_REQUEST['id']))

				  {

			$sql = "SELECT * FROM   careerbooks_products  where prod_id=$_REQUEST[id]";

		    $rs = mysql_query($sql);

	        $res=mysql_fetch_array($rs);

			extract($res);	

		

			}?>

			<tr><td align="center" valign="top" bgcolor="#EEEEEE">

			<form name="frm_add_edit"  enctype="multipart/form-data" method="post" action=""  onsubmit="return validate1"><input type="hidden" name="did" value="<?=$_GET['did'];?>" />

			<!--<input type="hidden" name="task" value="< ?=$_GET['type1'];?>" />-->

			

			

			<?php  if(isset($_REQUEST['id']))

				  { ?>

				  

				  <input type="hidden" name="act" value="edit">

				  <?php }?>

						<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">

			<tr class="header_row">

				<td colspan="3" align="left">User Edit/Add New Book name </td>
			</tr>

			<?php if($_GET['error']==1){ ?>

			<tr><td colspan="2" align="center" bgcolor="#FFFFFF">

			<?php echo "<font color=#FF0000>Product name already exits</font>";?></td>
			</tr>

			<?php  }?>

			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Book  Name* </strong></td>

				<td width="70%" align="left" bgcolor="#F7F7F7">

				<input name="prod_name" type="text" class="textbox" id="section_data" size="30" value="<?php print($prod_name);?>"/>				</td>
			</tr>

			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Author  Name* </strong></td>

				<td width="70%" align="left" bgcolor="#F7F7F7">

				<input name="authorname" type="text" class="textbox" id="section_data" size="30" value="<?php print($authorname);?>"/>				</td>
			</tr> 

			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Publisher  Name* </strong></td>

				<td width="70%" align="left" bgcolor="#F7F7F7">

				<input name="publishername" type="text" class="textbox" id="section_data" size="30" value="<?php print($publishername);?>"/>				</td>
			</tr>

			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Number Of Pages* </strong></td>

			  <td width="70%" align="left" bgcolor="#F7F7F7">

				<input name="numpages" type="text" class="textbox" id="section_data" size="30" value="<?php print($numpages);?>"/>				</td>
			</tr>

			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Binding Type* </strong></td>

				<td width="70%" align="left" bgcolor="#F7F7F7">

				<input name="bindtype" type="text" class="textbox" id="section_data" size="30" value="<?php print($bindtype);?>"/>				</td>
			</tr>

			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">

					<strong>Book Image<span class="featured">*</span> : </strong>	</td>

				<td width="70%" align="left" bgcolor="#F7F7F7"><input name="prod_image" type="file" class="textbox" id="prod_image" size="30" value=""/>&nbsp;<input type="hidden" name="prev_prod_image" value="<?php print($prod_image);?>"/>
				<b><font color="#FF0000">(width 400px height 527px)</font></b></td>
			</tr>
			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">

					<strong> Current Image <span class="featured">*</span> : </strong>	</td>

				<td width="70%" align="left" bgcolor="#F7F7F7"><img src="../images/productimages/<?php print($prod_image);?>" width="150" height="150" border="0"></td>
			</tr>
			 <tr>

			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Small Description<span class="featured">*:</span></strong></td>

			  <td align="left" bgcolor="#F7F7F7"><textarea name="smalldescription" rows="5" cols="30"><?php print($prod_smalldescrip);?></textarea></td>
			  </tr>
				
				 <tr>

			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Description<span class="featured">*:</span></strong></td>

			  <td align="left" bgcolor="#F7F7F7"><?php 
										$sBasePath = 'fckeditor/' ;
										$oFCKeditor = new FCKeditor('descripation') ;
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		= '' ;
										if(isset($descripation))
										$oFCKeditor->Value	= $descripation;
										$oFCKeditor->Width  = '600' ;
										$oFCKeditor->Height = '350' ;	
										$oFCKeditor->Create();
									?>
			  </td>
			  </tr>
			    <tr>

			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>MRP Price<span class="featured">*:</span></strong></td>

			  <td align="left" bgcolor="#F7F7F7"><input name="discountprice" type="text" class="textbox" id="discountprice" size="30" value="<?php print($discountprice);?>"/>			       </td>
			  </tr>
			   <tr>

			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Our Price<span class="featured">*:</span></strong></td>

			  <td align="left" bgcolor="#F7F7F7"><input name="price1" type="text" class="textbox" id="price1" size="30" value="<?php print($prod_price);?>"/>			       </td>
			  </tr>


			   <tr>

			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Bookcode Number<span class="featured">*:</span></strong></td>

			  <td align="left" bgcolor="#F7F7F7"><input name="bookcodenumber" type="text" class="textbox" id="bookcodenumber" size="30" value="<?php print($bookcodenumber);?>"/>			       </td>
			  </tr>

			   <tr>

			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>ISBN Code:<span class="featured">*:</span></strong></td>

			  <td align="left" bgcolor="#F7F7F7"><input name="isbncode" type="text" class="textbox" id="isbncode" size="30" value="<?php print($isbncode);?>"/>			       </td>
			  </tr>

			  <tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">

					<strong>English Books <span class="featured">*</span> : </strong>	</td>

				<td width="70%" align="left" bgcolor="#F7F7F7">

					<input name="english" type="radio"  value="1"<?php if($english=='1'){echo 'checked';}?>/>Yes

					<input name="english" type="radio"  value="0"<?php if($english=='0'){echo 'checked';}?>/>No		</td>
			</tr>

			 <tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">

					<strong>Hindi Books <span class="featured">*</span> : </strong>	</td>

				<td width="70%" align="left" bgcolor="#F7F7F7">

					<input name="hindi" type="radio"  value="1"<?php if($hindi=='1'){echo 'checked';}?>/>Yes

					<input name="hindi" type="radio"  value="0"<?php if($hindi=='0'){echo 'checked';}?>/>No		</td>
			</tr>

			 <tr>
			   <td height="30" align="right" bgcolor="#F7F7F7"><strong>Other Books <span class="featured">*</span> : </strong> </td>
			   <td align="left" bgcolor="#F7F7F7"><input name="others" type="radio"  value="1"<?php if($hindi=='1'){echo 'checked';}?>/>
			     Yes
			     <input name="others" type="radio"  value="0"<?php if($hindi=='0'){echo 'checked';}?>/>
			     No </td>
			   </tr>
			 <tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">

					<strong>New Release Books<span class="featured">*</span> : </strong>	</td>

				<td width="70%" align="left" bgcolor="#F7F7F7">

					<input name="newrelease" type="radio"  value="1"<?php if($newrelease=='1'){echo 'checked';}?>/>Yes

					<input name="newrelease" type="radio"  value="0"<?php if($newrelease=='0'){echo 'checked';}?>/>No		</td>
			</tr>

			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">

					<strong>Magazines Books<span class="featured">*</span> : </strong>	</td>

				<td width="70%" align="left" bgcolor="#F7F7F7">

					<input name="magazines" type="radio"  value="1"<?php if($magazines=='1'){echo 'checked';}?>/>Yes

					<input name="magazines" type="radio"  value="0"<?php if($magazines=='0'){echo 'checked';}?>/>No		</td>
			</tr>

			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">

					<strong>Best Seller Books<span class="featured">*</span> : </strong>	</td>

				<td width="70%" align="left" bgcolor="#F7F7F7">

					<input name="bestseller" type="radio"  value="1"<?php if($bestseller=='1'){echo 'checked';}?>/>Yes

					<input name="bestseller" type="radio"  value="0"<?php if($bestseller=='0'){echo 'checked';}?>/>No		</td>
			</tr>

			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">

					<strong>TOP 100 Books<span class="featured">*</span> : </strong>	</td>

				<td width="70%" align="left" bgcolor="#F7F7F7">

					<input name="topbooks" type="radio"  value="1"<?php if($topbooks=='1'){echo 'checked';}?>/>Yes

					<input name="topbooks" type="radio"  value="0"<?php if($topbooks=='0'){echo 'checked';}?>/>No		</td>
			</tr>

			<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Shipping Price<span class="featured">*:</span></strong></td>
			  <td align="left" bgcolor="#F7F7F7"><input name="shipping" type="text" class="textbox" id="shipping" size="30" value="<?php print($shipping);?>"/></td>
			  </tr>
			<tr>

				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">

					<strong> Status<span class="featured">*</span> : </strong>	</td>

				<td width="70%" align="left" bgcolor="#F7F7F7">

					<input name="Status" type="radio"  value="0"<?php if($status=='0'){echo 'checked';}?>/>Inactive

					<input name="Status" type="radio"  value="1"<?php if($status=='1'){echo 'checked';}?>/>Active		</td>
			</tr>

			

			<tr>

				<td align="right" bgcolor="#FFFFFF" height="40"></td>

				<td width="70%" align="left" bgcolor="#FFFFFF">

					<input type="submit" name="add_edit" value="Save Data" class="buttons" onclick="return validate1();" />&nbsp;&nbsp;

					<input type="reset" name="cancel" value="Cancel" class="buttons" />

					<a href="product_manager.php"><input type="button" name="back" value="Back" class="buttons" onclick="javascript:history.back();"></a>					</td>
		</tr>
		</table>

		</form>



			 <?php }		

	?>

<?php

 function paginate123($start,$limit,$total,$filePath,$otherParams) {

	global $lang;

	$allPages = ceil($total/$limit);

	$currentPage = floor($start/$limit) + 1;

	$pagination = "";

	if ($allPages>10) {

		$maxPages = ($allPages>9) ? 9 : $allPages;

		if ($allPages>9) {

			if ($currentPage>=1&&$currentPage<=$allPages) {

				$pagination .= ($currentPage>4) ? " ... " : " ";

				$minPages = ($currentPage>4) ? $currentPage : 5;

				$maxPages = ($currentPage<$allPages-4) ? $currentPage : $allPages - 4;

				for($i=$minPages-4; $i<$maxPages+5; $i++) {

					$pagination .= ($i == $currentPage) ? "[".$i."] " : "<a href=\"".$filePath."start".(($i-1)*$limit)."/product.html\" class=\"ratingtext\">".$i."</a> ";

				}

				$pagination .= ($currentPage<$allPages-4) ? " ... " : " ";

			} else {

				$pagination .= " ... ";

			}

		}

	} else {

		for($i=1; $i<$allPages+1; $i++) {

			$pagination .= ($i==$currentPage) ? "[".$i."] " : "<a href=\"".$filePath."start".(($i-1)*$limit)."/product.html\">".$i."</a> ";

		}

	}

	if ($currentPage>1) $pagination = "[<a href=\"".$filePath."start".(($currentPage-2)*$limit)."/product.html\">&lt;&lt;</a>] [<a href=\"".$filePath."start".(($currentPage-2)*$limit)."/product.html\">&lt;</a>] ".$pagination;

	if ($currentPage<$allPages) $pagination .= " [<a href=\"".$filePath."start".($currentPage*$limit)."/product.html\">&gt;</a>] [<a href=\"".$filePath."start".(($allPages-1)*$limit)."/product.html\">&gt;&gt;</a>]";

  	echo $pagination;

}

 function paginatetestimonial($start,$limit,$total,$filePath,$otherParams) {

	global $lang;

	$allPages = ceil($total/$limit);

	$currentPage = floor($start/$limit) + 1;

	$pagination = "";

	if ($allPages>10) {

		$maxPages = ($allPages>9) ? 9 : $allPages;

		if ($allPages>9) {

			if ($currentPage>=1&&$currentPage<=$allPages) {

				$pagination .= ($currentPage>4) ? " ... " : " ";

				$minPages = ($currentPage>4) ? $currentPage : 5;

				$maxPages = ($currentPage<$allPages-4) ? $currentPage : $allPages - 4;

				for($i=$minPages-4; $i<$maxPages+5; $i++) {

					$pagination .= ($i == $currentPage) ? "[".$i."] " : "<a href=\"".$filePath."start".(($i-1)*$limit)."/fronttestimonial.html\" class=\"ratingtext\">".$i."</a> ";

				}

				$pagination .= ($currentPage<$allPages-4) ? " ... " : " ";

			} else {

				$pagination .= " ... ";

			}

		}

	} else {

		for($i=1; $i<$allPages+1; $i++) {

			$pagination .= ($i==$currentPage) ? "[".$i."] " : "<a href=\"".$filePath."start".(($i-1)*$limit)."fronttestimonial.html\">".$i."</a> ";

		}

	}

	if ($currentPage>1) $pagination = "[<a href=\"".$filePath."start".(($currentPage-2)*$limit)."/fronttestimonial.html\">&lt;&lt;</a>] [<a href=\"".$filePath."start".(($currentPage-2)*$limit)."/fronttestimonial.html\">&lt;</a>] ".$pagination;

	if ($currentPage<$allPages) $pagination .= " [<a href=\"".$filePath."start".($currentPage*$limit)."/fronttestimonial.html\">&gt;</a>] [<a href=\"".$filePath."start".(($allPages-1)*$limit)."/fronttestimonial.html\">&gt;&gt;</a>]";

  	echo $pagination;

	}

	

	function paginatenews($start,$limit,$total,$filePath,$otherParams) {

	global $lang;

	$allPages = ceil($total/$limit);

	$currentPage = floor($start/$limit) + 1;

	$pagination = "";

	if ($allPages>10) {

		$maxPages = ($allPages>9) ? 9 : $allPages;

		if ($allPages>9) {

			if ($currentPage>=1&&$currentPage<=$allPages) {

				$pagination .= ($currentPage>4) ? " ... " : " ";

				$minPages = ($currentPage>4) ? $currentPage : 5;

				$maxPages = ($currentPage<$allPages-4) ? $currentPage : $allPages - 4;

				for($i=$minPages-4; $i<$maxPages+5; $i++) {

					$pagination .= ($i == $currentPage) ? "[".$i."] " : "<a href=\"".$filePath."start".(($i-1)*$limit)."/newsarticle.html\" class=\"ratingtext\">".$i."</a> ";

				}

				$pagination .= ($currentPage<$allPages-4) ? " ... " : " ";

			} else {

				$pagination .= " ... ";

			}

		}

	} else {

		for($i=1; $i<$allPages+1; $i++) {

			$pagination .= ($i==$currentPage) ? "[".$i."] " : "<a href=\"".$filePath."start".(($i-1)*$limit)."/newsarticle.html\">".$i."</a> ";

		}

	}

	if ($currentPage>1) $pagination = "[<a href=\"".$filePath."start".(($currentPage-2)*$limit)."/newsarticle.html\">&lt;&lt;</a>] [<a href=\"".$filePath."start".(($currentPage-2)*$limit)."/newsarticle.html\">&lt;</a>] ".$pagination;

	if ($currentPage<$allPages) $pagination .= " [<a href=\"".$filePath."start".($currentPage*$limit)."/newsarticle.html\">&gt;</a>] [<a href=\"".$filePath."start".(($allPages-1)*$limit)."/newsarticle.html\">&gt;&gt;</a>]";

  	echo $pagination;

	}

?>