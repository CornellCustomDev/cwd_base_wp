<?php 

if ( ! function_exists ( 'custom_body_classes' ) ) {
	
	function custom_body_classes( $classes ) {
		
		global $post;
		
		$post_type = get_post_type() ?: '';
		
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
		$archive_layout = array_key_exists( $post_type, $archive_options ) ? $archive_options[$post_type]['layout_' . $post_type] : '';
		
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

		// Academic unit checkbox
		$au_boolean = get_theme_mod( 'au_boolean' ) ?: '';

		// Get banner classes
		if(!$au_boolean) {
			$cu_banner = get_theme_mod( 'color' );
			$logo_size_option = get_theme_mod( 'logo_size' );
			$logo_position_option = get_theme_mod( 'logo_position' );
			$logo_mobile_option = get_theme_mod( 'logo_switch_mobile' );
			$logo_mobile_red_option = get_theme_mod( 'logo_switch_red_mobile' );
		} 
		else {
			$classes[] = 'cu-seal au-boolean'; // Make sure logo size is large initially
			$au_banner = get_theme_mod( 'au_color' );
			$au_logo_option = get_theme_mod( 'au_logo' );
			$au_logo_mobile_option = get_theme_mod( 'au_logo_switch_mobile' );
			$au_logo_mobile_red_option = get_theme_mod( 'au_logo_switch_red_mobile' );
		}

		if($au_boolean === '') {
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
		}
		else {
			switch($au_banner) {
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
		}

		if($au_boolean === '') {
			if($logo_size_option == 'small') {
				$classes[] = 'cu-45';
			} 
			if($logo_size_option == 'large') {
				$classes[] = 'cu-seal';
			}
			if($logo_position_option == 'right' && $logo_size_option == 'large') {
				$classes[] = 'cu-seal-right';
			}
		}
		
		if($au_boolean === '') {
			if($logo_mobile_option == 'yes') {
				$classes[] = 'cu-45-mobile';
			}
		}
		else {
			if($au_logo_mobile_option == 'yes') {
				$classes[] = 'cu-45-mobile';
			}
		}
		
		if($au_boolean === '') {
			if($logo_mobile_red_option == 'yes') {
				$classes[] = 'cu-45-mobile-red';
			}
		}
		else {
			if($au_logo_mobile_red_option == 'yes') {
				$classes[] = 'cu-45-mobile-red';
			}
		}

		if(has_nav_menu('top-menu')) {
			$classes[] = 'has-utility-nav';
		}
		
		if(is_page('Styleguide')) {
			$classes[] = 'styleguide';
		}

		$classes[] = 'page-slug-' . $post->post_name;

		// On multisites, add the blog id body class
		if(is_multisite()) {
			$classes[] = 'blog-' . get_current_blog_id();
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
