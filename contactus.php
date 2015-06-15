<?php
 session_start();
 error_reporting(0);
 require_once("config/config.inc.php");

 if(isset($_POST['submit']) && $_POST['submit'] !='')
 { 
   
    extract($_POST);   
   
    require 'PHPMailer/PHPMailerAutoload.php';
    
	$subject = 'You\'ve been contacted by ' . $name . '.';
	
    $msg = " <html>
			  <body bgcolor='#DCEEFC'>
			   <p>You have been contacted by <b>$name</b>.\r\n\n</p>
				<table>
				  <tr><td style='font-weight:bold;'>Name</td><td style='width:2px;'>:</td><td>$name</td></tr>
				  <tr><td style='font-weight:bold;'>Email ID</td><td style='width:2px;'>:</td><td>$email</td></tr>				  
				  <tr><td style='font-weight:bold;'>Message</td><td style='width:2px;'>:</td><td>$message</td></tr> 
				</table>
			  </body>
			</html>";
			
	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	$mail->setFrom($email, $name);
	//Set an alternative reply-to address
	$mail->addReplyTo($email, $name);
	//Set who the message is to be sent to
	$mail->addAddress('support@selfawarestories.in', 'Self-Aware Stories');
	//Set the subject line
	$mail->Subject = $subject;
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($msg);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	//$mail->addAttachment('images/phpmailer_mini.png');

	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		$mssg="Thank you for contacting us, we will get back to you soon.";
	}
   	
 }

?>

<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>Self-Aware Stories : Contact Us</title>
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

<script type="text/javascript" src="jss/validate_contact_form.js"></script>

</head>
<body onLoad="MM_preloadImages('images/blghover.png')">
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
					<li><a href="aboutus.php">About Us</a></li>
				<!--<li><a href="#"> Start Here </a></li> -->
					<li><a href="http://blog.selfawarestories.in/" target="_blank">Blog</a></li>
					<!--<li><a href="tour.php">Tour</a></li> -->
					<li><a href="testimonials.php">Testimonials</a></li>
					<li><a href="plans&pricing.php">Plans & Pricing</a></li>
					<li  id="current"><a href="contactus.php">Contact Us</a></li>
				</ul>
				<!-- main navigation ends-->
                <div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) {echo "<a href='logout.php'>Logout</a>";} else echo "<a href='signup.php'>SignUp</a>";?></h4>
				</div>
				<div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) {echo "<a href='welcome.php'>".$_SESSION['uname']."</a>";} else echo "<a href='login.php'>Login</a>";?></h4>
				</div>
                <div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) { echo '<a href="myjournal.php" target="_blank">My Journal</a>';} ?></h4>
				</div>
			</div>
		</div>
		<!--main navigation wrapper ends -->
		</header>
		<div id="content">

			<div class="container"><br><br>
                <h4 class="widget-title">Feedback</h4> 
				<?php if($_REQUEST['mssg']) $mssg=$_REQUEST['mssg']; if(isset($mssg)) echo "<h5 ic='ctcstatus' style='color:green;margin-bottom:10px;'>".$mssg."</h5>"; ?>
				<section class="three-fourth">
				<form name="frm1" action="#"  class="simple-form " method="post" onsubmit="return validateForm()">
					<div id="error-field">
					</div>
					<fieldset>
						<i class="icon-user tooltip left" title="Your Name"></i><input  placeholder="Your Name"   type="text" class="text requiredField" name="name" size="30" />
					    <span id="sp1"></span>
					</fieldset>
					<fieldset>
						<i class="icon-envelope tooltip left" title="Your Email"></i><input type="text" placeholder="Your Email"   class="email requiredField" name="email" size="30"/>
					    <span id="sp2"></span>
					</fieldset>
					<!--
					<fieldset>
						<i class="icon-globe tooltip left" title="Your Website"></i><input type="text" placeholder="Your Website"  class="text" name="url" size="40"/>
					</fieldset>
					-->
					<fieldset>
						<div class="input-title">
							Your Message : <span id="sp3"></span>
						</div>
						<textarea cols="30" rows="12" title="Your Message" class="text requiredField" name="message"></textarea>
					</fieldset>
					<div class="three-fourth">
						<input type="submit" name="submit" value="Send message" class="button big grey round"/>
					</div>
				</form>
				</section>
				<section class="one-fourth sidebar right">
				<div class="widget">
					<h4 class="widget-title">Contact Info</h4>
					<ul class="simple-list">
						<li><a href="javascript:void(0);">#374, Road No. 14, Banjara Hills, </a></li>
						<li><a href="javascript:void(0);">Hyderabad - 500034. </a></li>
						<li><a href="javascript:void(0);">Mobile No. +91 9959097000</a></li>
						<li><a href="mailto:support@selfawarestories.in">support@selfawarestories.in</a></li>
						<!-- <li><a href="#">Find us on Google Maps</a></li> -->
					</ul>
					<div class="pdf"><img src="images/ttr.png">&nbsp;&nbsp;&nbsp;<img src="images/fb.png">&nbsp;&nbsp;&nbsp; <img src="images/rss.png"></div>
					<!--
					<div class="pdf"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image6','','images/fblikhover.png',0)"><img id="Image6" src="images/fblik.png"></a>
					</div>
                    <div class="pdf">
				    <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image5','','images/lkdnhover.png',0)"><img id="Image5" src="images/lkdn.png"></a> </div>
                  <div class="pdf"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1234','','images/blghover.png',1)"><img id="Image1234" src="images/blg.png"></a></div>
   				  -->
				 </div>
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