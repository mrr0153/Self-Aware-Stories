<?php
session_start();
require_once("config/config.inc.php");

if(isset($_REQUEST['vid'])){
  $vid=$_REQUEST['vid'];
}
if(isset($_REQUEST['cvid'])){
  $cvid=$_REQUEST['cvid'];
}
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>Self-Aware Stories : Video Comments</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="images/favicon.gif"/>
<link rel="stylesheet" href="css/style.css" media="screen"/><!-- MAIN STYLE CSS FILE -->
<link rel="stylesheet" href="css/responsive.css" media="screen"/><!-- RESPONSIVE CSS FILE -->
<link rel="stylesheet" id="style-color" href="css/colors/blue-color.css" media="screen"/><!-- DEFAULT BLUE COLOR CSS FILE -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,500' rel='stylesheet' type='text/css'><!-- ROBOTO FONT FROM GOOGLE CSS FILE -->
<link rel="stylesheet" href="css/prettyPhoto.css" media="screen"/><!--PRETTYPHOTO CSS FILE -->
<link rel="stylesheet" href="css/font-awesome/font-awesome.min.css" media="screen"/><!-- FONT AWESOME ICONS CSS FILE -->
<link rel="stylesheet" href="css/layer-slider.css" media="screen"/><!-- LAYER SLIDER CSS FILE -->
<link rel="stylesheet" href="css/flexslider.css" media="screen"/><!-- FLEX SLIDER CSS FILE -->
<link rel="stylesheet" href="css/revolution-slider.css" media="screen"/><!-- REVOLUTION SLIDER CSS FILE -->
<!-- All JavaScript Files (FOR FASTER LOADING OF YOUR SITE, REMOVE ALL JS PLUGINS YOU WILL NOT USE)-->
<script type="text/javascript" src="js/jquery.min.js"></script><!-- JQUERY JS FILE -->
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script><!-- JQUERY UI JS FILE -->
<script type="text/javascript" src="js/flex-slider.min.js"></script><!-- FLEX SLIDER JS FILE -->
<script type="text/javascript" src="js/navigation.min.js"></script><!-- MAIN NAVIGATION JS FILE -->
<script type="text/javascript" src="js/map.min.js"></script><!-- GOOGLE MAP JS FILE -->
<script type="text/javascript" src="js/carousel.js"></script><!-- CAROUSEL SLIDER JS -->
<script type="text/javascript" src="js/jquery.theme.plugins.min.js"></script><!-- REVOLUTION SLIDER PLUGINS JS FILE -->
<script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script><!-- REVOLUTION SLIDER JS FILE -->
<script type="text/javascript" src="js/flickr.js"></script><!-- FLICKR WIDGET JS FILE -->
<script type="text/javascript" src="js/instagram.js"></script><!-- INSTAGRAM WIDGET JS FILE -->
<script type="text/javascript" src="js/jquery.twitter.js"></script><!--TWITTER WIDGET JS FILE -->
<script type="text/javascript" src="js/prettyPhoto.min.js"></script><!-- PRETTYPHOTO JS FILE -->
<script type="text/javascript" src="js/jquery.tooltips.min.js"></script><!-- TOOLTIPS JS FILE -->
<script type="text/javascript" src="js/isotope.min.js"></script><!--ISOTOPE JS FILE -->
<script type="text/javascript" src="js/scrolltopcontrol.js"></script><!-- SCROLL TO TOP JS PLUGIN -->
<script type="text/javascript" src="js/jquery.easy-pie-chart.js"></script><!-- EASY PIE JS FILE -->
<script type="text/javascript" src="js/jquery.transit.min.js"></script><!-- TRANSITION JS FILE -->
<script type="text/javascript" src="js/custom.js"></script><!-- CUSTOM JAVASCRIPT JS FILE -->
<script type="text/javascript" src="js/1.10.2jquery.js"></script>


<!---- comment script start --->
<link rel="stylesheet"  href="css/elements.css" />
<link rel="stylesheet"  href="css/question.css" />

<script src="js/my_js.js"></script>	
	
