<?php
	session_start();
	require_once("config/config.inc.php");
	require_once("getthemecategories.php");
	
	if(isset($_REQUEST['cid'])){
	   $cid=$_REQUEST['cid'];
	}    	
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>Self-Aware Stories : Video Comments</title>
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
<link rel="stylesheet"  href="css/question.css" />

<script src="js/my_js.js"></script>	
	
<script src="js/comment_script2.js"></script>
<!---- comment script end --->
<script> 
$(document).ready(function(){
    	
    $(".edit-comment-div").css("display","none"); 
				
    $("#cancel").click(function(){	    
		$("#abc").css("display","none"); 	     	   		  	 
    });
    
	$("#cancel3").click(function(){	    
		$("#abc3").css("display","none"); 	     	   		  	 
    });
	   
	/********** Forum ************/
	
	function loading_show(){
       $('#loading').html("<img src='images/loading.gif' width='50px' height='50px'/>").fadeIn('fast');
    }
    function loading_hide(){
       $('#loading').fadeOut('fast');
    }   
		
	var vcid='<?php echo $_REQUEST['cid'];?>';
	
	var vtitle=$('#videotitles').val()
	$(".vcomments").css("margin-bottom","100px")
	
	function loadData(page){
	    
		loading_show();
	
		$.post('getforumcomments.php',{"page":page,'vcid':vcid,'cid':vcid},function(data){
				loading_hide();
				//alert(data)
				$("#forumcomments").empty().html(data)
                $(".vcomments").css("margin-bottom","0px")				
		});		
	}
	
	loadData(1);  // For first time page load default results
	
	/********Pagination**********/
			
	
	$('.themeradio').click(function(){
	   
		var cids='';
		loading_show();
		
		$("#notheme").css('display','none')
		$("#nocomment").css('display','none')
		
		var k = $("input:checkbox[class=themeradio]:checked").length
		//alert(k)
		
		l=1;
		
		$("input:checkbox[class=themeradio]:checked").each(function () {
				
			if(l<k){
			   cids += $(this).val() + '|||';
			}else{
               cids += $(this).val()
            }
			
			l++;	
		});
		 		
		$.post('getforumcomments.php',{"page":1,'cids':cids,'cid':vcid},function(data){
	        
			loading_hide();					
			$("#forumcomments").empty().html(data)
		});
				
	});	
	
	
    	
});
</script>

<script>
 function del_commnet(id){
	 //alert(id)
	 
	if(confirm("Are you sure to delete this comment?"))
	{
		$.post("del_comment.php?id="+id,{},function(){
	   
	         location.reload();	 
	    });
	}
	 
 }
 
 function getComment(){
 
     var comment = document.getElementById('comment').value;
	 	
	 $.post("save_comment.php?comment="+comment,{},function(data){ 	});	 
 }
 
 function div_show(){ 
    				
	 var uid="<?php if(isset($_SESSION['uname'])) echo $_SESSION['uname']; ?>";	  
     
     if(uid){	  
	    //alert('set');	
     }else{
      
	   document.getElementById('abc').style.display = "block";	   
     }   
 }
 
