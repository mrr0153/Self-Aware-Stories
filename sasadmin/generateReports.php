<?php
  require_once("../config/config.inc.php");

  $reportdata=mysql_query("select * from sas_userqtnansws where  uid='$_REQUEST[uid]'");
  
  $count=mysql_num_rows($reportdata);
  
  $datails=array();
      
  if($count>0){
      
	  $vcount=1;
	  
	  while( $rslt=mysql_fetch_array($reportdata)){
	     
		 $crtsv1=0;
		 $wrgsv1=0;
		 
	     $sansrd=explode(':',$rslt['selectedanswers']);
		 $cansrd=explode(':',$rslt['originalanswers']);	
		 
		 $noqtns=4;	
		 
		 for($i=0;$i<$noqtns;$i++){
		    
		    if( $sansrd[$i] == $cansrd[$i] ){
		        			
			    $crtsv1++;			 
		    }
		 }  
		 
		 if( $rslt['vtype'] == 'SV'){
		   	   
			//$vdata=mysql_query("select * from sas_videos where id='$rslt[vid]'");
			//$vrslt=mysql_fetch_array($vdata);			   		   		   
		    //$vname=$vrslt['prod_name'];
			
			$vname='SV'.$vcount;
			   
		 }else if( $rslt['vtype'] == 'CV'){
		   	   
			//$vdata=mysql_query("select * from sas_copvideos where id='$rslt[cvid]'");
			//$vrslt=mysql_fetch_array($vdata);			   		   		   
		    //$vname=$vrslt['prod_name'];
			
			$vcount=$vcount-1;
            $vname='CV'.$vcount;				   
		 }
		   
		 $datails[]=array('code' => "$noqtns",'value' => $crtsv1,'name' => $vname ); 
		   
		 $vcount++;
          		 
	  }
	  
		  for($i=$count;$i<=10;$i++){
			  
			  if($i==1){
			  }else{
			    $svname='SV'.$i;
			  }
			  $cvname='CV'.$i;
			 
			  if($i==1){
			  }else{
			    $datails[]=array('code' => "4",'value' => 0,'name' => $svname);
			  }
			   
			  $datails[]=array('code' => "4",'value' => 0,'name' => $cvname ); 
		  }	  
	  
   
   }else{
   
       for($i=1;$i<=10;$i++){
	      
		  $svname='SV'.$i;
		  $cvname='CV'.$i;
		  
		  $datails[]=array('code' => "4",'value' => 0,'name' => $svname); 
		  $datails[]=array('code' => "4",'value' => 0,'name' => $cvname); 
	   }
   
   }
      
   $json=json_encode($datails);
	  
   $myfile = fopen("reports_json/questionnaire.json", "w");
  
   file_put_contents("reports_json/questionnaire.json",$json);	
	  
?>