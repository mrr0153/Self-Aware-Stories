
$(document).ready(function(){
 
	var form = $('form');
	var submit = $('#submit');
    // alert(submit)
	$( "#form1" ).submit(function( e ) {
		// prevent default action
		e.preventDefault();
		
		// send ajax request
		$.ajax({
			url: 'ajax_myjournal.php',
			type: 'POST',
			cache: false,
			data: $('#form1').serialize(), //form serizlize data
			beforeSend: function(){
				// change submit button value text and disabled it
				submit.val('Saving...').attr('disabled', 'disabled');
			
			},
			success: function(data){
			    //alert(data)				
				//var item = $(data).hide().fadeIn(800);
			    
				$('#new-post').prepend(data).hide().fadeIn(800);		
                							   
				//$('.allnotes').prepend(data);	
				
				$('#form1').trigger('reset');
                $('textarea#description').val('');				
				submit.val('Save').removeAttr('disabled');
				
				$('html, body').animate({
						scrollTop: $('#new-post').offset().top
				},1500);
				
				/******* Edit comment *****/
			    $(".myjournal-edit").click(function(){
	    
					$( '#div1' ).css('display','none');
					$( '#div2' ).css('display','block');
					
					var jid=$(this).attr('data-id')
						
					ttl=$("#topictitle"+jid).val()
					
					$( '#topictitle2' ).val(ttl)		
					
					desc=$("#p-myjournal"+jid).html()
					
					$('#prevjid').val(jid)	
					
					//alert('desc = '+desc)
		
		            $( 'textarea#description2' ).val(desc)	
					
					$('html, body').animate({
							scrollTop: $('#content').offset().top
					},1500);
		
						
						
				});
			   /********** end edit comment ******/
			},
			error: function(e){
				alert(e);
			}
		});
		
	 });
	 
	/******* edit form ********/
					
	$( "#form2" ).submit(function( e ) {
		
		e.preventDefault();
						
		ttl=$( '#topictitle2' ).val()	
						
		desc= $( 'textarea#description2' ).val()
						
		jid=$('#prevjid').val()
						
		$.post('edit_post.php?jid='+jid+"&desc="+desc+"&ttl="+ttl,{},function(data){
					 
			res = data.split("|||||"); 
			
			$("#p-title"+res[0]).html(res[1])
			$("#topictitle"+res[0]).html(res[1])							
			$("#p-myjournal"+res[0]).html(res[2])							
							
			$('#form2').trigger('reset');
			$("#topictitle2").val('')	
			$('textarea#description2').val('')
			$("textarea#description2").html('').trigger('reset');	
							
			$('html, body').animate({
					scrollTop: $("#myjournalblock"+res[0]).offset().top
			},1500);
						   
		});		
	});
					
});

