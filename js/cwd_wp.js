jQuery(document).ready(function($) {
	
	// Mobile breadcrumbs
	$('#main-article .breadcrumb').addClass('no-mobile');
	$('#sidebar-top .breadcrumb').addClass('mobile-only').attr('aria-label', 'Mobile Breadcrumb');
		
	// Remove top sidebar if...
	if( $('#sidebar-top .content-block').length < 1 && $('#sidebar-top .secondary-navigation').length < 1 ) {
		$('#sidebar-top').addClass('no-sidebar-top');
		$('#sidebar-top').remove();
	}
	// Remove bottom sidebar if...
	if( $('#sidebar-bottom .content-block').length < 1 ) {
		$('#sidebar-top').addClass('no-sidebar-bottom');
		$('#sidebar-bottom').remove();
	}
	// Remove both sidebars if...
	if( $('#sidebar-top .content-block').length < 1 && $('#sidebar-bottom .content-block').length < 1  && $('#sidebar-top .secondary-navigation').length < 1 ) {
		$('#sidebar-top #sidebar-bottom').remove();
		$('body').removeClass('sidebar sidebar-left sidebar-right').addClass('no-sidebar');
	}
	if ( $('body').hasClass('no-sidebar') ) {
		$('#sidebar-top #sidebar-bottom').remove();
	}
		
	// Fitvids on content containers
	$('iframe').parent().fitVids();
		
	// wp_link_pages
	$('.cwd-pagination.wp_link_pages > .post-page-numbers').wrap('<li></li>');
	
	// Calculate number of elements and add columns class (no more than 4)
	$('.columns').each(function(){
		var col_count = $(this).children('.col-item').length;
		
		if (col_count == 2) {
			$(this).addClass('two-col');
		}
		if (col_count == 3) {
			$(this).addClass('three-col');
		}
		if (col_count >= 4) {
			$(this).addClass('four-col');
		}

	});
	
	// Navigation menu widgets
	$('#sidebar-top .widget_nav_menu h2').addClass('menu-block-title');
	$('#sidebar-top .widget_nav_menu h2 + div[class^="menu"] > ul.menu').unwrap();
	$('#sidebar-top .widget_nav_menu > ul.menu').wrap('<nav class="secondary-navigation mobile-expander" aria-label="Section Navigation">');

	// Mobile menu a11y helper (close menu when tabbing out)
	(function ($) { $(function () { 'use strict';
		
		$('#main-navigation').keydown(function(e) {
			
			if ($('#mobile-nav').is(':visible')){
				
				var trigger = e.target;
				
				//If there is a utility nav, close after last item
				if($(trigger).parent().hasClass('last-item')) {
					$('#mobile-close').trigger('click');
				}

				// If there is a submenu
				else if($(trigger).parents().hasClass('sub-menu')) {
					var parent = $(trigger).parents('.parent');
					if ($(parent).is(':last-child') && $(trigger).is(':last-child')) {
						if (e.keyCode == 9 && !e.shiftKey) {
							$('#mobile-close').trigger('click');
						}
					}
				}
				
				// Otherwise it is probably a normal menu item and should close on last item.
				else if ($(trigger).parents('.top-level-li').is(':last-child') && $(trigger).is(':last-child') && !$(trigger).parents('#mobile-utility').length > 0) {
					$('#mobile-close').trigger('click');
				}
			}
		});	

	});})(jQuery, this);

});