<?php 
ob_start();

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

 if(isset($_SESSION['sessionMsg'])!='')

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

function timeAgo($timestamp)
{   
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

function coursecategoriesediting($id)
{
if(isset($_REQUEST['id']))
				  {
            
			$sql = "SELECT * FROM   sas_videos  where id=".$_REQUEST['id'];

		    $rs = mysql_query($sql);

	        $res=mysql_fetch_array($rs);

			extract($res);	

			}?>
			<tr><td align="center" valign="top" bgcolor="#EEEEEE">
			<form name="frm_add_edit"  enctype="multipart/form-data" method="post" action=""  onsubmit="return validate1">
			<input type="hidden" name="pcid" value="<?php echo $_GET['pcid'];?>" />
			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
			<!--<input type="hidden" name="task" value="< ?=$_GET['type1'];?>" />-->
			<?php 
			
			if(isset($_REQUEST['id']))
                 //echo $_REQUEST['id'];
			{ ?>
		  
			<input type="hidden" name="act" value="edit">

			<?php }?>

			<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">

			<tr class="header_row">

				<td colspan="3" align="left">Edit/Add New Video </td>
			</tr>
			
			<?php if(isset($_GET['error'])==1){ ?>
			<tr><td colspan="2" align="center" bgcolor="#FFFFFF">
			
			<?php echo "<font color=#FF0000>Video Name already exits</font>";?></td>
			</tr>
			<?php  }?>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Video  Name* </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="prod_name" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($prod_name)) print($prod_name);?>"/>	</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Video  Number* </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="videono" type="text" class="textbox" id="section_data" size="15" value="<?php if(isset($videono)) print($videono);?>"/><b><font color="#FF0000"> ( Ex: SV1 )</font></b> </td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>Video Image<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><input name="prod_image" type="file" class="textbox" id="prod_image" size="30" value=""/>&nbsp;<input type="hidden" name="prev_prod_image" value="<?php if(isset($prod_image)) print($prod_image);?>"/>
				<b><font color="#FF0000">(width 400px height 527px)</font></b></td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Current Video Image <span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><img src="../<?php if(isset($prod_image)) print($prod_image);?>" width="150" height="150" border="0"></td>
			</tr>
			<tr>
			 <td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Video Type<span class="featured">*</span> : </strong>
			 </td>
			 <td width="70%" align="left" bgcolor="#F7F7F7">				
				<input name="vtype" type="radio"  value="0" <?php if(isset($vtype) && $vtype =='0'){ echo 'checked'; }?>/>Paid
				<input name="vtype" type="radio"  value="1" <?php if(isset($vtype) && $vtype =='1'){ echo 'checked'; }?>/>Free 
			 </td>
			</tr>
            <tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Price<span class="featured">:</span></strong></td>
			  <td align="left" bgcolor="#F7F7F7"><input name="price1" type="text" class="textbox" id="price1" size="30" value="<?php if(isset($prod_price)) print($prod_price);?>"/>			       </td>
			  </tr>
              <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Video Vimeo Code* </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="vcode" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($vcode)) print($vcode);?>"/>				</td>
			</tr>
			 
			<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Video Description<span class="featured">*:</span></strong></td>
			  <td align="left" bgcolor="#F7F7F7">
			  <?php 

					$sBasePath = 'fckeditor/' ;

					$oFCKeditor = new FCKeditor('description') ;

					$oFCKeditor->BasePath	= $sBasePath ;

					$oFCKeditor->Value		= '' ;

					if(isset($description))

					   $oFCKeditor->Value	= $description;

					   $oFCKeditor->Width  = '600' ;

					   $oFCKeditor->Height = '350' ;	

					   $oFCKeditor->Create();

			  ?>
			  </td>
			  </tr>
			  
			  <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Page Title </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="pagetitle" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($pagetitle)) print($pagetitle);?>"/>				</td>
			 </tr>
			
			 <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Behaviour Topics </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<textarea name="btopics" rows="4" cols="72"><?php if(isset($btopics)) print($btopics);?></textarea>
				<span style="color:red"><br>*( Separate each item with 3 hyphen Ex. Know what your goals are. --- Have long antenna. --- Know what your goals are.)		</span>			</td>
			    
			 </tr>
			 <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Tags </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="tags" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($tags)) print($tags);?>"/>				</td>
			 </tr>
			 <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Mentor Resources </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="mresources" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($mresources)) print($mresources);?>"/>				</td>
			 </tr>
		 	 <tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Meta KeyWords:</strong></td>
			  <td align="left" bgcolor="#F7F7F7"><textarea name="mkeywords" rows="4" cols="72"><?php if(isset($mkeywords)) print($mkeywords);?></textarea></td>
			  </tr>
			<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Meta Description:</strong></td>
			  <td align="left" bgcolor="#F7F7F7"><textarea name="mdescription" rows="4" cols="72"><?php if(isset($mdescription)) print($mdescription);?></textarea></td>
			  </tr>
			<tr>
			 <td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Status<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="status" type="radio"  value="0" <?php if(isset($status) && $status =='0'){echo 'checked';}?>/>Inactive
				<input name="status" type="radio"  value="1" <?php if(isset($status) && $status =='1'){echo 'checked';}?>/>Active
			    </td>
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
  <?php 
        }
  ?>
  <?php

     function copingvideos($id){
  
       if(isset($_REQUEST['id'])){

			$sql = "SELECT * FROM   sas_copvideos  where id='$_REQUEST[id]'";

		    $rs = mysql_query($sql);

	        $res=mysql_fetch_array($rs);

			extract($res);	
            //print_r($res);
			}?>
			<tr><td align="center" valign="top" bgcolor="#EEEEEE">
			<form name="frm_add_edit"  enctype="multipart/form-data" method="post" action=""  onsubmit="return validate1">
			<input type="hidden" name="pcid" value="<?php echo $_GET['pcid'];?>" />
			<input type="hidden" name="pid" value="<?php echo $_GET['pid'];?>" />
			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
			<!--<input type="hidden" name="task" value="< ?=$_GET['type1'];?>" />-->
			<?php  if(isset($_REQUEST['id']))

				  { ?>
		  
				  <input type="hidden" name="act" value="edit">

				  <?php }?>

						<table width="100%" border="0" cellpadding="3" cellspacing="1" class="outercolor gray_txt">

			<tr class="header_row">

				<td colspan="3" align="left">Edit/Add New Video </td>
			</tr>
			
			<?php if(isset($_GET['error'])==1){ ?>
			<tr><td colspan="2" align="center" bgcolor="#FFFFFF">
			
			<?php echo "<font color=#FF0000>Coping Video Name already exits</font>";?></td>
			</tr>
			<?php  }?>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Video  Name* </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="prod_name" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($prod_name)) print(stripslashes($prod_name));?>"/>				</td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Video  Number* </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="videono" type="text" class="textbox" id="section_data" size="15" value="<?php if(isset($videono)) print($videono);?>"/><b><font color="#FF0000"> ( Ex: CV1 )</font></b> </td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong>Video Image<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><input name="prod_image" type="file" class="textbox" id="prod_image" size="30" value=""/>&nbsp;<input type="hidden" name="prev_prod_image" value="<?php if(isset($prod_image)) print($prod_image);?>"/>
				<b><font color="#FF0000">(width 400px height 527px)</font></b></td>
			</tr>
			<tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Current Video Image <span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7"><img src="../<?php if(isset($prod_image)) { print($prod_image); }else{ '../images/portfolio/portfolio-item-1.jpg'; }?>" width="150" height="150" border="0"></td>
			</tr>
			<tr>
			 <td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Video Type<span class="featured">*</span> : </strong>	
			 </td>
			 <td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="cvtype" type="radio"  value="0" <?php if(isset($cvtype) && $cvtype == '0'){echo 'checked';}?>/>Paid
				<input name="cvtype" type="radio"  value="1" <?php if(isset($cvtype) && $cvtype == '1'){echo 'checked';}?>/>Free
 			 </td>
			</tr>
            <tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Price<span class="featured">:</span></strong></td>
			  <td align="left" bgcolor="#F7F7F7"><input name="price1" type="text" class="textbox" id="price1" size="30" value="<?php if(isset($prod_price)) print($prod_price);?>"/>			       </td>
			  </tr>
              <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Video Vimeo Code* </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="vcode" type="text" class="textbox" id="section_data" size="30" value="<?php if(isset($vcode)) print($vcode);?>"/>				</td>
			</tr>
			 
			<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Video Description<span class="featured">*:</span></strong></td>
			  <td align="left" bgcolor="#F7F7F7">
			  <?php 

				  $sBasePath = 'fckeditor/' ;

				  $oFCKeditor = new FCKeditor('description') ;

				  $oFCKeditor->BasePath	= $sBasePath ;

				  $oFCKeditor->Value		= '' ;

				  if(isset($descripation))

					 $oFCKeditor->Value	= $description;

					 $oFCKeditor->Width  = '600' ;

					 $oFCKeditor->Height = '350' ;	

					 $oFCKeditor->Create();

			  ?>
			  </td>
			 </tr>
			  
			 <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Page Title </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="pagetitle" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($pagetitle)) print(stripslashes($pagetitle));?>"/>				</td>
			 </tr>
			
			 <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Behaviour Topics </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<textarea name="btopics" rows="4" cols="72"><?php if(isset($btopics)) print($btopics);?></textarea>
				<span style="color:red"><br>*( Separate each item with 3 hyphen Ex. Know what your goals are. --- Have long antenna. --- Know what your goals are.)		</span>			</td>
			    
			 </tr>
			 <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Tags </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				<input name="tags" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($tags)) print($tags);?>"/>				</td>
			 </tr>
			 <tr>
				<td width="30%" height="30" align="right" bgcolor="#F7F7F7"><strong>Mentor Resources </strong></td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
				
				<input name="mresources" type="text" class="textbox" id="section_data" size="116" value="<?php if(isset($mresources)) print($mresources);?>"/>				</td>
			 </tr>
		 	 <tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Meta KeyWords:</strong></td>
			  <td align="left" bgcolor="#F7F7F7"><textarea name="mkeywords" rows="4" cols="72"><?php if(isset($mkeywords)) print($mkeywords);?></textarea></td>
			  </tr>
			<tr>
			  <td height="30" align="right" bgcolor="#F7F7F7"><strong>Meta Description:</strong></td>
			  <td align="left" bgcolor="#F7F7F7"><textarea name="mdescription" rows="4" cols="72"><?php if(isset($mdescription)) print($mdescription);?></textarea></td>
			  </tr>
			<tr>
			 <td width="30%" height="30" align="right" bgcolor="#F7F7F7">
				<strong> Status<span class="featured">*</span> : </strong>	</td>
				<td width="70%" align="left" bgcolor="#F7F7F7">
					<input name="status" type="radio"  value="0" <?php if(isset($status) && $status == '0'){echo 'checked';}?>/>Inactive
					<input name="status" type="radio"  value="1" <?php if(isset($status) && $status == '1'){echo 'checked';}?>/>Active	
				</td>
			</tr>
			<tr>
				<td align="right" bgcolor="#FFFFFF" height="40"></td>
				<td width="70%" align="left" bgcolor="#FFFFFF">
				<input type="submit" name="add_edit" value="Save Data" class="buttons" onclick="return validate1();" />&nbsp;&nbsp;
				<input type="reset" name="cancel" value="Cancel" class="buttons" />
				<input type="button" name="back" value="Back" class="buttons" onclick="javascript:history.back();">				</td>

		</tr>

		</table>

		</form>
<?php 
      }	
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