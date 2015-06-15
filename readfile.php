<?php

	$file = 'https://s3-us-west-2.amazonaws.com/sas-userfiles/'.$_REQUEST['name'];
	$filename = $_REQUEST['name']; 
    
	/*
	header('Content-type: application/force-download');
	//header('Content-type: application/pdf');
	header('Content-Disposition: attachment; filename="' . $filename . '"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($file));
	header('Accept-Ranges: bytes');

	@readfile($file);
	*/
	
	header("Content-Disposition: attachment; filename=\"".basename($file)."\"");	
    readfile($file);
    exit;
?>
