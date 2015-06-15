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
		
		$qry2="select * from sas_themecategories";
		$rslt2=mysql_query($qry2) or die(mysql_error()); 
		$count=mysql_num_rows($rslt2);
		
		$catidarray=array();
		
		while($rslt2 && $rlt2=mysql_fetch_array($rslt2))
		{	
		   $catidarray[]=$rlt2['cat_id'];	   	   	   
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
	
	$qry="select * from sas_themecategories  order by cat_id asc limit $start,5 ";
	$rslt=mysql_query($qry) or die(mysql_error()); 
	$catarry=array();
?>	
	<ul id="navside" class="navside">
<?php	
	  while($rslt && $rlt=mysql_fetch_array($rslt))
	  {	    
		//print_r($rlt);
		extract($rlt);
		$catarry[]=$cat_id;		  
?>
	    <li><a href="theme.php?cid=<?php echo $cat_id; ?>"><?php echo $cat_name; ?></a></li>
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