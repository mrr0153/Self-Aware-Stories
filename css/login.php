<?php
include('config/config.inc.php');
?>

<?php
 if(isset($_POST['sub']) && $_POST['sub'] !='')
 { 
   $uname=mysql_real_escape_string($_POST['username']);
   $pwd=mysql_real_escape_string($_POST['password']);
   $result=mysql_query("select username from sas_users where username='$uname' and password='$pwd'");
   $count=mysql_num_rows($result);
   if($count==1)
    {
     session_start();
	 $_SESSION['aut']=true;
	 $_SESSION['uname']=$uname;
     /*header("location:welcome.php");
      echo "<script type='text/javascript'>window.location.href='welcome.php'</script>";*/
    } 
   else 
     /*$msg="Please enter valid login details or signup to login.";
     //header("location:login.php");*/
	 echo "<script type='text/javascript'>window.location.href='login.php'</script>";
   }	  
 
  ?>
<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>SAS</title>
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
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>

<script type="text/javascript" src="jss/form_validate.js"></script>
<script type="text/javascript" src="jss/check_availability.js"></script>

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
				<a href="index.html" id="logo"><img src="images/logo.png" alt="" width="110" height="120"/></a>
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
						<li><a href="#" class="tooltip" title="My Account"><img src="images/account.png"></a></li>
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
					<li><a href="index.html" id="current">Home</a></li>
					<li><a href="#">About Us</a></li>
					<li><a href="#"> Start Here </a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">Testimonials</a></li>
					<li><a href="#">Plans & Pricing</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
				<!-- main navigation ends-->
                <div class="after-nav-info">
					<h4><a href="signup.php">SignUp</a></h4>
				</div>
				<div class="after-nav-info">
					<h4><a href="login.php">Login</a></h4>
				</div>
                
			</div>
		</div>
		<!--main navigation wrapper ends -->
		</header>
		<div id="contentlogin">
		
			
			<div class="container">
				<section class="two-thirdlogin">
				<form name="frm2" action="" class="simple-form" method="post" onsubmit="return formValidate()">
					<div id="error-field">
					</div>
					<fieldset>
						<i class="icon-user tooltip left" title="User Name"></i><input id="username" placeholder="User Name"  type="text"  class="text requiredField" name="username" size="25"/>
					    <span id="sp1"></span>
					</fieldset>
					<fieldset>
						<i class="icon-password tooltip left" title="Your Password"></i><input type="password" placeholder="Your Password"   class="password requiredField" name="password" size="25"/>
					    <span id="sp2"></span>
					</fieldset>
                    <div class="forgotlink">
					<a href="forgot-password.php">&gt;Forgot Password? </a>
					</div>
                    </form>
                    </section>
                    <section class="two-thirdlogin">
                    <form>
					<div class="login">
                      <a href="signup.php"><input type="button" type="SignUp"  value="Sign Up" class="button big grey round"/></a>
					</div>
					<div class="login">
						<input type="submit" name="sub" value="Sign In" class="button big grey round"/>
                    </div>
                    <div class="login">
						<input type="clear" name="sub" value="Clear" class="button big grey round"/>
                    </div>
                    
				</form>
				</section>
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
				<li><a href="#" title="Home">Home</a></li>
				<li><a href="#" title="About">About us</a></li>
				<li><a href="#" title="Blog">Blog</a></li>
				<li><a href="#" title="Contact">Contact</a></li>
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