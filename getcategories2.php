<?php 
    session_start();
    require_once("config/config.inc.php");		
    require_once("getthemecategories.php");
	
	if( !empty($_REQUEST['type'])=='more' ){
		 
		$vcatid = $_REQUEST['vcatid'];		
		$start=$_REQUEST['start'];
        $limit='more';	
	
    }else if( !empty($_REQUEST['type'])=='less' ){
		    	 
		$vcatid = $_REQUEST['vcatid'];		
		$start=$_REQUEST['start'];
        $limit='less';
	
    }else{	
	    	 
		$vcatid = $_REQUEST['vcatid'];
		
		$catidarray=array();
		
		for( $i=1;$i<=count($_SESSION['categories']);$i++) 
	    { 					
		  $catidarray[]=$i;
        }		
		for( $i=0;$i<count($catidarray);$i++){
		   		   
		   if( $catidarray[$i] == $vcatid ){
		      			   
			  if( $i < 5 ){
			     //echo $i .' < 5';
				 $start=0;
			     $limit='more';
				 
			  }else if( $i > 4 or $i <= 9 ){
			     //echo $i .'> 4 or '.$i .'<= 9';
				 $start=5;
				 $limit='less';
			  
			  }else if( $i > 9 or $i <= 14 ){
			     //echo $i .'> 9 or '.$i .'<= 14';
				 $start=10;
                 $limit='less';				 
			  }          
		   }	   
		}
	
	}
	 		
	//echo $start;
	 
	$catarry=array();
?>	
	<ul id="navside" class="navside">
<?php	
	 for( $i=$start+1;$i<=$start+5;$i++) 
	 { 					
		$catarry[]=$i		  
?>
	    <li><a href="theme.php?cid=<?php echo $i; ?>"><?php echo $_SESSION['categories'][$i]; ?></a></li>
<?php 
     }
	  
	  $last=end($catarry);
	  $more="more";
	  $less="less";
	  	  
	  if( $last < 10){
	  
	    if($limit==$more){ 
?>        
		  <li onclick="morefun('<?php echo $last;?>','more')"><a href="javascript:void(0);" class="less" >More...</a></li>
<?php 
        }else if($limit==$less){ 
?>        
		  <li onclick="lessfun('<?php echo $last-10;?>','less')"><a href="javascript:void(0);" class="more" >Less...</a></li>
<?php 
        }else if($limit==""){
?>
          <li onclick="morefun('<?php echo $last;?>','more')"><a href="javascript:void(0);" class="more" >More...</a></li>
<?php 
        }	  
	  }else{
?>
          <li onclick="lessfun('<?php echo $last-10;?>','less')"><a href="javascript:void(0);" class="more" >Less...</a></li>
<?php 
      }
?>		
    </ul>