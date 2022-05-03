<?php

// Add customizer options
if ( ! function_exists ( 'cwd_base_customize_register' ) ) {

	function cwd_base_customize_register( $wp_customize ) {
		
		// Remove colors section
		$wp_customize->remove_control('header_textcolor');
		$wp_customize->remove_control('background_color');
		
		// Add banner section
		$wp_customize->add_section( 'cu_banner', array( 'title' => 'Banner', 'description' => 'Customize the Cornell banner.', 'priority' => 40, ) );
		
				// Banner settings
		$wp_customize->add_setting( 'color', array('default' => '', 'sanitize_callback'  => 'esc_attr') );
		$wp_customize->add_setting( 'logo_size', array('default' => 'small', 'sanitize_callback'  => 'esc_attr') );
		$wp_customize->add_setting( 'logo_position', array('default' => 'left', 'sanitize_callback'  => 'esc_attr') );
		$wp_customize->add_setting( 'logo_switch_mobile', array('default' => 'no', 'sanitize_callback'  => 'esc_attr') );
		$wp_customize->add_setting( 'logo_switch_red_mobile', array('default' => 'no', 'sanitize_callback'  => 'esc_attr') );

				// Banner controls
		$wp_customize->add_control( 'color', array( 'label' => 'Banner color', 'section' => 'cu_banner', 'type' => 'radio', 'choices' => array( 'cu-red' => 'Red', 'cu-black' => 'Black', '' => 'Light Gray', 'cu-gray' => 'Dark Gray', ), ) );
		
		$wp_customize->add_control( 'logo_size', array( 'label' => 'Logo size', 'section' => 'cu_banner', 'type' => 'radio', 'choices' => array( 'small' => 'Small (45px)', 'large' => 'Large insignia (120px)' ), ) );
		
		$wp_customize->add_control( 'logo_position', array( 'label' => 'Logo position', 'section' => 'cu_banner', 'type' => 'radio', 'choices' => array( 'left' => 'Left', 'right' => 'Right' ), ) );
		
		$wp_customize->add_control( 'logo_switch_mobile', array( 'label' => 'Switch to 45px style at mobile sizes?', 'section' => 'cu_banner', 'type' => 'radio', 'choices' => array( 'yes' => 'Yes', 'no' => 'No' ), ) );
		
		$wp_customize->add_control( 'logo_switch_red_mobile', array( 'label' => 'Also switch to red at mobile sizes?', 'section' => 'cu_banner', 'type' => 'radio', 'choices' => array( 'yes' => 'Yes', 'no' => 'No' ), ) );
		
				// Remove header text control
		$wp_customize->remove_control('display_header_text');
		
		// Add font section
		$wp_customize->add_section( 'fonts', array( 'title' => 'Fonts', 'description' => 'The default font for this theme is <a href="https://fonts.adobe.com/fonts/freight-sans" target="_blank">Freight Sans</a>. You can toggle that on or off here. ', 'priority' => 90, ) );

				// Font default setting
		$wp_customize->add_setting( 'freight', array( 'default' => true ) );

				// Font setting control
		$wp_customize->add_control( 'freight', array( 'label' => 'Use Freight Sans font?', 'section' => 'fonts', 'type' => 'checkbox', ) );

		// Add social icons section
		$wp_customize->add_section( 'social_icons_section', array( 'title' => 'Social Icons', 'description' => 'Enter the url for the social icons you wish to include in the footer.', 'priority' => 995, ) );
		
				// Add settings
		$wp_customize->add_setting( 'facebook', array( 'sanitize_callback'  => 'esc_url_raw') );
		$wp_customize->add_setting( 'twitter', array( 'sanitize_callback'  => 'esc_url_raw' ) );
		$wp_customize->add_setting( 'linkedin', array( 'sanitize_callback'  => 'esc_url_raw' ) );
		$wp_customize->add_setting( 'instagram', array( 'sanitize_callback'  => 'esc_url_raw' ) );
		$wp_customize->add_setting( 'youtube', array( 'sanitize_callback'  => 'esc_url_raw' ) );
		//$wp_customize->add_setting( 'google_plus', array( 'sanitize_callback'  => 'esc_url_raw' ) );
		//$wp_customize->add_setting( 'pinterest', array( 'sanitize_callback'  => 'esc_url_raw' ) );
		//$wp_customize->add_setting( 'tumblr', array( 'sanitize_callback'  => 'esc_url_raw' ) );
		//$wp_customize->add_setting( 'flickr', array( 'sanitize_callback'  => 'esc_url_raw' ) );
		//$wp_customize->add_setting( 'vimeo', array( 'sanitize_callback'  => 'esc_url_raw' ) );
		
				// Add controls
		$wp_customize->add_control( 'facebook', array( 'label' => 'Facebook', 'section' => 'social_icons_section', 'type' => 'text', ) );
		$wp_customize->add_control( 'twitter', array( 'label' => 'Twitter', 'section' => 'social_icons_section', 'type' => 'text', ) );
		$wp_customize->add_control( 'linkedin', array( 'label' => 'Linked In', 'section' => 'social_icons_section', 'type' => 'text', ) );
		$wp_customize->add_control( 'instagram', array( 'label' => 'Instagram', 'section' => 'social_icons_section', 'type' => 'text', ) );
		$wp_customize->add_control( 'youtube', array( 'label' => 'Youtube', 'section' => 'social_icons_section', 'type' => 'text', ) );
		//$wp_customize->add_control( 'google_plus', array( 'label' => 'Google Plus', 'section' => 'social_icons_section', 'type' => 'text', ) );
		//$wp_customize->add_control( 'pinterest', array( 'label' => 'Pinterest', 'section' => 'social_icons_section', 'type' => 'text', ) );
		//$wp_customize->add_control( 'tumblr', array( 'label' => 'Tumblr', 'section' => 'social_icons_section', 'type' => 'text', ) );
		//$wp_customize->add_control( 'flickr', array( 'label' => 'Flickr', 'section' => 'social_icons_section', 'type' => 'text', ) );
		//$wp_customize->add_control( 'vimeo', array( 'label' => 'Vimeo', 'section' => 'social_icons_section', 'type' => 'text', ) );
		
	}
}
add_action( 'customize_register', 'cwd_base_customize_register' );

// Customize controls script - show/hide options conditionally
function customize_controls_js() {
	wp_enqueue_script( 'customize-controls-js', get_theme_file_uri( '/functions/customizer/customize-controls.js' ), array('jquery'), '', true );
}
add_action( 'customize_controls_enqueue_scripts', 'customize_controls_js' );

