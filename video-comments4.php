<?php
session_start();
require_once("config/config.inc.php");

$pid=$_REQUEST['id'];

?>
<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>Self Aware Stories</title>
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

<!----- Popup start --->
<link rel="stylesheet" href="js/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery.fancybox.js"></script> 

<!----- Popup end --->
<!---- comment script start --->
<link rel="stylesheet"  href="css/elements.css" />
<script src="js/my_js.js"></script>	
	
<script src="js/comment_script.js"></script>
<!---- comment script end --->
<script> 
$(document).ready(function(){

    $(".edit-comment-div").css("display","none");
		
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
 $.post("del_comment.php?id="+id,{},function(){ location.reload(); });
}


</script>

</head>
<body>
<div id="container">
	<!-- main container starts-->
	<div id="wrapp">
		<!-- main wrapp starts-->
		<header id="header">
		<!--header starts -->
	
		<div class="container">
			<div class="head-wrapp">
				<a href="index.php" id="logo"><img src="images/logo.png" alt="" width="110" height="120"/></a>
				<!--your logo-->
				<nav class="top-search">
				<!-- search starts-->
				<form action="404-error.html" method="get">
					<button class="search-btn"></button>
					<input class="search-field" type="text" onblur="if(this.value=='')this.value='Search';" onfocus="if(this.value=='Search')this.value='';" value="Search"/>
				</form>
                <div id="socialiconsvid">
            <ul class="social-links">
						<!-- header social links starts-->
						<li><?php if(isset($_SESSION['uname'])){ echo '<a href="edit-profile.php" class="tooltip" title="'.$_SESSION['uname'].'"><img src="images/account.png"></a>';}else{ echo '<a href="login.php" class="tooltip" title=""><img src="images/account.png"></a>';}?></li>
						<li><a href="#" class="tooltip" title="Shopping Cart"><img src="images/shopping.png"></a></li>
						
					</ul>
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
					<li><a href="blog/">Blog</a></li>
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
					<h4><a href="#"><?php if(isset($_SESSION['uname'])) echo "My Journal";?></a></h4>
				</div>
			</div>
		</div>
		<!--main navigation wrapper ends -->
		</header>
		<!-- header ends-->
        <div class="container">
        <?php
				
				$query = mysql_query('SELECT * FROM sas_videos WHERE id ='.$pid);
				$row = mysql_fetch_array($query);
				
			?>
			<?php
			    $qry="select * from sas_videos where id='$pid' ";
				$rslt=mysql_query($qry); 
				$rlt=mysql_fetch_array($rslt);
				
				extract($rlt);
			   				
				$qry2="select * from sas_themecategories where cat_id='$cat_id' ";
				$rslt2=mysql_query($qry2); 
				$rlt2=mysql_fetch_array($rslt2);
				
				extract($rlt2);
			   
			?>
        <section class="one-half12">
			
           <img src="<?php echo $row['prod_image'];?>" width="725" height="320"></img>
		  	
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
	        <div style="height:auto;margin: 0 auto;width: 940px;position: relative;">
            <div class="wrap">			
			 
			<?php
				// retrive comments with post id
				$comment_query = mysql_query("SELECT * FROM sas_comment WHERE vid ='$pid' order by id desc ");
				
			?>
             <div class="comment-content">	
				<h4>Comments</h4>
				<div class="comment-block">
				<?php 
				  while($comment = mysql_fetch_array($comment_query)){ 
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
							<?php echo $date;?> 
							
							</div>
						  </div></br>
                          <div style="width:100%">
                          <p class="p-comment" id="p-comment<?php echo $id;?>"><?php echo $comment;?></p>	
						  <div class="edit-comment-div" id="edit-comment-div<?php echo $id;?>">
						  <form class="edit-form" method="post" action="" >
						    <input type="hidden" class="cmtid" name="cid" value="<?php echo $id;?>">
						    <textarea name="txt-comment" id="edit-comment" class="t-comment" ><?php echo $comment;?></textarea>
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
                             if(isset($_SESSION['uid']) && $_SESSION['uid'] == $user_id){    
                            					 
							?>
							<a class="comment-edit" href="#" data-id="<?php echo $id;?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="javascript:del_commnet(<?php echo $id; ?> )">Delete</a>
							<?php }
                             ?>
							&nbsp;&nbsp;&nbsp;<?php echo $date;?> 
							</div>
						  </div></br>
                          <div style="width:100%">
                          <p class="p-comment" id="p-comment<?php echo $id;?>"><?php echo $comment;?></p>	
						  <div class="edit-comment-div" id="edit-comment-div<?php echo $id;?>">
						  <form class="edit-form" method="post" action="" >
						    <input type="hidden" class="cmtid" name="cid" value="<?php echo $id;?>">
						    <textarea name="txt-comment" id="edit-comment" class="t-comment" ><?php echo $comment;?></textarea>
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
				 <form id="form1" method="post">
				 <input type="checkbox" id="anmuser" name="anmuser" value="Anonymous"> Comment as Anonymous User
				 
				<h4>Submit New Comment <span id="spn" style="padding-left: 25px;color:red"> </span></h4>
				
				<!--comment form -->
				
					<!-- need to supply post id with hidden fild -->
					<input type="hidden" name="pid" value="<?php echo $pid;?>">
					
					<label>
						<span>Your Comment </span><span style="color:red;">*</span>
						<textarea name="comment" id="comment" cols="30" rows="10" placeholder="Type your comment here...." required></textarea>
					</label>
					<div style="padding: 5px 25px;text-align: center;">
					<input type="submit" id="submit" value="Submit Comment">
					</div>		  
				</form>
				
				 <div id="popupContact"> 

					<!-- contact us form -->
						<form action="#" method="post" id="form" >
							<img src="images/3.png" id="close"/>
							<h2>Contact Us</h2><hr/>
							<input type="text" name="name" id="name" placeholder="Name"/>
							
							<input type="text" name="email" id="email" placeholder="Email"/>
							
							<textarea name="message" placeholder="Message" id="msg"></textarea>
							
							<input type="submit" id="submit" value="Submit Comment">
							
						</form>
				 </div> 
         <!--
				<div id="login-popup" style="display: none;">
				 <div  style="height: 250px;width: 300px;">
				 <br>
				 <p style="padding-left: 17px;color:red;font-size: 14px;"> Please login to comment on this video!  </p>
				 	<div  style="width: 200px;margin:0 auto;">               
					<script>
					 $(document).ready(function(){

						$(".login").click(function( e ) {
							
							//alert('hi');							
							e.preventDefault();
							uname=$(this).siblings("#username").val();
							pwd=$(this).siblings("#password").val();
							$.post("verify_user.php?uname="+uname+"&pwd="+pwd,{},function(data){
							 //alert(data)
							  if(data=="correct"){
							  
							    $(".fancybox-wrap fancybox-desktop fancybox-type-html fancybox-opened").css("display","none");
								//document.getElementById('login-popup').style.display="none";
								
							  }
							  else{
							    document.getElementById('error').innerHTML="Enter correct details";
							  }
							});
					     });
						 
	                  });
					
					</script>
					<form id="form3" name="login-form" method="post" action="" >	
						<span id="error" style="color:red;"></span>
						<label for="name">User Name</label>
						<input id="username" name="username" type="text" placeholder="User Name" required="">
								
						<label for="password">Password</label>
						<input id="password" name="password" type="password" placeholder="Password" required="">
						<br>		
						<input type="submit" name="submit" onclick ="div_show()" class="login" value="Login" style="width: 37%;font-size: 14px;">
					</form>
					
					</div>					
					</div>
				</div>
				-->
				
				</div>
			</div>	   
			</div>		
		
		</div>
		<br>
	  </div>
      
      <div class="home-intro"><!-- home intro starts -->
				<div class="container">
					<div class="one-half">
						<h4>Buy this Theme</h4>
						
					</div>
					<div class="one-half2">
                        <a href="#" class="button grey huge round">Feedback</a>
                        </div>
                        <div class="one-half2">
						<a href="#" class="button grey huge round">Buy Now</a>

					</div>
				</div>
			</div>
		
		<section id="copyrights">
		<section class="container">
		<div class="one-half">
			<p>
				 All rights Reserved.
			</p>
		</div>
		<div class="one-half">
			<ul class="copyright_links">
				<li><a href="index.php" title="Home">Home</a></li>
				<li><a href="aboutus.php" title="About Us">About us</a></li>
				<li><a href="blog/" title="Blog">Blog</a></li>
				<li><a href="contactus.php" title="Contact Us">Contact Us</a></li>
			</ul>
		</div>
		</section>
		</section>
	</div>
	<!-- main wrapp starts-->
</div>
<!-- main container ends-->
</body>
</html>