<?php
    session_start();
    require_once("config/config.inc.php");
    error_reporting(0);
    
	$cid=$_REQUEST['cid'];
	$id=$_REQUEST['cvid'];
	
    $qry2="select * from sas_copvideos where id='$id' ";
	$rslt2=mysql_query($qry2); 
	$rlt2=mysql_fetch_array($rslt2);
					
	//print_r($rlt2);
	extract($rlt2); 
	$catid=$cat_id; 
	
	$qry="select * from sas_themecategories where cat_id='$catid'";
    $rslt=mysql_query($qry); 
	while($rslt && $rlt=mysql_fetch_array($rslt))
	{
		//print_r($rlt);
		extract($rlt);
	}		    
 
    $rs=mysql_query("SELECT * FROM sas_quiz where cpvid=".$_REQUEST['cvid']." and status='1'" );
    //echo mysql_num_rows($rs);
	
	if( mysql_num_rows($rs) > 0 ){
 ?>

              <div class="popup-questions">
				   <div >
					  <h4 style="position:fixed;color: #005292;font-weight: 500;position: absolute;">Questionnaire </h4><br>
				      <h4 style="position:fixed;color: #005292;font-weight: 500;position: absolute;">Theme : <?php echo $cat_name;?> </h4><br>
					  <h4 style="position:fixed;color: #005292;font-weight: 500;position: absolute;">Coping Video : <?php echo $prod_name;?></h4><br><br>
					  <?php 
					 
					    if(isset($_SESSION['uid'])){
					  
					        $qtndata=mysql_query("select * from sas_userqtnansws where uid='$_SESSION[uid]' and cvid='$_REQUEST[cvid]' and vtype='CV' ");
						
						    if( mysql_num_rows($qtndata) == 0 ){

							}else{
					   ?>						
							   <p style="text-align:left" class="teststatus">You have already taken this test.  <a href="myreports.php?cid=<?php echo $cid;?>">View Test Report</a></p>	
					   <?php	
							}							
						 }						
					   ?>
					  <p class="inffo" >After watching the Coping Video please indicate what you think is the <b>best</b> answer: </p>
				      <p class="rslts" >You have <span class="corrected"></span> of <span class="totalqns"></span> correct. Please check the best answer and the explanation.</p>
					</div>
				     <script>					  
					    $(document).ready(function(){
						
                            $(".rslts").css("display","none") 
                            //$(".closefrm").css("display","none")							
                        });
											   
						function ansfun3() {
							
							for(i=1;i<5;i++){								  
							 for(j=0;j<4;j++){								  
								$(".a"+i).css("color","#000") 
								$(".b"+i).css("color","#000") 
								$(".c"+i).css("color","#000") 
								$(".d"+i).css("color","#000") 
							 }
							 
							}
							
							var aa1=$(".q-block input[type='radio'][name='aa1']:checked");													
							var aa2=$(".q-block input[type='radio'][name='aa2']:checked");
							var aa3=$(".q-block input[type='radio'][name='aa3']:checked");
							var aa4=$(".q-block input[type='radio'][name='aa4']:checked");
							var aa5=$(".q-block input[type='radio'][name='aa5']:checked");
							
							var a=aa1.val()+'|||'+aa2.val()+'|||'+aa3.val()+'|||'+aa4.val()+'|||'+aa5.val()
							
							var cid='<?php if(isset($_REQUEST['cid'])){echo $_REQUEST['cid'];}?>';
							var videono='<?php if(isset($rlt2['prod_id'])){echo $rlt2['prod_id'];}?>';
							var pid='<?php if(isset($_REQUEST['cvid'])){echo $_REQUEST['cvid'];}?>';
							var userid="<?php if(isset($_SESSION['uid'])) echo $_SESSION['uid']; ?>";  
							var vno="<?php if(isset($_REQUEST['vno'])) echo $_REQUEST['vno']; ?>"; 
														
							if(userid){
							
								var URL='getuservideocount.php';
								var dataString = 'uid=' + userid +'&vcid='+cid+'&vno='+vno ;
								//alert(dataString)
								$.ajax({
									type: "POST",
									url: URL,
									data: dataString,
									cache: false,
									success: function(html){

									 // alert('count='+html)
									  document.getElementById("propercent").innerHTML=html;
									  $('#probar').css('width',html); 
									  $('#probar').css('background-color','#99A607');
									}			 
								});	
							 }
							 
							$.post("validateanswrs.php?a="+a+"&cid="+cid+"&id="+pid+"&vtype=cvideo"+"&videono="+videono,{},function(data){
							      
								$(".ansdesc").css("padding","15px")
								$(".inffo").css("display","none")
								$(".submitfrm").css("display","none")
								//$(".closefrm").css("display","block")
								
								//alert(data)	
								
								a=data.split('*****')
								rts=a[0]
								wrgs=a[1]
								expl=a[2]
								correctans=a[3]
								
								rights=rts.split('|||')
								wrongs=wrgs.split('|||')
								explns=expl.split('|||||')								
								correctansarry=correctans.split('|||')
								
								//alert(correctansarry)
								
								$(".rslts").css("display","block")
								
								noofcorrects=rights.length-1;
								totalqns=4;
								
								$(".corrected").html(noofcorrects)
								$(".totalqns").html(totalqns)
								
								explns1=explns[0].split('|||')
								explns2=explns[1].split('|||')
								explns3=explns[2].split('|||')
								explns4=explns[3].split('|||')	
                                
							    $('.option').css("color","")
								
								$(".aa1").html(explns1[0])
								$(".bb1").html(explns1[1])
								$(".cc1").html(explns1[2])
								$(".dd1").html(explns1[3])
								
                                $(".aa2").html(explns2[0])
								$(".bb2").html(explns2[1])
								$(".cc2").html(explns2[2])
								$(".dd2").html(explns2[3])
    								
								$(".aa3").html(explns3[0])
								$(".bb3").html(explns3[1])
								$(".cc3").html(explns3[2])
								$(".dd3").html(explns3[3])
								
								$(".aa4").html(explns4[0])
								$(".bb4").html(explns4[1])
								$(".cc4").html(explns4[2])
								$(".dd4").html(explns4[3])
								
								
							    for(i=0;i<rights.length;i++){
								 
								 if( $(".q-block input[type='radio'][name='aa"+rights[i]+"']:checked") ){
								   //alert('rights='+rights[i])
								   id=$(".q-block input[type='radio'][name='aa"+rights[i]+"']:checked").attr('id')
								   //alert('id='+id)	
                                   $(".q-block input[type='radio'][name='aa"+rights[i]+"']:checked").siblings("span").css("color","green")
								   $(".q-block input[type='radio'][name='aa"+rights[i]+"']:checked").siblings("span").css("font-weight","bold")
								 							 
								  }
								 
								}
								
								for(i=0;i<wrongs.length;i++){
								 
								 if( $(".q-block input[type='radio'][name='aa"+wrongs[i]+"']:checked") ){
								   //alert('wrongs='+wrongs[i])
								   id=$(".q-block input[type='radio'][name='aa"+wrongs[i]+"']:checked").attr('id')
								   //alert('id='+id)
								   $(".q-block input[type='radio'][name='aa"+wrongs[i]+"']:checked").siblings("span").css("color","red")	
								   $(".q-block input[type='radio'][name='aa"+wrongs[i]+"']:checked").siblings("span").css("font-weight","bold")
								   
								  }						 
								 
								}
								
								
							for(i=1;i<=4;i++){								
								 
								optiona=$("#optona"+i).html()
								optionb=$("#optonb"+i).html()
								optionc=$("#optonc"+i).html()
								optiond=$("#optond"+i).html()
								 
								 if( optiona == correctansarry[i-1] ) {
		 	                              
		                             $(".a"+i+"a"+i+"a"+i).siblings("span").css("color","green")
									 $(".a"+i+"a"+i+"a"+i).siblings("span").css("font-weight","bold")
		                         }
									   
								if( optionb == correctansarry[i-1] ) {
		 	                         
									$(".b"+i+"b"+i+"b"+i).siblings("span").css("color","green")
		                            $(".b"+i+"b"+i+"b"+i).siblings("span").css("font-weight","bold")
		                        }
									   
								if( optionc == correctansarry[i-1] ) {
		 	                         
									$(".c"+i+"c"+i+"c"+i).siblings("span").css("color","green")
		                            $(".c"+i+"c"+i+"c"+i).siblings("span").css("font-weight","bold")
		                        }
									   
								if( optiond == correctansarry[i-1] ) {
		 	                             
									$(".d"+i+"d"+i+"d"+i).siblings("span").css("color","green")
		                            $(".d"+i+"d"+i+"d"+i).siblings("span").css("font-weight","bold")
		                        }
							 	     
							  }
								   
								   
							}); 							
					    }					 
	                     
					</script>
					
                    <form method="post" action="" id="ansfrm" name="frm1"  >					
                    <?php 
					  $i=1;
					  
			          $rs=mysql_query("SELECT * FROM sas_quiz where cpvid=".$_REQUEST['cvid']." and status='1'" );
                   	  
					   while($line=mysql_fetch_array($rs))
 					   {
					
					?>
                    <div class="q-block">
                     <p class="test"> </p>					
					 <p> <?php echo $i; ?>) <?php echo $line['question'];?></p>
					  
					  <div class="radbutton">					  
					    <input type="radio" name="aa<?php echo $i;?>" value="<?php echo $line['option1'];?>" id="aa<?php echo $i;?>" class="a<?php echo $i;?>a<?php echo $i;?>a<?php echo $i;?>" />
						<span class="option" id="optona<?php echo $i;?>" ><?php echo $line['option1'];?></span> <br>
						<div class="ansdesc">
						<span id="aaa<?php echo $i;?>" class="aa<?php echo $i;?>"  > </span>
						</div>                        						
					  </div>
					  
					  <div class="radbutton">	
                        <input type="radio" name="aa<?php echo $i;?>" value="<?php echo $line['option2'];?>" id="bb<?php echo $i;?>" class="b<?php echo $i;?>b<?php echo $i;?>b<?php echo $i;?>"/>					  
						<span class="option" id="optonb<?php echo $i;?>" ><?php echo $line['option2'];?></span> <br>
						<div class="ansdesc">
						<span id="bbb<?php echo $i;?>" class="bb<?php echo $i;?>"  > </span>
						</div>                       						
					  </div>  
					  
					  <div class="radbutton">
                        <input type="radio" name="aa<?php echo $i;?>" value="<?php echo $line['option3'];?>" id="cc<?php echo $i;?>" class="c<?php echo $i;?>c<?php echo $i;?>c<?php echo $i;?>"/>					  
						<span class="option" id="optonc<?php echo $i;?>" ><?php echo $line['option3'];?></span><br>
						<div class="ansdesc">
						<span id="ccc<?php echo $i;?>" class="cc<?php echo $i;?>"  > </span>
						</div> 					
					  </div>
					  
					  <div class="radbutton">
                        <input type="radio" name="aa<?php echo $i;?>" value="<?php echo $line['option4'];?>" id="dd<?php echo $i;?>" class="d<?php echo $i;?>d<?php echo $i;?>d<?php echo $i;?>"/>					  
						<span class="option" id="optond<?php echo $i;?>" ><?php echo $line['option4'];?></span><br>
						<div class="ansdesc">
						<span id="ddd<?php echo $i;?>" class="dd<?php echo $i;?>"  > </span>
						</div> 					
					  </div> 
					  					  
					</div>
					
					<?php $i++; } ?>
					
					<?php 
					 
					  if(isset($_SESSION['uid'])){
					  
					    $qtndata=mysql_query("select * from sas_userqtnansws where uid='$_SESSION[uid]' and cvid='$_REQUEST[cvid]' and vtype='CV' ");
						
						if( mysql_num_rows($qtndata) == 0 ){

                    ?>
					   <p style="text-align:left" class="submitfrm"><input type="button" id="ansfrm" onclick="ansfun3()" value="Submit" style="width: 30%;font-size: 14px;margin-top: 20px;"></p>	
				   					   
					<?php					

                        }
						
					  }
					
					?>
										
				   <!--  <p style="text-align:center" class="submitfrm"><input type="button" id="ansfrm" onclick="ansfun3()" value="Submit" style="width: 30%;font-size: 14px;margin-top: 20px;"></p>	-->
				   				   
				   </form>
				   
				</div>
				
<?php }else{ ?>
       
      <div class="popup-questions">
		 <div>
			<h4 style="position:fixed;color: #005292;font-weight: 500;position: absolute;">Questionnaire </h4><br>
			<h4 style="position:fixed;color: #005292;font-weight: 500;position: absolute;">Theme : <?php echo $cat_name;?> </h4><br>
			<h4 style="position:fixed;color: #005292;font-weight: 500;position: absolute;">Coping Video : <?php echo $prod_name;?></h4><br><br>
			<p class="inffo" >Sorry, The Questionnaire for <b>Coping Video : <?php echo $prod_name;?></b> is coming soon. </p>
			</div>
	  </div>
<?php } ?>	