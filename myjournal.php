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
<title>Self-Aware Stories : My Journal</title>
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

	$( 'textarea#description' ).ckeditor();
	
	$( 'textarea#description2' ).ckeditor();
    
	$( '#div2' ).css('display','none');
	
    $(".myjournal-edit").click(function(){
	    
		//alert(".myjournal-edit")
		
	    $('#div1').css('display','none');
		$('#div2').css('display','block');
		
	    var jid=$(this).attr('data-id')
		
        $('#prevjid').val(jid)	
		
        ttl=$("#topictitle"+jid).val() 
		
        $( '#topictitle2' ).val(ttl)		
		
		desc=$("#p-myjournal"+jid).html()
		
		//alert('desc = '+desc)
		
		$( 'textarea#description2' ).val(desc)	
				
		//alert('ttl = '+ttl+' jid = '+jid+' desc = '+desc)		        
		
        $('html, body').animate({
				scrollTop: $('#content').offset().top
		},1500);
		
			
    });
	
	/******* edit form ********/
	$("#form2").submit(function( e ) {
			
      e.preventDefault();
			
	  ttl=$('#topictitle2').val() 	
			
	  jid=$('#prevjid').val()
						
	  desc= $('textarea#description2').val()
						
	  $('#submit2').val('Saving...').attr('disabled', 'disabled');
			
	  //alert('jid = '+jid+' desc = '+desc+' ttl = '+ttl)
						
	  $.post('edit_post.php?jid='+jid+"&desc="+desc+"&ttl="+ttl,{},function(data){
			    	
		  res = data.split("|||||");  
								
		  $("#p-title"+res[0]).html(res[1])
		  $("#topictitle"+res[0]).val(res[1])
		  $("#p-myjournal"+res[0]).html(res[2])
					
		  $('#form2').trigger('reset');
		  $("#topictitle2").val('')	
		  $('textarea#description2').val('')
		  $("textarea#description2").html('').trigger('reset');	
		  $('#submit2').val('Save').removeAttr('disabled');
					
		  $('html, body').animate({
				 scrollTop: $("#myjournalblock"+res[0]).offset().top
		  },1500);
			   		 
	  });	
           
      $( '#div2' ).css('display','none');
      $( '#div1' ).css('display','block');			
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
	        <div class="myjournal-block" >
			   <div class="myjournal-block" >
			   <div  class="myjournal-block-wel" >
			     <p>Hey <span><?php if(isset($_SESSION['uname'])) { echo ucfirst($_SESSION['uname']);}?></span>, this space is so you can take notes for your reference. Write away!  </p>
			   </div>
			   </div>
			   <div id="div1" class="myjournal-block" >
				   <form id="form1" method="post" action="">
					   <h4 style="color:#005292">Topic Title :</h4><input type="text" name="topictitle" ><br>
				       <textarea class="ckeditor" cols="50" id="description" name="description" rows="10"></textarea><br>
					   <input type="hidden" id="prevjid" name="prevjid" value="">
					   <input type="submit" id="submit" value="Save"> 
				   </form>
			   </div>
			   
			   <div id="div2" class="myjournal-block" >
				   <form id="form2" method="post" action="">
					   <h4 style="color:#005292">Topic Title :</h4><input type="text" name="topictitle2" id="topictitle2"><br>
					   <textarea class="ckeditor" cols="50" id="description2" name="description2" rows="10"></textarea><br>
					   <input type="hidden" id="prevjid" name="prevjid" value="">
					   <input type="submit" id="submit2" name="submit2" value="Save"> 
				   </form>
			   </div>
			 </div>
		  </div>  
         </div>
		 <div id="breadcrumb1"><!-- breadcrumb starts-->
			<div class="container">
				<div class="one-half myjrnal-title">
					<h4>Self Aware Stories</h4>
				</div>
				<div class="one-half myjrnal-title">
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
		  <div class="container">
		  <div class="one">
		   <div class="myjournal-block" >
            <div class="myjournal-content">	
			 <div class="myjournal-content-header">
			    <div class="myjournal-content-header-left">
				   <h4>My Journal</h4>
				</div>
				<div class="myjournal-content-header-right" id="sort-post">
				   <?php if(isset($_GET['sort']) and $_GET['sort']=='asc'){ ?>
				     <a href="myjournal.php?sort=desc"><img id="sort-img" data-id="" src="images/up.jpg"></a>
				   <?php } else {?>
				     <a href="myjournal.php?sort=asc"><img id="sort-img" data-id="" src="images/down.jpg" ></a>
				   <?php } ?>
				</div>
			 </div> 
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
			<div class="allnotes">				
				<?php 				
				 $comment_query = mysql_query("SELECT * FROM sas_myjournal WHERE uid =".$_SESSION['uid']." order by date $query");
				 // echo mysql_num_rows($comment_query);
				  while($comment = mysql_fetch_array($comment_query)){ 
				  extract($comment);				 
				?>
				   <div class="myjournal-item" id="myjournalblock<?php echo $jid;?>">						
						<div class="myjournal-post" >
						  <div class="myjournal-post-div">
						    <div class="myjournal-post-left" >							  
								 <?php 
								  if(isset($topictitle)){ ?>
								 <h6 style="color:#005292" id="p-title<?php echo $jid;?>"><?php echo $topictitle ;?></h6>
								 <input type="hidden" name="topictitle" id="topictitle<?php echo $jid;?>" data-title="" value="<?php echo $topictitle ;?>">
								 <?php }?>							  
							</div>  
							<div class="myjournal-post-right" style="font-size:10px;">							
							<a class="myjournal-edit" href="javascpt:void(0);" data-id="<?php echo $jid;?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="javascript:del_commnet(<?php echo $jid; ?> )">Delete</a>
							&nbsp;&nbsp;&nbsp;<?php echo $date;?> 
							</div>
						  </div></br>
                          <div style="width:100%">
                            <div class="p-myjournal" id="p-myjournal<?php echo $jid;?>"><?php echo $description;?></div>						  
						  </div>						  
						</div>
				    </div>
				<?php
				  } 				
				?>
			 </div>
			 
             <div class="horizontal-line"></div>
		   </div>
          </div>		   
		  </div>  
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