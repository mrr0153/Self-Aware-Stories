<?php
//session_start();

$filepath="xml/categories.xml";
$myXMLData=file_get_contents($filepath);
$xml = simplexml_load_string($myXMLData);
$json = json_encode($xml);
$array = json_decode($json,TRUE);

$_SESSION['categories']=array();

for($i=0;$i<sizeof($array['categories']);$i++){
    
   $catid=$array['categories'][$i]['catid'];
   $catname=$array['categories'][$i]['catname'];
   
   $_SESSION['categories'][$catid]=$catname;
}

//print_r($_SESSION['categories']);

?>
