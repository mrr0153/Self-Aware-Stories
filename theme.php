<?php
  session_start();
  error_reporting(0);

  require_once("config/config.inc.php");

  if(isset($_REQUEST['cid'])){
     $cid=$_REQUEST['cid'];
  }
 
  $qry="select * from sas_themecategories where cat_id='$cid' order by cat_id desc limit 0,1";
  $rslt=mysql_query($qry) or die(mysql_error()); 
  while($rslt && $rlt=mysql_fetch_array($rslt))
  {
	//print_r($rlt);
	extract($rlt);
  }		 
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<title>Self-Aware Stories : <?php echo $cat_name; ?></title>
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>

<!----- Popup start --->
<link rel="stylesheet" href="js/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!----- Popup end --->

<!---- comment script start --->
<link rel="stylesheet"  href="css/elements.css" />
<script src="js/my_js.js"></script>	
<link rel="stylesheet"  href="css/question.css" />

<script>
 $(document).ready(function(){
    	 
	 $('#fulltitle2').css("display","none");
		 
	 var cid=document.getElementById('cid').value
	 $("#prev").css("display","none");
	 $("#next").css("display","block");
	 
	 function loading_show2(){
		$('#loading2').html("<img src='images/loading.gif'/>").fadeIn('fast');
	 }
	 function loading_hide2(){
		$('#loading2').fadeOut('fast');
	 } 
	 
	 loading_show2();
	 
     $.post("getvideos.php?qs=init&cid="+cid,{},function(data){ 
	    
		loading_hide2();
	    $("#bottom-videos").html(data).hide().fadeIn(500);	
     });
	 
	 $("#prev").click(function(){
	      
		  function loading_show2(){
			$('#loading2').html("<img src='images/loading.gif'/>").fadeIn('fast');
		  }
		  function loading_hide2(){
			$('#loading2').fadeOut('fast');
		  } 
	 
		  loading_show2(); 
		  
	   	  var prev=$(this).attr('data-id')
		  var cid=document.getElementById('cid').value
		  
		  $.post("getvideos.php?qs="+prev+"&cid="+cid,{},function(data){ 
		  
		     loading_hide2();
		     $("#bottom-videos").html(data).hide().fadeIn(500);	
		     $("#prev").css("display","none");
	         $("#next").css("display","block");
		  });		 
     });
	 
	 $("#next").click(function(){
	 
	      function loading_show2(){
			$('#loading2').html("<img src='images/loading.gif'/>").fadeIn('fast');
		  }
		  function loading_hide2(){
			$('#loading2').fadeOut('fast');
		  } 
	 
		  loading_show2(); 
		  
	      var cid=document.getElementById('cid').value
	      var next=$(this).attr('data-id')
		 
		  $.post("getvideos.php?qs="+next+"&cid="+cid,{},function(data){ 
		      loading_hide2();
			  $("#bottom-videos").html(data).hide().fadeIn(500);	
			  $("#next").css("display","none");
			  $("#prev").css("display","block");	   
		  });
		 
     });
	
	 function loading_show(){
		$('#loading').html("<img src='images/loading.gif'/>").fadeIn('fast');
	 }
	 function loading_hide(){
		$('#loading').fadeOut('fast');
	 } 
	 
	 loading_show();
	
	 $.post("getcategories1.php?start=&limit=&type=&vcatid=<?php echo $_REQUEST['cid'];?>",{},function(data){ 
	     
	     loading_hide();	
         $("#navig").html(data).hide().fadeIn(500);			 	 
		 var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');		 
	     $("#navside li a[href='theme.php?"+hashes[0]+"']").addClass("active");			 
     });
	 
	 $("#cancel").click(function(){
	 
         document.getElementById('abc').style.display = "none";  
	 });
	 
     $("#cancel2").click(function(){
	 
         document.getElementById('abc2').style.display = "none";  
	 });
	
	 $("#cancel5").click(function(){
	 
         document.getElementById('abc5').style.display = "none";  
	 });
	
	 $("#cancel3").click(function(){
	 
         document.getElementById('abc3').style.display = "none";  
	 });
	
	 $("#cancel4").click(function(){
	 
         document.getElementById('abc4').style.display = "none";  
	 });
	
	 $("#cancel41").click(function(){
	 
         document.getElementById('abc41').style.display = "none";  
	 });
	
	 $.post("getprogress.php?vcid=<?php echo $_REQUEST['cid']; ?>",{},function(data){ 
	     //alert(data)
	     document.getElementById("propercent").innerHTML=data;
	     //$('#propercent').innerHTML=data;
	     $('#probar').css('width',data); 
	     $('#probar').css('background-color','#99A607');
     });	    
	 
  });   
   		 
 
