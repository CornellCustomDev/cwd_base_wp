<?php 

if ( ! function_exists ( 'custom_body_classes' ) ) {
	
	function custom_body_classes( $classes ) {
		
		global $post;
		
		$post_type = get_post_type();
		
		// Get layout for current page
		$layout = get_layout();

		// Add layout classes to body
		if ( $layout == 'left_sidebar' ) {
			$classes[] = 'sidebar sidebar-left';
		}
		if ( $layout == 'right_sidebar' ) {
			$classes[] = 'sidebar sidebar-right';
		}
		if ( $layout == 'no_sidebar' ) {
			$classes[] = 'no-sidebar';
		}

		// Sidebar tinting
		$sidebar_options = get_field('sidebar_options', 'options');
		$tinting = $sidebar_options['tinting'];
		$tinting_options = $sidebar_options['tinting_options'];
		
		// Get layout for archives
		$archive_options = get_field('archive_options', 'options');
		$archive_layout = $archive_options[$post_type]['layout_' . $post_type];		
		
		if($tinting == 1 
		    && $layout != 'no_sidebar'
		    && $archive_layout != 'no_sidebar') {
			$classes[] = 'sidebar-tint';
		}
		if($tinting_options == 'edge' 
		    && $layout != 'no_sidebar'
		    && $archive_layout != 'no_sidebar') {
			$classes[] = 'sidebar-tint-edge';
		}
		if($tinting_options == 'fade' 
		    && $layout != 'no_sidebar'
		    && $archive_layout != 'no_sidebar') {
			$classes[] = 'sidebar-tint-fade';
		}

		// Get banner classes
		$cu_banner = get_theme_mod( 'color' );
		$logo_size_option = get_theme_mod( 'logo_size' );
		$logo_position_option = get_theme_mod( 'logo_position' );
		$logo_mobile_option = get_theme_mod( 'logo_switch_mobile' );
		$logo_mobile_red_option = get_theme_mod( 'logo_switch_red_mobile' );

		switch($cu_banner) {
			case 'cu-red':
				$classes[] ='cu-red';
				break;
			case 'cu-black':
				$classes[] ='cu-black';
				break;
			case 'cu-gray':
				$classes[] ='cu-gray';
				break;
			default:

		}

		if($logo_size_option == 'small') {
			$classes[] = 'cu-45';
		} 
		if($logo_size_option == 'large') {
			$classes[] = 'cu-seal';
		}
		
		if($logo_position_option == 'right' && $logo_size_option == 'large') {
			$classes[] = 'cu-seal-right';
		}
		
		if($logo_mobile_option == 'yes') {
			$classes[] = 'cu-45-mobile';
		}		
		
		if($logo_mobile_red_option == 'yes') {
			$classes[] = 'cu-45-mobile-red';
		}		

		if(has_nav_menu('top-menu')) {
			$classes[] = 'has-utility-nav';
		}
		
		if(is_page('Styleguide')) {
			$classes[] = 'styleguide';
		}
		
		return $classes;
	}
	add_filter( 'body_class', 'custom_body_classes' );
}

// Remove custom post type from post_class()
if ( ! function_exists ( 'cwd_remove_postclass' ) ) {
	function cwd_remove_postclass($classes, $class, $post_id) {
		$classes = array_diff( $classes, array(
			get_post_type($post_id),
		) );
		return $classes;
	}
	add_filter('post_class', 'cwd_remove_postclass', 10, 3);
}
