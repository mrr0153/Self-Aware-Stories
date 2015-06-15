<?php
 set_time_limit(0);
 require_once("../config/config.inc.php");
 //require_once("generateReports.php");
 
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
<script src="js/ajaxGetPost.js" type="text/javascript"></script>
<script type="text/javascript" src="js/1.10.2jquery.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>
function charts(data,ChartType)
{
	var c=ChartType;
	var jsonData=data;
	google.load("visualization", "1", {packages:["corechart"], callback: drawVisualization});
	
	function drawVisualization() 
	{
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'No. of Questions');
		data.addColumn('number', 'Correct Answers');
		$.each(jsonData, function(i,jsonData)
		{
			var value=jsonData.value;
			var name=jsonData.name;
			data.addRows([ [name, value] ]);
		});

		var options = {
			title : "Reports for Questionnaire",
			colorAxis: {colors: ['#54C492', '#cc0000']},
			datalessRegionColor: '#dedede',
			defaultColor: '#dedede'
		};

		var chart;
		
		chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		
		chart.draw(data, options);
	}
}

$(document).ready(function () 
{
	url='reports_json/questionnaire.json';
	ajax_data('GET',url, function(data)
	{ 		
	  charts(data,"ColumnChart");	
		
	});
});
</script>
<style>
body{font-family: 'Roboto',arial,helvetica,sans-serif;}

#filelist {
 color:#000;
 list-style-type:disc;
 padding:0px;
 width:100%;
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
</head>
<body style="width: 80%;margin: 0 auto;">
	<br><br>
	<h2 style="color: #005292;text-align:center">Questionnaire Reports</h2>
	<?php
					   						 
		$usrdata=mysql_query("select * from sas_users");
		//$resusrdata=mysql_fetch_array($usrdata);
        
        while( $resusrdata=mysql_fetch_array($usrdata) ) {	
 
        // print_r($resusrdata); 
	?>
	
	<!-- <div id="chart_div"></div> -->
	             
	<div class="one" style="padding: 5px 0;">
     <h4 style="background-color: #f6f7fb; padding: 10px 40px;color: #005292;">User Name : <?php echo $resusrdata['username'];?></h4>
	                				   
	<?php
					   						 
		$qtndata=mysql_query("select * from sas_userqtnansws where uid='$resusrdata[user_id]'");
		$count=mysql_num_rows($qtndata);
						 
		if($count>0){
	?>
		<table id="filelist" align="center" >
            <tr width="100%" style="background-color:#C1C6CE;color: #005292;">
				<td width="10%" align="center">S.No</td>					   
				<td width="30%" align="center">Video Name</td>
				<td width="15%" align="center">Video Type</td>
				<td width="15%" align="center">Correct Answers</td>
				<td width="15%" align="center">Wrong Answers</td>
				<td width="15%" align="center">UnAnswered</td>
			</tr>
     <?php					
		
		$sno=1;
						 
		while($resquery = mysql_fetch_array($qtndata)){ 
						
			//extract($resquery);
							
			if( $resquery['vtype'] == 'SV' ){
							
				$videors=mysql_query("SELECT * FROM sas_videos where id=$resquery[vid]");
							   
				$vtype='Situational Video';
			}
			else if( $resquery['vtype'] == 'CV' ){
							
				$videors=mysql_query("SELECT * FROM sas_copvideos where id=$resquery[cvid]");
							   
				$vtype='Coping Video';
			}
														
			$videorrs=mysql_fetch_array($videors);
						 	                           
			$orginaloptns=explode(':',$resquery['originalanswers']);	 	 
							 	
			$selectedoptns=explode(':',$resquery['selectedanswers']);	 
                          
			$correct=0;
			$wrong=0;							
			$notanswered=0;
						    							
			for($i=0;$i < sizeof($orginaloptns);$i++){
							    								
				if( $selectedoptns[$i] ==  $orginaloptns[$i] ){
								
					$correct++;								  
				}
				else if( $selectedoptns[$i] ==  0 ){
                                  
					$notanswered++;
                }
				else if( $selectedoptns[$i] !=  $orginaloptns[$i] ){
								  
					$wrong++;
				}
																
			}							
							
			if($sno%2==0){ 
							
				$bg="#f6f7fb";								
			}
			else {
							
				$bg="#fff";
			}  					
		?>
		    <tr width="100%" style="background-color:<?php echo $bg;?>;">
				<td align="center"><?php echo $sno; ?></td>
				<td  align="center"><?php echo $videorrs['prod_name']; ?></td>
				<td  align="center"><?php echo $vtype; ?></td>
				<td  align="center"><?php echo $correct; ?></td>
				<td  align="center"><?php echo $wrong; ?></td>
				<td  align="center"><?php echo $notanswered; ?></td>
			</tr> 
	<?php 					
			$sno++;				
		}			
	?>
			<tr style="background-color:#C1C6CE;color: #005292;">
				<td  align="center">&nbsp;</td>			   
				<td  align="center">&nbsp;</td>
				<td  align="center">&nbsp;</td>
				<td  align="center">&nbsp;</td>
				<td  align="center">&nbsp;</td>
				<td  align="center">&nbsp;</td>
			</tr>
		</table>	   
	<?php
       }
      else{
    ?>  
	    <table id="filelist" align="center" >
            
            <tr style="background-color:#C1C6CE;color: #005292;">
				<p style="text-align:center;padding:10px 0px;">No Reports available at this point.</p>
			</tr>
			
		</table> 
		
		
	<?php		
        } 
    ?>					
				
   </div>
   
   <?php }?>
   
</body>
</html>