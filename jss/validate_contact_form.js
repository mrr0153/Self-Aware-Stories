function validateForm() {

var reason = "";

  reason += validateUname(frm1.name);
  
  reason += validateEmail(frm1.email);

  //reason += validateMobile(frm1.url);
  
   reason += validateMsg(frm1.message); 
   
  if (reason != "") {
    
	 $("#ctcstatus").html('')
    // alert("Some fields need correction:\n" + reason);

    return false;

  }

  return true;

}

function validateUname(fld) {

    var error = "";

    if (fld.value == "") {

        //fld.style.background = '#CEF6F5'; 

        error = "Please enter your name.\n";
        error = '<span style="color:red">'+error+'</span>';
		
    } else if ((fld.value.length < 2) || (fld.value.length > 15)) {

        //fld.style.background = '#CEF6F5'; 

        error = "Your name must be 2 to 15 character.\n";
        error = '<span style="color:red">'+error+'</span>';
		
    }else {

        fld.style.background = 'White';

    } 
    document.getElementById("sp1").innerHTML=error;
	
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

        error = "Please enter an email address.\n";
		error = '<span style="color:red">'+error+'</span>';

    } else if (!emailFilter.test(tfld)) {              //test email for illegal characters

        //fld.style.background = '#CEF6F5';

        error = "Please enter a valid email address.\n";
		error = '<span style="color:red">'+error+'</span>';

    } else if (fld.value.match(illegalChars)) {

        //fld.style.background = '#CEF6F5';

        error = "The email address contains illegal characters.\n";
		error = '<span style="color:red">'+error+'</span>';

    } else {

        fld.style.background = 'White';

    }
	
    document.getElementById("sp2").innerHTML=error;
	
    return error;

}

function validateMsg(fld) {

    var error = "";

    if (fld.value == "") {

        //fld.style.background = '#CEF6F5'; 

        error = "Please enter your message.\n";
		error = '<span style="color:red">'+error+'</span>';

    } else {

        fld.style.background = 'White';

    } 
    
	document.getElementById("sp3").innerHTML=error;
	
    return error;

}