</script>
<script>
function validateUser(id,vtype,vno){

  // alert('pid='+pid+',id='+id+',cvtype='+cvtype+',vno='+vno)
  
  var uid="<?php if(isset($_SESSION['uname'])) echo $_SESSION['uname']; ?>";  
  var userid="<?php if(isset($_SESSION['uid'])) echo $_SESSION['uid']; ?>";  
  var cid=document.getElementById('cid').value;
  
  $.post("getvideocount.php?vcid=<?php echo $_REQUEST['cid']; ?>",{},function(data){ 
   
    t=data.trim();
	//alert('data='+data)
	
	var a = t.split("|||")
	var rows=a[0];
	var count=a[1];
	
	var statuss='';
	
	if(count==0){
	   statuss='Please watch Situational Video 1';
	}
	else if(count==1){
	   statuss='Please watch Coping Video 1';
	}
	else if(count==1.5){
	   statuss='Please watch Situational Video 2';
	}
	else if(count==2){
	   statuss='Please watch Coping Video 2';
	}
	else if(count==2.5){
	   statuss='Please watch Situational Video 3';
	}
	else if(count==3){
	   statuss='Please watch Coping Video 3';
	}
	else if(count==3.5){
	   statuss='Please watch Situational Video 4';
	}
	else if(count==4){
	   statuss='Please watch Coping Video 4';
	}
	else if(count==4.5){
	   statuss='Please watch Situational Video 5';
	}
	else if(count==5){
	   statuss='Please watch Coping Video 5';
	}
	else if(count==5.5){
	   statuss='Please watch Situational Video 6';
	}
	//alert(statuss)
    $('#status1').html(statuss)
	
    if(vtype==1){
	   //alert("vtype= free") 	   
	   window.location.href='video.php?cid=<?php echo $cid;?>&pid='+id;	   	
   
    }else{ 
        // alert("vctype= not free") 
	    if(uid){
	  	
		  if(count == 0 ){
	         // alert("count=0")
	         if(vno==1){
			 
		       window.location.href='video.php?cid=<?php echo $cid;?>&pid='+id;			
		     }	
 		     else{		  
		       //alert('Please watch previous video')
			   document.getElementById('abc2').style.display = "block";		  
		     }
			 
		  }else if(count > 0) {
		  
		     // alert('count > 0')
		     var vcount= parseFloat(count) + parseFloat(0.5)
		     //alert(vcount)
		   
			 if( vno == vcount  ){	 
		       	// alert(vno +'=='+ vcount)
				window.location.href='video.php?cid=<?php echo $cid;?>&pid='+id;
				
			 } else if( vno > vcount ){			   
			   //alert('Please watch previous video')
			   document.getElementById('abc2').style.display = "block";	
			   
			 }else {
			
			   window.location.href='video.php?cid=<?php echo $cid;?>&pid='+id;
			 }		
		  }
		  
	   }else{
	   
	       //alert('Please login/singup to access this video.');
	       document.getElementById('abc').style.display = "block";	  
	   }
    }
   
   });
  
 }
 
 function validateUser2(pid,id,cvtype,vno){
 
  // alert('pid='+pid+',id='+id+',cvtype='+cvtype+',vno='+vno)
  
  var uid="<?php if(isset($_SESSION['uname'])) echo $_SESSION['uname']; ?>";  
  var userid="<?php if(isset($_SESSION['uid'])) echo $_SESSION['uid']; ?>";
  var cid=document.getElementById('cid').value;   
    
  $.post("getvideocount.php?vcid=<?php echo $_REQUEST['cid']; ?>",{},function(data){ 
   
    t=data.trim(); 
	//alert('data='+data)
	
	var a = t.split("|||")
	var rows=a[0];
	var count=a[1];
	
	var statuss='';
	
	if(count==0){
	   statuss='Please watch Situational Video 1';
	}
	else if(count==1){
	   statuss='Please watch Coping Video 1';
	}
	else if(count==1.5){
	   statuss='Please watch Situational Video 2';
	}
	else if(count==2){
	   statuss='Please watch Coping Video 2';
	}
	else if(count==2.5){
	   statuss='Please watch Situational Video 3';
	}
	else if(count==3){
	   statuss='Please watch Coping Video 3';
	}
	else if(count==3.5){
	   statuss='Please watch Situational Video 4';
	}
	else if(count==4){
	   statuss='Please watch Coping Video 4';
	}
	else if(count==4.5){
	   statuss='Please watch Situational Video 5';
	}
	else if(count==5){
	   statuss='Please watch Coping Video 5';
	}
	else if(count==5.5){
	   statuss='Please watch Situational Video 6';
	}
	//alert(statuss)
    $('#status1').html(statuss)
	
    if(cvtype==1){
      //alert("cvtype= free")  
      if(uid){
	    
	    if(count >= 1){
	      //alert("count>= 1")
	       if(vno>count){
		      //alert("vno>count")		   			
			  window.location.href='copingvideo.php?cid='+cid+'&pid='+pid+'&id='+id;			 
		   }else{
		     //alert("vno<count")
		     window.location.href='copingvideo.php?cid='+cid+'&pid='+pid+'&id='+id;
		   }		   
		 }
		 else{
		     //alert('Please watch previous video')
		     document.getElementById('abc2').style.display = "block";
		 }
	  }else {
	 
	      window.location.href='copingvideo.php?cid='+cid+'&pid='+pid+'&id='+id;
	  }	
	  
   }else {
       // alert("vctype= not free") 
	  
	    if(uid){
	  
		  if(count == 0 ){
	         // alert("count=0")
	         if(vno==1){		  
		       //  alert("vno==1")		    			
		       window.location.href='copingvideo.php?cid='+cid+'&pid='+pid+'&id='+id;			
		     }	
 		     else{		  
		       //alert('Please watch previous video')
			   document.getElementById('abc2').style.display = "block";		  
		     }
			 
		  } else if(count > 0) { 
		     //alert('count > 0')
		     var vcount= parseFloat(count) + parseFloat(0.5)
			
			 if( vno == vcount ){
			 				
				window.location.href='copingvideo.php?cid='+cid+'&pid='+pid+'&id='+id;			   
			 }
			 else if( vno > vcount ){			 
			     //alert('Please watch previous video')
			    document.getElementById('abc2').style.display = "block";			   
			 } 
			 else{			
			    window.location.href='copingvideo.php?cid='+cid+'&pid='+pid+'&id='+id;
			 }	 
		  } 
		
	    }else{	  
	      //alert('Please login/singup to access this video.');
	      document.getElementById('abc').style.display = "block";	  
	    }
   }
  
  });
  
 }
 
