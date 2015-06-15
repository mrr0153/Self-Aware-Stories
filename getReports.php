  <?php
		
	session_start();
	require_once("config/config.inc.php");
    error_reporting(0);			
	
	$cid=$_REQUEST['cid'];
		   
	if(isset($_SESSION['uid'])){
					     						 
		$qtndata=mysql_query("select * from sas_userqtnansws where uid='$_SESSION[uid]' and cid='$cid'") or die(mysql_error());
		$count=mysql_num_rows($qtndata);
						 
		if($count>0){
  ?>
		<table width="100%" id="filelist" >
           <tr width="100%" style="background-color:#C1C6CE;color: #005292;">
			<td width="6%" align="center">S.No</td>					   
			<td width="30%" align="center">Video Name</td>
			<td width="15%" align="center">Video Type</td>
			<td width="10%" align="center">Correct Answers</td>
			<td width="10%" align="center">Wrong Answers</td>
			<td width="10%" align="center">Not Answered</td>
		   </tr>
  <?php					
		$sno=1;
						 
		while($resquery = mysql_fetch_array($qtndata)){ 
							
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
		
		<p style="text-align:center;padding:120px 0px;">No Reports available at this point.</p> 
   <?php		
       } 
	}	
   ?>	