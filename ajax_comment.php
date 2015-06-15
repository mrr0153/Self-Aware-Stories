 <?php
 @ob_start(); 
 require_once("config/config.inc.php"); 
 session_start();

 if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )){	
		
	 $comment=$_SESSION['comment'];
	 
	 if( isset($_SESSION['uid']) AND !empty($comment) ) {
		
		$uid = mysql_real_escape_string($_SESSION['uid']);
		$comment = mysql_real_escape_string($comment);	
		$vid = mysql_real_escape_string($_POST['vid']);			
		if(isset($_POST['anmuser'])) 
	    { 		  
		    $cid = mysql_real_escape_string($_POST['cid']);
            			
		    mysql_query("INSERT INTO sas_comment(comment,anmuser,cid,vid)VALUES('$comment','1','$cid','$vid')");	  	  
		}
        else{
	      
		    $cid = mysql_real_escape_string($_POST['cid']);	
		    mysql_query("INSERT INTO sas_comment(comment,uid,anmuser,cid,vid)VALUES('$comment','$uid','','$cid','$vid')");	
	  	  
		    $sql="select * from sas_users where user_id='$uid'";
		    $rslt=mysql_query($sql);
		    $rsrslt=mysql_fetch_array($rslt);		  
		    extract($rsrslt);
       }
		
	   //echo $uid;
	   $resl=mysql_query("select max(id) as max from sas_comment where uid='$uid'");
	   $rresl=mysql_fetch_array($resl);
	   extract($rresl);
	   //print_r($rresl);
	   $resl2=mysql_query("select * from sas_comment where id='$max'");
	   $rresl2=mysql_fetch_array($resl2);
	   
 ?>
          <script type="text/javascript" src="js/1.10.2jquery.js"></script>	
          <script src="js/my_js.js"></script>	
          <script src="js/comment_script2.js"></script>
		  
		  <script> 
			$(document).ready(function(){

				 $(".edit-comment-div").css("display","none");
				
				 $(".comment-edit").click(function(){
				    
					//alert('hi')
					
				    $(".edit-form").css("display","block");  
					$("#form1").css("display","none");
					$(".p-comment").css("display","block");  
					$(".edit-comment-div").css("display","none");
					
					var prev=$(this).attr('data-id')
					//alert(prev)
					
					$("#p-comment"+prev).css("display","none");
				
					$("#edit-comment-div"+prev).css("display","block");   	   
						 
				});
			    
				$(".cancel-rply").click(function(){				
					cmtid=$(this).attr("data-id")
                    $("#p-comment"+cmtid).css('display','block')					
					$("#edit-comment-div"+cmtid).css('display','none')					
				});
				
				$( ".edit-form" ).submit(function( e ) {
				
					  e.preventDefault();
					  
					  // alert('cmtxt')
					   var formData = {
						 'cid' :$(this).children(".cmtid").val(),
						 'txt-comment' :$(this).children(".t-comment").val(),
					   };
					  // alert(cid)
					// send ajax request
					$.ajax({
						url: 'ajax_edit_comment.php',
						type: 'POST',
						cache: false,
						data: formData, //form serizlize data
						beforeSend: function(){
							// change submit button value text and disabled it
							$('.edit-submit').val('Submitting...').attr('disabled', 'disabled');
						
						},
						success: function(data){
						    
							rslt=data.split('|||')
							//alert(rslt[0])
							
							$('#p-comment'+rslt[0]).html(rslt[1]);
                            						
							//$('#edit-comment-'+rslt[0]).val(rslt[1]);
							$('#edit-comment-'+rslt[0]).text(rslt[1]);
							$('.edit-form').trigger('reset');
							$('.edit-submit').val('Submit Comment').removeAttr('disabled');
							$('.edit-form').css('display','none');
							$('#p-comment'+rslt[0]).css('display','block');
							//location.reload();
						},
						error: function(e){
							alert(e);
						}
					});
				});
	
            });				
		  </script> 
		  
 
 <div class="comment-item">
	<div class="comment-avatar">
	<?php 
	  if(!empty($photopath)){
	?>
		<img src="https://s3-us-west-2.amazonaws.com/sas-userphotos/<?php echo $photopath; ?>" alt="">
	<?php }
    else{?>
        <img src="https://s3-us-west-2.amazonaws.com/sas-userphotos/account.png" alt="">
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
			<h6><?php echo $_SESSION['uname']; ?> <span style="color:#000;"> said....</span></h6>
		 <?php }?>		 
	   </div>  
	   <div class="comment-post-right" style="font-size:10px;">
	     <?php
					
			if(!empty($_SESSION['uid'])){
							
				$uid=$_SESSION['uid'];							
												
				$q=mysql_query("SELECT like_id FROM comment_like WHERE cmtid_fk='$rresl2[id]' and  uid_fk='$uid' and cid_fk='".$cid."' ");
											
				if(mysql_num_rows($q)==0)
				{ 
				?>
				<a href="javascript:void(0);" class="like" id="like<?php echo $rresl2['id'];?>" title="Like" rel="Like"  style='color: #005292;'><img id="likeimg<?php echo $rresl2['id'];?>" src="images/like.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('like','<?php echo $rresl2['id'];?>','<?php if(isset($cid)){echo $cid; } ?>'); return false;"></a>
				<?php }
				else{							 
				?>							
				<a href="javascript:void(0);" class="like" id="ulike<?php echo $rresl2['id'];?>" title="Unlike" rel="Unlike"  style='color: #005292;'><img id="likeimg<?php echo $id;?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $rresl2['id'];?>','<?php if(isset($cid)){echo $cid; }?>'); return false;"></a>
				<?php } 
				}
				else{?>	
							  
				<img id="likeimg<?php echo $rresl2['id'];?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $rresl2['id'];?>'); return false;">
				<a href="javascript:void(0);" class="like" id="ulike<?php echo $rresl2['id'];?>" title="Unlike" rel="Unlike"  style='color: #005292;'> Like</a> <?php if($likecount>=0){  echo " (<span id='likescnt".$rresl2['id']."'>".$likecount."</span>)";} ?>
				<?php
				}
				?>&nbsp;
			    <?php 
				  if(!isset($_POST['anmuser']) && $_SESSION['uid'] == $user_id){                             					 
			    ?>
				<a class="comment-edit" href="javascript:void(0);" data-id="<?php echo $rresl2['id'];?>">Edit</a>&nbsp;&nbsp;&nbsp;
				<a href="javascript:del_commnet(<?php echo $rresl2['id']; ?> )">Delete</a>
				<?php
				  }
				?>
		&nbsp;&nbsp;&nbsp;<?php echo $rresl2['date'];?>
	   </div>
	  </div>
	  <div style="width:100%">
	     <p class="p-comment" id="p-comment<?php echo $rresl2['id'];?>"><?php echo stripslashes($comment);?></p>
		 <div class="edit-comment-div" id="edit-comment-div<?php echo $rresl2['id'];?>">
			<form class="edit-form" name="edit-form" method="post" action="" >
				<input type="hidden" class="cmtid" name="cid" value="<?php echo $rresl2['id'];?>">
				<textarea name="txt-comment" id="edit-comment-<?php echo $rresl2['id'];?>" class="t-comment" ><?php echo stripslashes($comment);?></textarea>
				<input type="submit" class="edit-submit" name="edit-submit" value="Update"> &nbsp;&nbsp; 
				<input type="button" style="width: 15%;" class="cancel-rply" data-id="<?php echo $rresl2['id'];?>" value="Cancel">
				 
			</form>
			
		 </div>
	  </div>	 
	</div>
 </div>

<?php
  }	
 }  

?>