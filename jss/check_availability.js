
function checkEmail(){
  
  i=document.getElementById("email").value
  
  //t=$("#email").val()

  //alert(i)

var xmlhttp3;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp3=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp3.onreadystatechange=function()
  {
  if (xmlhttp3.readyState==4 && xmlhttp3.status==200)
    {
    //document.getElementById("select2").innerHTML=xmlhttp3.responseText;
	 j=xmlhttp3.responseText.trim();
	 //alert(j)
	 
	 document.getElementById("sp3").innerHTML=xmlhttp3.responseText;
	 document.getElementById("sp3").value=xmlhttp3.responseText;	
    }
  }
xmlhttp3.open("POST","checkemail.php?qs="+i,true);
xmlhttp3.send();
  
}


function checkUser(){

  k=document.getElementById("username").value
  
  //t=$("#email").val()

  //alert(k)

var xmlhttp2;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp2=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp2.onreadystatechange=function()
  {
  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
    {
    //document.getElementById("select2").innerHTML=xmlhttp2.responseText;
	 l=xmlhttp2.responseText.trim();
	// alert(l)
	 
	 document.getElementById("sp4").innerHTML=xmlhttp2.responseText;
	 document.getElementById("sp4").value=xmlhttp2.responseText;	
    }
  }
xmlhttp2.open("POST","checkuser.php?qs="+k,true);
xmlhttp2.send();
  
}



