<?php 
	session_start();
    require_once("config/config.inc.php");
	$sort=$_REQUEST['sort'];
	$comment_query = mysql_query("SELECT * FROM sas_myjournal WHERE uid =".$_SESSION['uid']." order by jid ".$sort);
	// echo mysql_num_rows($comment_query);
	while($comment = mysql_fetch_array($comment_query)){ 
	extract($comment);
?>
 
	<div class="comment-item" style="width: 748px;">
	  <div class="comment-post" style="width: 730px;">
		<div class="comment-post-div">
		<div class="comment-post-left" >
		 <?php 
		  if(isset($topictitle)){ ?>
		 <h6 style="color:#005292"><?php echo $topictitle ;?></h6>
		 <?php }?>
		</div>  
		<div class="comment-post-right" style="font-size:10px;">							
		<a class="edit-post"   href="#" data-id="<?php echo $jid;?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="javascript:del_commnet(<?php echo $jid; ?> )">Delete</a>
		&nbsp;&nbsp;&nbsp;<?php echo $date;?> 
		</div>
		</div></br>
        <div style="width:100%">
        <div class="p-comment" id="p-comment<?php echo $jid;?>"><?php echo $description;?></div>						  
		</div>
	   </div>
	 </div>
<?php
 } 
?>