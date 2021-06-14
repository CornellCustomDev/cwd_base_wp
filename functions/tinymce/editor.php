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
		$src = get_template_directory_uri().'/css/tinymce_editor.css';
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
if ( ! function_exists ( 'cwd_base_tinymce_buttons' ) ) {
	function cwd_base_tinymce_buttons( $in ) {
		$in['remove_linebreaks'] = false;
		$in['gecko_spellcheck'] = true;
		$in['keep_styles'] = true;
		$in['accessibility_focus'] = true;
		$in['tabfocus_elements'] = 'major-publishing-actions';
		$in['media_strict'] = false;
		$in['paste_remove_styles'] = false;
		$in['paste_remove_spans'] = false;
		$in['paste_strip_class_attributes'] = 'none';
		$in['paste_text_use_dialog'] = true;
		$in['wpeditimage_disable_captions'] = true;
		$in['plugins'] = 'tabfocus,paste,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs';
		$in['content_css'] = get_template_directory_uri() . "/css/editor-style.css";
		$in['wpautop'] = true;
		$in['apply_source_formatting'] = false;
		$in['block_formats'] = "Paragraph=p; Heading 3=h3; Heading 4=h4";
		$in['toolbar1'] = 'bold,italic,strikethrough,bullist,numlist,alignleft,aligncenter,alignright,link,unlink,spellchecker,wp_fullscreen,wp_adv';
		$in['toolbar2'] = 'a11ycheck,formatselect,styleselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help ';
		$in['toolbar3'] = '';
		$in['toolbar4'] = '';
		return $in;
	}
	add_filter( 'tiny_mce_before_init', 'cwd_base_tinymce_buttons' );
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
						'title' => 'Invisible',  
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
		);  
		$init_array['style_formats'] = json_encode( $style_formats );  

		return $init_array;  

	} 
	add_filter( 'tiny_mce_before_init', 'cwd_base_custom_styles' );
}