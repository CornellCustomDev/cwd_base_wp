<?php

// Enqueue admin assets
if ( ! function_exists ( 'cwd_base_admin_assets' ) ) {
	function cwd_base_admin_assets() {
		wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/css/admin.css' );
		wp_enqueue_script( 'admin-scripts', get_template_directory_uri() . '/js/wp/admin.js');
	}

	add_action( 'admin_enqueue_scripts', 'cwd_base_admin_assets');
}

// Load CSS Framework scripts
if ( ! function_exists ( 'cwd_base_scripts_and_styles' ) ) {
	function cwd_base_scripts_and_styles() {
		global $post;

		wp_enqueue_script('cwd-wp-script-js', get_template_directory_uri() . '/js/wp/cwd_wp.js','','',true );
		wp_enqueue_script('cwd-card-slider-js', get_template_directory_uri() . '/js/cwd_card_slider.js', '','',true );
		wp_enqueue_script('cwd-formidable-validation-js', get_template_directory_uri() . '/js/wp/formidable_validation.js', '','',true );
		wp_enqueue_script('cwd-gallery-js', get_template_directory_uri() . '/js/cwd_gallery.js', '','',true );
		wp_enqueue_script('cwd-popups-js', get_template_directory_uri() . '/js/cwd_popups.js', '','',true );
		wp_enqueue_script('cwd-utilities-js', get_template_directory_uri() . '/js/cwd_utilities.js', '','',true );
		wp_enqueue_script('cwd-twitter-widget-js', get_template_directory_uri() . '/js/wp/twitter-widget.js', '','',true );
		wp_enqueue_script('contrib-js-swipe-js', get_template_directory_uri() . '/js/contrib/jquery.detect_swipe.js', '','',true );
		wp_enqueue_script('contrib-js-debounce-js', get_template_directory_uri() . '/js/contrib/modernizr.js', '','',true );
		wp_enqueue_script('contrib-js-pep-js', get_template_directory_uri() . '/js/contrib/pep.js', '','',true );
		wp_enqueue_script('contrib-js-fitvids-js', get_template_directory_uri() . '/js/wp/jquery.fitvids.js', '','',true );
		wp_enqueue_script('cwd-siteimprove-js', get_template_directory_uri() . '/js/wp/siteimprove.js', '','',true );
		wp_enqueue_script('cwd-project-js', get_template_directory_uri() . '/js/wp/project.js', '','',true );
		wp_enqueue_script('jquery-effects-core'); // jQuery UI effects - contains easing functions

		// Header slider scripts
		// Load slider functionality from CSS Framework
		wp_enqueue_script('cwd-slider-js', get_template_directory_uri() . '/js/cwd_slider.js', '','',true );

		// Register script to initialize header slider
		wp_register_script('cwd-header-slider-js', get_template_directory_uri() . '/js/cwd_header_slider.js', '','',true );

		// Only localize & enqueue slider init script on pages that use slider
		if ( get_field( 'use_slider_in_header' ) && have_rows( 'header_slides' ) ) {
			// Pass php variables to the init script
			wp_localize_script( 'cwd-header-slider-js', 'image_array1', cwd_base_generate_slide_array() );

			// Finally, enqueue the init script
			wp_enqueue_script( 'cwd-header-slider-js' );
		}

		// Styles
		wp_enqueue_style('freight-css', '//use.typekit.net/nwp2wku.css'); // Freight Text and Sans
		wp_enqueue_style('cwd-base-css', get_template_directory_uri() . '/css/base.css');
		wp_enqueue_style('cornell-css', get_template_directory_uri() . '/css/cornell.css');
		wp_enqueue_style('cwd-card-slider-css', get_template_directory_uri() . '/css/cwd_card_slider.css');
		wp_enqueue_style('cwd-gallery-css', get_template_directory_uri() . '/css/cwd_gallery.css');
		wp_enqueue_style('cwd-slider-css', get_template_directory_uri() . '/css/cwd_slider.css');
		wp_enqueue_style('cwd-utilities-css', get_template_directory_uri() . '/css/cwd_utilities.css');
		wp_enqueue_style('cwd-wp-css', get_template_directory_uri() . '/css/cwd_wp.css');
		wp_enqueue_style('cwd-twitter-widget-css', get_template_directory_uri() . '/css/twitter-widget.css');
		wp_enqueue_style('cwd-formidable-validation-css', get_template_directory_uri() . '/css/formidable_validation.css');
		wp_enqueue_style('cornell-font-fa-css', get_template_directory_uri() . '/fonts/font-awesome.min.css');
		wp_enqueue_style('cornell-font-zmdi-css', get_template_directory_uri() . '/fonts/material-design-iconic-font.min.css');
		wp_enqueue_style('cwd-project-css', get_stylesheet_directory_uri() . '/css/project.css');
	}

	add_action('wp_enqueue_scripts', 'cwd_base_scripts_and_styles');
}

// Remove WP version number and append random version number for scripts and styles
if ( ! function_exists ( 'add_random_version_number' ) ) {
	function add_random_version_number ( $src, $handle ) {
		if( strpos( $src, '?ver=' ) ) {
			$src = remove_query_arg( 'ver', $src );
		}

		return add_query_arg( 'ver', rand(), $src );
	}

	add_filter( 'script_loader_src', 'add_random_version_number', 10, 2 );
	add_filter( 'style_loader_src', 'add_random_version_number', 10, 2 );
}
