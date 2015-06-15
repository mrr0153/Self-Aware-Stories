<?php 
mysql_connect("localhost","root","");
mysql_select_db("sas");

if(isset($_POST['sub'])){

  $data=$_POST['editor1'];
  mysql_query("INSERT INTO `test` (`description`) VALUES ('$data')"); 
   
 
}
$data=mysql_query("select * from test");
  while($rslt=mysql_fetch_array($data)){
    extract($rslt);
	echo $description;
  } 
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>

<script>
$( document ).ready( function() {
	$( 'textarea#editor1' ).ckeditor();
 });
</script>
<form method="post" action="">
<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10">
				
</textarea>
<input type="submit" name="sub" value="submit">
</form>