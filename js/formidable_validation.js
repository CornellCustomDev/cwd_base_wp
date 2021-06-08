/** 

Last updated: 9/24/20

This function will work on any Formidable form and any required field, but may need to be tested or adjusted for certain of the more special or uncommon fields.

**/


// Formidable validation
jQuery(document).ready(function($) {
	
	// Create error message container
	$('.frm_forms .frm_form_fields > fieldset').prepend('<div id="message-box" style="display: none;"><a id="message-link"></a><div id="message-list"><ul></ul></div></div>');

	// Delay error for half a second after submit 
	setTimeout(function(){ 		
		
		// First, find the errors on the page
		var $numberOfErrors = $('.frm_required_field .frm_error').length; 

		// If there are errors
		if($numberOfErrors > 0) { 

			// Expand all collapsed sections
			$('.frm_trigger').each(function() { 
				$(this).addClass('active');
				$(this).siblings('.frm_grid_container').css('display', 'grid');
			});
				
			// Show error message div
			$('#message-box').css('display', 'block'); 

			// Show the error announcement
			if($numberOfErrors == 1) {
				$('#message-link').append('There is an error in the form you submitted. Please review and fix the error.');  
			}
			else {
				$('#message-link').append('There are '+$numberOfErrors+' errors in the form you submitted. Please review and fix the errors.');  
			}

			// List all error messages, give them a unique id, and link them to their associated input fields
			$('.frm_required_field .frm_error').each(function() { 
				var $error = $(this).parent().find('label').text().replace('*','');
				var $location = $(this).parents('.frm_required_field').find('*[data-reqmsg]').attr('id');
				$('#message-list ul').append('<li><a class="error_message" id="'+$location+'_error" href="#'+$location+'">The '+$error+' field cannot be blank.</a></li>');
			});
			
			// Send focus to input field on click (this won't work for a Signature field unless TypeIt is selected)
			$('.drawIt > a').removeClass('current');
			$('.typeIt > a').addClass('current').click();
						
			$('.error_message').each(function() { 
				$(this).on('click', function(e) {
					e.preventDefault();
					$(this.hash).focus();
				});
			});
				
			// Get id of first error input field
			var $firstError = $('#message-list > ul > li:first-child > a').attr('id');

			// Link error announcement to first error and focus
			$('#message-link').attr('href', '#'+$firstError).focus();
			
			// Remove inline error messages. They're redundant.
			$('.frm_error').each(function() {
				$(this).addClass('sr-only');
			});
			
		}

	},500);
	
});