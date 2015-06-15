<?php 
    require_once("config/config.inc.php");
	
    $start=$_REQUEST['start'];	
	$limit=$_REQUEST['limit'];
	
	$catarry=array();
?>	
	<ul id="navside" class="navside">
<?php	
	 for( $i=$start+1;$i<=$start+5;$i++) 
	 { 					
		$catarry[]=$i;		  
?>
	<li><a href="theme.php?cid=<?php echo $i; ?>"><?php echo $_SESSION['categories'][$i]; ?></a></span></li>
<?php 
     }
	$last=end($catarry);
	$more="more";
	$less="less";
	if($limit==$more){ 
?>
    <li onclick="lessfun('<?php echo $last-10;?>','less')"><a href="javascript:;" class="more" >Less...</a></li>
<?php 
     } 
  if($limit==$less){ 
?>
    <li onclick="morefun('<?php echo $last;?>','more')"><a href="javascript:;" class="less" >More...</a></li>
<?php 
     } 
  if($limit==""){
?>
    <li onclick="morefun('<?php echo $last;?>','more')"><a href="javascript:;" class="more" >More....</a></li>
<?php 
     } 
?>
</ul>