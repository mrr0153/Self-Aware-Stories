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


<!---- comment script start --->
<link rel="stylesheet"  href="css/elements.css" />
<script src="js/my_js.js"></script>	
	
<script src="js/myjournal_script2.js"></script>
<!---- comment script end --->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>
<script>
$( document ).ready( function() {

	$( 'textarea#description' ).ckeditor();
	$( 'textarea#description2' ).ckeditor();
    
	$( '#div2' ).css('display','none');
	
    $(".comment-edit").click(function(){
	    //alert('hi')
	    $( '#div1' ).css('display','none');
		$( '#div2' ).css('display','block');
		
	    var jid=$(this).attr('data-id')
		//alert(jid)  	
        ttl=$("#topictitle"+jid).val()
        // alert(ttl)
        $( '#topictitle2' ).val(ttl)		
		
		d=$("#p-comment"+jid).html( )
		//alert(d) 
        $( 'textarea#description2' ).val(d)	
		
        $( "#form2" ).submit(function( e ) {
		
		e.preventDefault();
		k=$( '#topictitle2' ).val()	
		//alert(k) 
		a= $( 'textarea#description2' ).val()
		
   		$.post('edit_post.php?jid='+jid+"&desc="+a+"&ttl="+k,{},function(data){
		 //alert(data)
		 
		 location.reload();
		 
		});
		
        });
	
    });
	
	
		
	
});
</script>

<script>
function del_commnet(jid){
if(confirm("Are you sure to delete this Note?"))
 {
	 $.post("del_journal_post.php?jid="+jid,{},function(){
      location.reload();
    });
 }
}

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
				<form action="404-error.html" method="get">
					<button class="search-btn"></button>
					<input class="search-field" type="text" onblur="if(this.value=='')this.value='Search';" onfocus="if(this.value=='Search')this.value='';" value="Search"/>
				</form>
                <div id="socialiconsvid">
                    <ul class="social-links">
						<!-- header social links starts-->
						<li><?php if(isset($_SESSION['uname'])){ echo '<a href="edit-profile.php" class="tooltip" title="'.$_SESSION['uname'].'"><img src="images/account.png"></a>';}else{ echo '<a href="login.php" class="tooltip" title=""><img src="images/account.png"></a>';}?></li>
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
				<!--<li><a href="#"> Start Here </a></li> -->
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
					<h4><?php if(isset($_SESSION['uname'])) {echo "<a href='edit-profile.php'>".$_SESSION['uname']."</a>";} else echo "<a href='login.php'>Login</a>";?></h4>
				</div>
                <div class="after-nav-info">
					<h4><a href="myjournal.php"><?php if(isset($_SESSION['uname'])) echo "My Journal";?></a></h4>
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
	        <div style="height:auto;margin: 0 auto;width: 780px;position: relative;">
			   <div>
			   <p style="float: left;background: #f6f7fb;width: 100%;padding: 9px 0px 10px 0px;border-top: 1px solid #e6e9ee;border-bottom: 1px solid #e6e9ee;text-align: center;">Hey <span style="color:#005292"><?php if(isset($_SESSION['uname'])) { echo $_SESSION['uname'];}?></span>, this space is so you can take notes for your reference. Write away!  </p>
			   </div>
			   <div id="div1">
			   <form id="form1" method="post" action="">
			   <h4 style="color:#005292">Topic Title :</h4><input type="text" name="topictitle" ><br>
		
			   <textarea class="ckeditor" cols="50" id="description" name="description" rows="10">
				
               </textarea><br>
			   <input type="submit" id="submit" value="Save"> 
			   </form>
			   </div>
			   
			   <div id="div2">
			   <form id="form2" method="post" action="">
			   <h4 style="color:#005292">Topic Title :</h4><input type="text" name="topictitle2" id="topictitle2"><br>
			   
			   <textarea class="ckeditor" cols="50" id="description2" name="description2" rows="10">
				
               </textarea><br>
			   <input type="submit" id="submit" name="submit2" value="Save"> 
			   </form>
			   </div>
			    </div>
			  </div>  
           </div>
		   <div id="breadcrumb1"><!-- breadcrumb starts-->
				<div class="container">
					<div class="one-half">
						<h4>Self Aware Stories</h4>
					</div>
					<div class="one-half">
						<nav id="breadcrumbs"><!--breadcrumb nav starts-->
						<ul>
							<li>You are here:</li>
							<li><a href="index.php">Home</a></li>
							<li>My Journal</li>
						</ul>
						</nav><!--breadcrumb nav ends -->
					</div>
				</div>
			 </div> 
              
             <div class="comment-content" style="width: 785px;margin: 0px auto;">	
				<div style="width:100%"><div style="width:50%;float:left;"><h4>My Journal</h4></div><div style="width:50%;float:left;text-align:right;" id="sort-post"><?php if(isset($_GET['sort']) and $_GET['sort']=='asc'){ ?><a href="myjournal.php?sort=desc"><img id="sort-img" data-id="" src="images/up.jpg" style="height: 35px;width: 35px;padding-right:10px;"></a><?php } else {?><a href="myjournal.php?sort=asc"><img id="sort-img" data-id="" src="images/down.jpg" style="height: 35px;width: 35px;padding-right:10px;"></a> <?php } ?></div> </div> 
				<?php
				 
				  $orderby = $_GET['sort'];
				  
				  if ( $orderby == 'asc' ) {
				  $query.= ' asc ';
				  }
				  else if ( $orderby == 'desc' ) {
				  $query.= ' desc ';
				  }				  		  
				  else {  
				  $query.= ' desc ';  //Default sort order.
				  }
				
				
				?>
				<div id="new-post">
			
			    </div>
				<div class="comment-block" >				
				<?php 				
				 $comment_query = mysql_query("SELECT * FROM sas_myjournal WHERE uid =".$_SESSION['uid']." order by jid $query");
				 // echo mysql_num_rows($comment_query);
				  while($comment = mysql_fetch_array($comment_query)){ 
				  extract($comment);				 
				?>
				   <div class="comment-item" style="width: 748px;">						
						<div class="comment-post" style="width: 730px;">
						  <div class="comment-post-div">
						    <div class="comment-post-left" >							  
								 <?php 
								  if(isset($topictitle)){ ?>
								 <h6 style="color:#005292"><?php echo $topictitle ;?></h6>
								 <input type="hidden" name="topictitle" id="topictitle<?php echo $jid;?>" data-title="" value="<?php echo $topictitle ;?>">
								 <?php }?>							  
							</div>  
							<div class="comment-post-right" style="font-size:10px;">							
							<a class="comment-edit" href="#" data-id="<?php echo $jid;?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="javascript:del_commnet(<?php echo $jid; ?> )">Delete</a>
							&nbsp;&nbsp;&nbsp;<?php echo $date;?> 
							</div>
						  </div></br>
                          <div style="width:100%">
                            <div class="p-comment" id="p-comment<?php echo $jid;?>"><?php echo $description;?></div>						  
						  </div>						  
						</div>
				    </div>
				<?php
				  } 				
				?>
				
				</div>
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