jQuery(document).ready(function($) {
	  
	// Change label at the bottom of the customizer preview settings
	$('#customize-footer-actions > button').replaceWith('<div id="devices-preview-text">Devices Preview</div>');	

	// Make archive options collapsible
	$('div[data-name="archive_options"] > .acf-input > .acf-fields > .acf-field > .acf-label label').each(function() {
		$(this).wrapInner('<span class="archive-name closed"></span>');
	});
	
	$('div[data-name="archive_options"] > .acf-input > .acf-fields > .acf-field > .acf-label label .archive-name').each(function() {
		$(this).append('<span class="icon">+</span>');
	});
	
	$('div[data-name="archive_options"] > .acf-input > .acf-fields > .acf-field > .acf-label label .archive-name').each(function() {

		$(this).click(function() {

			$(this).toggleClass(function(){
				return $(this).is('.open, .closed') ? 'open closed' : 'open';
			});

			if($(this).hasClass('closed')) {
				$(this).children('span').text('+');
				$(this).parent().parent().siblings('.acf-input').hide(300);
			}
			else {
				$(this).children('span').text('-');
				$(this).parent().parent().siblings('.acf-input').show(300);
				$(this).parent().parent().parent().siblings('.acf-field-group').find('.icon').text('+');
				$(this).parent().parent().parent().siblings('.acf-field-group').children('.acf-input').hide(300);
			}

		});

	});

	$('.toplevel_page_theme-options label .no-taxonomies').each(function() {
		$(this).prev('input').css('display', 'none');
	});

	// Get the logo size from the customizer setting
	const themeMod = LogoSize.SizeValue;
	function logoSizeFunction() {
		if (themeMod === 'large') {
			$('#_customize-description-logo_size').hide();
		}
		else {
			$('#_customize-description-logo_size').show();
			$('#customize-control-logo_switch_red_mobile').hide();
		}
	}
	logoSizeFunction();

	$('#_customize-input-logo_size-radio-small').on('click', function () {
		$('#_customize-description-logo_size').show();
		$('#customize-control-logo_switch_red_mobile').hide();
	});

	$('#_customize-input-logo_size-radio-large').on('click', function () {
		$('#_customize-description-logo_size').hide();
		if ($('#_customize-input-logo_switch_mobile-radio-yes').is(':checked')) {
			$('#customize-control-logo_switch_red_mobile').show();
		} else {
			$('#customize-control-logo_switch_red_mobile').hide();
		}
	});

});