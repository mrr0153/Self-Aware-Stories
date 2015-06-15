<?php
session_start();
require_once("config/config.inc.php");

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
						<li><?php if(isset($_SESSION['uname'])){ echo '<a href="welcome.php" class="tooltip" title="'.$_SESSION['uname'].'"><img src="images/account.png"></a>';}else{ echo '<a href="login.php" class="tooltip" title=""><img src="images/account.png"></a>';}?></li>
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
					<li id="current"><a href="index.php" >Home</a></li>
					<li><a href="aboutus.php">About Us</a></li>
				<!--<li><a href="#"> Start Here </a></li> -->
					<li><a href="blog/">Blog</a></li>
					<li><a href="#">Testimonials</a></li>
					<li><a href="#">Plans & Pricing</a></li>
					<li><a href="contactus.php">Contact Us</a></li>
				</ul>
				<!-- main navigation ends-->
                <div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) {echo "<a href='logout.php'>Logout</a>";} else echo "<a href='signup.php'>SignUp</a>";?></h4>
				</div>
				<div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) {echo "<a href='welcome.php'>".$_SESSION['uname']."</a>";} else echo "<a href='login.php'>Login</a>";?></h4>
				</div>
                
			</div>
		</div>
		<!--main navigation wrapper ends -->
		</header>
		<!-- header ends-->
        <div class="container">
        <div id="navig">
        <span>THEMES</span>
       <ul id="navside">
<!--
<li><a href="theme1.php?cid=1">Feedback is your friend</a></span></li>

<li><a href="theme1.php?cid=2">Job Readiness</a></li>

<li><a href="theme1.php?cid=3">New Hire Transition</a></li>

<li><a href="#">Theme4</a> </li>

<li><a href="#">Theme5</a></li>

--->
<?php
            $qry="select * from sas_themecategories  order by cat_id asc limit 0,5 ";
            $rslt=mysql_query($qry) or die(mysql_error()); 
			while($rslt && $rlt=mysql_fetch_array($rslt))
			{
			 //print_r($rlt);
			 extract($rlt);
			  
			?>
<li><a href="theme1.php?cid=<?php echo $cat_id; ?>"><?php echo $cat_name; ?></a></span></li>
<?php }?>
<li><a href="index_2.php">More....</a></li>


</ul>
</div>
<section class="one-half1">
				
            <h2><a href="#"> <img src="images/play.png"></img></a></h2>
				
				</section>
				
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
						<h4>Welcome to Self Aware Stories</h4>
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
            <p>The goal of Self Aware Stories is to help us become aware of  the consequences of our behavior, and the behavior of others, and to provide a  framework for personal and professional growth. </p>
            <p>Our immersive and engaging story telling framework is for  anyone who:</p>
            <p>
           <section class="one-halfindex">
	
	<ul>
		<!-- latest posts widget starts-->
		<li>•&nbsp;&nbsp;	Gets angry when they are given feedback.</li>
		<li>•&nbsp;&nbsp; Has unhappy and unsatisfying relationships that are difficult to cope with.</li>
		<li>•&nbsp;&nbsp;	Is good at work but feels his/ her efforts aren’t being recognized.</li>
		<li>•&nbsp;&nbsp;	Is interested in learning a framework that will enable them to successfully deal with any situation.</li>
	</ul>
    
    </section>
    </p>
 
            <p>At Self Aware Stories we believe that awareness of our  behavior and its consequences is a skill that can be easily learned, with very  high payback.</p>
            <p>For example, we all know people who harm themselves, or  others, with their behavior.  With some  people these behaviors may be small, so we overlook them, but with others the  behavior issues can be big, and really hurt their personal and professional  lives. It&rsquo;s difficult to get closeto people who exhibit these behaviors.  And these behaviors can easily hold us back  at work.  </p>
            <p>So the question is: do you have behaviors that are harming  you? How would you know? </p>
            <p>Through our stories you will be immersed in situations where  you can practice applying tools and coping mechanisms in specific scenarios to  get your desired consequences. </p>
            <p>Our Self Aware Stories are fun and interesting. Watch the  explainer video and see for yourself.<a name="_GoBack"></a></p>
            </div>
            <div class="horizontal-line"></div>
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
				<li><a href="aboutus.php" title="About Us">About Us</a></li>
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