<?php

// Add editor styles
if ( ! function_exists ( 'cwd_base_editor_styles' ) ) {
	function cwd_base_editor_styles() {
		add_editor_style( 'css/editor-style.css');
	}
}
add_action( 'admin_init', 'cwd_base_editor_styles' );

// Override default TinyMCE skin
if ( ! function_exists ( 'cwd_base_tinymce_editor_css' ) ) {
	function cwd_base_tinymce_editor_css() {
		$src = get_template_directory_uri().'/css/tinymce.css';
		$ver = add_query_arg( 'ver', rand(), $src ); ?>
		<link rel='stylesheet' href='<?php echo $ver; ?>' type='text/css' />
		<?php
	}
	add_action( 'admin_footer', 'cwd_base_tinymce_editor_css' );
}

// Display kitchen sink by default in the editor
if ( ! function_exists ( 'cwd_base_format_TinyMCE' ) ) {
	function cwd_base_format_TinyMCE( $in ) {
		$in['wordpress_adv_hidden'] = FALSE;
		return $in;
	}
	add_filter( 'tiny_mce_before_init', 'cwd_base_format_TinyMCE' );
}

// Custom WYSIWYG Classes
if ( ! function_exists ( 'add_style_select_buttons' ) ) {
	function add_style_select_buttons( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}
	add_filter( 'mce_buttons', 'add_style_select_buttons' );
}

// Customize the TinyMCE buttons
if( !function_exists('cwd_base_editor_mce_buttons') ){
    function cwd_base_editor_mce_buttons($buttons) { // First row
        return array(
            'formatselect', 'bold', 'italic', 'strikethrough', 'alignleft', 'aligncenter', 'alignright', 'alignfull', 'outdent', 'indent', 'bullist', 'numlist', 'subscript', 'superscript', 'table', 'charmap', 'removeformat', 'spellchecker', 'undo', 'redo', 'link', 'unlink', 'image', 'cleanup', 'wp_help', 'anchor', 'visualaids', 'separator', 'fullscreen'
        ); // Not sure why all of these aren't working, and I wish I had a list of all available buttons, but apparently that's highly classified, top secret information.
    }
    add_filter('mce_buttons', 'cwd_base_editor_mce_buttons', 0); // Use mce_buttons_2, 3, or 4 to add more rows.
}

// Add table plugin for tinymce
function add_the_table_plugin( $plugins ) {
    $plugins['table'] = get_template_directory_uri() . '/functions/tinymce/plugins/table/plugin.min.js';
    return $plugins;
}
add_filter( 'mce_external_plugins', 'add_the_table_plugin' );

if( !function_exists('cwd_base_editor_mce_buttons_2') ){
    function cwd_base_editor_mce_buttons_2($buttons) { // Second row, not needed at the moment, but we need to explicitly make it empty or WordPress will add buttons we don't want.
        return array('');
    }
    add_filter('mce_buttons_2', 'cwd_base_editor_mce_buttons_2', 0);
}