<script src="js/comment_script2.js"></script>
<!---- comment script end --->
<script> 
$(document).ready(function(){

    $(".edit-comment-div").css("display","none"); 
				
    $("#cancel").click(function(){
	     //alert('hi')
		$("#abc").css("display","none"); 	     	   		  	 
    });
    
	$("#cancel3").click(function(){
	    // alert('hi')
		$("#abc3").css("display","none"); 	     	   		  	 
    });
		
    $(".comment-edit").click(function(){
	    $("#form1").css("display","none");
		$(".p-comment").css("display","block");  
	    $(".edit-comment-div").css("display","none");
	    var prev=$(this).attr('data-id')
		//alert(prev)
		$("#p-comment"+prev).css("display","none");
	
	    $("#edit-comment-div"+prev).css("display","block");   	   
		  	 
    });
	
	
	$( ".edit-form" ).submit(function( e ) {
	    e.preventDefault();
		  
		   //alert(cmtxt)
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
			   // alert(data)
				//var item = $(data).hide().fadeIn(800);
				//$('.comment-block').append(item);
                
				// reset form and button
				//$('#edit-form').trigger('reset');
				//$('#edit-submit').val('Submit Comment').removeAttr('disabled');
				location.reload();
			},
			error: function(e){
				alert(e);
			}
		});
	});
	

});
</script>

<script>
function del_commnet(id){
 //alert(id)
 $.post("del_comment.php?id="+id,{},function(){
   location.reload();
 
 });
}
 function getComment(){
 
   var comment = document.getElementById('comment').value;
	//alert(comment)	
	$.post("save_comment.php?comment="+comment,{},function(data){ 
   	   
	});
	//alert(comment)
 }
 
 function div_show(){ 
    				
	 var uid="<?php if(isset($_SESSION['uname'])) echo $_SESSION['uname']; ?>";	  
     
     if(uid){	  
	    //alert('set');	
     }else{
      
	   document.getElementById('abc').style.display = "block";
	   
      }   
	}
 
</script>
<script type="text/javascript">

function funlike(rel,cmtid,vid,type) 
 {	//alert("rel="+rel+"--cmtid="+cmtid+"--vid="+vid+"--type="+type)	
	var ID = rel+cmtid;	
	var New_ID=vid;
	var rel2 = $('#'+ID).attr("rel");
	//alert(rel+"--"+id+"--"+rel2)
	//alert(rel2)
	 var URL='comment_like_ajax.php';
	
	var dataString = 'vid=' + vid +'&cmtid=' + cmtid +'&rel='+ rel2+'&type='+ type;
	var userid="<?php if(isset($_SESSION['uid'])){echo $_SESSION['uid'];}?>";
	if(userid == null || userid==""){
	
	  document.getElementById('abc3').style.display = "block";	
	}
	else{
	
		$.ajax({
		type: "POST",
		url: URL,
		data: dataString,
		cache: false,
		success: function(html){ 
		
		   // alert('count='+html)
			//alert("#likescnt"+cmtid)
			if(rel2=='Like')
			{ //alert(rel2+'==Like')        		
			  $('#'+ID).attr('rel', 'Unlike').attr('title', 'Unlike');
			  $("#likescnt"+cmtid).html(html)
			  $("#likeimg"+cmtid).attr('src','images/unlike.png')
			}
			else
			{  //alert(rel2+'==Unlike')
			  $('#'+ID).attr('rel', 'Like').attr('title', 'Like');
			  $("#likescnt"+cmtid).html(html)
			  $("#likeimg"+cmtid).attr('src','images/like.png')
			}
		  
		}
	  });
  
  }
  
}
</script>

