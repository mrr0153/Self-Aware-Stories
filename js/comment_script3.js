
$(document).ready(function(){

	var form = $('form');
	var submit = $('#submit');
    // alert(submit)
	$( "#form1" ).submit(function( e ) {
		// prevent default action
		e.preventDefault();
				
		// send ajax request
		$.ajax({
			url: 'ajax_comment.php',
			type: 'POST',
			cache: false,
			data: $('#form1').serialize(), //form serizlize data
			beforeSend: function(){
				// change submit button value text and disabled it
				submit.val('Submitting...').attr('disabled', 'disabled');
			
			},
			success: function(data){
			
				if(data=='Please login to comment this video!'){
				 
				document.getElementById('abc').style.display = "block";
				
				}else{
				var item = $(data).hide().fadeIn(800);
				$('.comment-block').append(item);
                }
				// reset form and button
				$('#form1').trigger('reset');
				submit.val('Submit Comment').removeAttr('disabled');
				//location.reload();
			},
			error: function(e){
				alert(e);
			}
		});
		
	});
	
});

/*
$(document).ready(function(){
	var form = $('form');
	var submit = $('#submit');
   // alert(submit)
	form.on('submit', function(e) {
		// prevent default action
		e.preventDefault();
		 
		// send ajax request
		$.ajax({
			url: 'ajax_comment.php',
			type: 'POST',
			cache: false,
			data: form.serialize(), //form serizlize data
			beforeSend: function(){
				// change submit button value text and disabled it
				submit.val('Submitting...').attr('disabled', 'disabled');
			
			},
			success: function(data){
			
				if(data=='Please login to comment this video!'){
				
				document.getElementById('spn').innerHTML=data;
				
				}else{
				var item = $(data).hide().fadeIn(800);
				$('.comment-block').append(item);
                }
				// reset form and button
				form.trigger('reset');
				submit.val('Submit Comment').removeAttr('disabled');
				location.reload();
			},
			error: function(e){
				alert(e);
			}
		});
		
	});
});
*/