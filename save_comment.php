<?php
 session_start();
 
 $comment=$_REQUEST['comment'];
 $_SESSION['comment']=$comment;

 
?>