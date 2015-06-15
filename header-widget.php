
<ul class="social-links">
  <!-- header social links starts-->
<?php

  if(isset($_SESSION['uid'])){
  
    $uname=$_SESSION['uname'];
	
    $data=mysql_query("select * from sas_users where username='$uname'");
	$rslt=mysql_fetch_array($data);
	extract($rslt);
				   
	$rquery = mysql_query("SELECT * FROM sas_userreadings WHERE uid =".$_SESSION['uid']." and status='0'");
	$notices=mysql_num_rows($rquery); 
	
	if($notices > 0){
?>
	<li><a href="myreadings.php" class="tooltip" id="notes" title="My Readings (<?php if(isset($notices)){ echo $notices;}?>)"><img src="images/messi_red.png"></a></li>
<?php 
    } else {
?>
	<li><a href="myreadings.php" class="tooltip" title="My Readings (<?php if(isset($notices)){ echo $notices;}?>)"><img src="images/messi.png"></a></li>
<?php 
    }
?>	
	<li><a href="myreports.php" class="tooltip" title="My Report Card"><img src="images/report3.png"></a></li>
<?php
  }
?> 
    <li><?php if(isset($_SESSION['uname'])){ echo "<a href='edit-profile.php' class='tooltip' title='$_SESSION[uname]'><img style='width: 34px;height: 25px;' src='https://s3-us-west-2.amazonaws.com/sas-userphotos/$photopath'></a>";}else{ echo "<a href='login.php' class='tooltip' title=''><img src='images/account.png'></a>";}?></li>
	<li><a href="javascript:;" class="tooltip" title="Shopping Cart"><img src="images/shopping.png"></a></li>
						
</ul>