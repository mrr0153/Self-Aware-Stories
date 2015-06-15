<?php
session_start();
require_once("config/config.inc.php");
require_once("generatexml.php");
require_once("getthemecategories.php");
error_reporting(0);

?>
<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>Self-Aware Stories : Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="images/favicon.gif"/>
<link rel="stylesheet" href="css/style.css" media="screen"/><!-- MAIN STYLE CSS FILE -->
<link rel="stylesheet" href="css/responsive.css" media="screen"/><!-- RESPONSIVE CSS FILE -->
<link rel="stylesheet" id="style-color" href="css/colors/blue-color.css" media="screen"/><!-- DEFAULT BLUE COLOR CSS FILE -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,500' rel='stylesheet' type='text/css'><!-- ROBOTO FONT FROM GOOGLE CSS FILE -->
<link rel="stylesheet" href="css/prettyPhoto.css" media="screen"/><!--PRETTYPHOTO CSS FILE -->
<link rel="stylesheet" href="css/font-awesome/font-awesome.min.css" media="screen"/><!-- FONT AWESOME ICONS CSS FILE -->
		
<!-- <link rel="stylesheet" href="css/layer-slider.css" media="screen"/> --> <!-- LAYER SLIDER CSS FILE -->
<!-- <link rel="stylesheet" href="css/flexslider.css" media="screen"/> -->  <!-- FLEX SLIDER CSS FILE -->
<!-- <link rel="stylesheet" href="css/revolution-slider.css" media="screen"/> --> <!-- REVOLUTION SLIDER CSS FILE -->

<!-- All JavaScript Files (FOR FASTER LOADING OF YOUR SITE, REMOVE ALL JS PLUGINS YOU WILL NOT USE)-->
 <script type="text/javascript" src="js/jquery.min.js"> </script><!-- JQUERY JS FILE -->
<!-- <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"> </script> --> <!-- JQUERY UI JS FILE -->
<!-- <script type="text/javascript" src="js/flex-slider.min.js"></script> --><!-- FLEX SLIDER JS FILE -->
<script type="text/javascript" src="js/navigation.min.js"></script><!-- MAIN NAVIGATION JS FILE -->
<!--  <script type="text/javascript" src="js/map.min.js"></script> --> <!-- GOOGLE MAP JS FILE -->
<!--  <script type="text/javascript" src="js/carousel.js"></script> --><!-- CAROUSEL SLIDER JS -->
<script type="text/javascript" src="js/jquery.theme.plugins.min.js"></script><!-- REVOLUTION SLIDER PLUGINS JS FILE -->
<script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script><!-- REVOLUTION SLIDER JS FILE -->
<script type="text/javascript" src="js/flickr.js"></script><!-- FLICKR WIDGET JS FILE -->
<!-- <script type="text/javascript" src="js/instagram.js"></script> --> <!-- INSTAGRAM WIDGET JS FILE -->
<!--  <script type="text/javascript" src="js/jquery.twitter.js"></script> --> <!--TWITTER WIDGET JS FILE -->
<!-- <script type="text/javascript" src="js/prettyPhoto.min.js"></script> --> <!-- PRETTYPHOTO JS FILE -->
<script type="text/javascript" src="js/jquery.tooltips.min.js"></script><!-- TOOLTIPS JS FILE -->
<script type="text/javascript" src="js/isotope.min.js"></script><!--ISOTOPE JS FILE -->
<script type="text/javascript" src="js/scrolltopcontrol.js"></script><!-- SCROLL TO TOP JS PLUGIN -->
<!-- <script type="text/javascript" src="js/jquery.easy-pie-chart.js"></script> --> <!-- EASY PIE JS FILE -->
<script type="text/javascript" src="js/jquery.transit.min.js"></script><!-- TRANSITION JS FILE -->
<script type="text/javascript" src="js/custom.js"></script>  <!-- CUSTOM JAVASCRIPT JS FILE -->
<script type="text/javascript" src="js/1.10.2jquery.js"> </script> 

<!----- Popup start --->
<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
<link rel="stylesheet" href="js/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
-->
<!----- Popup end --->
			
