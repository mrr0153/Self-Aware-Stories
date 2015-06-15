<?php
 set_time_limit(0);
 require_once("../config/config.inc.php");
 
?>
<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Self-Aware Stories</title>
<link rel="shortcut icon" href="../images/favicon.gif"/>
<meta content='width=device-width, initial-scale=1' name='viewport'/>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,500' rel='stylesheet' type='text/css'><!-- ROBOTO FONT FROM GOOGLE CSS FILE -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/1.10.2jquery.js"></script>

<style>
body{font-family: 'Roboto',arial,helvetica,sans-serif;}

#filelist {
 color:#000;
 list-style-type:disc;
 padding:0px;
 width:50%;
 border:0; 
 border-top: 1px solid #e6e9ee;
 background: #f6f7fb;
 font-family: 'Roboto',arial,helvetica,sans-serif;
 color: #000;
 border-collapse: collapse;
 border-spacing: 5;
}
#filelist td, th { 
 border: 1px solid transparent; /* No more visible border */
 height: 30px; 
 transition: all 0.3s;  /* Simple transition for hover effect */
}

#filelist th {
 background: #DFDFDF;  /* Darken header a bit */
 font-weight: bold;
}
#filelist td{
  text-align: center;
  padding: 5px 0;
  vertical-align: middle;
}
#filelist td a{
color:#000;
}
#filelist a:hover {
  color:#005292;
  text-decoration:underline;
}

</style>

<script>

	$(document).ready(function(){

        var cid=$("#theme").val()
		
	    $.post('getVideosTitle.php',{'cid':cid},function(data){
											
			result=data.split('@@@')	
			
            vId=result[0].split('|||')
            
            vTitle=result[1].split('|||')
            			
			var x=document.getElementById("video");
				x.options.length=0;
				
			for (var i = 0; i < vId.length-1; i++)
			 {
				var option=document.createElement("option");
				option.text=vTitle[i];
				option.value=vId[i];
				
				try
				{
					 // for IE earlier than version 8
				   x.add(option,x.options[null]);
				}
				catch (e)
				{
				   x.add(option,null);
				}
			 }
			 
			 
		});
		
		$('#theme').change(function(){
	   		
		    var cid=$(this).val()
		    			
			$.post('getVideosTitle.php',{'cid':cid},function(data){
											
				result=data.split('@@@')	
				
				vId=result[0].split('|||')
				
				vTitle=result[1].split('|||')
							
				var x=document.getElementById("video");
					x.options.length=0;
					
				for (var i = 0; i < vId.length-1; i++)
				 {
					var option=document.createElement("option");
					option.text=vTitle[i];
					option.value=vId[i];
					
					try
					{
						 // for IE earlier than version 8
					   x.add(option,x.options[null]);
					}
					catch (e)
					{
					   x.add(option,null);
					}
				 }
				 				 
			});
			
		});	
		
		
		$('#generate').click(function(){
			
			var cid=$("#theme").val()
			
			var vid=$("#video").val()
			
			window.location.href="sample.php?cid="+cid+"&vid="+vid;
										
		});
	     
		 
	 });

</script>

</head>
<body style="width: 80%;margin: 0 auto;">
	<br><br>
	<h2 style="color: #005292;text-align:center">Generate Questionnaire Reports </h2>
	
	<table id="filelist" align="center" >
	  
        <tr width="100%" style="background-color:#C1C6CE;color: #005292;">
			<td width="30%" align="right" style="text-align:right">Select Theme &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
			<td width="70%" align="left" style="text-align:left">
				<select id="theme" name="theme" >				
				<?php 
					
					$themesrslt = mysql_query("SELECT * FROM sas_themecategories");
					
					while( $themes = mysql_fetch_array($themesrslt) ){
									
						$catid=$themes['cat_id'];
						$catname=$themes['cat_name'];
				?>   
				   <option value="<?php echo $catid;?>"><?php echo $catname;?></option>
				<?php }?> 
				</select>
			</td>
		</tr>
        
		<tr width="100%" style="background-color:#C1C6CE;color: #005292;">
			<td width="30%" align="right" style="text-align:right">Select Video &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
			<td width="70%" align="left" style="text-align:left">
			    <select id="video" name="video" required>
                <option value="">Select</option>				
				 <?php 
					/*
					$videosrslt = mysql_query("SELECT * FROM sas_videos where cid=$themes[0][cat_id]");
					
					while( $videos = mysql_fetch_array($videosrslt) ){
									
						$vid=$videos['id'];
						$vname=$videos['prod_name'];
				 ?>   
				   <option value="<?php echo $vid;?>"><?php echo $vname;?></option>
				 <?php } */?> 
				</select>
			</td>
		</tr>
		<tr width="100%" style="background-color:#C1C6CE;color: #005292;">
			<td width="30%" align="right" style="text-align:right">&nbsp;</td>
			<td width="70%" align="left" style="text-align:left"><input type="button" id="generate" value="Generate Reports"> </td>
		</tr>	
		
    </table>		
    
	
	
</body>
</html>