
function formValidate() {

  var reason = "";
  
  reason += validateUsername(frm2.username);
    
  //reason += checkSpan();
  
  reason += validatePwd(frm2.username,frm2.password);
   
    if (reason != "") {
        
	     $("#errorstatus").val('error')
		
         //alert("Some fields need correction:\n" + reason);

         return false;
	   
    }
	 
    return true;
 }

 function validateUsername(fld) {

    var error = "";
    
    if (fld.value == "") {
        
        error = "Please enter username";
		$("#error").html("Please enter username")
		$("#errorstatus").val('Please enter username')
    } 
	
    return error;
}

 function validatePwd(fld1,fld){

   var error="";

   if(fld1.value == "" || fld1.value == null){
    
	  $("#errorstatus").val("Please enter username")	
      error = "Please enter username";    
      $("#error").html('Please enter username')
   }
   else if(fld.value == "" || fld.value == null){
      
	  $("#errorstatus").val("Please enter password")	
      error = "Please enter password";     
      $("#error").html('Please enter password')
   }else{
      $("#error").html('')
	  $("#errorstatus").val("")	
   }
    
   return error;
 }


 function checkUser(){

	  var error="";
	  
	  k=document.getElementById("username").value
	  
	  $.post("validate_user.php?qs="+k,{},function(data){ 
     
	        if(data==''){
			  $("#errorstatus").val('')
              $("#error").html('')			  
            }else{
               
			   error=data; 
			   $("#error").html(data)              
               $("#errorstatus").val(data)			   
            }
      });
	    
      return error;
 
 }


 function checkSpan() {
   
   m=document.getElementById("errorstatus").value
      
   if(m!=''){
     return m;
   }
   else return '';
 }
 
/////////// validate onblur and onfocus /////////////
 
  function uname_focus(){
    $("#error").html('')   
  }
   
  function password_focus(){
  
    $("#error").html("") 
  }
  

function clear_fields()
{
    document.getElementById("username").innerHTML="";
	document.getElementById("username").value=""; 
	$("#error").html('')
	document.getElementById("sp1").innerHTML=""; 
	document.getElementById("sp1").value=""; 
 
    document.getElementById("sp2").innerHTML=""; 
	document.getElementById("sp2").value="";
  
}