// Add custom styles to Formats menu
if ( ! function_exists ( 'cwd_base_custom_styles' ) ) {
	
	function cwd_base_custom_styles( $init_array ) {  

		$style_formats = array(  
			array(  
				'title' => 'Intro Text',  
				'block' => 'span',  
				'classes' => 'intro',
				'wrapper' => true,
			),
			array(  
				'title' => 'Note',  
				'inline' => 'strong',  
				'classes' => 'tutorial note',
				'styles' => array(
					'color'         => '#518212',
					'fontWeight'    => 'bold',
				),
				'wrapper' => true,
			),
			array(  
				'title' => 'Link Button',  
				'selector' => 'a',  
				'classes' => 'link-button',
			),
			array(  
				'title' => 'Text Highlights',				
				'items' => array(
					array(  
						'title' => 'Red',  
						'inline' => 'mark',  
						'classes' => 'text-highlight-red',
					),
					array(  
						'title' => 'Green',  
						'inline' => 'mark',  
						'classes' => 'text-highlight-green',
					),
					array(  
						'title' => 'Gold',  
						'inline' => 'mark',  
						'classes' => 'text-highlight-yellow',
					),
					array(  
						'title' => 'Yellow',  
						'inline' => 'mark',  
					),
					array(  
						'title' => 'Blue',  
						'inline' => 'mark',  
						'classes' => 'text-highlight-blue',
					),
					array(  
						'title' => 'Purple',  
						'inline' => 'mark',  
						'classes' => 'text-highlight-purple',
					),
				),
			),
			array(  
				'title' => 'Block Quotes',				
				'items' => array(
					array(  
						'title' => 'Block Quote (offset)',  
						'block' => 'blockquote',  
						'classes' => 'offset',
						'wrapper' => true,
					),
					array(  
						'title' => 'Block Quote (impact)',  
						'block' => 'blockquote',  
						'classes' => 'impact',
						'wrapper' => true,
					),
				),
			),
			array(  
				'title' => 'Testimonials',  
				'block' => 'div',  
				'classes' => 'testimonial',
				'wrapper' => true,
			),
			array(  
				'title' => 'Asides',				
				'items' => array(
					array(  
						'title' => 'Aside',  
						'block' => 'aside',  
						'wrapper' => true,
					),
					array(  
						'title' => 'Aside Right',  
						'block' => 'aside',  
						'classes' => 'sidebar',
						'wrapper' => true,
					),
					array(  
						'title' => 'Aside Column',  
						'block' => 'aside',  
						'classes' => 'column',
						'wrapper' => true,
					),
				),
			),
			array(  
				'title' => 'Horizontal Rules',				
				'items' => array(
					array(  
						'title' => 'Default',  
						'block' => 'hr',  
						'wrapper' => false,
					),
					array(  
						'title' => 'Blue-Green',  
						'block' => 'hr',  
						'classes' => 'accent1',
						'wrapper' => false,
					),
					array(  
						'title' => 'Blue',  
						'block' => 'hr',  
						'classes' => 'accent2',
						'wrapper' => false,
					),
					array(  
						'title' => 'Purple',  
						'block' => 'hr',  
						'classes' => 'accent3',
						'wrapper' => false,
					),
					array(  
						'title' => 'Gold',  
						'block' => 'hr',  
						'classes' => 'accent4',
						'wrapper' => false,
					),
					array(  
						'title' => 'Green',  
						'block' => 'hr',  
						'classes' => 'accent5',
						'wrapper' => false,
					),
					array(  
						'title' => 'Invisible (no visible line, spacer only)',  
						'block' => 'hr',  
						'classes' => 'invisible',
						'wrapper' => false,
					),
					array(  
						'title' => 'Dotted',  
						'block' => 'hr',  
						'classes' => 'dotted',
						'wrapper' => false,
					),
					array(  
						'title' => 'Dashed',  
						'block' => 'hr',  
						'classes' => 'dashed',
						'wrapper' => false,
					),
					array(  
						'title' => 'Double',  
						'block' => 'hr',  
						'classes' => 'double',
						'wrapper' => false,
					),
					array(  
						'title' => 'Heavy',  
						'block' => 'hr',  
						'classes' => 'heavy',
						'wrapper' => false,
					),
					array(  
						'title' => 'Extra-Heavy',  
						'block' => 'hr',  
						'classes' => 'extra-heavy',
						'wrapper' => false,
					),
					array(  
						'title' => 'Faded',  
						'block' => 'hr',  
						'classes' => 'fade',
						'wrapper' => false,
					),
					array(  
						'title' => 'Flourish',  
						'block' => 'hr',  
						'classes' => 'flourish',
						'wrapper' => false,
					),
					array(  
						'title' => 'Cornell Icon',  
						'block' => 'hr',  
						'classes' => 'bigred',
						'wrapper' => false,
					),
					array(  
						'title' => 'Section Break (section divider with extra spacing)',  
						'block' => 'hr',  
						'classes' => 'section-break',
						'wrapper' => false,
					),
				),
			),
			array(  
				'title' => 'Panels',				
				'items' => array(
					array(  
						'title' => 'Default',  
						'block' => 'div',  
						'wrapper' => true,
						'classes' => 'fill panel',
					),
					array(  
						'title' => 'Blue-Green',  
						'block' => 'div',  
						'wrapper' => true,
						'classes' => 'accent-blue-green fill panel',
					),
					array(  
						'title' => 'Blue',  
						'block' => 'div',  
						'wrapper' => true,
						'classes' => 'accent-blue fill panel',
					),
					array(  
						'title' => 'Purple',  
						'block' => 'div',  
						'wrapper' => true,
						'classes' => 'accent-purple fill panel',
					),
					array(  
						'title' => 'Gold',  
						'block' => 'div',  
						'wrapper' => true,
						'classes' => 'accent-gold fill panel',
					),
					array(  
						'title' => 'Green',  
						'block' => 'div',  
						'wrapper' => true,
						'classes' => 'accent-green fill panel',
					),
					array(  
						'title' => 'Red',  
						'block' => 'div',  
						'wrapper' => true,
						'classes' => 'accent-red fill panel',
					),
				),
			),
			array(  
				'title' => 'Tables',				
				'items' => array(
					array(  
						'title' => 'Default',  
						'selector' => 'table',
						'classes' => 'table'
					),
					array(  
						'title' => 'Bordered',  
						'selector' => 'table',
						'classes' => 'table bordered',
					),
					array(  
						'title' => 'Flat',  
						'selector' => 'table',
						'classes' => 'table flat',
					),
					array(  
						'title' => 'Striped',  
						'selector' => 'table',
						'classes' => 'table striped',
					),
					array(  
						'title' => 'Flat + Striped',  
						'selector' => 'table',
						'classes' => 'table flat striped',
					),
					array(  
						'title' => 'Colored',  
						'selector' => 'table',
						'classes' => 'table striped colored',
					),
					array(  
						'title' => 'Flat + Colored',  
						'selector' => 'table',
						'classes' => 'table flat striped colored',
					),
					array(  
						'title' => 'Rainbow',  
						'selector' => 'table',
						'classes' => 'table striped rainbow',
					),
					array(  
						'title' => 'Flat + Rainbow',  
						'selector' => 'table',
						'classes' => 'table flat striped rainbow',
					),
				),
			),
		);  
		$init_array['style_formats'] = json_encode( $style_formats );  

		return $init_array;  

	} 
	add_filter( 'tiny_mce_before_init', 'cwd_base_custom_styles' );
}