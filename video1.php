<?php
session_start();
require_once("config/config.inc.php");
error_reporting(0);
?>
<?php
if(isset($_REQUEST['cid'])){
$cid=$_REQUEST['cid'];
}
else{
$cid=1;
}
if(isset($_REQUEST['pid'])){
$pid=$_REQUEST['pid'];
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

<script type="text/javascript" src="js/1.10.2jquery.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!----- Popup start --->
<link rel="stylesheet" href="js/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!----- Popup end --->

<script>
 $(document).ready(function(){
	
	var vars = [], hash,hash2;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	
    for(var i = 0; i < hashes.length; i++)
    {   //hash2 = hashes[i];
        hash = hashes[i].split(',');
        vars.push(hash[0]);
		//vars.push(hash[1]);
       // vars[hash[0]] = hash[1];
		//vars[hash[1]] = hash[1];
    }
    //alert(vars);
    //alert(hash);
    $('a[href="theme1.php?'+hash+'"]').addClass("active");
	
	$("a").click(function(){
	   $("a.active").removeClass("active");
	   $(this).addClass("active");
	   
	   var hr = $(this).attr("href");
	   window.load(hr);
	   event.preventDefault();
    });
	
    var cid=document.getElementById('cid').value
	 $("#prev").css("display","none");
	 $("#next").css("display","block");
	 // alert(cid)
     $.post("theme1_1.php?qs=init&cid="+cid,{},function(data){ 
	 //alert(data)
	 document.getElementById("bottom-videos").innerHTML=data;
     });
	 
	$("#prev").click(function(){
	   //alert('prev')
	      
	   	  var prev=$(this).attr('data-id')
		  var cid=document.getElementById('cid').value
		   // alert(cid)
		  $.post("theme1_1.php?qs="+prev+"&cid="+cid,{},function(data){ 
		  //alert(data)
		  document.getElementById("bottom-videos").innerHTML=data;
		  $("#prev").css("display","none");
	      $("#next").css("display","block");
		  });		 
    });
	
	$("#next").click(function(){
	   //alert('next')
	    
	    var cid=document.getElementById('cid').value
	    var next=$(this).attr('data-id')
		//alert(cid)
		  $.post("theme1_1.php?qs="+next+"&cid="+cid,{},function(data){ 
		  //alert(data)
		  document.getElementById("bottom-videos").innerHTML=data;
		  $("#next").css("display","none");
	      $("#prev").css("display","block");
	   
		  });
		 
    });
	
	 $.post("getcategories.php?start=0&limit=",{},function(data){ 
	 //alert(data)
	 document.getElementById("navside").innerHTML=data;
     });
	 
  });
  
 
</script>
<script>
 function validateUser(id){
  //alert('hi')
  var uid="<?php if(isset($_SESSION['uname'])) echo $_SESSION['uname']; ?>";
  
  var cid=document.getElementById('cid').value;
  if(cid==1){

	   window.location.href='video1.php?cid=<?php echo $cid;?>&pid='+id;
  }
   if(cid==2){
  
	  if(uid){
	   window.location.href='video1.php?cid=<?php echo $cid;?>&pid='+id;
	   
	  }else{
	  
	  alert('Please login/singup to access this video.');
	  }
  }
 }
	
function getpop(id){
   //alert(id)
   $('.pop-title').css("display","none");
   $('#pop-title'+id).fadeToggle();
}

function hidepop(id){
   //alert('leaved')
   $('.pop-title').css("display","none");
  // $('#pop-title'+id).css("display","block");
  // $('#pop-title'+id).fadeToggle();
}
	
</script>

<script>
 
 function morefun(id,limit){
 
 //alert('more'+id)
 $.post("getcategories.php?start="+id+"&limit=more",{},function(data){ 
	 //alert(data)
	 document.getElementById("navside").innerHTML=data;
     });
 
 }
 
 function lessfun(id,limit){
 
// alert('less'+id)
 $.post("getcategories.php?start="+id+"&limit=less",{},function(data){ 
	 //alert(data)
	 document.getElementById("navside").innerHTML=data;
     });
 
 }
</script>
<style>
.pop-title {
padding: 4px 4px;
overflow: hidden;
position: absolute;
top: -17px;
left: 62px;
display: none;
height: 108px;
width: 810px;
text-align:center;
}

</style>
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
					<li><a href="index.php">Home</a></li>
					<li><a href="aboutus.php">About Us</a></li>
			<!--    <li><a href="#"> Start Here </a></li> -->
					<li><a href="blog/">Blog</a></li>
					<li><a href="testimonials.php">Testimonials</a></li>
					<li><a href="plans&pricing.php">Plans & Pricing</a></li>
					<li><a href="contactus.php">Contact Us</a></li>
				</ul>
				<!-- main navigation ends-->
                <div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) {echo "<a href='logout.php'>Logout</a>";} else echo "<a href='signup.php'>SignUp</a>";?></h4>
				</div>
				<div class="after-nav-info">
					<h4><?php if(isset($_SESSION['uname'])) {echo "<a href='welcome.php'>".$_SESSION['uname']."</a>";} else echo "<a href='login.php'>Login</a>";?></h4>
				</div>
                <div class="after-nav-info">
					<h4><a href="#"><?php if(isset($_SESSION['uname'])) echo "My Space";?></a></h4>
				</div>
			</div>
		</div>
		<!--main navigation wrapper ends -->
		</header>
		<!-- header ends-->
        <div class="container">
        <div id="navig">
  
        <ul id="navside">

        </ul>
