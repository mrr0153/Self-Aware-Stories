<?php
session_start();
require_once("config/config.inc.php");
error_reporting(0);
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

<!--- bookblock Starts --->
  <link rel="stylesheet" type="text/css" href="css-bookblock/default.css" />
  <link rel="stylesheet" type="text/css" href="css-bookblock/bookblock.css" />
  <!-- custom demo style -->
  <link rel="stylesheet" type="text/css" href="css-bookblock/demo1.css" />
  <script src="js-bookblock/modernizr.custom.js"></script>
<!--- bookblock Starts --->

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
				   <?php include('header-widget.php');  ?>
                </div>
			  </nav>
				
		  </div>

		</div>
		<div id="main-navigation">
			<!--main navigation wrapper starts --> 
			<div class="container">
				<ul class="main-menu">
					<li><a href="index.php" >Home</a></li>
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
        <div id="navig">
        
        </div>
        </div>  
         
		
		<div id="content">
		  <!--
          <div id="breadcrumb1">
				<div class="container">
					<div class="one-half">
						<h4>About Us</h4>
					</div>
					<div class="one-half">
						<nav id="breadcrumbs">
						<ul>
							<li>You are here:</li>
							<li><a href="aboutus.php">About Us</a></li>
							
						</ul>
						</nav>
					</div>
				</div>
			</div>
			-->
            <div class="container">
              <div class="one">
               
				<div class="bb-custom-wrapper">
					
					<div id="bb-bookblock" class="bb-bookblock">
						<div class="bb-item">
							<a href="javascript:void(0);"><img src="images-bookblock/demo1/t1.png" alt="" style="width:800px;height:500px"/></a>
						</div>
						<div class="bb-item">
							<a href="javascript:void(0);"><img src="images-bookblock/demo1/t2.png" alt="" style="width:800px;height:500px"/></a>
						</div>
						<div class="bb-item">
							<a href="javascript:void(0);"><img src="images-bookblock/demo1/t3.png" alt="" style="width:800px;height:500px"/></a>
						</div>
						<div class="bb-item">
							<a href="javascript:void(0);"><img src="images-bookblock/demo1/t4.png" alt="" style="width:800px;height:500px"/></a>
						</div>
						<div class="bb-item">
							<a href="javascript:void(0);"><img src="images-bookblock/demo1/t5.png" alt="" style="width:800px;height:500px"/></a>
						</div>
						<div class="bb-item">
							<a href="javascript:void(0);"><img src="images-bookblock/demo1/t6.png" alt="" style="width:800px;height:500px"/></a>
						</div>
						<div class="bb-item">
							<a href="javascript:void(0);"><img src="images-bookblock/demo1/t7.png" alt="" style="width:800px;height:500px"/></a>
						</div>
						<div class="bb-item">
							<a href="javascript:void(0);"><img src="images-bookblock/demo1/t8.png" alt="" style="width:800px;height:500px"/></a>
						</div>
						<div class="bb-item">
							<a href="javascript:void(0);"><img src="images-bookblock/demo1/t9.png" alt="" style="width:800px;height:500px"/></a>
						</div>
						<div class="bb-item">
							<a href="javascript:void(0);"><img src="images-bookblock/demo1/t10.png" alt="" style="width:800px;height:500px"/></a>
						</div>
					</div>
					<nav>
						<a id="bb-nav-first" href="#" class="bb-custom-icon bb-custom-icon-first">First page</a>
						<a id="bb-nav-prev" href="#" class="bb-custom-icon bb-custom-icon-arrow-left">Previous</a>
						<a id="bb-nav-next" href="#" class="bb-custom-icon bb-custom-icon-arrow-right">Next</a>
						<a id="bb-nav-last" href="#" class="bb-custom-icon bb-custom-icon-last">Last page</a>
					</nav>
				</div>
		
		</div><!-- /container -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="js-bookblock/jquerypp.custom.js"></script>
		<script src="js-bookblock/jquery.bookblock.js"></script>
		<script>
			var Page = (function() {
				
				var config = {
						$bookBlock : $( '#bb-bookblock' ),
						$navNext : $( '#bb-nav-next' ),
						$navPrev : $( '#bb-nav-prev' ),
						$navFirst : $( '#bb-nav-first' ),
						$navLast : $( '#bb-nav-last' )
					},
					init = function() {
						config.$bookBlock.bookblock( {
							speed : 800,
							shadowSides : 0.8,
							shadowFlip : 0.7
						} );
						initEvents();
					},
					initEvents = function() {
						
						var $slides = config.$bookBlock.children();

						// add navigation events
						config.$navNext.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'next' );
							return false;
						} );

						config.$navPrev.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'prev' );
							return false;
						} );

						config.$navFirst.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'first' );
							return false;
						} );

						config.$navLast.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'last' );
							return false;
						} );
						
						// add swipe events
						$slides.on( {
							'swipeleft' : function( event ) {
								config.$bookBlock.bookblock( 'next' );
								return false;
							},
							'swiperight' : function( event ) {
								config.$bookBlock.bookblock( 'prev' );
								return false;
							}
						} );

						// add keyboard events
						$( document ).keydown( function(e) {
							var keyCode = e.keyCode || e.which,
								arrow = {
									left : 37,
									up : 38,
									right : 39,
									down : 40
								};

							switch (keyCode) {
								case arrow.left:
									config.$bookBlock.bookblock( 'prev' );
									break;
								case arrow.right:
									config.$bookBlock.bookblock( 'next' );
									break;
							}
						} );
					};

					return { init : init };

			})();
		</script>
		<script>
				Page.init();
		</script>
		
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
</div>
<!-- main container ends-->
</body>
</html>