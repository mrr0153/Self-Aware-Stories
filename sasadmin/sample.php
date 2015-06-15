<?php
    set_time_limit(0);
	
    require_once("../config/config.inc.php");
    
	// $usrdata=mysql_query("select * from sas_users where user_id in (96,97,98,99)");
	
	$usrdata=mysql_query("select * from sas_users");
	
	$result='';
			
    while( $resusrdata=mysql_fetch_array($usrdata) ) {
		
		$qtndata=mysql_query("select * from sas_userqtnansws where uid=$resusrdata[user_id] and vtype='SV' and vid='$_REQUEST[vid]' and cid='$_REQUEST[cid]'");
		$count=mysql_num_rows($qtndata);
			
		$sno=1;
				
		while($resquery = mysql_fetch_array($qtndata)){ 
		 
			$correct=0;
			$wrong=0;							
			$notanswered=0;
			
            if(mysql_num_rows($qtndata)>0){		
			
				//extract($resquery);
							
				if( $resquery['vtype'] == 'SV' ){
									   
					$vtype='Situational Video';
				}
				else if( $resquery['vtype'] == 'CV' ){
									   
					$vtype='Coping Video';
				}
							
				$orginaloptns=explode(':',$resquery['originalanswers']);									
				$selectedoptns=explode(':',$resquery['selectedanswers']);	 
																			
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
			}else{
			
			  $correct='Not Attempted';
			  $wrong='';							
			  $notanswered='';
			}
			
			$cvqtndata=mysql_query("SELECT * FROM sas_userqtnansws where uid=$resusrdata[user_id] and vno=$resquery[vid] and vtype='CV' ");
			$cvresquery=mysql_fetch_array($cvqtndata);
			
			$cvcorrect=0;
			$cvwrong=0;							
			$cvnotanswered=0;
			
			if(mysql_num_rows($cvqtndata)>0){
			
				$cvorginaloptns=explode(':',$cvresquery['originalanswers']);									
				$cvselectedoptns=explode(':',$cvresquery['selectedanswers']);
								
				for($i=0;$i < sizeof($cvorginaloptns);$i++){
																		
					if( $cvselectedoptns[$i] ==  $cvorginaloptns[$i] ){
										
						$cvcorrect++;								  
					}
					else if( $cvselectedoptns[$i] ==  0 ){
										  
						$cvnotanswered++;
					}
					else if( $cvselectedoptns[$i] !=  $cvorginaloptns[$i] ){
										  
						$cvwrong++;
					}																
				}			
		    }else{
			
			  $cvcorrect='Not Attempted';
			  $cvwrong='';							
			  $cvnotanswered='';
			}
		  
		  $sno++; 

		  $result .= $resusrdata['username']." \t ".$resusrdata['first_name']." \t ".$resusrdata['last_name']." \t ".$correct." \t ".$wrong." \t ".$notanswered." \t ".$cvcorrect." \t ".$cvwrong." \t ".$cvnotanswered." \t \n";
		}
	   
	}
	$header = " \t  \t  \t  \t SV \t  \t  \t CV \t  \t \n";
	$header .= "User Name \t First Name \t Last Name \t Correct \t Wrong \t UnAnswered \t Correct \t Wrong \t UnAnswered \t";
	
    	
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=export.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	print "$header\n$result";
		

?>