</div>
     <?php
	 if($pidd){ ?>
       <section class="one-half1">
				
            <?php
            $qry="select * from sas_themes where cat_id=$cid and prod_id=$pid ";
            $rslt=mysql_query($qry) or die(mysql_error()); 
			while($rslt && $rlt=mysql_fetch_array($rslt))
			{
			 //print_r($rlt);
			 extract($rlt);
			 $catid=$cat_id; 
			?>
       <!--     <h2><a href="#"> <img src="images/play.png"></img></a></h2> -->
			<a href="#"><iframe src="//player.vimeo.com/video/<?php if($pidd==11){echo $vcode;}else{echo $cvcode; }?>" width="725" height="320" frameborder="0" ></iframe></a>
            <?php }?>			
			</section>
    <?php  } else{
	  ?>
        <section class="one-half1">
				
            <?php
            $qry="select * from sas_videos where cat_id='$cid' and id='$pid' ";
            $rslt=mysql_query($qry) or die(mysql_error()); 
			while($rslt && $rlt=mysql_fetch_array($rslt))
			{
			 //print_r($rlt);
			 extract($rlt);
			 $catid=$cat_id; 
			?>
       <!--     <h2><a href="#"> <img src="images/play.png"></img></a></h2> -->
			<a href="#"><iframe src="//player.vimeo.com/video/<?php echo $vcode;?>" width="725" height="320" frameborder="0" ></iframe></a>
            <?php }?>			
			</section>
		<?php } ?>		
           </div>    
		<!--layer slider ends-->
		<div id="content">
        <div id="breadcrumb"><!-- breadcrumb starts-->
				<div class="container">
					<div class="one-half">
					<?php
					
						$qry="select * from sas_themes where cat_id=$cid and prod_id=$pid ";
						$rslt=mysql_query($qry) or die(mysql_error()); 
						while($rslt && $rlt=mysql_fetch_array($rslt))
						{
						 //print_r($rlt);
						 extract($rlt);
						 $catid=$cat_id; 
						}
			
                    $qry="select * from sas_themecategories where cat_id='$catid'";
                    $rslt=mysql_query($qry) or die(mysql_error()); 
		        	while($rslt && $rlt=mysql_fetch_array($rslt))
			        {
			        //print_r($rlt);
			        extract($rlt);
			    
			       ?>
						<h4><?php echo $pagetitle;?></h4>
					<?php }?>	
					</div>
					<div class="one-half">
						<nav id="breadcrumbs"><!--breadcrumb nav starts-->
						<ul>
							<li>You are here:</li>
							<li><a href="index.php">Home</a></li>
							<li><a href="theme1.php"><?php echo $cat_name;?></a></li>
                            <!-- <li><?php echo $prod_name;?></li> -->
						</ul>
						</nav><!--breadcrumb nav ends -->
					</div>
				</div>
			</div>
            <!--breadcrumbs ends --><!--home intro ends-->
		  <div class="container">
	<div class="one">
    <div style="width:50%;float:left;">
    <h4>Video Description</h4>    
	</div>
	<div style="width:50%;float:left;">
	<h4 style="text-align:right;"><img style="padding-left: 35px;" src="images/discuss_button.png"> </h4>
	</div>  
    <p> <?php echo $description;?> </p>		
     <h4>Characters :</h4>
     <div class="tag2">
        <ul>
		<?php
         $charimgqry="select * from sas_chars where prod_id='$pid' and cat_id='$cid' ";
		 $rslt=mysql_query($charimgqry); 
		 //echo mysql_num_rows($rslt);
		 while($rlt=mysql_fetch_array($rslt))
		 {		 
			extract($rlt);
	    ?>
		<li><a data-id="<?php echo $id; ?>" href="#"><img src="character_photos/<?php echo $photopath;?>" width="100" height="100"></a></li>
        <div  id="popuptext-<?php echo $id; ?>" style="display:none;"> 
		  <div class="popup-content2">
		  
		  <h3 style="color:#005292"><?php echo $title;?></h4>
		   <img src="character_photos/<?php echo $photopath;?>" width="200" height="200">
		   <?php echo $description; ?>
		   
		 </div>
		</div>
	   <?php  } ?>		
		</ul>
     
     </div>
            
	 </br></br></br></br></br></br>
	 <h5>Behaviour Topics :</h5>
	 <?php
	 if(isset($btopics)){
	   $btopics=explode("---",$btopics);
	   //print_r($btopics);
	   $size=sizeof($btopics);
	   for($i=0;$i<$size;$i++){
	   if(!empty($btopics[$i])){
	 ?> 
	 
     <p>• &nbsp;<?php echo $btopics[$i];?> </p>
	 
     <?php } } }?>        
	 <h5>Tags :</h5>
     <p>   </p>
          
	 <p>
     <h4>Mentor Resources :</h4>
	  <div class="tag2">
		<ul>
		  <li><a href="#"> </a></li>
		  <li><a href="#"></a></li>
		  <li><a href="#"></a></li>
		</ul>
       </div>
      </p>
	  </br></br>
	  <h5>More Videos :</h5>
        <div class="container2">
      <!--
  	    <ul class="client-block modern">
			 <li class="one-sixth"><a href="#" class="tooltip" title="Some Clients Name"><img src="images/clients/client-1.png" alt=""/></a></li>
			 <li class="one-sixth"><a href="#" class="tooltip" title="Some Clients Name"><img src="images/clients/client-2.png" alt=""/></a></li>
			 <li class="one-sixth"><a href="#" class="tooltip" title="Some Clients Name"><img src="images/clients/client-3.png" alt=""/></a></li>
			 <li class="one-sixth"><a href="#" class="tooltip" title="Some Clients Name"><img src="images/clients/client-4.png" alt=""/></a></li>
			 <li class="one-sixth"><a href="#" class="tooltip" title="Some Clients Name"><img src="images/clients/client-5.png" alt=""/></a></li>
			 <li class="one-sixth"><a href="#" class="tooltip" title="Some Clients Name"><img src="images/clients/client-6.png" alt=""/></a></li>
		 </ul>
		 -->
		 <!--
		 <ul class="client-block modern">
		 <?php
            $qry="select * from sas_themes where cat_id=$cid and prod_id NOT LIKE '$prod_id' order by prod_id desc limit 0,6";
            $rslt=mysql_query($qry) or die(mysql_error()); 
			while($rslt && $rlt=mysql_fetch_array($rslt))
			{
			// print_r($rlt);
			 extract($rlt);
			 if(!empty($vcode)){
			 
			 $image = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vcode.php"));
             $img=$image[0]['thumbnail_small']; 
			?>
			<li class="one-sixth"><a href="video1.php?pid=<?php echo $prod_id;?>&cid=<?php echo $catid;?>" class="tooltip" title="Some Clients Name"><img src='images/portfolio/portfolio-item-1.jpg' width="150" height="80" ></a></li>
			<?php
			 }
			 else{
			 ?>
			 <li class="one-sixth"><a href="#" class="tooltip" title="Some Clients Name"><img src='images/portfolio/portfolio-item-1.jpg' width="150" height="80" ></a></li>
			 <?php
			 }
			}
			?>		
			
			</ul>
			--->
				
			<input type="hidden" id="cid" value="<?php echo $cid; ?>">
			<div style="width:100%">
			  <div style="width:5%;float:left;padding-right: 15px;padding-top: 120px;">
			  <img src="images/prev.png" id="prev" data-id="prev">
			  </div>
			  <div style="width:88%;float:left;" id="bottom-videos">
			  
			  </div>	
			<div style="width:5%;float:left;padding-top:120px;">		
			<img src="images/next.png" id="next" data-id="next">	
			</div>		
			</div>	
			
            </div>

            <div class="horizontal-line"></div>
				
				 

					<!-- Pagination -->
						
					<!-- End pagination -->
			</div><!-- intro features panel ends -->
			
	  </div>
      
      <div class="home-intro"><!-- home intro starts -->
				<div class="container">
					<div class="one-half">
						<h4>Buy this Theme</h4>
						
					</div>
					<div class="one-half2">
                        <a href="#" class="button grey huge round">Feedback</a>
                        </div>
                        <div class="one-half2">
						<a href="#" class="button grey huge round">Buy Now</a>

					</div>
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
				<li><a href="aboutus.php" title="About Us">About us</a></li>
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