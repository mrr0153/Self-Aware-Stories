<?php
 require_once("../sasadmin/config/config.inc.php");
 require_once("generateReports.php");
?>

<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Google Charts Jquery</title>
<meta content='width=device-width, initial-scale=1' name='viewport'/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
<script src="ajaxGetPost.js" type="text/javascript"></script>

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
			data.addRows([ [name, value]]);
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
	url='questionnaire.json';
	ajax_data('GET',url, function(data)
	{ 
		
		charts(data,"ColumnChart");	
		
	});
});
</script>
<style>
body{font-family:arial}
</style>
</head>
<body style="text-align:center">
<div id="chart_div"></div>

</body>
</html>