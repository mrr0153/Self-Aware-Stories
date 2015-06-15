<?php
session_start();
require_once("config/config.inc.php");
error_reporting(0);
if(isset($_SESSION['uname'])){
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>Self-Aware Stories : My Readings</title>
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


<!---- comment script start --->
<link rel="stylesheet"  href="css/elements.css" />
<script src="js/my_js.js"></script>	
	
<script src="js/myjournal_script.js"></script>
<!---- comment script end --->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>
<script>
$( document ).ready( function() {
	
	$(".notes").click(function(){
	  
	  rid=$(this).attr('data-id')
	  //alert(rid)
	  $.post('updatenotices.php?uid=<?php echo $_SESSION['uid']?>&rid='+rid,{},function(data){ 
	    //alert(data)	 
	    location.reload();
	  });
	  
	});	
	
});
</script>


</head>
<body id ="bdy" >
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
					<li><a href="index.php">Home</a></li>
					<li><a href="aboutus.php">About Us</a></li>
				<!--<li><a href="#"> Start Here </a></li> -->
					<li><a href="http://blog.selfawarestories.in/">Blog</a></li>
					<!--<li><a href="tour.php">Tour</a></li> -->
					<li><a href="testimonials.php">Testimonials</a></li>
					<li><a href="plans&pricing.php">Plans & Pricing</a></li>
					<li><a href="contactus.php">Contact Us</a></li>
				</ul>
				<!-- main navigation ends-->
                <div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) { echo "<a href='logout.php'>Logout</a>";} else echo "<a href='signup.php'>SignUp</a>";?></h4>
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
      
		<!--layer slider ends-->
		<div id="content">		
		  <div class="container">
	       <div class="one">
		    <br><br>
	        <div class="myreadings-block" style="">
			   <div>
			  <!-- <p style="float: left;background: #f6f7fb;width: 100%;padding: 9px 0px 10px 0px;border-top: 1px solid #e6e9ee;border-bottom: 1px solid #e6e9ee;text-align: center;">Hey <span style="color:#005292"><?php if(isset($_SESSION['uname'])) { echo $_SESSION['uname'];}?></span>,  ! </p> -->
			   <p class="myreadings-title" style=""><span style="color:#005292">My Readings</span> </p>
			   
			   </div>
			   <div style="font-family: 'Roboto',arial,helvetica,sans-serif;color: #000;"><br><br>
			   
				   <table width="100%" id="filelist" >
					<tr width="100%" style="background-color:#C1C6CE;color: #005292;">
					   <td width="5%" align="center">S.No</td>
					   <td width="20%" align="center">File Name</td>
					   <td width="20%" align="center">Video Name</td>
					   <td width="20%" align="center">Theme Name</td>
					   <td width="5%" align="center">Action</td>
					   <td width="5%" align="center">Status</td>
					   <td width="10%" align="center">Date</td>
					</tr>
				   
					<?php
					  if(isset($_SESSION['uname'])){
					  
						 $rquery = mysql_query("SELECT * FROM sas_readings order by addedon desc");
						 $count=mysql_num_rows($rquery);
						 
						 $i=1;
						 while($resquery = mysql_fetch_array($rquery)){ 
						
							extract($resquery);
							
							$rrquery = mysql_query("SELECT * FROM sas_userreadings where rid=$resquery[rid]");
							$rresquery=mysql_fetch_array($rrquery);
						    
						    $themers=mysql_query("SELECT * FROM sas_themecategories where cat_id=$resquery[cid]");
							$themerrs=mysql_fetch_array($themers);
							
							$videors=mysql_query("SELECT * FROM sas_videos where id=$resquery[vid]");
							$videorrs=mysql_fetch_array($videors);
						 
							if($i%2==0){ 
							
							  $bg="#f6f7fb";
								
							}else {
							
							  $bg="#fff";
							}  					
					?>
				   <tr width="100%" style="background-color:<?php echo $bg;?>;">
				     <td align="center"><?php echo $i; ?></td>
					 <td  align="center"><a class="notes" data-id="<?php echo $rid; ?>" href="readfile.php?name=<?php echo $rfilepath; ?>" target="_blank" style="color:#312E2E;"><?php echo $rtitle; ?></a></td>
					 <td  align="center"><?php echo $videorrs['prod_name']; ?></td>
					 <td  align="center"><?php echo $themerrs['cat_name']; ?></td>
					 <td align="center"><a class="notes" data-id="<?php echo $rid; ?>" href="readfile.php?name=<?php echo $rfilepath; ?>" target="_blank" style="color:#312E2E;">View<a/></td>
					 <td  align="center"><?php if($rresquery['status']=='0'){echo 'Unread';}else{echo 'Read';}?></td>
					 <td  align="center"><?php echo $addedon; ?></td> </tr>
					
					<?php 
					  $i++;				
					  } 
					}?>
				   <tr style="background-color:#C1C6CE;color: #005292;"><td align="center"></td><td  align="left"></td><td  align="center">&nbsp;</td><td  align="center">&nbsp;</td><td  align="center">&nbsp;</td><td  align="center"></td><td   align="center"></td> </tr>
					
				   </table>
			   </div>
			   <br><br><br><br><br><br><br><br>
			</div>
		   </div>  
          </div>
		   <!--
		   <div id="breadcrumb1">
				<div class="container">
					<div class="one-half">
						<h4>Self Aware Stories</h4>
					</div>
					<div class="one-half">
						<nav id="breadcrumbs">
						<ul>
							<li>You are here:</li>
							<li><a href="index.php">Home</a></li>
							<li>My Journal</li>
						</ul>
						</nav>
					</div>
				</div>
			 </div> 
              -->
             <div class="comment-content" style="width: 785px;margin: 0px auto;">	
				
             <div class="horizontal-line"></div>
				
			 </div>  
			
         <br><br><br><br>			
		
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
<?php } else header('location:index.php');?>