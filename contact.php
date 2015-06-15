<?php
session_start();
error_reporting(0);
?>
<?php
 if(isset($_POST['submit']) && $_POST['submit'] !='')
 {
   extract($_POST);   
        
   $to='support@selfawarestories.in,martin@selfawarestories.in,meghna@selfawarestories.in';
   
   $subject = "Contact Details ";
	
   $msg = "
<html>
  <body bgcolor='#DCEEFC'>
   <h4>Contact Details ,</h4>
    <table>
      <tr><td style='font-weight:bold;'>Name</td><td style='width:2px;'>:</td><td>$name</td></tr>
	  <tr><td style='font-weight:bold;'>Email ID</td><td style='width:2px;'>:</td><td>$email</td></tr>
	  <tr><td style='font-weight:bold;'>Url</td><td style='width:2px;'>:</td><td>$url</td></tr>
	  <tr><td style='font-weight:bold;'>Message</td><td style='width:2px;'>:</td><td>$message</td></tr> 
	</table>
  </body>
</html>";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .=  "From:$name". "\r\n" ;
    $headers .= "Reply-To:$email". "\r\n" ;
	
 if(mail($to,$subject,$msg,$headers))
	 {
	   $mssg="Thank you for contacting us, we will get you back !";
      }    
	/*echo "<script type='text/javascript'>window.location.href='contact.php?mssg=$mssg'</script>";  
	//header('location:thankyou.php?mssg='.$mssg); */
  }

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
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>

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
					<li><a href="aboutus.php">About Us</a></li>
				<!--<li><a href="#"> Start Here </a></li> -->
					<li><a href="blog/">Blog</a></li>
					<li><a href="#">Testimonials</a></li>
					<li><a href="#">Plans & Pricing</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
				<!-- main navigation ends-->
                <div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) {echo "<a href='logout.php'>Logout</a>";} else echo "<a href='signup.php'>SignUp</a>";?></h4>
				</div>
				<div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) {echo $_SESSION['uname'];} else echo "<a href='login.php'>Login</a>";?></h4>
				</div>
                
			</div>
		</div>
		<!--main navigation wrapper ends -->
		</header>
		<div id="content">

			<div class="container">
            <h4 class="widget-title">Feedback <?php if($_REQUEST['mssg']) $mssg=$_REQUEST['mssg']; if(isset($mssg)) echo "&nbsp;&nbsp;&nbsp;&nbsp;<span style='color:green;'>".$mssg."</span>"; ?> </h4> 
				<section class="three-fourth">
				<form name="frm1" action="#"  class="simple-form " method="post" onsubmit="return validateForm()">
					<div id="error-field">
					</div>
					<fieldset>
						<i class="icon-user tooltip left" title="Your Name"></i><input  placeholder="Your Name"   type="text" class="text requiredField" name="name" size="40" />
					    <span id="sp1"></span>
					</fieldset>
					<fieldset>
						<i class="icon-envelope tooltip left" title="Your Email"></i><input type="text" placeholder="Your Email"   class="email requiredField" name="email" size="40"/>
					    <span id="sp2"></span>
					</fieldset>
					<fieldset>
						<i class="icon-globe tooltip left" title="Your Website"></i><input type="text" placeholder="Your Website"  class="text" name="url" size="40"/>
					</fieldset>
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
						<li><a href="#">5 Avenue, Some City</a></li>
						<li><a href="#">+00 (0) 000 00 00</a></li>
						<li><a href="#">support@domain.com</a></li>
						<li><a href="#">Find us on Google Maps</a></li>
					</ul>
					<div class="pdf"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image6','','images/fblikhover.png',0)"><img id="Image6" src="images/fblik.png"></a>
					</div>
                    <div class="pdf">
				    <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image5','','images/lkdnhover.png',0)"><img id="Image5" src="images/lkdn.png"></a> </div>
                  <div class="pdf"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1234','','images/blghover.png',1)"><img id="Image1234" src="images/blg.png"></a></div>
   				  </div>
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