function validateEditform() {

  var reason = "";
  
  reason += validateFname(frm1.firstname);
  
  reason += validateLname(frm1.lastname);
  
  reason += validateEmail(frm1.email);
  
  reason += checkSpan3();
  
  reason += validateUname(frm1.username);
  
  reason += checkSpan4();
  
  reason += validatePassword(frm1.password);
  
  
 if (reason != "") {

   // alert("Some fields need correction:\n" + reason);

    return false;

  }

  return true;

}


function validateFname(fld) {

    var error = "";

    if (fld.value == "") {

        //fld.style.background = '#CEF6F5'; 
        
        error = "Please enter first name";
		error = '<span style="color:red">'+error+'</span>';
		
    } else {

        fld.style.background = 'White';

    }
	
	document.getElementById("sp1").innerHTML=error;

    return error;
}

function validateLname(fld) {

   var error = "";

    if (fld.value == "") {

       //fld.style.background = '#CEF6F5'; 

        error = "Please enter last name";
		error = '<span style="color:red">'+error+'</span>';
		
    } else {

        fld.style.background = 'White';

    } 
  
    document.getElementById("sp2").innerHTML=error;
		
    return error;
}

function trim(s)

   {

     return s.replace(/^\s+|\s+$/, '');

  } 

function validateEmail(fld) {

    var error="";

    var tfld = trim(fld.value);     // value of field with whitespace trimmed off

    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;

    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
  
    if (fld.value == "") {

        //fld.style.background = '#CEF6F5';

        error = "Please enter an email id ";
        error = '<span style="color:red">'+error+'</span>';
		
    } else if (!emailFilter.test(tfld)) {     //test email for illegal characters

        //fld.style.background = '#CEF6F5';

        error = "Please enter a valid email id ";
        error = '<span style="color:red">'+error+'</span>';
		
    } else if (fld.value.match(illegalChars)) {

        //fld.style.background = '#CEF6F5';

        error = "The email id contains illegal characters";
        error = '<span style="color:red">'+error+'</span>';
		
    } else {
       
	    l=document.getElementById("email").value
		m=document.getElementById("oldemail").value
        
	    //alert(l)
		//alert(m)
	 if(l===m){	
	  // alert('emails are equal');
	   document.getElementById("sp3").innerHTML='';
	   document.getElementById("sp3").value='';
     }
	 else{ 
	    //alert('emails are not equal');
	     var xmlhttp;
         if (window.XMLHttpRequest)
         {// code for IE7+, Firefox, Chrome, Opera, Safari
           xmlhttp=new XMLHttpRequest();
         }
         else
         {// code for IE6, IE5
           xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         }
         xmlhttp.onreadystatechange=function()
         {
           if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
             //document.getElementById("select2").innerHTML=xmlhttp.responseText;
	         error=xmlhttp.responseText.trim();
	         //alert(error)
	         document.getElementById("sp3").innerHTML=xmlhttp.responseText;
	         document.getElementById("sp3").value=xmlhttp.responseText;
	         // document.getElementById("email").style.background="#CEF6F5";
	  
           }
         }
         xmlhttp.open("POST","checkemail.php?qs="+l,true);
         xmlhttp.send();
 
         return error;
 
	 
	    }
	}
	   
	document.getElementById("sp3").innerHTML=error;
	
   return error;
}

function validateUname(fld) {

    var error = "";
	x=document.getElementById("username").value
   // alert(x);
	
    if (x == "") {

        //fld.style.background = '#CEF6F5'; 

        error = "Please choose user name";
		error = '<span style="color:red">'+error+'</span>';
		
    } else if ((x.length < 3) || (x.length > 15)) {

        //fld.style.background = '#CEF6F5'; 

        error = "User name must be 3 to 15 character\n";
        error = '<span style="color:red">'+error+'</span>';
    } else {
        		
		k=document.getElementById("username").value
		n=document.getElementById("oldusername").value
        
	   // alert(k)
		//alert(n)
	   if(k===n){	
	   // alert('names are equal');
		document.getElementById("sp4").innerHTML='';
	    document.getElementById("sp4").value='';
       }
	   else{ 
	    // alert('names are not equal');
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
	       error=xmlhttp2.responseText.trim();
	      // alert(error)
	       document.getElementById("sp4").innerHTML=xmlhttp2.responseText;
	       document.getElementById("sp4").value=xmlhttp2.responseText;
	      // document.getElementById("username").style.background="#CEF6F5";
	  
          }
        }
        xmlhttp2.open("POST","checkuser.php?qs="+k,true);
        xmlhttp2.send();
 
       return error;
  
      }
	}   		
     
	document.getElementById("sp4").innerHTML=error;
	
    return error;
    
}