</script>
<script type="text/javascript">

 function funlike(rel,cmtid,vid,type) 
 {	//alert("rel="+rel+"--cmtid="+cmtid+"--vid="+vid+"--type="+type)	
	var ID = rel+cmtid;	
	var New_ID=vid;
	var rel2 = $('#'+ID).attr("rel");
	//alert(rel+"--"+id+"--"+rel2)
	//alert(rel2)
	 var URL='comment_like_ajax.php';
	
	var dataString = 'vid=' + vid +'&cmtid=' + cmtid +'&rel='+ rel2+'&type='+ type;
	var userid="<?php if(isset($_SESSION['uid'])){echo $_SESSION['uid'];}?>";
	
	if(userid == null || userid==""){
	
	  document.getElementById('abc3').style.display = "block";	
	}
	else{
	
		$.ajax({
		type: "POST",
		url: URL,
		data: dataString,
		cache: false,
		success: function(html){ 
		
		   // alert('count='+html)
			//alert("#likescnt"+cmtid)
			if(rel2=='Like')
			{ //alert(rel2+'==Like')        		
			  $('#'+ID).attr('rel', 'Unlike').attr('title', 'Unlike');
			  $("#likescnt"+cmtid).html(html)
			  $("#likeimg"+cmtid).attr('src','images/unlike.png')
			}
			else
			{  //alert(rel2+'==Unlike')
			  $('#'+ID).attr('rel', 'Like').attr('title', 'Like');
			  $("#likescnt"+cmtid).html(html)
			  $("#likeimg"+cmtid).attr('src','images/like.png')
			}
		  
		}
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
				<a href="index.php" id="logo"><img src="images/logo.png" alt="" width="110" height="auto"/></a>
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
           <?php
											
				$qry="select * from sas_themecategories where cat_id='$cid' ";
				$rslt=mysql_query($qry); 
				$rlt=mysql_fetch_array($rslt);
				
				extract($rlt);			   
			?>			
           </div>    
		<!--layer slider ends-->
		<div id="content"><br><br>
		   <div class="container">
		       <h4 style="padding-left: 20px; text-align:center; font-family: Showers; color: #005292;"><?php echo $rlt['cat_name'];?></h4>
               <div id="breadcrumb"><!-- breadcrumb starts-->
				    
					<div class="one-half">
					<!--	<h4>Theme : Feedback is your Friend</h4> -->
					<!--<h4 style="padding-left: 20px;">Theme :&nbsp;<?php echo $rlt['cat_name'];?></h4>-->
					</div>
					<div class="one-half" style="width: 100%;padding-bottom: 5px;">
						<nav id="breadcrumbs"><!--breadcrumb nav starts-->
						<ul style="padding-right: 20px;">
							<li>You are here:</li>
							<li><a href="index.php">Home</a></li>
						    <li><?php echo $cat_name;?></li>
						    <li>Forum</li>
						</ul>
						</nav><!--breadcrumb nav ends -->
					</div>
				</div>
			</div>
            <!--breadcrumbs ends --><!--home intro ends-->
		  <div class="container">
	      <div class="one">
		   <!--
		   <div class="vcommentlist">		   
		      <input type="text" name="vtitle" id="vtitle" placeholder="Select a Video Forum...">
			  <div id="update2">	</div>		   		   
		   </div>
		   -->
		   
	       <div class="vcommentlist">
		    <!--
		      <select id="videotitles" name="videotitles">
			  <?php
			    $sql="SELECT * FROM sas_videos WHERE cat_id = $cid ";
				$result = mysql_query($sql) or die(mysql_error());				
				$vtitles='';
				while($row = mysql_fetch_array($result)) {
					
					$vtitles.=stripslashes($row['prod_name']). "||||";	
			  ?>
			    <option><?php echo stripslashes($row['prod_name']); ?></option>
			  <?php } ?>
			  </select>
			-->
			<?php 
			
			 $filepath="xml/categories.xml";
			 $myXMLData=file_get_contents($filepath);
			 $xml = simplexml_load_string($myXMLData);
			 $json = json_encode($xml);
			 $array = json_decode($json,TRUE);
			
			 for($i=0;$i<sizeof($array['categories']);$i++){
					
				$catid=$array['categories'][$i]['catid'];
				$catname=$array['categories'][$i]['catname'];				
			
			?>
			   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="themeradio" name="themeradio[]" value="<?php echo $catid; ?>" <?php if(isset($_REQUEST['cid']) && $_REQUEST['cid'] == $catid ){ echo "checked"; }?> > <?php echo $catname; ?><br>
			<?php
 			 } 
			?>
		   </div>
		   
		   <div class="vcomments" >
            <div class="vcomments-block">
             <div class="comment-content">	
			   <div style="width:100%;float:left;">			    
				<h4>Comments</h4>				
			   </div>
			   
			   <div id="loading" style="text-align:center;margin:0px;"> </div>
			   <div id="forumcomments"> </div>	   
				               
			   <div id="abc">
				 <div id="popupContact" style="font-size: 12px;"> 
				   <script>
					 $(document).ready(function(){

						$("#login").click(function( e ) {
							
							//alert('hi');							
							e.preventDefault();
							
							uname=$(this).siblings("#username").val();
							pwd=$(this).siblings("#password").val();
							
							
							if(uname && pwd){
							
							   $.post("verify_user.php?uname="+uname+"&pwd="+pwd,{},function(data){
									//alert(data)
									if(data=="correct"){							  
									
									  document.getElementById('abc').style.display="none";
									  location.reload();
									}
									else{
									  document.getElementById('error').innerHTML="Enter correct login details";
									}							
							    });
								
							}else {

                               document.getElementById('error').innerHTML="Please enter login details";
                            }
							 
					     });
						 
	                  });
					
					</script>
					<!-- contact us form -->
						<form id="popupform" action="#" method="post" id="form" >
						
							<h6 style="text-align:center;padding-top: 8px;font-size: 14px;line-height: 7px;color:#005292;">Please login to comment on this forum!</h6><hr/>
							<span id="error" style="color: red;font-weight: normal;font-size: 14px;"></span>
							<input type="text" name="username" id="username" placeholder="User Name" style="margin:0 auto;" />
							<br>
							<input type="password" name="password" id="password" placeholder="Password" style="margin:0 auto;" />
							<br>				
							<input type="submit" id="login" onclick="check_empty()" value="Login" style="width: 37%;font-size: 14px;">	
                            &nbsp;&nbsp;&nbsp;<input type="button" id="cancel"  value="Cancel" style="width: 37%;font-size: 14px;">							
						</form>
				 </div>
               </div> 				 
               
			   <div id="abc3">
				 <div id="popupContact3" style="font-size: 12px;"> 
				   <script>
					 $(document).ready(function(){

						$("#login3").click(function( e ) {
							
							//alert('hi');							
							e.preventDefault();
							
							uname=$(this).siblings("#username").val();
							pwd=$(this).siblings("#password").val();
							
							
							if(uname && pwd){
							
									$.post("verify_user.php?uname="+uname+"&pwd="+pwd,{},function(data){
										//alert(data)
										if(data=="correct"){							  
										
										  document.getElementById('abc3').style.display="none";
										  location.reload();
										  
										}else {
										
										  document.getElementById('error3').innerHTML="Enter correct login details";
										}								
									}); 
									
							}else {

                                 document.getElementById('error3').innerHTML="Please enter login details";
                            }
							 
					     });
						 
	                  });
					
					</script>
					<!-- contact us form -->
						<form id="popupform" action="#" method="post" id="form" >
						
							<h6 style="text-align:center;padding-top: 8px;font-size: 14px;line-height: 7px;color:#005292;">Please login to like/reply to comments!</h6><hr/>
							<span id="error3" style="color: red;font-weight: normal;font-size: 14px;"></span>
							<input type="text" name="username" id="username" placeholder="User Name" style="margin:0 auto;" />
							<br>	
							<input type="password" name="password" id="password" placeholder="Password" style="margin:0 auto;" />
							<br>				
							<input type="submit" id="login3" onclick="check_empty()" value="Login" style="width: 37%;font-size: 14px;">	
                            &nbsp;&nbsp;&nbsp;<input type="button" id="cancel3"  value="Cancel" style="width: 37%;font-size: 14px;">							
						</form>
				 </div>
               </div>
				
				</div>
			</div>	   
			</div>		
		<div class="horizontal-line"></div>	
		</div>
		<br>
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