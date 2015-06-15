<?php
 include('config/config.inc.php');
 session_start();

 if(isset($_SESSION['uname'])){   
    header('location:edit-profile.php');
 }
 else{
    	
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>Self-Aware Stories : Login</title>
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
<script type="text/javascript" src="js/1.10.2jquery.js"></script>
<script type="text/javascript" src="jss/validate_user.js"></script>

 <script>
   $(document).ready(function(){
       
	    $('form#frm2').submit(function(event) {
			
			var val=$("#errorstatus").val()
			 //alert(val)
			if(val==''){
			
				event.preventDefault(); // Prevent the form from submitting via the browser.				
					
				var form = $(this);
					
				$.ajax({
					type: 'post',
					url: 'validateUser.php',
					data: form.serialize()
				}).done(function(response) {
					
					status=response.trim()
					
					if(status==''){
					   
					   window.location.href="index.php";
					}
					else {
					   $("#error").html("Invalid login details")
					}
					
										
				}).fail(function() {
						   // Optionally alert the user of an error here...
				});						
				
			 }
		  
	    });
		
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
					 <form action="javascript:void(0);" method="get">
						<button class="search-btn"></button>
					 	<input class="search-field" type="text" onblur="if(this.value=='')this.value='Search';" onfocus="if(this.value=='Search')this.value='';" value="Search"/>
					 </form>
				   
				    <div id="socialiconsvid" class="social-block"> 
				    <ul class="social-links">
					    <li><a href='login.php' class='tooltip' title='Login'><img src='images/account.png'></a></li>
						<li><a href="javascript:;" class="tooltip" title="Shopping Cart"><img src="images/shopping.png"></a></li>
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
					<li><a href="http://blog.selfawarestories.in/" target="_blank">Blog</a></li>
					<!--<li><a href="tour.php">Tour</a></li> -->
					<li><a href="testimonials.php">Testimonials</a></li>
					<li><a href="plans&pricing.php">Plans & Pricing</a></li>
					<li><a href="contactus.php">Contact Us</a></li>
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
				<section class="two-thirdlogin" style="background: #FFF;">
				  <h4 class="widget-title" style=" background: #FFF;">Login</h4>
				  <span id="error" style="color:red"></span>
				  <form name="frm2" id="frm2" action="" onsubmit="return formValidate()" class="simple-form" method="post" autocomplete="off">
					<input type="hidden" id="errorstatus" value="">
					<div id="error-field">
					</div>
					<fieldset>
						<i class="icon-user tooltip left" title="User Name"></i>
						<input id="username" placeholder="User Name"  type="text"  class="text requiredField" name="username" />
					    
					</fieldset>
					<fieldset>
						<i class="icon-key tooltip left" title="Your Password"></i>
						<input id="password" type="password" placeholder="Your Password"  class="password requiredField" name="password" />
					    
					</fieldset>
                    <div class="forgotlink">
					<a href="forgot-password.php">Forgot Password?</a> /<a href="signup.php"> SignUp Here </a>
					</div>
					<div class="one-fourthlogin">
						<input type="submit" name="sub" value="Sign In" class="button big grey round"/>
                    </div>
					<div class="one-fourthlogin">
                      <input type="reset" name="clear" value="Clear" class="button big grey round" onclick="clear_fields()"/>
					</div>
				                    
				</form>
				</section>
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
<?php } ?>