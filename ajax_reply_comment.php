 <?php
 @ob_start(); 
 require_once("config/config.inc.php"); 
 session_start();

 if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )){	
	 
     //print_r($_POST);	 
	 $comment=$_POST['txt-comment'];
	 $cmtid=$_POST['cmtid'];
	 $vid=$_POST['vid'];
 
	 if( isset($_SESSION['uid']) AND !empty($comment) ) {
		
		$uid = mysql_real_escape_string($_SESSION['uid']);
		$comment = mysql_real_escape_string($comment);	
					
		if(isset($_POST['anmuser'])){ 
		
			  mysql_query("INSERT INTO sas_comment_replies(reply,cmtid,anuid,vid,replieddate,status)VALUES('$comment','$cmtid','1','$vid',now(),1)");	
		      $resl=mysql_query("select * from sas_comment_replies where replieddate=now() and cmtid='$cmtid'");
	          $rresl=mysql_fetch_array($resl);
		}else{	      		
			  mysql_query("INSERT INTO sas_comment_replies(reply,cmtid,uid,vid,replieddate,status)VALUES('$comment','$cmtid','$uid','$vid',now(),1)");	
		      $resl=mysql_query("select * from sas_comment_replies where replieddate=now() and cmtid='$cmtid'");
	          $rresl=mysql_fetch_array($resl);
		}
	    
		//print_r($rresl);
		
        $usql="select * from sas_users where user_id='$uid'";
		$urslt=mysql_query($usql);
		$ursrslt=mysql_fetch_array($urslt);
			  
		//extract($ursrslt);	   
 ?> 
    
   <script type="text/javascript" src="js/1.10.2jquery.js"></script>	
   <!-- <script src="js/my_js.js"></script>	
   <script src="js/comment_script2.js"></script> -->
		  
   <script> 
   
               $(".reply-edit").click(function(){
	    					  
					var rid=$(this).attr('data-id')
					
					$("#edit-rply-div"+rid).css("display","block");
					$("#p-rply"+rid).css("display","none");
					$("#edit-rply-frm"+rid).css("display","block");
					
				}); 
	
				$(".cancel-rply-edit").click(function(){				
					rid=$(this).attr("data-id")
                    $("#edit-rply-div"+rid).css('display','none')				
					$("#p-rply"+rid).css("display","block");					
				});
				
				$( ".edit-rply-frm" ).submit(function( e ) {
				
					e.preventDefault();
					//alert("edit-rply-frm")
                    var form = $(this);					
					// send ajax request
					$.ajax({
						url: 'ajax_edit_reply.php',
						type: 'POST',
						cache: false,
						data: form.serialize(),
						beforeSend: function(){
							// change submit button value text and disabled it
							$('.edit-rply-submit').val('Updating...').attr('disabled', 'disabled');						
						},
						success: function(data){
						    
							rslt=data.split('|||')
							//alert(rslt[0])
							
							$('#p-rply'+rslt[0]).html(rslt[1]);
                            						
							//$('#edit-rply-'+rslt[0]).val(rslt[1]);
							$('#edit-rply-'+rslt[0]).text(rslt[1]);
							$('#updtdate'+rslt[0]).html(rslt[2]);
							
							$('.edit-rply-frm').trigger('reset');
							$('.edit-rply-submit').val('Update').removeAttr('disabled');
							$('.edit-rply-frm').css('display','none');
							$('#p-rply'+rslt[0]).css('display','block');
							//location.reload();
						},
						error: function(e){
							alert(e);
						}
					});
				});	       
		  
   </script> 
		  
 
 <div class="comment-item" id="comment-rply<?php echo $rresl['rid'];?>" style="width: 90%;float: right;background-color: #E6E6E6;">
	<div class="comment-avatar">
	<?php 
	  if(!empty($ursrslt['photopath'])){
	?>
		<img src="https://s3-us-west-2.amazonaws.com/sas-userphotos/<?php echo $ursrslt['photopath']; ?>" alt="<?php echo $ursrslt['username'];?>">
	<?php }
	else{?>
		<img src="https://s3-us-west-2.amazonaws.com/sas-userphotos/account.png" alt="<?php echo $ursrslt['username'];?>">
	<?php }?>
	</div>
	<div class="comment-post">
	 <div class="comment-post-div">
	   <div class="comment-post-left" >			  
		 <?php 
			if(isset($_POST['anmuser'])){  
		 ?>
			<h6>Anonymous <span style="color:#000;">said....</span></h6>
		 <?php }else{ ?>
			<h6><?php echo $ursrslt['username'];?> <?php ?><span style="color:#000;"> said....</span></h6>
		 <?php }?>		 
	   </div>  
	   <div class="comment-post-right" style="font-size:10px;">
	    <!--
	     <?php
					
			if(!empty($_SESSION['uid'])){
							
				$uid=$_SESSION['uid'];							
												
				$q=mysql_query("SELECT like_id FROM reply_comment_like WHERE cmtid_fk='$cmtid' and uid_fk='$uid' ");
										
				if(mysql_num_rows($q)==0)
				{ 
				?>
				<a href="javascript:void(0);" class="like" id="like<?php echo $rresl['rid'];?>" title="Like" rel="Like"  style='color: #005292;'><img id="likeimg<?php echo $rresl['rid'];?>" src="images/like.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('like','<?php echo $rresl['rid'];?>',''); return false;"></a>
				<?php }
				else{							 
				?>							
				<a href="javascript:void(0);" class="like" id="ulike<?php echo $rresl['rid'];?>" title="Unlike" rel="Unlike"  style='color: #005292;'><img id="likeimg<?php echo $rresl['rid'];?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $rresl['rid'];?>',''); return false;"></a>
				<?php } 
				}
				else{?>	
							  
				<img id="likeimg<?php echo $rresl['rid'];?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $rresl['rid'];?>'); return false;">
				<a href="javascript:void(0);" class="like" id="ulike<?php echo $rresl['rid'];?>" title="Unlike" rel="Unlike"  style='color: #005292;'> Like</a> <?php if($likecount>=0){  echo " (<span id='likescnt".$rresl['rid']."'>".$likecount."</span>)";} ?>
				<?php
				}
				?>&nbsp; -->
			    <?php 
				  if(!isset($_POST['anmuser']) && $_SESSION['uid'] == $ursrslt['user_id']){                             					 
			    ?>
				<a class="reply-edit" href="javascript:void(0);" data-id="<?php echo $rresl['rid'];?>">Edit</a>&nbsp;&nbsp;&nbsp;
				<a href="javascript:del_reply(<?php echo $rresl['rid']; ?> )">Delete</a>
				<?php
				  }
				?>
		&nbsp;&nbsp;&nbsp;<span style="font-weight: normal;" id="updtdate<?php echo $rresl['rid'];?>"><?php echo $rresl['replieddate'];?></span>
	   </div>
	  </div>
	  
	  <div style="width:100%">
	     <p class="p-rply" id="p-rply<?php echo $rresl['rid'];?>"><?php echo stripslashes($rresl['reply']);?></p>
		 <div class="edit-rply-div" id="edit-rply-div<?php echo $rresl['rid'];?>">
		   <form class="edit-rply-frm" name="edit-rply-frm" id="edit-rply-frm<?php echo $rresl['rid'];?>" method="post" action="" style="display:none;">
			<input type="hidden" class="rid" name="rid" value="<?php echo $rresl['rid'];?>">
			<textarea name="txt-comment" id="edit-rply-<?php echo $rresl['rid'];?>" class="t-comment" ><?php echo stripslashes($rresl['reply']);?></textarea>
			<input type="submit" style="width: 15%;" class="edit-rply-submit" name="edit-rply-submit" value="Update"> &nbsp;&nbsp;
			<input type="button" style="width: 15%;" class="cancel-rply-edit" data-id="<?php echo $rresl['rid'];?>" value="Cancel">
		  </form>
		 </div>
	  </div>
	  
	</div>
 </div>

<?php
  }
 
 }  

?>