 <?php
     
	require_once("config/config.inc.php");

    $qs=$_REQUEST['qs'];
	$cid=$_REQUEST['cid'];
			
	if($qs=="next"){
		$start=5;
		$end=5;
		$i=$start+1;
	}
	else if($qs=="prev"){
		$start=0;
		$end=5;
		$i=1;
	}
	else if($qs=="init") {
		$start=0;
		$end=5;
		$i=1;
	}
			
    $qry="select * from sas_videos where cat_id='$cid' order by id asc limit ".$start.",".$end;
    $rslt=mysql_query($qry); 
	//echo mysql_num_rows($rslt);
	$constant=0.5;
	$constant2=1;
	$vcount=1;
						
	while($rslt && $rlt=mysql_fetch_array($rslt))
	{
		//print_r($rlt);
		extract($rlt);
        //echo $vcount+$constant;
			 
 ?> 			
			<ul id="portfolio-container"  data-ul="<?php echo $i;?>">
			
					<li class="isotope-item" data-categories="design print" >
					
						<div class="item-wrapp">
						   <div class="videos" >
							 
							  <input type="hidden" id="cid" value="<?php echo $cid;?>">
							  <?php
							    if(!empty($vcode)){
								  //$image = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vcode.php"));
								  //$img=$image[1]['thumbnail_medium'];															  
							  ?>
								<div class="portfolio-item" >
								    <a href="javascript:void(0);" onclick="validateUser('<?php echo $id;?>','<?php echo $vtype;?>','<?php echo $vcount; ?>')"><?php if(isset($prod_image)){ ?><img src='https://s3-us-west-2.amazonaws.com/sas-productimages/<?php echo $prod_image;?>' frameborder="0" > <?php }else{?><img src='images/portfolio/portfolio-item-1.jpg' frameborder="0" ><?php } ?></a> 
								</div>
								<div class="portfolio-item-title">
								    <a href="javascript:void(0);" onclick="validateUser('<?php echo $id;?>','<?php echo $vtype;?>','<?php echo $vcount; ?>')" onmouseover="getpop('<?php echo "SV".$i." : ".stripslashes($prod_name);?>')"  ><?php echo "SV".$i." : ".stripslashes(substr($prod_name,0,10))."..";?></a>	
								   <?php 
									    if($vtype=='1'){ 
								   ?>
									<div><span class="vtype">Free</span></div>
								   <?php }?>
								</div>								
								<?php }else { ?>
								<div class="portfolio-item" >								   
									<a href="javascript:void(0);" onclick="testfun('<?php echo $id;?>','<?php echo $vtype;?>','<?php echo $vcount; ?>')" ><?php if(!empty($prod_image)){ ?><img src='https://s3-us-west-2.amazonaws.com/sas-productimages/<?php echo $prod_image;?>' frameborder="0" > <?php }else{?><img src='images/portfolio/portfolio-item-1.jpg' frameborder="0" ><?php } ?></a>
								</div>
								<div class="portfolio-item-title">
									<a href="javascript:void(0);" onmouseover="getpop('<?php echo "SV".$i." : ".stripslashes($prod_name);?>')" onmouseout="hidepop('<?php echo $id;?>')" aref="<?php echo $id;?>"><?php echo "SV".$i." : ".stripslashes(substr($prod_name,0,10))."..";?></a>
								    <?php 
									   if($vtype=='1'){  ?>
									<div><span class="vtype">Free</span></div>
									 <?php }?>	
								</div>								
								<?php 
								}
								?>								
						   </div>	
						</div>
						<div class="qtnr-div">
							<?php
							
							   if(!empty($vcode)){
							?>		
							<span class="sv-qtnr-div" >
							  <a href="javascript:void(0);" onclick="sv_qtnr(<?php echo $cid;?>,<?php echo $rlt['id'];?>,<?php echo $vtype; ?>,'<?php echo $vcount; ?>')"  ><?php echo "SV".$i." : ";?>Questionnaire</a>
							</span>
							<?php }else{ ?>
							<span class="sv-qtnr-div" >
							  <a href="javascript:void(0);" onclick="empty_sv_qtnr()"  ><?php echo "SV".$i." : ";?>Questionnaire</a>
							</span>						
							<?php }?>
					    </div>	
					</li>
					<?php
					$qry2="select * from sas_copvideos where cat_id='$cid' and prod_id='$id' ";
					$rslt2=mysql_query($qry2) or die(mysql_error()); 
					$rlt2=mysql_fetch_array($rslt2);
					
					 //print_r($rlt);
					 //extract($rlt);
                     $vcode2=$rlt2['vcode'];
					 $cvtype=$rlt2['cvtype']
					?>
					
					<li class="isotope-item" data-categories="design print" v-count="<?php echo $vcount+$constant; ?>">
					
						<div class="item-wrapp">
						      <div class="videos">	
							  
							  <?php
							    if(!empty($vcode2)){
								  //$image = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vcode2.php"));
								  //$img=$image[1]['thumbnail_medium'];															  
							  ?>
								<div class="portfolio-item" >								  
									<a href="javascript:void(0);"  onclick="validateUser2('<?php echo $rlt2['prod_id'];?>','<?php echo $rlt2['id'];?>','<?php echo $cvtype;?>','<?php echo $vcount+$constant; ?>')" ><?php if($prod_image){ ?><img src='https://s3-us-west-2.amazonaws.com/sas-productimages/<?php echo $prod_image;?>' frameborder="0" > <?php }else{?><img src='images/portfolio/portfolio-item-1.jpg' frameborder="0" ><?php } ?></a>
								</div>
								<div class="portfolio-item-title">
									<a  onmouseover="getpop('<?php echo "CV".$i." : ".stripslashes($prod_name);?>')" onmouseout="hidepop('<?php echo $rlt2['prod_id'].$id;?>')" href="javascript:void(0);"><?php echo "CV".$i." : ".stripslashes(substr($rlt2['prod_name'],0,10))."..";?></a>
									<?php 
									    if($cvtype=='1'){  ?>
									<div><span  class="vtype">Free</span></div>
									<?php }?>
								</div>
								<?php
								}else {
								?>
								<div class="portfolio-item" data-vid="<?php echo $id;?>">								   
									<a href="javascript:void(0);"  onclick="testfun('<?php echo $rlt2['prod_id'];?>','<?php echo $rlt2['id'];?>','<?php echo $cvtype;?>','<?php echo $vcount+$constant; ?>')" ><?php if($prod_image){ ?><img src='https://s3-us-west-2.amazonaws.com/sas-productimages/<?php echo $prod_image;?>' frameborder="0" > <?php }else{?><img src='images/portfolio/portfolio-item-1.jpg' frameborder="0" ><?php } ?></a>
								</div>
								<div class="portfolio-item-title">
									<a onmouseover="getpop('<?php echo "CV".$i." : ".stripslashes($prod_name);?>')" onmouseout="hidepop('<?php echo $rlt2['prod_id'].$id;?>')" href="javascript:void(0);"><?php echo "CV".$i." : ".stripslashes(substr($rlt2['prod_name'],0,10))."..";?></a>
									<?php 
									   if($cvtype=='1'){  ?>
									  <div><span class="vtype" >Free</span></div>
									 <?php }?>
								</div>
								<?php 
								}
								?>								
							  </div>	
						</div>
						<div class="qtnr-div">
							<?php
								if(!empty($vcode2)){
							?>		
							<span class="cv-qtnr-div" >
							  <a href="javascript:void(0);" onclick="cv_qtnr(<?php echo $cid;?>,<?php echo $rlt2['id'];?>,<?php echo $cvtype; ?>,'<?php echo $vcount+$constant; ?>')" ><?php echo "CV".$i." : ";?>Questionnaire</a>
							</span>
							<?php }else{ ?>
							<span class="cv-qtnr-div" >
							  <a href="javascript:void(0);" onclick="empty_cv_qtnr()" ><?php echo "CV".$i." : ";?>Questionnaire</a>
							</span>						
							<?php }?>
						</div>	
					</li>
			</ul> 
  <?php
				 
		$i++;
		$vcount++;				 
	}			 
  ?>	