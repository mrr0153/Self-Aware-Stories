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
<title>Self-Aware Stories : About Us</title>
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

<script>
 $(document).ready(function(){
      /*
      $("#notes").click(function(){
	  
	  $.post('updatenotices.php?uid=<?php echo $_SESSION['uid']?>',{},function(data){ 
	  //alert(data)	 
	  window.location('myreadings.php');
	  });
	  }); 
	*/ 	
	  
	});	 
 
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
					<li><a href="index.php" >Home</a></li>
					<li  id="current"><a href="aboutus.php">About Us</a></li>
				<!--<li><a href="#"> Start Here </a></li> -->
					<li><a href="http://blog.selfawarestories.in/" target="_blank">Blog</a></li>
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
		  
            <div id="breadcrumb1"><!-- breadcrumb starts-->
				<div class="container">
					<div class="one-half">
						<h4>About Us</h4>
					</div>
					<div class="one-half">
						<nav id="breadcrumbs"><!--breadcrumb nav starts-->
						<ul>
							<li>You are here:</li>
							<li><a href="aboutus.php">About Us</a></li>
							
						</ul>
						</nav><!--breadcrumb nav ends -->
					</div>
				</div>
			</div>
            <div class="container">
              <div class="one">
                <div class="one-fourth">
                  <div class="team-member">
                    <!-- team member starts -->
                    <div class="avatar"> <img src="images/team/martin2.png" alt=" "/> </div>
                    <span style="font-family: 'Sign',sans-serif;font-size: 31px;line-height: 26px;padding-left: 10px;font-weight: bold;">Martin Radley</span>
                  <!--  <h5>Senior Web Developer</h5> -->
                  <!--  <ul class="social-links alternative"> -->
                      <!-- header social links starts-->
                  <!--    <li><a href="#" class="twitter tooltip" title="Some Title"><i class="icon-twitter"></i></a></li>
                      <li><a href="#" class="facebook tooltip" title="Some Title"><i class="icon-facebook"></i></a></li>
                      <li><a href="#" class="linkedin tooltip" title="Some Title"><i class="icon-linkedin"></i></a></li>
                      <li><a href="#" class="skype tooltip" title="Some Title"><i class="icon-skype"></i></a></li>
                      
                    </ul> -->
                  </div>
                  <!-- team member ends -->
                </div>
                <div class="three-fourth">
                  <p> I taught adult learners in a Software Engineering Master’s Degree program at Carnegie Mellon University for almost 7 years. They had come to learn some new approaches to solve software engineering problems, but most of these people were already very competent technically.   Yet many were struggling to advance.  It was easy for me to see why:  they were not aware of the consequences of their behavior.  They were nice people, but sometimes they would say or do things that were off-putting, rude or sometimes just caused problems.  Over time, these folks get a reputation for not being easy to work with, but of course no one tells them any of this.</p>
                  <p>
                  Soon I realized this was often true for their personal lives as well.  People not understanding the consequences of their behavior, often leading to disastrous consequences
                  </p>
                  <p>
                  Initially I called this “Man Training”, and I discussed the topic with close family, friends and colleagues. They all knew someone who had behaviors that are hurting them, and they agreed that it is difficult to give people feedback on their behavior, so how would someone know if they aren’t exhibiting negative behavior?  To address this I added Giving and Receiving Feedback to my mentor training materials.
                  </p>
                  
                </div>
              </div>
              <div class="one" style="margin-top:20px;">
                <div class="one-fourth" style="float:right">
                  <div class="team-member">
                    <!-- team member starts -->
                    <div class="avatar"> <img src="images/team/meghna2.png" alt=" "/> </div>
                   <span style="font-family: 'Sign',sans-serif;font-size: 31px;line-height: 26px;font-weight: bold;">Meghna Vivaswat </span>
                <!--    <h5>Senior Web Developer</h5> -->
                <!--    <ul class="social-links alternative"> -->
                      <!-- header social links starts-->
                <!--      <li><a href="#" class="twitter tooltip" title="Some Title"><i class="icon-twitter"></i></a></li>
                      <li><a href="#" class="facebook tooltip" title="Some Title"><i class="icon-facebook"></i></a></li>
                      <li><a href="#" class="linkedin tooltip" title="Some Title"><i class="icon-linkedin"></i></a></li>
                      <li><a href="#" class="skype tooltip" title="Some Title"><i class="icon-skype"></i></a></li>
                      
                    </ul> -->
                  </div>
                  <!-- team member ends -->
                </div>
                <div class="three-fourth">
                  <p>In Fall 2010, I discussed the “Man Training” concepts with Meghna Vivaswat, and introduced her to the giving and receiving feedback material. She mentioned that though it’s more obvious in men, there are a lot of women who don’t “get it” either.  After a few discussions we changed the name from “Man Training” to “Self-Aware Stories” to reflect the focus on being aware of the consequences of one’s behavior. Meghna and I started discussing situations, stories, experiences and how poor behaviors can be seen everywhere: both at work and in our personal lives, and we began to talk about how we might go about addressing this problem.</p>
                  <p>
                  We wanted to create an interesting, engaging and affordable way for people to become more aware of their behavior.  To accomplish this we decided to use videos that show people not being aware of the consequences of their behavior, and have “narrators” that help the viewer analyze each video scene.  
                  </p>
                  <p>
                  In addition, we want our subscribers to send us their stories or experiences with poor behavior and it’s consequences that we can share in a video.
                  </p>
                  <p>
                  Finally, we want everyone to know that at Self-Aware Stories you will never be told what the right thing to do is; you will only be asked to reflect on the consequences of your behavior to determine whether your behavior is aligned with your goals.
                  </p>
                  
                </div>
              </div><div class="horizontal-line"></div>
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