</head>
<body id ="bdy" >
<div id="container">
	<!-- main container starts-->
	<div id="wrapp">
		<!-- main wrapp starts-->
		<header id="header">
		<!--header starts -->
	
		<div class="container">
			<div class="head-wrapp">
				<a href="index.php" id="logo"><img src="images/logo.png" alt="" width="110" height="auto"/></a>
				<!--your logo-->
				<nav class="top-search">
					<!-- search starts-->
				   <div class="search-block"> 	
					 <form action="javascript:void(0);" method="get">
						<button class="search-btn"></button>
					 	<input class="search-field" type="text" onblur="if(this.value=='')this.value='Search';" onfocus="if(this.value=='Search')this.value='';" value="Search"/>
					 </form>
				   </div>	
				   <div id="socialiconsvid" class="social-block">                 
					   <?php include('header-widget.php');  ?>
				   </div>
				 </nav>
				<!--search ends -->
               
					
					<!--header social links ends -->
				
		  </div>

		</div>
		<div id="main-navigation">
			<!--main navigation wrapper starts --> 
			<div class="container">
				<ul class="main-menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="aboutus.php">About Us</a></li>
				<!--<li><a href="#"> Start Here </a></li> -->
					<li><a href="blog/" target="_blank">Blog</a></li>
				<!--<li><a href="tour.php">Tour</a></li> -->
					<li><a href="testimonials.php">Testimonials</a></li>
					<li><a href="plans&pricing.php">Plans & Pricing</a></li>
					<li><a href="contactus.php">Contact Us</a></li>
				</ul>
				<!-- main navigation ends-->
                <div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) {echo "<a href='logout.php'>Logout</a>";} else echo "<a href='signup.php'>SignUp</a>";?></h4>
				</div>
				<div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) {echo "<a href='edit-profile.php'>".$_SESSION['uname']."</a>";} else echo "<a href='login.php'>Login</a>";?></h4>
				</div>
                <div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) { echo '<a href="myjournal.php" target="_blank">My Journal</a>';} ?></h4>
				</div>
			</div>
		</div>
		<!--main navigation wrapper ends -->
		</header>
		<!-- header ends-->
        <div class="container">
           <?php
				if(isset($_REQUEST['vid'])){
				  $query = mysql_query('SELECT * FROM sas_videos WHERE id ='.$_REQUEST['vid']);
				}
				if(isset($_REQUEST['cvid'])){
				  
				  $query = mysql_query('SELECT * FROM sas_copvideos WHERE id ='.$_REQUEST['cvid']);
				}
				
				$row = mysql_fetch_array($query);
				
				//print_r($row);
			?>
			<?php
			   
			    if(isset($_REQUEST['vid'])){
				  $qry = mysql_query('SELECT * FROM sas_videos WHERE id ='.$_REQUEST['vid']);
				}
				if(isset($_REQUEST['cvid'])){
				  $qry = mysql_query('SELECT * FROM sas_copvideos WHERE id ='.$_REQUEST['cvid']);
				}
				//echo mysql_num_rows($qry);
				//$rslt=mysql_query($qry); 
				$rlt=mysql_fetch_array($qry);
				
				extract($rlt);
			   				
				$qry2="select * from sas_themecategories where cat_id='$cat_id' ";
				$rslt2=mysql_query($qry2); 
				$rlt2=mysql_fetch_array($rslt2);
				
				extract($rlt2);
			   
			?>
        <section class="one-half12">
			
           <img src="productimages/<?php echo $row['prod_image'];?>" ></img>
		  	
		</section>
				
           </div>    
		<!--layer slider ends-->
		<div id="content">
        <div id="breadcrumb"><!-- breadcrumb starts-->
				<div class="container">
					<div class="one-half">
					<!--	<h4>Theme : Feedback is your Friend</h4> -->
					<h4>Video :&nbsp;<?php echo $row['prod_name'];?></h4>
					</div>
					<div class="one-half">
						<nav id="breadcrumbs"><!--breadcrumb nav starts-->
						<ul>
							<li>You are here:</li>
							<li><a href="index.php">Home</a></li>
						    <li><?php echo $cat_name;?></li>
						
						</ul>
						</nav><!--breadcrumb nav ends -->
					</div>
				</div>
			</div>
            <!--breadcrumbs ends --><!--home intro ends-->
		  <div class="container">
	      <div class="one">
	       <div class="vcomments" >
            <div class="vcomments-block">			
			 
			<?php				
				//$comment_query = mysql_query("SELECT * FROM sas_comment WHERE vid ='$pid' order by id desc ");
				
				if(isset($_REQUEST['vid'])){
				  $comment_query = mysql_query("SELECT * FROM sas_comment WHERE vid ='".$_REQUEST['vid']."' order by id desc ");
				}
				if(isset($_REQUEST['cvid'])){
				  $comment_query = mysql_query("SELECT * FROM sas_comment WHERE cvid ='".$_REQUEST['cvid']."' order by id desc ");
				}
			?>
             <div class="comment-content">	
			   <div style="width:100%;float:left;">
			    
				<h4>Comments</h4>
				
			    </div>
				<div class="comment-block" id="comment-blockk">
				<?php 
				  while($comment = mysql_fetch_array($comment_query)){
                  $cmtid=$comment['id'];
                  $likecount=$comment['like_count'];				  
				  extract($comment);
				  
				  if(isset($anmuser) && $anmuser==1 ){
				 				
				?>
					<div class="comment-item">
						<div class="comment-avatar">							
						 <img src="user_photos/account.png" alt="avatar">							
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
												
						    if(isset($_REQUEST['vid'])){
							  //echo $uid.'--'.$_REQUEST['vid'].'--'.$cat_id;
							  $q=mysql_query("SELECT like_id FROM comment_like WHERE cmtid_fk='$cmtid' and  uid_fk='$uid' and vid_fk='".$_REQUEST['vid']."' ");
							}
							if(isset($_REQUEST['cvid'])){
							   //echo $uid.'--'.$_REQUEST['cvid'].'--'.$cat_id;
							   $q=mysql_query("SELECT like_id FROM comment_like WHERE cmtid_fk='$cmtid' and uid_fk='$uid' and cpvid_fk='".$_REQUEST['cvid']."' ");
							}
							//echo mysql_num_rows($q);
							
							if(mysql_num_rows($q)==0)
							{ 
							 
							?>
							<a href="javascript:void(0);" class="like" id="like<?php echo $cmtid;?>" title="Like" rel="Like"  style='color: #005292;'><img id="likeimg<?php echo $cmtid;?>" src="images/like.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('like','<?php echo $cmtid;?>','<?php if(isset($_REQUEST['vid'])){echo $_REQUEST['vid']; } else{ echo $_REQUEST['cvid']; }?>','<?php if(isset($_REQUEST['vid'])){echo 'vid'; } else{ echo 'cvid'; }?>'); return false;"></a>
							<!-- <a href="#" class="like" id="like<?php echo $cmtid;?>" title="Like" rel="Like"  style='color: #005292;'> Like</a> --><?php if($likecount>=0){  echo " (<span id='likescnt".$cmtid."'>".$likecount."</span>)";} ?>
							
							<?php }
							else{
							 //echo "already liked";
							?>							
							<a href="javascript:void(0);" class="like" id="ulike<?php echo $cmtid;?>" title="Unlike" rel="Unlike"  style='color: #005292;'><img id="likeimg<?php echo $cmtid;?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $cmtid;?>','<?php if(isset($_REQUEST['vid'])){echo $_REQUEST['vid']; }else{ echo $_REQUEST['cvid']; }?>','<?php if(isset($_REQUEST['vid'])){echo 'vid'; } else{ echo 'cvid'; }?>'); return false;"></a>
							<!--<a href="#" class="like" id="ulike<?php echo $cmtid;?>" title="Unlike" rel="Unlike"  style='color: #005292;'> Unlike</a> --> <?php if($like_count>=0){  echo " (<span id='likescnt".$cmtid."'>".$likecount."</span>)";} ?>
							 
							<?php } 
							}
							else{?>	
							  
							<img id="likeimg<?php echo $cmtid;?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $cmtid;?>'); return false;">
							<a href="javascript:void(0);" class="like" id="ulike<?php echo $cmtid;?>" title="Unlike" rel="Unlike"  style='color: #005292;'> Like</a> <?php if($likecount>=0){  echo " (<span id='likescnt".$cmtid."'>".$likecount."</span>)";} ?>
							  <?php
							  }
							 ?>
							&nbsp;&nbsp;&nbsp;
							<?php echo $date;?>							
							</div>
						  </div></br>
                          <div style="width:100%">
                          <p class="p-comment" id="p-comment<?php echo $id;?>"><?php echo stripslashes($comment);?></p>	
						  <div class="edit-comment-div" id="edit-comment-div<?php echo $id;?>">
						  <form class="edit-form" method="post" action="" >
						    <input type="hidden" class="cmtid" name="cid" value="<?php echo $id;?>">
						    <textarea name="txt-comment" id="edit-comment" class="t-comment" ><?php echo stripslashes($comment);?></textarea>
						    <input type="submit" class="edit-submit" name="edit-submit" value="Submit">
						  </form>
						  </div>
						  </div>
						  
						</div>
					</div>
				<?php 
				  }else {
				  
				  $sql="select * from sas_users where user_id='$uid'";
				  $rslt=mysql_query($sql);
				  $rsrslt=mysql_fetch_array($rslt);
				   extract($rsrslt);
				
				?>
					<div class="comment-item">
						<div class="comment-avatar">
							<?php 
							  if(!empty($photopath)){
							?>
								<img src="user_photos/<?php echo $photopath; ?>" alt="avatar">
							<?php }
							else{?>
								<img src="user_photos/account.png" alt="avatar">
							<?php }?>	
						</div>
						<div class="comment-post">
						  <div class="comment-post-div">
						    <div class="comment-post-left" >
							  <h6><?php echo $username;?> <span style="color:#000;">said....</span></h6>
							</div>  
							<div class="comment-post-right" style="font-size:10px;">	
							<?php
					
						   if(!empty($_SESSION['uid'])){
							
							$uid=$_SESSION['uid'];							
												
						    if(isset($_REQUEST['vid'])){
							  //echo $uid.'--'.$_REQUEST['vid'].'--'.$cat_id;
							  $q=mysql_query("SELECT like_id FROM comment_like WHERE cmtid_fk='$cmtid' and  uid_fk='$uid' and vid_fk='".$_REQUEST['vid']."' ");
							}
							if(isset($_REQUEST['cvid'])){
							   //echo $uid.'--'.$_REQUEST['cvid'].'--'.$cat_id;
							   $q=mysql_query("SELECT like_id FROM comment_like WHERE cmtid_fk='$cmtid' and uid_fk='$uid' and cpvid_fk='".$_REQUEST['cvid']."' ");
							}
							
							if(mysql_num_rows($q)==0)
							{ 
							 
							?>
							<a href="javascript:void(0);" class="like" id="like<?php echo $cmtid;?>" title="Like" rel="Like"  style='color: #005292;'><img id="likeimg<?php echo $cmtid;?>" src="images/like.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('like','<?php echo $cmtid;?>','<?php if(isset($_REQUEST['vid'])){echo $_REQUEST['vid']; } else{ echo $_REQUEST['cvid']; }?>','<?php if(isset($_REQUEST['vid'])){echo 'vid'; } else{ echo 'cvid'; }?>'); return false;"></a>
							
							<?php }
							else
							{							 
							?>
							
							<a href="javascript:void(0);" class="like" id="ulike<?php echo $cmtid;?>" title="Unlike" rel="Unlike"  style='color: #005292;'><img id="likeimg<?php echo $cmtid;?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $cmtid;?>','<?php if(isset($_REQUEST['vid'])){echo $_REQUEST['vid']; }else{ echo $_REQUEST['cvid']; }?>','<?php if(isset($_REQUEST['vid'])){echo 'vid'; } else{ echo 'cvid'; }?>'); return false;"></a>
							 
							<?php } 
							}
							else{?>	
							  
							<img id="likeimg<?php echo $cmtid;?>" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;" onclick="funlike('ulike','<?php echo $cmtid;?>'); return false;">
							<a href="javascript:void(0);" class="like" id="ulike<?php echo $cmtid;?>" title="Unlike" rel="Unlike"  style='color: #005292;'> Like</a> <?php if($likecount>=0){  echo " (<span id='likescnt".$cmtid."'>".$likecount."</span>)";} ?>
							  <?php
							  }
							 ?>&nbsp;
							<?php 
                             if(isset($_SESSION['uid']) && $_SESSION['uid'] == $user_id){    
                            					 
							?>
							<a class="comment-edit" href="javascript:void(0);"  data-id="<?php echo $id;?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="javascript:del_commnet(<?php echo $id; ?> )">Delete</a>
							<?php }
                             ?>
							&nbsp;&nbsp;&nbsp;<?php echo $date;?> 
							</div>
						  </div></br>
                          <div style="width:100%">
                          <p class="p-comment" id="p-comment<?php echo $id;?>"><?php echo stripslashes($comment);?></p>	
						  <div class="edit-comment-div" id="edit-comment-div<?php echo $id;?>">
						  <form class="edit-form" method="post" action="" >
						    <input type="hidden" class="cmtid" name="cid" value="<?php echo $id;?>">
						    <textarea name="txt-comment" id="edit-comment" class="t-comment" ><?php echo stripslashes($comment);?></textarea>
						    <input type="submit" class="edit-submit" name="edit-submit" value="Submit">
						  </form>
						  </div>
						  </div>
						  
						</div>
					</div>
				<?php
				  } 
				 }
				?>
				</div>
                 <div class="horizontal-line"></div>	
				 <form name="commentform" id="form1" method="post" onsubmit=" return div_show()">
				 
				   <h4>Submit New Comment <span id="spn" style="padding-left: 25px;color:red"> </span></h4>
				
				    <!--comment form -->
				
					<!-- need to supply post id with hidden fild -->
					<?php 
					 if(isset($_REQUEST['vid'])){ 
					?>
                      <input type="hidden" name="vid" value="<?php echo $vid;?>">
                    <?php					
					 }
					?>
					<?php 
					 if(isset($_REQUEST['cvid'])){ 
					?>
                      <input type="hidden" name="cvid" value="<?php echo $cvid;?>">
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
				<div id="abc">
				 <div id="popupContact" style="font-size: 12px;"> 
				   <script>
					 $(document).ready(function(){

						$("#login").click(function( e ) {
							
							//alert('hi');							
							e.preventDefault();
							
							uname=$(this).siblings("#username").val();
							pwd=$(this).siblings("#password").val();
							
							
							if(uname && pwd){
							
							    $.post("verify_user.php?uname="+uname+"&pwd="+pwd,{},function(data){
									//alert(data)
									if(data=="correct"){							  
									
									  document.getElementById('abc').style.display="none";
									  location.reload();
									}
									else{
									  document.getElementById('error').innerHTML="Enter correct login details";
									}							
							    });
								
							}else {

                               document.getElementById('error').innerHTML="Please enter login details";
                            }
							 
					     });
						 
	                  });
					
					</script>
					<!-- contact us form -->
						<form id="popupform" action="#" method="post" id="form" >
						
							<h6 style="text-align:center;padding-top: 8px;font-size: 14px;line-height: 7px;color:#005292;">Please login to comment on this video!</h6><hr/>
							<span id="error" style="color: red;font-weight: normal;font-size: 14px;"></span>
							<input type="text" name="username" id="username" placeholder="User Name" style="margin:0 auto;" />
							<br>
							<input type="password" name="password" id="password" placeholder="Password" style="margin:0 auto;" />
							<br>				
							<input type="submit" id="login" onclick="check_empty()" value="Login" style="width: 37%;font-size: 14px;">	
                            &nbsp;&nbsp;&nbsp;<input type="button" id="cancel"  value="Cancel" style="width: 37%;font-size: 14px;">							
						</form>
				 </div>
               </div> 				 
               
			   <div id="abc3">
				 <div id="popupContact3" style="font-size: 12px;"> 
				   <script>
					 $(document).ready(function(){

						$("#login3").click(function( e ) {
							
							//alert('hi');							
							e.preventDefault();
							
							uname=$(this).siblings("#username").val();
							pwd=$(this).siblings("#password").val();
							
							
							if(uname && pwd){
							
									$.post("verify_user.php?uname="+uname+"&pwd="+pwd,{},function(data){
										//alert(data)
										if(data=="correct"){							  
										
										  document.getElementById('abc3').style.display="none";
										  location.reload();
										  
										}else {
										
										  document.getElementById('error3').innerHTML="Enter correct login details";
										}								
									}); 
									
							}else {

                                 document.getElementById('error3').innerHTML="Please enter login details";
                            }
							 
					     });
						 
	                  });
					
					</script>
					<!-- contact us form -->
						<form id="popupform" action="#" method="post" id="form" >
						
							<h6 style="text-align:center;padding-top: 8px;font-size: 14px;line-height: 7px;color:#005292;">Please login to like this video!</h6><hr/>
							<span id="error3" style="color: red;font-weight: normal;font-size: 14px;"></span>
							<input type="text" name="username" id="username" placeholder="User Name" style="margin:0 auto;" />
							<br>	
							<input type="password" name="password" id="password" placeholder="Password" style="margin:0 auto;" />
							<br>				
							<input type="submit" id="login3" onclick="check_empty()" value="Login" style="width: 37%;font-size: 14px;">	
                            &nbsp;&nbsp;&nbsp;<input type="button" id="cancel3"  value="Cancel" style="width: 37%;font-size: 14px;">							
						</form>
				 </div>
               </div>
				
				</div>
			</div>	   
			</div>		
		<div class="horizontal-line"></div>	
		</div>
		<br>
	  </div>
      
		<section id="copyrights">
		<section class="container">
		<?php include('footer.php');?>
		</section>
		</section>
	</div>
	<!-- main wrapp starts-->
</div>
<!-- main container ends-->
</body>
</html>