<?php

  require_once("config/config.inc.php");
  
  $rss_table = array(); 
  $query = mysql_query("SELECT * FROM sas_themecategories");
    while($values_query = mysql_fetch_assoc($query))
    {
        $rss_table [] = array(
        'catid' => $values_query['cat_id'],
        'catname' => $values_query['cat_name']        
        );
    }

  $doc = new DOMDocument(); 
  $doc->formatOutput = true;
  $doc->encoding = "utf-8";

  $r = $doc->createElement( "theme" ); 
  $doc->appendChild( $r ); 

   //$i=0;
    foreach( $rss_table as $rss ) 
    { 
		$b = $doc->createElement( "categories" );
			$catid = $doc->createElement( "catid" ); 
			$catid->appendChild( 
			$doc->createTextNode( $rss['catid'] ) 
			); 
		$b->appendChild( $catid ); 


		$catname = $doc->createElement( "catname" ); 
		$catname->appendChild( 
		$doc->createTextNode( $rss['catname'] ) 
		); 
		$b->appendChild( $catname );
		
		$r->appendChild( $b );
    }
	
$doc->saveXML();
$doc->save("xml/categories.xml") 

?>