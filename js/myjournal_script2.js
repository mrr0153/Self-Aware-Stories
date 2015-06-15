
$(document).ready(function(){
 
	var form = $('form');
	var submit = $('#submit');
    // alert(submit)
	$( "#form1" ).submit(function( e ) {
		// prevent default action
		e.preventDefault();
		
		// alert("submit")	
		// send ajax request
		$.ajax({
			url: 'ajax_myjournal2.php',
			type: 'POST',
			cache: false,
			data: $('#form1').serialize(), //form serizlize data
			beforeSend: function(){
				// change submit button value text and disabled it
				submit.val('Saving...').attr('disabled', 'disabled');
			
			},
			success: function(data){
			    //alert(data)
				
				//var item = $(data).hide();
			    //$('.comment-block').append(item);				
                //$('#new-post').append(data);
				$('.comment-block').append(data);	
				
				$('#form1').trigger('reset');
				submit.val('Save').removeAttr('disabled');
				//location.reload();
			},
			error: function(e){
				alert(e);
			}
		});
		
	});
	
});