function validatePassword(fld){

  var error="";

  if(fld.value == "" || fld.value == null){

   error = "Please choose password\n";
   error = '<span style="color:red">'+error+'</span>';
   //fld.style.background = '#CEF6F5';

   }else {

        fld.style.background = 'White';

    } 
 
   document.getElementById("sp5").innerHTML=error;
   
   return error;
}

function checkSpan3() {
   
   m=document.getElementById("sp3").value
   
   //document.getElementById("sp3").innerHTML=m;
   if(m!=0){
   return m;
   }
   //else return 'email not existed';
   else return '';
}

function checkSpan4() {
   
   l=document.getElementById("sp4").value
   
   if(l!=0){
   return l;
  }
  //else return 'user name not existed';
   else return '';
}



///////////////// validate form onfocus and onblur ////////////////


 function fname_focus(){
  
   document.getElementById("sp1").innerHTML=""; 
 }
 
 function fname_blur(){
  
  l=document.getElementById("firstname").value
   
  if(l.length == 0) {
    
    document.getElementById("sp1").innerHTML="Please enter first name "; 
	document.getElementById("sp1").style.color='red';
   }
   else{
     
      document.getElementById("sp1").innerHTML=""; 
   }
   
 }
 
 
function lname_focus(){
  
   document.getElementById("sp2").innerHTML=""; 
 }
 
 function lname_blur(){
  
  l=document.getElementById("lastname").value
   
  if(l.length == 0) {
    
    document.getElementById("sp2").innerHTML="Please enter last name "; 
	document.getElementById("sp2").style.color='red';
   }
   else{
     
      document.getElementById("sp2").innerHTML=""; 
   }
   
 }
 
 function email_focus(){
  
   document.getElementById("sp3").innerHTML=""; 
 }
 function email_blur(){
  
  l=document.getElementById("email").value
  var tfld = trim(l);     // value of field with whitespace trimmed off

    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;

    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
  
  if(l.length == 0) {
    
    document.getElementById("sp3").innerHTML="Please enter an email id "; 
	document.getElementById("sp3").style.color='red';
	
   } else if (!emailFilter.test(tfld)) {              //test email for illegal characters

        //fld.style.background = '#CEF6F5';

       document.getElementById("sp3").innerHTML="Please enter a valid email id "; 
	   document.getElementById("sp3").style.color='red';
		
    } else if (l.match(illegalChars)) {

        //fld.style.background = '#CEF6F5';
        document.getElementById("sp3").innerHTML="The email id contains illegal characters\n "; 
	    document.getElementById("sp3").style.color='red';
		
    }else{
     
      //document.getElementById("sp2").innerHTML=""; 
	  i=document.getElementById("email").value
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
   
 }
 
 
 function uname_focus(){
  
   document.getElementById("sp4").innerHTML=""; 
 }
 
 function uname_blur(){
  
  l=document.getElementById("username").value
   
  if(l.length == 0) {
    
    document.getElementById("sp4").innerHTML="Please choose user name "; 
	document.getElementById("sp4").style.color='red';
	
   }else if ((l.length < 3) || (l.length > 15)) {

        document.getElementById("sp4").innerHTML="User name must be 3 to 15 character "; 
	    document.getElementById("sp4").style.color='red';
    }
   else{
     
      //document.getElementById("sp2").innerHTML=""; 
	  
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
   
 }
 
 function password_focus(){
  
   document.getElementById("sp5").innerHTML=""; 
 }
 
 function password_blur(){
  
  s=document.getElementById("password").value
  
  if(s.length == 0) {
    
    document.getElementById("sp5").innerHTML="Please choose password "; 
	document.getElementById("sp5").style.color='red';
   }
   else{
     
      document.getElementById("sp5").innerHTML=""; 
   }
   
 }