function getpop(id){
  
   $('#fulltitle2').css("display","block");
   document.getElementById('fulltitle2').innerHTML=id;
}
function hidepop(id){
   //alert('leaved')
   $('#fulltitle2').css("display","none");
  
}
	
</script>

<script>
 
 function morefun(id,limit){ 
  
  $.post("getcategories1.php?start="+id+"&limit=more&type='more'&vcatid=<?php echo $_REQUEST['cid']; ?>",{},function(data){ 
	 
	 document.getElementById("navig").innerHTML=data;
	 
	 var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');		
	 $("#navside li a[href='theme.php?"+hashes[0]+"']").addClass("active");
	 
  });
 
 }
 
 function lessfun(id,limit){ 
 
   $.post("getcategories1.php?start="+id+"&limit=less&type='less'&vcatid=<?php echo $_REQUEST['cid']; ?>",{},function(data){ 
	 
	  document.getElementById("navig").innerHTML=data;
	 
	  var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');		
	  $("#navside li a[href='theme.php?"+hashes[0]+"']").addClass("active");
	 
   });
 
 }

 function funlike(rel,id){	
 
	var ID = rel+id;	
	var New_ID=id;
	var rel2 = $('#'+ID).attr("rel");
	//alert(rel+"--"+id+"--"+rel2)
	var URL='videocat_like_ajax.php';
	var dataString = 'vcid=' + New_ID +'&rel='+ rel2;
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
			success: function(html){ //alert('count='+html)
			   //alert(rel2)   
				if(rel2=='Like'){ 
				  //alert(rel2+'==Like')        		
				  $('#'+ID).attr('rel', 'Unlike').attr('title', 'Unlike').html('Theme Liked');
				  $("#likescnt").html(html)
				  $("#likeimg").attr('src','images/unlike.png')
						  
				}else {  //alert(rel2+'==Unlike')
				
				  $('#'+ID).attr('rel', 'Like').attr('title', 'Like').html('Like this Theme');
				  $("#likescnt").html(html)
				  $("#likeimg").attr('src','images/like.png')		  		  
				
				}			  
			}
	    });  
    }  
 }


 function testfun(id,vtype,vno){
 
   //alert('vid = '+id+' -- vtype = '+vtype+'-- vno = '+vno)
   var uid="<?php if(isset($_SESSION['uname'])) echo $_SESSION['uname']; ?>";
   var userid="<?php if(isset($_SESSION['uid'])) echo $_SESSION['uid']; ?>";  
   var cid=document.getElementById('cid').value;
   var quizstatus='<?php echo $quizstatus;?>';
	 
   $.post("getvideocount.php?vcid=<?php echo $_REQUEST['cid']; ?>",{},function(data){ 
   
		t=data.trim();
		//alert(t)
		var a = t.split("|||")
		var rows=a[0];
		var count=a[1];
		
		var statuss='';
		
		if(count==0){
		   statuss='Please watch Situational Video 1';
		}
		else if(count==1){
		   statuss='Please watch Coping Video 1';
		}
		else if(count==1.5){
		   statuss='Please watch Situational Video 2';
		}
		else if(count==2){
		   statuss='Please watch Coping Video 2';
		}
		else if(count==2.5){
		   statuss='Please watch Situational Video 3';
		}
		else if(count==3){
		   statuss='Please watch Coping Video 3';
		}
		else if(count==3.5){
		   statuss='Please watch Situational Video 4';
		}
		else if(count==4){
		   statuss='Please watch Coping Video 4';
		}
		else if(count==4.5){
		   statuss='Please watch Situational Video 5';
		}
		else if(count==5){
		   statuss='Please watch Coping Video 5';
		}
		else if(count==5.5){
		   statuss='Please watch Situational Video 6';
		}
		//alert(statuss)
		$('#status1').html(statuss)
		
		if(vtype==1){
		 
			if(uid){
			   //alert("count="+count)    
			   if(count == 0){
			   // alert("count="+count)     
				 if( vno > count ){
			  
				   var URL='getuservideocount.php';
				   var dataString = 'uid=' + userid +'&vcid='+cid ;
				   //alert(dataString)
				   $.ajax({
					   type: "POST",
					   url: URL,
					   data: dataString,
					   cache: false,
					   success: function(html){
						  // alert('count='+html)
						  document.getElementById("propercent").innerHTML=html;
						  $('#probar').css('width',html); 
						  $('#probar').css('background-color','#99A607');
					   }			 
				    });			 
				 }
			   
				 if(quizstatus==1){
				  
				    window.location.href='video.php?cid=<?php echo $cid;?>&pid='+id;	          		     
				 }else {
				  /*
				   $.fancybox({		    
					 type: 'inline',
					 content: $('#vquestions').html(),
					 afterClose: function() { 
					 
					   window.location.href='video.php?cid=<?php echo $cid;?>&pid='+id;
					 }			
				   });	
				   */
					window.location.href='video.php?cid=<?php echo $cid;?>&pid='+id;
				 }		   
				
			  }else{
				 //alert('quizstatus='+quizstatus)
				  if(quizstatus==1){
				  
					 window.location.href='video.php?cid=<?php echo $cid;?>&pid='+id;	          		     
				  }else {
				   /*
				    $.fancybox({		    
					  type: 'inline',
					  content: $('#vquestions').html(),
					  afterClose: function() { 
					
						window.location.href='video.php?cid=<?php echo $cid;?>&pid='+id;
					  }			
				    });
				   */
				    window.location.href='video.php?cid=<?php echo $cid;?>&pid='+id;				   
				  }       
			  }     
					
		   }else {
		   
			  document.getElementById('abc').style.display = "block";
		   }
		   
		}else {		
		    //alert("vctype= not free") 	  
		    if(uid){
			  // alert("count = "+count+", vno = "+vno)
			  if(count == 0 ){
							
				if(vno==1){			  
				  	   			
				  if(quizstatus==1){
				  
					 window.location.href='copingvideo.php?cid='+cid+'&pid='+pid+'&id='+id;	 
					 
				  }else {
					/*
					 $.fancybox({		    
						type: 'inline',
						content: $('#vquestions').html(),
						afterClose: function() { 
					  
						  window.location.href='copingvideo.php?cid='+cid+'&pid='+pid+'&id='+id; 
						}			
					 });
				   */
				    window.location.href='copingvideo.php?cid='+cid+'&pid='+pid+'&id='+id;				   
				  }		    			
				}	
				else{		  
					 // alert('Please watch previous video')
					 document.getElementById('abc2').style.display = "block";		  
				}
			  
			  }else if( count > 0 ) { 
				  // alert('count='+count +' > 0')
				  
				  var vcount= parseFloat(count) + parseFloat(0.5)
				  
				  //alert('vno = '+vno+'  ==  vcount = '+vcount)
				  
				  if( vno == vcount ){
					 // alert('vno = '+vno+'  ==  vcount = '+vcount)
					 document.getElementById('abc41').style.display = "block";
										
				  }else if( vno > vcount ){					
					 //alert('Please watch previous video')
					 document.getElementById('abc41').style.display = "block";
					 
				  }else if( vno < vcount ){					 
					 //alert('Please watch previous video')
					 document.getElementById('abc41').style.display = "block";			   
				  } 			
			  } 
			
		    }else {	  
				//alert('Please login/singup to access this video.');
				document.getElementById('abc').style.display = "block";	  
		    }
	    }  
	   
   });
   
 }
 
 function empty_sv_qtnr(id,vtype,vno){ 
   
   var uid="<?php if(isset($_SESSION['uname'])) echo $_SESSION['uname']; ?>";
   
   if(uid){
   
       document.getElementById('abc41').style.display = "block";
	  
   }else{
   
       document.getElementById('abc').style.display = "block"; 
   }
   
 }  
 function empty_cv_qtnr(id,vtype,vno){ 
   
   var uid="<?php if(isset($_SESSION['uname'])) echo $_SESSION['uname']; ?>";
   
   if(uid){
   
       document.getElementById('abc41').style.display = "block";
	  
   }else{
   
       document.getElementById('abc').style.display = "block"; 
   }
   
 }  
  
 
 function sv_qtnr(cid,svid,vtype,vno){
 
  //alert('cid = '+ cid+ ',svid = '+ svid+',vtype = '+vtype+',vno = '+vno);
      
  var uid="<?php if(isset($_SESSION['uname'])) echo $_SESSION['uname']; ?>";
  var userid="<?php if(isset($_SESSION['uid'])) echo $_SESSION['uid']; ?>";  
  var cid=document.getElementById('cid').value;
  var quizstatus='<?php echo $quizstatus;?>';
  
  $.post("getvideocount.php?vcid=<?php echo $_REQUEST['cid']; ?>",{},function(data){ 
   
		t=data.trim();
		//alert(t)
		var a = t.split("|||")
		var rows=a[0];
		var count=a[1];
		
		var statuss='';
		
		if(count==0){
		   statuss='Please watch Situational Video 1';
		}
		else if(count==1){
		   statuss='Please watch Coping Video 1';
		}
		else if(count==1.5){
		   statuss='Please watch Situational Video 2';
		}
		else if(count==2){
		   statuss='Please watch Coping Video 2';
		}
		else if(count==2.5){
		   statuss='Please watch Situational Video 3';
		}
		else if(count==3){
		   statuss='Please watch Coping Video 3';
		}
		else if(count==3.5){
		   statuss='Please watch Situational Video 4';
		}
		else if(count==4){
		   statuss='Please watch Coping Video 4';
		}
		else if(count==4.5){
		   statuss='Please watch Situational Video 5';
		}
		else if(count==5){
		   statuss='Please watch Coping Video 5';
		}
		else if(count==5.5){
		   statuss='Please watch Situational Video 6';
		}
		//alert(statuss)
		$('#statuss').html(statuss)		
		
		//alert("count = "+count) 
		if(vtype==1){
		   //alert("vtype = free")  
		   if(uid){
			 
			 if(count == 0){
				 
			   if(vno>count){
				 //  alert('vno='+vno+" > count="+count)			   
				 $.post('get_sv_qsnr.php',{'cid':cid,'svid':svid,'vno':vno},function(data){
			 
					 $.fancybox({		    
					   type: 'inline',
					   content: $('#svquestions').html(data)					
					 });				   
				 });		   
			   }
				
			 }else{
				    $.post('get_sv_qsnr.php',{'cid':cid,'svid':svid,'vno':vno},function(data){
			 
					   $.fancybox({		    
					     type: 'inline',
					     content: $('#svquestions').html(data)					
					   });				  
				    });
			 }	   
					
		   }else {
		  
			  $.post('get_sv_qsnr.php',{'cid':cid,'svid':svid,'vno':vno},function(data){
			 
				  $.fancybox({		    
					 type: 'inline',
					 content: $('#svquestions').html(data)					
				  });
			 });
		   }
		 
	    }else { 
	   
			 //alert('vtype= Not free')	
			 
			if(uid){
			 
			  if(count == 0 ){
				//alert('count='+count+' == 0')
				
				if(vno==1){		  
				  //alert("vno==1")
			   
				    $.post('get_sv_qsnr.php',{'cid':cid,'svid':svid,'vno':vno},function(data){
			 
					   $.fancybox({		    
						  type: 'inline',
						  content: $('#svquestions').html(data)					
					   });			    
				    });
										
				}else {		  
				   //alert('Please watch previous video')
				   document.getElementById('abc4').style.display = "block";		  
				}
			  
			  }else if( count > 0 ) {
			   
				//alert('count='+count+' > 0')
				
				var vcount= parseFloat(count) + parseFloat(0.5)
				
				//alert('vno='+vno +' ,  vcount='+ vcount)	
				  
				if( vno == vcount  ){	 
					
				  //alert('vno='+vno +' ==  vcount='+ vcount)	
				  
				  if( vno < 2 ){
				  
					  $.post('get_sv_qsnr.php',{'cid':cid,'svid':svid,'vno':vno},function(data){
				 
						  $.fancybox({		    
							 type: 'inline',
							 content: $('#svquestions').html(data)					
						  });						 
					  });
					  
				  }else{
				   
					 document.getElementById('abc41').style.display = "block";	
				  }
				  
				}else if( vno > vcount ){
				
				   // alert(vno +'>'+ vcount)
				   //alert('Please watch previous video')
				   document.getElementById('abc41').style.display = "block";
				   
				}else if(vno < vcount) {
				
				   // alert(vno +'<'+ vcount)
				  
				   $.post('get_sv_qsnr.php',{'cid':cid,'svid':svid,'vno':vno},function(data){
				 
					   $.fancybox({		    
						  type: 'inline',
						  content: $('#svquestions').html(data)					
					   });						 
				   });				
				}
				
			  }	
			  
			}else{	  
				 //alert('Please login/singup to access this video.');
				 document.getElementById('abc5').style.display = "block";	  
			}
		}
	   
	  });    
 }
 
 function cv_qtnr(cid,cvid,cvtype,vno){
  //alert('cid = '+ cid+ ',cvid = '+ cvid+',cvtype = '+cvtype +',vno = '+vno);
   
  var uid="<?php if(isset($_SESSION['uname'])) echo $_SESSION['uname']; ?>";  
  var userid="<?php if(isset($_SESSION['uid'])) echo $_SESSION['uid']; ?>";
  var cid=document.getElementById('cid').value;
  var quizstatus='<?php echo $quizstatus;?>';
  //alert(quizstatus) 
   
  $.post("getvideocount.php?vcid=<?php echo $_REQUEST['cid']; ?>",{},function(data){ 
   
		t=data.trim(); 
		//alert('data='+data)
		
		var a = t.split("|||")
		var rows=a[0];
		var count=a[1];
		
		var statuss='';
		
		if(count==0){
		   statuss='Please watch Situational Video 1';
		}
		else if(count==1){
		   statuss='Please watch Coping Video 1';
		}
		else if(count==1.5){
		   statuss='Please watch Situational Video 2';
		}
		else if(count==2){
		   statuss='Please watch Coping Video 2';
		}
		else if(count==2.5){
		   statuss='Please watch Situational Video 3';
		}
		else if(count==3){
		   statuss='Please watch Coping Video 3';
		}
		else if(count==3.5){
		   statuss='Please watch Situational Video 4';
		}
		else if(count==4){
		   statuss='Please watch Coping Video 4';
		}
		else if(count==4.5){
		   statuss='Please watch Situational Video 5';
		}
		else if(count==5){
		   statuss='Please watch Coping Video 5';
		}
		else if(count==5.5){
		   statuss='Please watch Situational Video 6';
		}
		//alert(statuss)
		$('#statuss').html(statuss)	
		
	    if(cvtype==1){
		 //alert("cvtype = free")  
		 if(uid){	
		 
		   if(count >= 1){
			// alert("count>= 1")
			  if(vno>count){			  
			  // alert("vno>count")
			   $.post('get_cv_qsnr.php',{'cid':cid,'cvid':cvid,'vno':vno},function(data){
			 
				   $.fancybox({		    
					 type: 'inline',
					 content: $('#cvquestions').html(data)					
				   });				  
			   });
			  
			  }else {
			  
			    $.post('get_cv_qsnr.php',{'cid':cid,'cvid':cvid,'vno':vno},function(data){
			 
				   $.fancybox({		    
					 type: 'inline',
					 content: $('#cvquestions').html(data)					
				   });				  
			    });	
			  }
			   
		   }else {
			   //alert('Please watch previous video')
			   document.getElementById('abc2').style.display = "block";
		   }
			
		 }else {	
		 
			$.post('get_cv_qsnr.php',{'cid':cid,'cvid':cvid,'vno':vno},function(data){
			 
				$.fancybox({		    
					type: 'inline',
					content: $('#cvquestions').html(data)					
				});
			});
		 }
		 
	  }else {
		  //alert("cvtype = not free") 		  
		  if(uid){
		    //alert("vno = "+vno+',count='+count)
			if(count == 0 ){			 
			   //alert("vno = "+vno+',count='+count)			   
			  if(vno==1){			  
			  // alert("vno==1")			   
			    $.post('get_cv_qsnr.php',{'cid':cid,'cvid':cvid,'vno':vno},function(data){
			 
				   $.fancybox({		    
					 type: 'inline',
					 content: $('#cvquestions').html(data)					
				   }); 				   
			    });
								
			  }else if(vno>count){
				  //alert("vno = "+vno+' > count='+count)
				  document.getElementById('abc4').style.display = "block";
			   
			  }else {				 
				 //alert('Please watch previous video')
				 document.getElementById('abc4').style.display = "block";			  
			  }			  
			
			}else if(count > 0) { 
			    //alert('count > 0')
				var vcount= parseFloat(count) + parseFloat(0.5)
				 //alert(vno+' == '+ vcount)
				if( vno == vcount ){
				  
				   $.post('get_cv_qsnr.php',{'cid':cid,'cvid':cvid,'vno':vno},function(data){
						
					   $.fancybox({		    
						 type: 'inline',
						 content: $('#cvquestions').html(data)					
					   }); 					 
				   });
							
				}else if( vno > vcount ){
				 
				   //alert('Please watch previous video')
				   document.getElementById('abc4').style.display = "block";				   
				}else{

					 $.post('get_cv_qsnr.php',{'cid':cid,'cvid':cvid,'vno':vno},function(data){
			 
						$.fancybox({		    
							type: 'inline',
							content: $('#cvquestions').html(data)					
						});
					 });
				 }	 
				
			}		
			
		  }else {
		  
		     //alert('Please login/singup to access this video.');
		     document.getElementById('abc5').style.display = "block";		  
		  }
	  }
	  
   });
 
 }
 
 
