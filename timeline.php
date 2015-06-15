<?php
session_start();
require_once("config/config.inc.php");
$id=$_REQUEST['id'];
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>Self-Aware Stories : Timeline</title>
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
					<li><a href="index.php" >Home</a></li>
					<li><a href="aboutus.php">About Us</a></li>
				<!--<li><a href="#"> Start Here </a></li> -->
					<li><a href="http://blog.selfawarestories.in/">Blog</a></li>
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
                
			</div>
		</div>
		<!--main navigation wrapper ends -->
		</header>
		<!-- header ends-->
        <div class="container">
        <div id="navig">
        
        </div>
        </div>  
           <!--  
		
		<div id="content">
		  <div class="intro-features">
				<div class="container">
					<h4>Teasers</h4>
					<div class="slidewrap">
						
						<ul class="slider" id="sliderName">
							<li class="slide">
							<div class="one-fourth">
							<div class="item-wrapp">
								<div class="portfolio-item">
									<a href="#"></a>
									<a href="#" data-rel="prettyPhoto"></a>
									<img src="images/portfolio/portfolio-item-1.jpg" alt=""/>
								</div>
								<div class="portfolio-item-title">
									<a href="single-project-small.html">Theme Name </a>
									<p>
										 Details / Description
									</p>
								</div>
							</div>
							</div>

							<div class="one-fourth">
							<div class="item-wrapp">
								<div class="portfolio-item">
									<a href="#" ></a>
									<a href="#" data-rel="prettyPhoto"></a>
									<img src="images/portfolio/portfolio-item-2.jpg" alt=""/>
								</div>
								<div class="portfolio-item-title">
									<a href="single-project-small.html">Theme Name </a>
									<p>
										  Details / Description
									</p>
								</div>
							</div>
							</div>

							<div class="one-fourth">
							<div class="item-wrapp">
								<div class="portfolio-item">
									<a href="#" ></a>
									<a href="#" data-rel="prettyPhoto"></a>
									<img src="images/portfolio/portfolio-item-2.jpg" alt=""/>
								</div>
								<div class="portfolio-item-title">
									<a href="single-project-small.html">Theme Name</a>
									<p>
										 Details / Description
									</p>
								</div>
							</div>
							</div>

							<div class="one-fourth">
							<div class="item-wrapp">
								<div class="portfolio-item">
									<a href="#"></a>
									<a href="#" data-rel="prettyPhoto"></a>
									<img src="images/portfolio/portfolio-item-6.jpg" alt=""/>
								</div>
								<div class="portfolio-item-title">
									<a href="#">Theme Name</a>
									<p>
										 Details / Description
									</p>
								</div>
							</div>
							</div>
							</li>
							<li class="slide">
							<div class="one-fourth">
							<div class="item-wrapp">
								<div class="portfolio-item">
									<a href="#"></a>
									<a href="#" data-rel="prettyPhoto" ></a>
									<img src="images/portfolio/portfolio-item-7.jpg" alt=""/>
								</div>
								<div class="portfolio-item-title">
									<a href="#">Theme Name</a>
									<p>
										 Details / Description
									</p>
								</div>
							</div>
							</div>

							<div class="one-fourth">
							<div class="item-wrapp">
								<div class="portfolio-item">
									<a href="#"></a>
									<a href="#" data-rel="prettyPhoto"></a>
									<img src="images/portfolio/portfolio-item-8.jpg" alt=""/>
								</div>
								<div class="portfolio-item-title">
									<a href="#">Theme Name</a>
									<p>
										 Details / Description
									</p>
								</div>
							</div>
							</div>

							<div class="one-fourth">
							<div class="item-wrapp">
								<div class="portfolio-item">
									<a href="#"></a>
									<a href="#" data-rel="prettyPhoto" ></a>
									<img src="images/portfolio/portfolio-item-9.jpg" alt=""/>
								</div>
								<div class="portfolio-item-title">
									<a href="single-project-small.html">Theme Name</a>
									<p>
										 Details / Description
									</p>
								</div>
							</div>
							</div>

							<div class="one-fourth">
							<div class="item-wrapp">
								<div class="portfolio-item">
									<a href="#"></a>
									<a href="#" data-rel="prettyPhoto"></a>
									<img src="images/portfolio/portfolio-item-10.jpg" alt=""/>
								</div>
								<div class="portfolio-item-title">
									<a href="single-project-small.html">Theme Name</a>
									<p>
										 Details / Description
									</p>
								</div>
							</div>
							</div>
							</li>
						</ul>
						<ul class="slidecontrols">
							<li><a href="#sliderName" class="prev">Prev</a></li>
							<li><a href="#sliderName" class="next">Next</a></li>
							
						</ul>
					</div>
				</div>
			</div><!-- intro features panel ends -->
            <div id="breadcrumb1"><!-- breadcrumb starts-->
				<div class="container">
					<div class="one-half">
						<h4>Timeline</h4>
					</div>
					<div class="one-half">
						<nav id="breadcrumbs"><!--breadcrumb nav starts-->
						<ul>
							<li>You are here:</li>
							<li><a href="timeline.php">Timeline</a></li>
							
						</ul>
						</nav><!--breadcrumb nav ends -->
					</div>
				</div>
			</div>
            <div class="container">
              <div class="one">
			  <?php 
			   if($id==1){ ?>
			  <iframe src='http://cdn.knightlab.com/libs/timeline/latest/embed/index.html?source=0Ai93PWNRhMsqdGtYMWtmY25iRTdBNEJDelBTaDRCWFE&font=Rancho-Gudea&maptype=toner&lang=en&height=650' width='100%' height='650' frameborder='0'></iframe>
              <?php } 
			   else{
			  ?>
			  <iframe src='http://cdn.knightlab.com/libs/timeline/latest/embed/index.html?source=0Ap4-NCP6kyCHdDFnUC13SkpBelJTeFQwc0JUX2pjUHc&font=Rancho-Gudea&maptype=toner&lang=en&start_at_end=true&height=650' width='100%' height='650' frameborder='0'></iframe>
              <?php } 
			   
			  ?>
			  </div>
             
            </div>
            <div class="horizontal-line"></div>
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