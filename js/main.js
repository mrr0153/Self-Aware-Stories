
  $(document).ready(function(){
	
   
     $('.d-block').click(function(e)
	 {		
		e.preventDefault();
	    //var id=$(this).attr('data-id')
	 
	    $.fancybox({
          type: 'inline',
          content: $('#popuptext').html()
        });
	  });

	  
	  
	  
     $('.tag2 ul li a').click(function(e)
	 {  	
		e.preventDefault();
	    var id=$(this).attr('data-id')
	   		
	    $.fancybox({
          type: 'inline',
          content: $('#popuptext-'+id).html()
        });
		
	  });
	  
    
	  
  });



 

 
 