</script>

</head>
<body id ="bdy">
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
				<!-- <li><a href="tour.php">Tour</a></li> -->
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
				<h4><a href="myjournal.php" target="_blank"><?php if(isset($_SESSION['uname'])) echo "My Journal";?></a></h4>
			 </div>
		   </div>
		</div>
		<!--main navigation wrapper ends -->
	  </header>
	  <!-- header ends-->
      <div class="container">
        <div id="navig">              
          <div id="loading"></div>	      
		</div>
		<section class="one-half1">			
          <!--  <h2><a href="#"> <img src="images/play.png"></img></a></h2> -->
	      <?php 
		    if(!empty($vcode)){ ?>
			  <iframe id="catvideo" name="catvideo" src="//player.vimeo.com/video/<?php echo $vcode;?>" width="100%" height="auto" frameborder="0" ></iframe>
          <?php
			}else { ?>
			  <img src="images/play.png"></img>
		  <?php } ?>						
		</section>				
       </div>    
		<!--layer slider ends-->
	   <div id="content">
			<div id="breadcrumb"><!-- breadcrumb starts-->
				<div class="container">
					<div class="one-half">
						<!--	<h4>Theme : Feedback is your Friend</h4> -->
						<h4>Theme :&nbsp;<?php echo $cat_name;?></h4>
					</div>
					<div class="one-half">
						<nav id="breadcrumbs"><!--breadcrumb nav starts-->
							<ul>
								<li>You are here:</li>
								<li><a href="index.php">Home</a></li>
								<li><?php echo $cat_name;?></li>						
							</ul>
						</nav><!--breadcrumb nav ends -->
					</div>
				</div>
			</div>
		   <!--breadcrumbs ends --><!--home intro ends-->
		 <div class="container">
			<div class="one">
			  <?php
			    if(isset($_SESSION['uid'])){
			  ?>
				<div class="progressbar">				
					<div class="progressbar-left"><p><span style="font-weight:bold;">Progress</span> (<span id="propercent"></span>)</p></div>
					<div class="progressbar-right">
					  <div id="probar">&nbsp;</div>	
					</div>	
				</div>
			  <?php }	?>
			    <div class="theme-desc-header" >
				   <div class="theme-desc-header-left">
				      <h4>Theme Description</h4>	
				   </div>
				
				   <div class="theme-desc-header-right">				
				      <div class="theme-like" id="videolike">
					   <?php
						
					   if(!empty($_SESSION['uid'])){
						
						$uid=$_SESSION['uid'];
						
						$q=mysql_query("SELECT like_id FROM video_like WHERE uid_fk='$uid' and vcid_fk='$cat_id' ");
						
						if(mysql_num_rows($q)==0)
						{ ?>
						
						<img id="likeimg" src="images/like.png" style="margin-bottom: -2px;height: 15px;">
						<a href="javascript:void(0);" class="like" id="like<?php echo $cat_id;?>" title="Like" rel="Like" onclick="funlike('like','<?php echo $cat_id;?>'); return false;" style='color: #005292;'> Like this Theme</a> <?php if($like_count>0){  echo " (<span id='likescnt'>".$like_count."</span>)";} ?>
						
						<?php }	else { ?>
						
						<img id="likeimg" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;">
						<a href="javascript:void(0);" class="like" id="ulike<?php echo $cat_id;?>" title="Unlike" rel="Unlike" onclick="funlike('ulike','<?php echo $cat_id;?>'); return false;" style='color: #005292;'> Theme Liked</a> <?php if($like_count>0){  echo " (<span id='likescnt'>".$like_count."</span>)";} ?>
						
						<?php } } else{ ?>	
						
						<img id="likeimg" src="images/unlike.png" style="margin-bottom: -2px;height: 15px;">
						<a href="javascript:void(0);" class="like" id="ulike<?php echo $cat_id;?>" title="Unlike" rel="Unlike" onclick="funlike('ulike','<?php echo $cat_id;?>'); return false;" style='color: #005292;'> Like this Theme</a> <?php if($like_count>0){  echo " (<span id='likescnt'>".$like_count."</span>)";} ?>
						<?php
						  }
						 ?>				   
				      </div>
				 	  <div class="theme-timeline" >
						 <p><a href="video-comments.php?cid=<?php echo $_REQUEST['cid']?>"><img src="images/discuss_button.png"></a> &nbsp;&nbsp;&nbsp;&nbsp; <a class="d-block" href="javascript:void(0);"><img src="images/timeline_button.png"></a><p> 
					  </div>
					  
				    </div>
				
			    </div> 
			
			   
			   
				<div class="themedescription">
					<p>	<?php echo $catdesctiption;?> </p>
				</div>		 
				Tags :
				<div class="tag1">
					<ul>
						<li><a href="#">Self, </a></li>
						<li><a href="#">Aware, </a></li>
						<li><a href="#">Stories</a></li>
					</ul>
				</div>			
			   
				<br><br>
				
				<div id="fulltitle" >
				  <span id="fulltitle2" > </span>
				</div>
				
				<input type="hidden" id="cid" value="<?php echo $cid; ?>">
				
				<div class="videos-container" >
				
				  <div class="left-arrow-side">
					  <div class="left-arrow-side-top">
						<img src="images/ar1.png">
					  </div>
					  <div class="left-arrow-side-bottom">
					    <img src="images/prev.png" id="prev" data-id="prev">
					  </div>
				  </div>
				  
				  <div class="videos-div">
				      <div id="loading2"></div>
					  <div class="videos-top-title"><h4>Situational Videos </h4></div>
					  <div id="bottom-videos"></div>
					  <div class="videos-bottom-title"><h4>Coping Videos </h4></div>
				  </div>
				  <div class="right-arrow-side">
				      <div class="right-arrow-side-top">
						<img src="images/next.png" id="next" data-id="next" >
					  </div>
					  <div class="right-arrow-side-bottom">		  
						<img src="images/ar2.png">
					  </div>		 	
				  </div>					
				</div>		
				
			</div>
			
			<!--- Theme TimeLine --->
			<div id="popuptext<?php echo $i;?>" style="display:none;"> 
			   <div class="popup-content">				 
				  <iframe src='http://cdn.knightlab.com/libs/timeline/latest/embed/index.html?source=<?php echo $timeline;?>&font=Rancho-Gudea&maptype=toner&lang=en&height=650' width='100%' height='650' frameborder='0'></iframe>
			   </div>
			</div>
				  
            <!--- Bottom Videos --->
		    <div id="svquestions" style="display:none;">  </div>
	        <div id="cvquestions" style="display:none;">  </div>
		    <!--- Bottom Videos --->
		  
			<div id="abc">
				<div id="popupContact" style="font-size: 12px;"> 
					<script>
						$(document).ready(function(){

						   $("#login").click(function( e ) {
									
							  //alert('hi');							
							  e.preventDefault();
									
							  uname=$(this).siblings("#username").val();
							  pwd=$(this).siblings("#password").val();
									
							  //alert('uname = '+uname+',pwd = '+pwd)
									
							  if(uname && pwd){
							  
								 $.post("verify_user.php?uname="+uname+"&pwd="+pwd,{},function(data){
									 //alert(data)
									 if(data=="correct"){							  
										
										document.getElementById('abc').style.display="none";
										location.reload();
										
									 }else {
									 
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
						<h6 style="text-align: center;padding-top: 8px;font-size: 14px;line-height: 7px;color:#005292;">Please login to watch this video!</h6><hr/>
						<span id="error" style="color: red;font-weight: normal;font-size: 14px;"></span>
						<input type="text" name="username" id="username" placeholder="User Name" style="margin: 0 auto;"/>
						<br>	
						<input type="password" name="password" id="password" placeholder="Password" style="margin: 0 auto;"/>
						<br>				
						<input type="submit" id="login" onclick="check_empty()" value="Login" style="width: 37%;font-size: 14px;">	
						&nbsp;&nbsp;&nbsp;<input type="button" id="cancel"  value="Cancel" style="width: 37%;font-size: 14px;">							
					</form>
				</div>
			</div>
					   
			<div id="abc5">
				<div id="popupContact" style="font-size: 12px;"> 
					<script>
						$(document).ready(function(){

							$("#login5").click(function( e ) {
									
								//alert('hi');							
								e.preventDefault();
									
								uname=$(this).siblings("#username5").val();
								pwd=$(this).siblings("#password5").val();
									
								//alert('uname = '+uname+',pwd = '+pwd)
									
								if(uname && pwd){
									
									$.post("verify_user.php?uname="+uname+"&pwd="+pwd,{},function(data){
									//alert(data)
										if(data=="correct"){							  
											
										   document.getElementById('abc5').style.display="none";
										   location.reload();
										   
										}else {
											  document.getElementById('error5').innerHTML="Enter correct login details";
										}							
									 });
										
								 }else {

									 document.getElementById('error5').innerHTML="Please enter login details";
								 }
									 
							  });
								 
						});							
					</script>
							
					<form id="popupform" action="#" method="post" id="form" >								
						<h6 style="text-align:center;padding-top: 8px;font-size: 14px;line-height: 7px;color:#005292;">Please login to answer this questionnaire !</h6><hr/>
						<span id="error5" style="color: red;font-weight: normal;font-size: 14px;"></span>
						<input type="text" name="username" id="username5" placeholder="User Name" style="margin: 0 auto;"/>
						<br>	
						<input type="password" name="password" id="password5" placeholder="Password" style="margin: 0 auto;"/>
						<br>				
						<input type="submit" id="login5" onclick="check_empty()" value="Login" style="width: 37%;font-size: 14px;">	
						&nbsp;&nbsp;&nbsp;<input type="button" id="cancel5"  value="Cancel" style="width: 37%;font-size: 14px;">							
					</form>
				</div>
			</div>
					   
			<div id="abc2" >
				<div id="popupContact2" style="font-size: 12px;"> 
					<div id="popupform" >
						<h6 style="text-align:center;padding-top: 8px;font-size: 14px;line-height: 7px;color:#005292;" id="status1" ></h6><hr/>
						<p style="text-align:center;"><input type="button" id="cancel2"  value="Close" style="width: 37%;font-size: 14px;"></p>
					</div>		
				</div>
			</div>
					  
			<div id="abc3">
				<div id="popupContact3" style="font-size: 12px;"> 
					<script>
					    $(document).ready(function(){

							$("#login3").click(function( e ) {									
								//alert('hi');							
								e.preventDefault();
								uname=$(this).siblings("#username3").val();
								pwd=$(this).siblings("#password3").val();
								//alert('uname = '+uname+',pwd = '+pwd)
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
					<form id="popupform" action="#" method="post" id="form" >
						<h6 style="text-align:center;padding-top: 8px;font-size: 14px;line-height: 7px;color:#005292;">Please login to like this Theme!</h6><hr/>
						<span id="error3" style="color: red;font-weight: normal;font-size: 14px;"></span>
						<input type="text" name="username" id="username3" placeholder="User Name" style="margin: 0 auto;"/>
						<br>	
						<input type="password" name="password" id="password3" placeholder="Password" style="margin: 0 auto;"/>
						<br>				
						<input type="submit" id="login3" onclick="check_empty()" value="Login" style="width: 37%;font-size: 14px;">	
						&nbsp;&nbsp;&nbsp;<input type="button" id="cancel3"  value="Cancel" style="width: 37%;font-size: 14px;">							
					</form>
				</div>
			</div>
			
			<div id="abc4" >
				<div id="popupContact2" style="font-size: 12px;"> 
					<div id="popupform" >
					   <h6 style="text-align:center;padding-top: 8px;font-size: 14px;line-height: 7px;color:#005292;" id="statuss" ></h6><hr/>
					   <p style="text-align:center;"><input type="button" id="cancel4"  value="Close" style="width: 37%;font-size: 14px;"></p>
					</div>		
				</div>
			</div>
			<div id="abc41" >
				<div id="popupContact2" style="font-size: 12px;"> 
					<div id="popupform" >
						<h6 style="text-align:center;padding-top: 8px;font-size: 14px;line-height: 7px;color:#005292;"  > This Video is Unavailable for the Pilot.</h6><hr/>
						<p style="text-align:center;"><input type="button" id="cancel41"  value="Close" style="width: 37%;font-size: 14px;"></p>
					</div>		
				</div>
			</div>
		  </div>
		    
		  
		  <div class="home-intro"><!-- home intro starts -->
			 <div class="container">			 
				<div class="footer-widget-left">
				    <h4><a href="signup.php">Subscribe</a></h4>
				</div>
				<div class="footer-widget-right">
					<div class="footer-widget-feedback">
					   <a href="javascript:void(0);" class="button grey huge round">Feedback</a>
					</div>
					<div class="footer-widget-feedback">
					   <a href="javascript:void(0);" class="button grey huge round">Buy Now</a>
					</div>
				</div>
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