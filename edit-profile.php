<?php
 session_start();
 include('config/config.inc.php');
 error_reporting(0);
 
 //include the S3 class
 if (!class_exists('S3'))require_once('S3.php');
			
 require_once("config/awsKeys.php");
			
 //instantiate the class
 $s3 = new S3(awsAccessKey, awsSecretKey);
	
 if(isset($_POST['sub']))
 {
    extract($_POST);
    
    if(isset($_FILES['file1']['name'])){
	  
      //retreive post variables
	  $fileName =$_SESSION['uid'].'_'.$_FILES['file1']['name'];	  
	  $fileTempName = $_FILES['file1']['tmp_name'];
	  $fileSize = $_FILES["file1"]["size"];
	  $fileType = $_FILES["file1"]["type"];
	  
	  //create a new bucket
	  //$s3->putBucket("sas-userphotos", S3::ACL_PUBLIC_READ);
	  
	  if ($fileSize < 1000 or $fileSize > 20000) { /// 1000 == 1kb	  
		  $msg="<span style='color:red;'>Sorry, Profile Pic size should be >1kb and < 20kb.</span>";
	  }else{
         
         if($fileType != "image/jpg" && $fileType != "image/png" && $fileType != "image/jpeg"
			&& $fileType != "image/gif" ) {
			
			$msg="<span style='color:red;'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</span>";	
			
		  }else{
		  
				//move the file
				if ($s3->putObjectFile($fileTempName, "sas-userphotos", $fileName, S3::ACL_PUBLIC_READ)) {
					//echo "<strong>We successfully uploaded your file.</strong>";
					mysql_query("update sas_users set first_name='$firstname',last_name='$lastname',email='$email',password='$password',photopath='$fileName',subscribe_status='$subscribe',date_added=now() where user_id=$_SESSION[uid]");
					
				}else{
					//echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
				    $msg="<span style='color:red;'>Sorry, File Name should not contain white spaces.</span>";	
				}		  
		  }
		  
		  
	  }	
	  
	} 
	else{
		
	     $fileName=$dbpic;
	     mysql_query("update sas_users set first_name='$firstname',last_name='$lastname',email='$email',password='$password',photopath='$fileName',subscribe_status='$subscribe',date_added=now() where user_id=$_SESSION[uid]");
	}
	/*
    if(mysql_query("update sas_users set first_name='$firstname',last_name='$lastname',email='$email',password='$password',photopath='$fileName',subscribe_status='$subscribe',date_added='now()' where user_id=$_SESSION[uid]"))
    {
      $msg="Your profile details updated sucessfully";
      //echo "<script type='text/javascript'>window.location.href='edit-profile.php?msg=$msg'</script>"; 
    }
   */
 } 

?>
<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>Self-Aware Stories : Edit Profile</title>
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

<script type="text/javascript" src="jss/check_availability.js"></script>
<script type="text/javascript" src="jss/edit_validate.js"></script>

<script>
 $(document).ready(function(){
    	  
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
					<h4><a href="logout.php">Logout</a></h4>
				</div>
				<div class="after-nav-info">
					<h4><a href="edit-profile.php"><?php if(isset($_SESSION['uname'])) echo $_SESSION['uname'];?></a></h4>
				</div>
                <div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) { echo '<a href="myjournal.php" target="_blank">My Journal</a>';} ?></h4>
				</div>
			</div>
		</div>
		<!--main navigation wrapper ends -->
		</header>
		<div id="contentlogin">
		   
			<div class="container">
			
				<section class="two-thirdlogin">
				<?php
				   $uname=$_SESSION['uname'];
				   $data=mysql_query("select * from sas_users where username='$uname'");
				   $rslt=mysql_fetch_array($data);
				   extract($rslt);
				   $_SESSION['email']=$email;
				   
				?> 
				<h4 class="widget-title" style=" background: #FFF;margin-bottom: 10px;">Edit Profile</h4>
				<form name="frm1" action=""  class="simple-form" method="post" onsubmit="return validateEditform()" enctype="multipart/form-data">
					<div id="error-field" style=" margin-bottom: 10px;"><?php if(isset($msg)) echo '<span style="color:green">'.$msg.'</span>';?>
					</div>
					<fieldset>
						<i class="icon-user tooltip left" title="First Name"></i><input id="firstname" placeholder="First Name *"  type="text" onfocus="fname_focus()" class="text requiredField" name="firstname" size="27" value="<?php if(isset($first_name)) echo $first_name; ?>"/>
					    <span id="sp1"></span>
					</fieldset>
                    <fieldset>
						<i class="icon-user tooltip left" title="Last Name"></i><input id="lastname" placeholder="Last Name *"  type="text" onfocus="lname_focus()" class="text requiredField" name="lastname" size="27" value="<?php if(isset($last_name)) echo $last_name; ?>"/>
					    <span id="sp2"></span>
					</fieldset>
                    <fieldset>
						<i class="icon-user tooltip left" title="Your Email"></i><input id="email"  placeholder="Your Email *"  type="text" onfocus="email_focus()" name="email" size="27" value="<?php if(isset($email)) echo $email; ?>"/>
					   <span id="sp3"></span>
					</fieldset>	
                   <!--					
                    <fieldset>
						<i class="icon-user tooltip left" title="User Name"></i><input id="username"  placeholder="User Name *" onfocus="uname_focus()" onblur="checkUser()"  type="text" class="text requiredField" name="username" size="27" value="<?php if(isset($username)) echo $username; ?>"/>
					    <span id="sp4"></span>
					</fieldset>
                   -->					
					<fieldset>
					
						<i class="icon-key tooltip left" title="Your Password "></i><input  type="password"  placeholder="Your Password *"  onfocus="password_focus()" class="password requiredField" name="password" size="27" value="<?php if(isset($password)) echo $password; ?>"/>
					    <span id="sp5"></span>
					</fieldset>
                    
					<input id="oldusername" type="hidden" name="oldusername" value="<?php echo $_SESSION['uname'];?>" >
					<input id="oldemail" type="hidden" name="oldemail" value="<?php echo $_SESSION['email'];?>" >
					<table>
					<tr style="height:50px;">
					  <td style="font-size:13px;width:120px;">Upload Your Photo :&nbsp;&nbsp;&nbsp; <input type="file" name="file1" /></td><td style="font-size:13px;width:50px;"><input type="hidden" name="dbpic" value="<?php echo $photopath;?>"><?php if(!empty($photopath))
	                  echo "<img src='https://s3-us-west-2.amazonaws.com/sas-userphotos/".$photopath."' width='80' height='60'/>";?></td>
					</tr>
					</table>
					
					<div style="float:left;">
					   <span style="float:left;padding-top: 5px;"><input type="checkbox" name="subscribe" value="1" <?php if($subscribe_status==1){ echo 'checked';}?> style="float: left;" /></span>
					   <span style="float:left;padding-left: 5px;">Check to get subscriptions</span>
					</div>
					
					<div class="one-fourthreg">
						<input type="submit" value="Update" name="sub" class="button big grey round"/>
                    </div>
                   <input type="hidden" name="status" value="1">
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