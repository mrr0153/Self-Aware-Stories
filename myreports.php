<?php
 session_start();
 require_once("config/config.inc.php");
 error_reporting(0);

 if(isset($_SESSION['uname'])){
   
    $filepath="xml/categories.xml";
	$myXMLData=file_get_contents($filepath);
	$xml = simplexml_load_string($myXMLData);
	$json = json_encode($xml);
	$array = json_decode($json,TRUE);
				 
    if(isset($_REQUEST['cid'])){
       $cid=$_REQUEST['cid'];
    }else{      
	   $cid=$array['categories'][0]['catid'];
    } 
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>Self-Aware Stories : My Report Card</title>
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
<script>
 $(document).ready(function(){
      
      cid='<?php echo $cid;?>';	  
	  
	  function loading_show(){
		   $('#loading').html("<img src='images/loading.gif' width='50px' height='50px'/>").fadeIn('fast');
	  }
	  function loading_hide(){
		   $('#loading').fadeOut('fast');
	  } 
	  
	  loading_show();
	  	  	  
	  $.post('getReports.php',{"page":1,'cid':cid},function(data){
	        
			loading_hide();					
			
			$("#forumcomments").empty().html(data)
	  });
		
		
	  $('.themeradio').click(function(){
	   	
        cid = $(this).val()		
		window.location.href='myreports.php?cid='+cid;
			
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
						<h4>My Report Card</h4>
					</div>
					<div class="one-half">
						<nav id="breadcrumbs"><!--breadcrumb nav starts-->
						<ul>
							<li>You are here:</li>
							<li><a href="myreports.php">My Report Card</a></li>							
						</ul>
						</nav><!--breadcrumb nav ends -->
					</div>
				</div>
			</div>
            <div class="container">
              <div class="one">
                <div class="vcommentlist">
				<h4 style="color: #005292;  padding-left: 20px;margin-bottom: 10px;">Themes</h4>
				
				<?php 
				
				 for($i=0;$i<sizeof($array['categories']);$i++){
						
					$catid=$array['categories'][$i]['catid'];
					$catname=$array['categories'][$i]['catname'];				
				
				?>
				   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="themeradio" name="themeradio" value="<?php echo $catid; ?>" <?php if( $cid == $catid ){ echo "checked"; }?> > <?php echo $catname; ?><br>
				<?php
				 } 
				?>
			   </div> 
			   
			   <div class="vcomments" >
				<div class="vcomments-block">
				  <div class="comment-content">	
				    <div style="width:100%;float:left;">			    
					   <h4>Reports</h4>				
				    </div>
				   
				   <div id="loading" style="text-align:center;text-align: center; margin: 10% 32%; position: absolute;"> </div>
				   <?php
                     if(isset($cid)){
				   ?>
				   <div id="forumcomments"> </div>	
				   <?php } else{ ?>
					 
					 <p class="notheme" style="text-align:center;padding:120px 0px;">Please select a Theme.</p>
				   <?php } ?> 
				  </div>
                 </div>
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
</div>
<!-- main container ends-->
</body>
</html>
<?php

 }else{
 
   header("location:index.php");
 }
?>