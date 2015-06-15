<?php
    ob_start();	
    session_start();
	require_once("config/config.inc.php"); 
	set_time_limit(0);
	
	$strcids='';
	
	if( isset($_REQUEST['vcid']) && !empty($_REQUEST['vcid']) ){	
	    $strcids=$_REQUEST['vcid'];
		$themeids=$_REQUEST['vcid'];
		$videoid=$_REQUEST['vid'];
	}else{
	    $videoid=$_REQUEST['vid'];
	    $themeids=$_REQUEST['cid'];
		$cids=explode('|||',$_REQUEST['cid']);
		$cidssize=sizeof($cids);	
		//print_r($cids);
		for($i=0;$i < $cidssize ;$i++){
		
		   if($i < $cidssize - 1){
			  $strcids .= $cids[$i].',';
		   }else{	  
			  $strcids .= $cids[$i];
		   }
		}		
	}
			
	if( $strcids != ''){
	
	  if($_POST['page'])
	  {  
		 $page = $_POST['page'];
		 		 
		 if( isset($_REQUEST['type']) && !empty($_REQUEST['type']) ){	
			$strcids=''; 
			//echo $strcids;
			$themeids=$_REQUEST['type'];		
			$cids=explode('|||',$_REQUEST['type']);			
			$cidssize=sizeof($cids);	
			$videoid=$_REQUEST['vid'];
			for($i=0;$i < $cidssize ;$i++){
		
			   if($i < $cidssize - 1){
				  $strcids .= $cids[$i].',';
			   }else{	  
				  $strcids .= $cids[$i];
			   }
			}		
		 }
		 
		 $cur_page = $page;
		 $page -= 1;
		 $per_page = 15;
		 $previous_btn = true;
		 $next_btn = true;
		 $first_btn = true;
		 $last_btn = true;
		 $start = $page * $per_page;
		 $end= $per_page;
	     
         //echo "SELECT * FROM sas_comment WHERE cid IN ( ".$strcids." ) order by date desc limit $start, $end";
		 		 
		 $comment_query = mysql_query("SELECT * FROM sas_comment WHERE cid IN ( ".$strcids." ) and vid='$videoid' order by date desc limit $start, $end") or die(mysql_error());
		 
         $query = mysql_query("SELECT * FROM sas_comment WHERE cid IN ( ".$strcids." ) and vid='$videoid' order by date desc ") or die(mysql_error());
		 
		 $count= mysql_num_rows($query);
?> 
          <script type="text/javascript" src="js/1.10.2jquery.js"></script>	
          <script src="js/my_js.js"></script>	
          <script src="js/comment_script2.js"></script>
		  
		  <script> 
			$(document).ready(function(){

				$(".edit-comment-div").css("display","none");
				$(".rply-comment-div").css('display','none')
				$(".edit-rply-div").css("display","none"); 
				
				$(".comment-edit").click(function(){
				
				    $(".edit-form").css("display","block");  
					//$("#form1").css("display","none");
					$(".p-comment").css("display","block");  
					$(".edit-comment-div").css("display","none");
					var prev=$(this).attr('data-id')
					//alert(prev)
					$("#p-comment"+prev).css("display","none");
				
					$("#edit-comment-div"+prev).css("display","block");   	   
						 
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
							$('.edit-submit').val('Submit').removeAttr('disabled');
							$('.edit-form').css('display','none');
							$('#p-comment'+rslt[0]).css('display','block');
							//location.reload();
						},
						error: function(e){
							alert(e);
						}
					});
				});	            
				
				$(".cancel-edit").click(function(){	
				
					cmtid=$(this).attr("data-id")					
					$("#edit-comment-div"+cmtid).css('display','none')
					$("#p-comment"+cmtid).css('display','block')
					$("#form1").css("display","block");
				}); 
	   
	            $(".rplylink").click(function(){	
				
				    var userid="<?php if(isset($_SESSION['uid'])){echo $_SESSION['uid'];}?>";
	
					if(userid == null || userid==""){
					
					   document.getElementById('abc3').style.display = "block";					   
					}
					else{
					
					   cmtid=$(this).attr("data-id")
					   $(this).css("font-weight","bold")
					   $("#rply-comment-div"+cmtid).css('display','block')
					}
					
				});
	            
				$(".cancel-rply").click(function(){				
					cmtid=$(this).attr("data-id")
                    $("#rplylink"+cmtid).css("font-weight","normal")					
					$("#rply-comment-div"+cmtid).css('display','none')					
				});
				
				$( ".rply-form" ).submit(function( e ) {
				
					e.preventDefault();
					   
					//alert('rply-form')
										
		            cmtid=$(this).children(".cmtid").val()
					//alert(cmtid)
					var form = $(this);
					// send ajax request
					$.ajax({
						url: 'ajax_reply_comment.php',
						type: 'POST',
						cache: false,
						//data: formData, //form serizlize data
						data: form.serialize(),
						beforeSend: function(){
							// change submit button value text and disabled it
							$('#rply-submit').val('Replying...').attr('disabled', 'disabled');
						
						},
						success: function(data){
							
							//alert(data)	
							$("#rply-comment-div"+cmtid).css('display','none'); 
							var item = $(data).hide().fadeIn(800);
							$(".replied-response"+cmtid).html(item);
														
							// reset form and button
							$('#rply-form').trigger('reset');
							submit.val('Reply').removeAttr('disabled');
							//location.reload();							
							//$(".edit-rply-frm").css('display','none');
						},
						error: function(e){
							alert(e);
						}
						
					});
				});
				
				
				$(".reply-edit").click(function(){
	    					  
					var rid=$(this).attr('data-id') 
					$('.edit-rply-frm').css('display','none');
					$('.p-rply').css('display','block');
					
					$("#edit-rply-div"+rid).css("display","block");
					$("#edit-rply-frm"+rid).css("display","block");
					$("#p-rply"+rid).css("display","none");
					
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
							
							//$('.edit-rply-frm').css('display','none');
							
							$('#edit-rply-frm'+rslt[0]).css('display','none');
							
							$('#p-rply'+rslt[0]).css('display','block');
							//location.reload();
						},
						error: function(e){
							alert(e);
						}
					});
				});	       
						
				
            });
            
			function del_reply(id){
				 //alert(id)
				 
				if(confirm("Are you sure to delete this reply?"))
				{
					$.post("del_reply.php?id="+id,{},function(){
				   
						 location.reload();	 
					});
				}
				 
			 }
 
		  </script> 
		  
		  <div class="comment-block" id="comment-blockk">
		   
				<?php 
				  
				if(mysql_num_rows($comment_query)>0){
				  
				  while($comment = mysql_fetch_array($comment_query)){
                   //print_r($comment);	
				   $cmtid=$comment['id'];
				   $cid=$comment['cid'];
                   $likecount=$comment['like_count'];				  
				   //extract($comment);
				   		  	
				   $crqry = mysql_query("SELECT * FROM sas_comment_replies WHERE cmtid=$cmtid order by replieddate desc ");
				   
				   if(isset($comment['anmuser']) && $comment['anmuser']==1 ){				 				
				?>
					 <div class="comment-item">
						<div class="comment-avatar">							
						 <img src="https://s3-us-west-2.amazonaws.com/sas-userphotos/account.png" alt="avatar">							
						</div>
						<div class="comment-post">
						  <div class="comment-post-div">
						    <div class="comment-post-left" >
							  <h6>Anonymous<span style="color:#000;"> said....</span></h6>
							</div>  
							<div class="comment-post-right" style="font-size:10px;">
 
							<?php
						
							  if(!empty($_SESSION['uid'])){
								
								$uid=$_SESSION['uid'];							
													
								if(isset($cid)){
								  
								   $q=mysql_query("SELECT like_id FROM comment_like WHERE cmtid_fk='$cmtid' and  uid_fk='$uid' and cid_fk='".$cid."' ");
								}								
								
								if(mysql_num_rows($q)==0)
								{ 							 
								?>
								<a href="javascript:void(0);" class="like" id="like<?php echo $cmtid;?>" title="Like" rel="Like"  style='color: #005292;'><img id="likeimg<?php echo $cmtid;?>" src="images/like.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('like','<?php echo $cmtid;?>','<?php if(isset($cid)){ echo $cid; } ?>'); return false;"></a>
								<?php
								}
								else{							 
								?>							
								<a href="javascript:void(0);" class="like" id="ulike<?php echo $cmtid;?>" title="Unlike" rel="Unlike"  style='color: #005292;'><img id="likeimg<?php echo $cmtid;?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $cmtid;?>','<?php if(isset($cid)){echo $cid; } ?>'); return false;"></a>
								 
							<?php } 
							 }
							 else{?>							  
								<img id="likeimg<?php echo $cmtid;?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $cmtid;?>'); return false;">
								<a href="javascript:void(0);" class="like" id="ulike<?php echo $cmtid;?>" title="Unlike" rel="Unlike"  style='color: #005292;'> Like</a> <?php if($likecount>=0){  echo " (<span id='likescnt".$cmtid."'>".$likecount."</span>)";} ?>
							<?php
							 }
							?>
							&nbsp;&nbsp;&nbsp;
							<?php echo $comment['date'];?>							
							</div>
						  </div></br>
                          <div style="width:100%">
							  <p class="p-comment" id="p-comment<?php echo $comment['$id'];?>"><?php echo stripslashes($comment['comment']);?></p>	
							  <div class="edit-comment-div" id="edit-comment-div<?php echo $comment['id'];?>">
							  <form class="edit-form" name="edit-form" method="post" action="" >
								<input type="hidden" class="cmtid" name="cid" value="<?php echo $comment['id'];?>">
								<textarea name="txt-comment" id="edit-comment-<?php echo $comment['id'];?>" class="t-comment" ><?php echo stripslashes($comment['comment']);?></textarea>
								<input type="submit" style="width: 15%;" class="edit-submit" name="edit-submit" value="Submit">
							  </form>
							  </div>
						  </div>
						  
						</div>
					</div>
				<?php 
				  }else {
				  
				   $sql="select * from sas_users where user_id='$comment[uid]'";
				   $rslt=mysql_query($sql);
				   $rsrslt=mysql_fetch_array($rslt);
				   //extract($rsrslt);
				   //print_r($rsrslt);
				?>
					<div class="comment-item">
						<div class="comment-avatar">
							<?php 
							  if(!empty($rsrslt['photopath'])){
							?>
								<img src="https://s3-us-west-2.amazonaws.com/sas-userphotos/<?php echo $rsrslt['photopath']; ?>" alt="<?php echo $rsrslt['username'];?>">
							<?php }
							else{?>
								<img src="https://s3-us-west-2.amazonaws.com/sas-userphotos/account.png" alt="<?php echo $rsrslt['username'];?>">
							<?php }?>	
						</div>
						<div class="comment-post">
						  <div class="comment-post-div">
						    <div class="comment-post-left" >
							  <h6><?php if(isset($_SESSION['uid']) && $_SESSION['uid'] == $comment['uid']){ echo $rsrslt['username']; }else if(!empty($rsrslt['username'])){ echo $rsrslt['username'];}else{ echo "Anonymous"; }?> <span style="color:#000;">said....</span></h6>
							</div>  
							<div class="comment-post-right" style="font-size:10px;">	
							<?php
						
							  if(!empty($_SESSION['uid'])){
								
								$uid=$_SESSION['uid'];							
													
								if(isset($cid)){
								  //echo $uid.'--'.$vid.'--'.$cat_id;
								  $q=mysql_query("SELECT like_id FROM comment_like WHERE cmtid_fk='$cmtid' and  uid_fk='$uid' and cid_fk='".$cid."' ");
								}
																
								if(mysql_num_rows($q)==0)
								{ 							 
								?>
								   <a href="javascript:void(0);" class="like" id="like<?php echo $cmtid;?>" title="Like" rel="Like"  style='color: #005292;'><img id="likeimg<?php echo $cmtid;?>" src="images/like.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('like','<?php echo $cmtid;?>','<?php if(isset($cid)){echo $cid; } ?>'); return false;"></a>
								<?php }
								else
								{							 
								?>							
								   <a href="javascript:void(0);" class="like" id="ulike<?php echo $cmtid;?>" title="Unlike" rel="Unlike"  style='color: #005292;'><img id="likeimg<?php echo $cmtid;?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $cmtid;?>','<?php if(isset($cid)){echo $cid; } ?>'); return false;"></a>
								<?php } 
								}
								else{?>	
								   <img id="likeimg<?php echo $cmtid;?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $cmtid;?>'); return false;">
								   <a href="javascript:void(0);" class="like" id="ulike<?php echo $cmtid;?>" title="Unlike" rel="Unlike"  style='color: #005292;'> Like</a> <?php if($likecount>=0){  echo " (<span id='likescnt".$cmtid."'>".$likecount."</span>)";} ?>
								<?php
								  }
								?>&nbsp;
								<?php 
								 if(isset($_SESSION['uid']) && $_SESSION['uid'] == $rsrslt['user_id']){ 
								?>
								   <a class="comment-edit" href="javascript:void(0);"  data-id="<?php echo $comment['id'];?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="javascript:del_commnet(<?php echo $comment['id']; ?> )">Delete</a>
								<?php } ?>
								&nbsp;&nbsp;&nbsp;<span style="font-weight: normal;" id="updtdate<?php echo $comment['id'];?>"><?php echo $comment['date'];?></span> 
							</div>
						  </div></br>
                          <div style="width:100%">
                             <p class="p-comment" id="p-comment<?php echo $comment['id'];?>"><?php echo stripslashes($comment['comment']);?></p>	
						     <div class="edit-comment-div" id="edit-comment-div<?php echo $comment['id'];?>">
							  <form class="edit-form" name="edit-form" method="post" action="" >
								<input type="hidden" class="cmtid" name="cid" value="<?php echo $comment['id'];?>">
								<textarea name="txt-comment" id="edit-comment-<?php echo $comment['id'];?>" class="t-comment" ><?php echo stripslashes($comment['comment']);?></textarea>
								<input type="submit" style="width: 15%;" class="edit-submit" name="edit-submit" value="Submit"> &nbsp;&nbsp; <input type="button" style="width: 15%;" class="cancel-edit" data-id="<?php echo $comment['id'];?>" value="Cancel">
							  </form>
							 </div>
							<?php 
                             if(isset($_SESSION['uid']) && $_SESSION['uid'] == $comment['uid']){
							 
							 }else{
							?>
							<div class="rplylink" id="rplylink<?php echo $comment['id'];?>" data-id="<?php echo $comment['id'];?>" ><a href="javascript:void();">Reply</a></div>
							<?php } ?>
							 
						  </div>					  
						</div></br>	
				  </div>
				  
				  <?php 
                     if(isset($_SESSION['uid']) && $_SESSION['uid'] == $comment['uid']){
							 
					 }else{
					 
                       if(isset($_SESSION['uid'])){
					   
						 $usql="select * from sas_users where user_id='$_SESSION[uid]'";
						 $urslt=mysql_query($usql);
						 $ursrslt=mysql_fetch_array($urslt);				  
						 //print_r($ursrslt);
				     				 
				  ?>
				  <div class="comment-item rply-comment-div" id="rply-comment-div<?php echo $comment['id'];?>" style="width: 90%;float: right;background-color: #E6E6E6;" >
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
							   <h6><?php if(!empty($ursrslt['username'])){ echo $ursrslt['username']; }?> <span style="color:#000;">replying...</span></h6>
							</div>							
							<div class="comment-post-right" style="font-size:10px;">							   
							</div>
						 </div>	
						 <div style="width:100%">						     	
                             <div class="" >
							  <form class="rply-form" name="rply-form" id="rply-form" method="post" action="" >
								<input type="hidden" class="cmtid" name="cmtid" value="<?php echo $comment['id'];?>">
								<textarea name="txt-comment" class="t-comment" required ></textarea>
								<input type="hidden" name="vid" value="<?php echo $comment['vid'];?>">
								<input type="submit" style="width: 15%;" class="rply-submit" name="rply-submit" value="Reply"> &nbsp;&nbsp; 
								<input type="button" style="width: 15%;" class="cancel-rply" data-id="<?php echo $comment['id'];?>" value="Cancel">
							  </form>
							 </div>
						 </div>
					  </div></br><br>
               	  </div>				  
				  <div class="replied-response<?php echo $comment['id'];?>"></div>	
			  <?php 
				  }   
				   } 
			  ?>
			  <?php
				  }
				  				  
				  if(mysql_num_rows($crqry)>0){
				  
				     while($crrslt=mysql_fetch_array($crqry)){
				  	   
					     $rid=$crrslt['rid'];
					 
						 //print_r($crrslt);
						 
						 if( $crrslt['mdrid'] != 0 ){
						 
							 $asql="select * from sas_moderators where admin_id=".$crrslt['mdrid'];
							 $arslt=mysql_query($asql);
							 $arsrslt=mysql_fetch_array($arslt);
							 $photopath=$arsrslt['photopath'];
							 //extract($arsrslt);
						 }
						 else if( $crrslt['uid'] != 0 ){
							 
							 $asql="select * from sas_users where user_id=".$crrslt['uid'];
							 $arslt=mysql_query($asql);
							 $arsrslt=mysql_fetch_array($arslt);
							 $photopath=$arsrslt['photopath'];
							 //extract($arsrslt);						
						 }					 
			  ?>  
				     <div class="comment-item" id="comment-rply<?php echo $crrslt['rid'];?>" style="width: 90%;float: right;background-color: #E6E6E6;">
						<div class="comment-avatar">
							<?php 
							  if( $crrslt['mdrid'] != 0 or $crrslt['adminid'] != 0){
							?>
								<!-- <img src="https://s3-us-west-2.amazonaws.com/moderator-photos/<?php echo $arsrslt['photopath']; ?>" alt="Moderator"> -->
								<img src="https://s3-us-west-2.amazonaws.com/moderator-photos/s-logo.png" alt="">
							<?php 
							  }else if( $crrslt['uid'] != 0 ){ 
							?>
								<img src="https://s3-us-west-2.amazonaws.com/sas-userphotos/<?php echo $photopath;?>" alt="<?php echo $arsrslt['username'];?>">
							<?php
 							  }else if( $crrslt['anuid'] != 0 ){
							?>
                                <img src="images/Anonymous.png" alt="Anonymous">
							<?php }?>							
						</div>
						<div class="comment-post">
						  <div class="comment-post-div">
						    <div class="comment-post-left" >
							  <h6><?php if( $crrslt['adminid'] != 0 ){ echo 'Admin';}else if( $crrslt['mdrid'] != 0 ){ echo 'Moderator'; } else if( $crrslt['uid'] != 0 ){ if( isset($_SESSION['uid']) && $_SESSION['uid'] == $crrslt['uid'] ){ echo $arsrslt['username'];}else{ echo $arsrslt['username'];} }else if( $crrslt['anuid'] != 0 ){ echo "Anonymous";} ?> <span style="color:#000;">said....</span></h6>
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
								  <a href="javascript:void(0);" class="like" id="like<?php echo $rid;?>" title="Like" rel="Like"  style='color: #005292;'><img id="likeimg<?php echo $rid;?>" src="images/like.png" style="margin-bottom: -2px;height: 15px;" onclick="replylike('like','<?php echo $rid;?>','<?php echo $cmtid;?>'); return false;"></a>
							<?php }
								else
								{							 
							?>							
								  <a href="javascript:void(0);" class="like" id="ulike<?php echo $rid;?>" title="Unlike" rel="Unlike"  style='color: #005292;'><img id="likeimg<?php echo $rid;?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="replylike('ulike','<?php echo $rid;?>','<?php echo $cmtid;?>'); return false;"></a>
							<?php } 
							 }
							 else{
							?>								  
								<img id="likeimg<?php echo $rid;?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $rid;?>'); return false;">
								<a href="javascript:void(0);" class="like" id="ulike<?php echo $rid;?>" title="Unlike" rel="Unlike"  style='color: #005292;'> Like</a> <?php if($likecount>=0){  echo " (<span id='likescnt".$rid."'>".$likecount."</span>)";} ?>
							<?php
							 }
							?>&nbsp; 
							-->
							<?php 
								 if( isset($_SESSION['uid']) && $_SESSION['uid'] == $crrslt['uid'] ){    
							?>
								<a class="reply-edit" href="javascript:void(0);"  data-id="<?php echo $rid;?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="javascript:del_reply(<?php echo $rid; ?> )">Delete</a>
							<?php
								 } 
							?>
							&nbsp;&nbsp;&nbsp;<span style="font-weight: normal;" id="updtdate<?php echo $crrslt['rid'];?>"><?php echo $crrslt['replieddate'];?></span> 
							</div>
						  </div></br>
                          <div style="width:100%">
                             <p class="p-rply" id="p-rply<?php echo $crrslt['rid'];?>" ><?php echo stripslashes($crrslt['reply']);?></p>                             
							 <div class="edit-rply-div" id="edit-rply-div<?php echo $crrslt['rid'];?>">
							  <form class="edit-rply-frm" id="edit-rply-frm<?php echo $crrslt['rid'];?>" name="edit-rply-frm" method="post" action="" >
								<input type="hidden" class="rid" name="rid" value="<?php echo $crrslt['rid'];?>">
								<textarea name="txt-comment" id="edit-rply-<?php echo $crrslt['rid'];?>" class="t-comment" ><?php echo stripslashes($crrslt['reply']);?></textarea>
								<input type="submit" style="width: 15%;" class="edit-rply-submit" name="edit-rply-submit" value="Update"> &nbsp;&nbsp; <input type="button" style="width: 15%;" class="cancel-rply-edit" data-id="<?php echo $crrslt['rid'];?>" value="Cancel">
							  </form>
							 </div>
							 
						  </div>						  
						</div>
				     </div></br><br></br><br>
				  
            <?php
			        }
                  }				  
				}
							  			
			?>
			<?php
 
            $no_of_paginations = ceil($count / $per_page);
			$msg = "";
			/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
			if ($cur_page >= 7) {
				$start_loop = $cur_page - 3;
				if ($no_of_paginations > $cur_page + 3)
					$end_loop = $cur_page + 3;
				else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
					$start_loop = $no_of_paginations - 6;
					$end_loop = $no_of_paginations;
				} else {
					$end_loop = $no_of_paginations;
				}
			} else {
				$start_loop = 1;
				if ($no_of_paginations > 7)
					$end_loop = 7;
				else
					$end_loop = $no_of_paginations;
			}
			/* ----------------------------------------------------------------------------------------------------------- */
			$msg .= "<div class='pagination'><div style='width: 65%;float: left;'><ul id='pagination'>";

			// FOR ENABLING THE FIRST BUTTON
			if ($first_btn && $cur_page > 1) {
				
				$msg .= "<li p='1' type='$themeids' vid='$_REQUEST[vid]' class='active'>First</li>";
				
			} else if ($first_btn) {
				$msg .= "<li p='1' type='$themeids' vid='$_REQUEST[vid]' class='inactive'>First</li>";
			}

			// FOR ENABLING THE PREVIOUS BUTTON
			if ($previous_btn && $cur_page > 1) {
				$pre = $cur_page - 1;
				$msg .= "<li p='$pre' type='$themeids' vid='$_REQUEST[vid]' class='active'>Previous</li>";
			} else if ($previous_btn) {
				$msg .= "<li class='inactive'>Previous</li>";
			}
			for ($i = $start_loop; $i <= $end_loop; $i++) {

				if ($cur_page == $i)
					$msg .= "<li p='$i' type='$themeids' vid='$_REQUEST[vid]' style='color:#fff;background-color:#005292;' class='active'>{$i}</li>";
				else
					$msg .= "<li p='$i' type='$themeids' vid='$_REQUEST[vid]' class='active'>{$i}</li>";
			}

			// TO ENABLE THE NEXT BUTTON
			if ($next_btn && $cur_page < $no_of_paginations) {
				$nex = $cur_page + 1;
				$msg .= "<li p='$nex' type='$themeids' vid='$_REQUEST[vid]' class='active'>Next</li>";
			} else if ($next_btn) {
				$msg .= "<li class='inactive'>Next</li>";
			}

			// TO ENABLE THE END BUTTON
			if ($last_btn && $cur_page < $no_of_paginations) {
				$msg .= "<li p='$no_of_paginations' type='$themeids' vid='$_REQUEST[vid]' class='active'>Last</li>";
			} else if ($last_btn) {
				$msg .= "<li p='$no_of_paginations' type='$themeids' vid='$_REQUEST[vid]' class='inactive'>Last</li>";
			}
			$goto = "<input type='text' class='goto'  size='1' />
			<input type='button' difftype='$themeids' vid='$_REQUEST[vid]' id='go_btn' class='go_button' value='Go'/>";
			$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
			$msg = $msg . "</ul></div><div style='width: 35%;float: left;'>" . $goto . $total_string . "</div></div>";  // Content for pagination
			echo $msg;
            
			}else{
                 echo "<p  id='nocomment' style='text-align:center;padding-top: 50px;color: #000;'>No comments available at this point.</p>";
            }
		 }
		
       ?>			
			</div>
			
			    <div class="horizontal-line"></div>	
			    <form name="commentform" id="form1" method="post" onsubmit=" return div_show()">
				 
				   <h4>Submit New Comment <span id="spn" style="padding-left: 25px;color:red"> </span></h4>
				
				    <!--comment form -->				
					<!-- need to supply post id with hidden field -->
					<?php 
					 if(isset($_REQUEST['cid'])){ 
					?>
                       <input type="hidden" name="cid" value="<?php echo $_REQUEST['cid'];?>">
					   <input type="hidden" name="vid" value="<?php echo $_REQUEST['vid'];?>">
                    <?php					
					 }
					?>
                    				
					<label style=" padding: 0;">
						<span>Your Comment </span><span style="color:red;">*</span>
						<textarea  onmouseout="getComment()" id="comment" name="comment" cols="30" rows="10" placeholder="Type your comment here...." required></textarea>
					</label>
					<div class="comment-submit">
					  <div class="comment-submit-left">
						<input type="submit" id="submit" value="Submit Comment">					
					  </div>
					  <div class="comment-submit-right">
						<input type="checkbox" id="anmuser" name="anmuser"  value="Anonymous"> Comment as Anonymous User
					  </div>
					</div>		  
				</form>
		<?php 
		
        }else{
             
			 echo "<p id='notheme' style='text-align:center;padding-top: 50px;color: #000;'>Please select a Theme.</p>";
        }				
		?>		
		
		<script>
		
		 $(document).ready(function(){
		 
		    function loading_show(){
			   $('#loading').html("<img src='images/loading.gif' width='50px' height='50px'/>").fadeIn('fast');
			}
			function loading_hide(){
			   $('#loading').fadeOut('fast');
			}   
				
			var vcid='<?php echo $_REQUEST['cid'];?>';
			
			function loadData(page,type,vid){
				
				loading_show();
			
				$.post('getforumcomments.php',{"page":page,'type':type,'vcid':vcid,'cid':vcid,'vid':vid},function(data){
						loading_hide();
						//alert(data)
						$("#forumcomments").empty().html(data)							
				});
				
			}
						
			$('#pagination li.active').click(function(){
			var page = $(this).attr('p');
			var type = $(this).attr('type');
			var vid = $(this).attr('vid');
			//alert(page)
			loadData(page,type,vid);
						
		  }); 
					
		  $('#go_btn').click(function(){
		  
			var page = parseInt($('.goto').val());
			var type = $(this).attr('difftype');
			var vid = $(this).attr('vid');
			
			var no_of_pages = parseInt($('.total').attr('a'));
			if(page != 0 && page <= no_of_pages){
			    loadData(page,type,vid);
			}else{
				  alert('Enter a PAGE between 1 and '+no_of_pages);
				  $('.goto').val("").focus();
				  return false;
			}
						
		 });
		 
	 
		 });
		
		
		</script>