<script>
$(document).ready(function(){
     
	 function loading_show(){
		$('#loading').html("<img src='images/loading.gif'/>").fadeIn('fast');
	 }
	 function loading_hide(){
		$('#loading').fadeOut('fast');
	 } 
	 
	 loading_show();
	
	 $.post("gethomecategories.php?start=0&limit=",{},function(data){ 
	     
		 loading_hide();         		 
         $("#navig").html(data).hide().fadeIn(500);	
     });
	    
     $('.open-tour').click(function(){  
   
         window.open("tour.php", "", "width=900px, height=650");
     });
   
 });
 
</script>
		
<script>			
 function morefun(id,limit){
 
   $.post("gethomecategories.php?start="+id+"&limit=more",{},function(data){ 
	 
	  $("#navig").html(data);
   });
 
 }
 
 function lessfun(id,limit){
 
   $.post("gethomecategories.php?start="+id+"&limit=less",{},function(data){ 
	
	  $("#navig").html(data);
   });
 
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
				    	
					 <form action="javascript:void(0);" method="get">
						<button class="search-btn"></button>
					 	<input class="search-field" type="text" onblur="if(this.value=='')this.value='Search';" onfocus="if(this.value=='Search')this.value='';" value="Search"/>
					 </form>
                     <div id="socialiconsvid">					 
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
					<li id="current"><a href="index.php" >Home</a></li>
					<li><a href="aboutus.php">About Us</a></li>
				<!--<li><a href="#"> Start Here </a></li> -->
					<li><a href="http://blog.selfawarestories.in/" target="_blank">Blog</a></li>
				<!-- <li><a href="tour.php">Tour</a></li> -->
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
		
		  <div id="navig" class="navig">
		     <div id="loading"></div>	   
		  </div>
		  
		  <section class="one-half1">						
			 <iframe src="//player.vimeo.com/video/103498461" width="100%" height="320" frameborder="0" ></iframe>			 		
		  </section>
					
		</div>           
		
		<div id="content">
		  
            <div id="breadcrumb1"><!-- breadcrumb starts-->
				<div class="container">
					<div class="one-half">
						<h4>Welcome to Self-Aware Stories</h4>
					</div>
					<div class="one-half">
						<nav id="breadcrumbs"><!--breadcrumb nav starts-->
						<ul>
							<li>You are here:</li>
							<li><a href="index.php">Home</a></li>
							
						</ul>
						</nav><!--breadcrumb nav ends -->
					</div>
				</div>
			</div>
            <div class="container">
            
            
			<div class="one">
			<div class="one_content">
            <p>At Self-Aware Stories we believe that awareness of our behavior and its consequences is a skill that can be easily learned, with very high payback.</p>
            <p>Through our stories you will be immersed in situations where you can practice applying tools and coping mechanisms in specific scenarios to get your desired consequences.</p>
            <p>Our Self-Aware Stories are fun and interesting. Take our tour to familiarize yourself with how Self-Aware Stories works. </p>
			   <!--
			   <p>
				  <section class="one-halfindex">	
					<ul>				
					  <li>Gets angry when they are given feedback.</li>
					  <li>Has unhappy and unsatisfying relationships that are difficult to cope with.</li>
					  <li>Is good at work but feels his/ her efforts aren’t being recognized.</li>
					  <li>Is interested in learning a framework that will enable them to successfully deal with any situation.</li>
					</ul>    
				  </section>
				</p>
				-->
			 <br>
			 <p><h4 style="text-align:left;"><a class="open-tour" href="javascript:void(0);" ><img src="images/tour.png"></a> </h4> </p>
            </div>
			
		</div>
        <div class="horizontal-line"></div>
	  </div>
		</div>
		<section id="copyrights">
		<section class="container">
		<?php include('footer.php');?>
		</section>
		</section>
	</div>
	
	
	<!-- main wrapp starts-->
	<!--
	 <script src="js-bookblock/jquerypp.custom.js"></script>
     <script src="js-bookblock/jquery.bookblock.js"></script>		
	 <script>
		Page.init();
	 </script>
	-->	  

</div>
<!-- main container ends-->
</body>
</html>