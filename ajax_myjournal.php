<?php
 session_start();
 require_once("config/config.inc.php");

 if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )){	
	 //$description=$_POST['description'];	 
	 if ( isset($_SESSION['uid']) AND !empty($_POST['description']) )  {
		
		$uid = mysql_real_escape_string($_SESSION['uid']);
		$desc = mysql_real_escape_string($_POST['description']);
		$topic=mysql_real_escape_string($_POST['topictitle']);
		
		mysql_query("INSERT INTO sas_myjournal(topictitle,description,uid)VALUES('$topic','$desc','$uid')");			
	    
		$sql2="select max(jid) as max from sas_myjournal where uid='$uid'";
		$rslt2=mysql_query($sql2);
		
		while($rsrslt2=mysql_fetch_array($rslt2)){
		  extract($rsrslt2); 
		}
		//echo $max;
		$sql="select * from sas_myjournal where jid='$max'";
		$rslt=mysql_query($sql);
		$rsrslt=mysql_fetch_array($rslt);
		extract($rsrslt);     
	
 ?>
 
 <div class="myjournal-item" id="myjournalblock<?php echo $jid;?>">						
  <div class="myjournal-post" >
	<div class="myjournal-post-div">
	  <div class="myjournal-post-left" >							  
		<?php 
			if(isset($topic)){ ?>
		<h6 style="color:#005292" id="p-title<?php echo $jid;?>"><?php echo $topictitle ;?></h6>
		<input type="hidden" name="topictitle" id="topictitle<?php echo $jid;?>" data-title="" value="<?php echo $topictitle ;?>">
		<?php }?>							  
	  </div>  
	  <div class="myjournal-post-right" style="font-size:10px;">							
		<a class="myjournal-edit" href="javascpt:void(0);" data-id="<?php echo $jid;?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="javascript:del_commnet(<?php echo $jid; ?> )">Delete</a>
		&nbsp;&nbsp;&nbsp;<?php echo $date;?> 
	  </div>
	</div></br>
    <div style="width:100%">
       <div class="p-myjournal" id="p-myjournal<?php echo $jid;?>"><?php echo stripslashes($description);?></div>						  
	</div>						  
  </div>
</div>
<?php
  }	
  
 }
?>