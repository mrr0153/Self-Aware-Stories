<?php 
    error_reporting(0);
	session_start();
	require_once("config/config.inc.php");
	
	if(isset($_SESSION['uid'])){
       $uid=$_SESSION['uid'];
	}else{
	   $uid='';
	}
	
	$ans=$_REQUEST['a'];
	$cid=$_REQUEST['cid'];
		
	if(isset($_REQUEST['pid'])){
	   $pid=$_REQUEST['pid']; 
    }
	if(isset($_REQUEST['id'])){
	   $id=$_REQUEST['id'];
    }
	if(isset($_REQUEST['videono'])){
	   $videono=$_REQUEST['videono'];
    }		
	
    $resans=str_replace("undefined",0,$ans);	
	$anwrs=explode('|||',$resans);
	//print_r($anwrs);
    $orginalans=array();	
	
	if($_REQUEST['vtype']=="svideo" ){
	 
	  $ansrs=mysql_query("SELECT * FROM sas_quiz  where vcid='$cid' and vid='$pid'");
	  
	  if(!empty($uid)){
	  
	     $qdata=mysql_query("SELECT * FROM sas_userquiz WHERE uid='$uid' and vcid='$cid' and vid='$pid' and status=1 ") ;
	
	     if(mysql_num_rows($qdata)==0){
		 
		    mysql_query("insert into sas_userquiz(vid,vcid,uid,status) values( '$pid','$cid','$uid',1 ) ") ;
	     }         
	  }
    }
	
	if($_REQUEST['vtype']=="cvideo" ){
	  //echo "from cvideo";
	  $ansrs=mysql_query("SELECT * FROM sas_quiz  where vcid='$cid' and cpvid='$id'");
	  
	  if(!empty($uid)){
	  
	     $qdata=mysql_query("SELECT * FROM sas_userquiz WHERE uid='$uid' and vcid='$cid' and cpvid='$id' and status=1") ;
	 
	     if(mysql_num_rows($qdata)==0){
		 
	         mysql_query("insert into sas_userquiz(cpvid,vcid,uid,status) values( '$id','$cid','$uid',1 ) ") ;	 
	     }		 
	  }
    }
	
	$oas=array();
	$sas=array();
	
	$alloptns[]=array();
	$i=0;  
    while($organs=mysql_fetch_array($ansrs)){
	
       $correctans.=$organs['answer'].'|||';
	   
	   $orginalans[]=$organs['answer'];
  	   		   
	   if( $organs['option1'] == $organs['answer'] ){
	      $oas[] = 1; 
	   }else if($organs['option2'] == $organs['answer'] ){
	      $oas[] = 2; 	   
	   }else if($organs['option3'] == $organs['answer'] ){
	      $oas[] = 3; 
	   }else if($organs['option4'] == $organs['answer'] ){
	      $oas[] = 4; 
       } 
	   	  
		   
	    if( !empty($anwrs[$i]) && $anwrs[$i] !='0' && $organs['option1'] == $anwrs[$i] ){
			   
			$sas[] = 1; 
			     
	    }else if( !empty($anwrs[$i]) && $anwrs[$i] !='0' && $organs['option2'] == $anwrs[$i] ){
			   
			$sas[] = 2; 
			     
		}else if( !empty($anwrs[$i]) && $anwrs[$i] !='0' && $organs['option3'] == $anwrs[$i] ){
			   
			$sas[] = 3; 
			  
		}else if( !empty($anwrs[$i]) && $anwrs[$i] !='0' && $organs['option4'] == $anwrs[$i] ){
			   
			$sas[] = 4; 				  
		       
 		}else if( $anwrs[$i] == '0' && $organs['option1'] !== $anwrs[$i] && $organs['option2'] !== $anwrs[$i] && $organs['option3'] !== $anwrs[$i] && $organs['option4'] !== $anwrs[$i] ){
		        
			$sas[] = 0; 
			   
		}  
		  
	   $explanation.=$organs['opt1expl']."|||".$organs['opt2expl']."|||".$organs['opt3expl']."|||".$organs['opt4expl']."|||||"; 
	   
	   $i++;
	}
	
		
	//print_r($sas);
	
	$orginaloptns='';
	
	for($i=0;$i < sizeof($oas);$i++){
	  
	  if($i < sizeof($oas) - 1){
	     $orginaloptns.=$oas[$i].':';	 
      }else{
         $orginaloptns.=$oas[$i];	 
      }	  
	}
	
	//print_r($sas);
	
	$selectedoptns='';
		
	for($i=0;$i < sizeof($sas);$i++){
	 
	  if($i < sizeof($sas) - 1){
	     $selectedoptns.=$sas[$i].':';	 
      }else{
         $selectedoptns.=$sas[$i];	 
      }	  
	}
	
	
    if($_REQUEST['vtype']=="svideo" ){
	
	  if(!empty($uid)){
	
	     $qtndata=mysql_query("SELECT * FROM sas_userqtnansws WHERE uid='$uid' and vid='$pid' ") ;
	     
	     if(mysql_num_rows($qtndata)==0){	
		 
		    mysql_query("insert into sas_userqtnansws(vno,vid,uid,cid,vtype,selectedanswers,originalanswers) values( '$videono','$pid','$uid','$cid','SV','".addslashes($selectedoptns)."','".addslashes($orginaloptns)."' ) ") ;
	     }
		 else{
		    $rqtndata=mysql_fetch_array($qtndata);
			//print_r($rqtndata);
		    mysql_query("update sas_userqtnansws set selectedanswers = '".addslashes($selectedoptns)."', originalanswers = '".addslashes($orginaloptns)."' where vid='$pid' and id='$rqtndata[id]' ") or die(mysql_error());
		 }		
	  }
	}

	if($_REQUEST['vtype']=="cvideo" ){
	
	  if(!empty($uid)){
	
	     $qtndata=mysql_query("SELECT * FROM sas_userqtnansws WHERE uid='$uid' and cvid='$id' ") ;
	     
	     if(mysql_num_rows($qtndata)==0){	
		 
		    mysql_query("insert into sas_userqtnansws(vno,cvid,uid,cid,vtype,selectedanswers,originalanswers) values( '$videono','$id','$uid','$cid','CV','".addslashes($selectedoptns)."','".addslashes($orginaloptns)."' ) ") ;
	     }
		 else{
		    $rqtndata=mysql_fetch_array($qtndata);
		    mysql_query("update sas_userqtnansws set selectedanswers = '".addslashes($selectedoptns)."', originalanswers = '".addslashes($orginaloptns)."' where cvid='$id' and id='$rqtndata[id]' ") ;
		 }		
	  }
	}
	
	for($i=0;$i<sizeof($orginalans);$i++){
	  
	   if( $orginalans[$i] == $anwrs[$i] ){
	   
		  $rightans.=$i+1 ."|||";
	   }
	   else{
	     
          $wrongans.=$i+1 ."|||"; 
	   }

	 }
	 echo $rightans.'*****'.$wrongans.'*****'.$explanation.'*****'.$correctans;  
      
?>