jQuery(document).ready(function($) {
	
	// Change label at the bottom of the customizer preview settings
	$('#customize-footer-actions > button').replaceWith('<div id="devices-preview-text">Devices Preview</div>');
	
	// Show/hide metatags for each post type based on checked post types
	$('input[value="news"]').on('click', function() {
		if( $('input[value="news"]').is(':checked') ) {
			$('div[data-name="news"]').css('display', 'block');
		}
		else {
			$('div[data-name="news"]').css('display', 'none');
		}
	});

	$('input[value="events"]').on('click', function() {
		if( $('input[value="events"]').is(':checked') ) {
			$('div[data-name="events"]').css('display', 'block');
		}
		else {
			$('div[data-name="events"]').css('display', 'none');
		}
	});

	$('input[value="people"]').on('click', function() {
		if( $('input[value="people"]').is(':checked') ) {
			$('div[data-name="people"]').css('display', 'block');
		}
		else {
			$('div[data-name="people"]').css('display', 'none');
		}
	});

	$('input[value="courses"]').on('click', function() {
		if( $('input[value="courses"]').is(':checked') ) {
			$('div[data-name="courses"]').css('display', 'block');
		}
		else {
			$('div[data-name="courses"]').css('display', 'none');
		}
	});

	$('input[value="testimonials"]').on('click', function() {
		if( $('input[value="testimonials"]').is(':checked') ) {
			$('div[data-name="testimonials"]').css('display', 'block');
		}
		else {
			$('div[data-name="testimonials"]').css('display', 'none');
		}
	});

	$('input[value="galleries"]').on('click', function() {
		if( $('input[value="galleries"]').is(':checked') ) {
			$('div[data-name="photo_galleries"]').css('display', 'block');
		}
		else {
			$('div[data-name="photo_galleries"]').css('display', 'none');
		}
	});

});

jQuery(window).load(function() {
	
	if( jQuery('input[value="news"]').is(':checked') ) {
		jQuery('div[data-name="news"]').css('display', 'block');
	}
	else {
		jQuery('div[data-name="news"]').css('display', 'none');
	}
	
	if( jQuery('input[value="events"]').is(':checked') ) {
		jQuery('div[data-name="events"]').css('display', 'block');
	}
	else {
		jQuery('div[data-name="events"]').css('display', 'none');
	}
	
	if( jQuery('input[value="people"]').is(':checked') ) {
		jQuery('div[data-name="people"]').css('display', 'block');
	}
	else {
		jQuery('div[data-name="people"]').css('display', 'none');
	}
	
	if( jQuery('input[value="courses"]').is(':checked') ) {
		jQuery('div[data-name="courses"]').css('display', 'block');
	}
	else {
		jQuery('div[data-name="courses"]').css('display', 'none');
	}
	
	if( jQuery('input[value="testimonials"]').is(':checked') ) {
		jQuery('div[data-name="testimonials"]').css('display', 'block');
	}
	else {
		jQuery('div[data-name="testimonials"]').css('display', 'none');
	}
	
	if( jQuery('input[value="galleries"]').is(':checked') ) {
		jQuery('div[data-name="photo_galleries"]').css('display', 'block');
	}
	else {
		jQuery('div[data-name="photo_galleries"]').css('display', 'none');
	}
	
});