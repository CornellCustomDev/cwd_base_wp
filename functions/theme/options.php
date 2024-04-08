<?php

// Get site URL
$baseUrl = site_url();

// Create post type checkboxes on theme options page
function acf_load_post_types( $field ) {
    
	$field['choices'] = array();
	
	$all_post_types = get_all_custom_post_types();
	
    foreach( $all_post_types as $post_type ) {
		if($post_type == 'galleries') {
			$field['choices'][ 'galleries' ] = 'Photo Galleries'; // Change the label for photo galleries
		}
		else {
			$field['choices'][ $post_type ] = ucwords(str_replace('_', ' ', $post_type));
		}
    }

	return $field;

}
add_filter('acf/load_field/name=post_types', 'acf_load_post_types');

// Get chosen post_types based on theme options checked boxes
if ( ! function_exists ( 'get_checked_post_types' ) ) {
	function get_checked_post_types() {

		$post_type_options = get_field('post_type_options', 'options');

		if($post_type_options) {
			$checked_post_types = $post_type_options['post_types'];
			return $checked_post_types;
		}

	}
}

// Check the box for a new post type on theme options page
function check_post_type_box_initially($data) {

	// Get the post types that are already checked
	$checked = get_checked_post_types();

	// Get the post types that have already been registered
	$already_registered = get_option('already_registered', []);

	// Don't do anything for those post types that are not new
	if ( in_array( $data['cpt_custom_post_type']['name'], $already_registered ) ) {
		return;
	}

	// This is a new post type: add it to the checked and already registered arrays
	$checked[] = $data['cpt_custom_post_type']['name'];
	$already_registered[] = $data['cpt_custom_post_type']['name'];

	// Update the database
	update_option('options_post_type_options_post_types', $checked);
	update_option('already_registered', $already_registered, 'yes');

}
add_action( 'cptui_after_update_post_type', 'check_post_type_box_initially' );

// Filter post type metadata choices
if ( ! function_exists ( 'add_metadata_filter' ) ) {
	function add_metadata_filter() {
		
		$checked_post_types = get_checked_post_types();

		foreach($checked_post_types as $post_type) {
			add_filter('acf/load_field/name=metadata_' . $post_type, 'get_taxonomies_from_post_type');
		}
	}
	add_action('init', 'add_metadata_filter');
}

// Load taxonomies for each post type
function get_taxonomies_from_post_type( $field ) {
    
	$field['choices'] = array();

	$post_type = substr($field['name'], 9);
		
	$args = array(
		'object_type' => array( $post_type ),
		'public'      => true,
	);

	$taxonomies = get_taxonomies( $args, 'objects' );

	if(empty($taxonomies)) {
		$field['choices']['message'] = '<em class="no-taxonomies">*This post type has no tags, categories, or taxonomies to display.</em>';
		return $field;
	}

	foreach ( $taxonomies as $taxonomy ) {
		$field['choices'][$taxonomy->name] = $taxonomy->label;
	}

	$field['choices']['archives'] = 'On archive pages';
	$field['choices']['single'] = 'On single posts';
	$field['choices']['labels'] = 'Text labels';
	$field['choices']['icons'] = 'Icons';

	return $field;

}

function get_post_type_taxonomies_names($post_type) {

	$taxonomies = get_object_taxonomies( $post_type );

	return $taxonomies;

}

function get_post_type_taxonomies_labels($post_type) {

	$taxonomies = array();

	$args = array(
		'object_type' => array( $post_type ),
		'public'      => true,
	);

	$taxonomies = get_taxonomies( $args, 'objects' );

	foreach ( $taxonomies as $taxonomy ) {
		$taxonomies[] = $taxonomy->label;
	}

	return $taxonomies;

}

if( function_exists('acf_add_options_page') ):

acf_add_options_page(array(
	'page_title' => 'Theme Options',
	'menu_slug' => 'theme-options',
	'menu_title' => 'Theme Options',
	'capability' => 'edit_posts',
	'position' => '',
	'parent_slug' => '',
	'icon_url' => 'dashicons-admin-tools',
	'redirect' => true,
	'post_id' => 'options',
	'autoload' => false,
	'update_button' => 'Update',
	'updated_message' => 'Options Updated',
));

endif;

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
	'key' => 'group_60ee337d69ad0',
	'title' => 'Post Types',
	'fields' => array(
		array(
			'key' => 'field_60ee337d7101e',
			'label' => 'Post types',
			'name' => 'post_type_options',
			'type' => 'group',
			'instructions' => 'Add these post types to your theme.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'acfe_seamless_style' => 0,
			'acfe_group_modal' => 0,
			'sub_fields' => array(
				array(
					'key' => 'field_60ee337d728e7',
					'label' => 'Post types',
					'name' => 'post_types',
					'type' => 'checkbox',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'input-10',
						'id' => '',
					),
					'choices' => array(
					),
					'allow_custom' => 0,
					'default_value' => array(
					),
					'layout' => 'vertical',
					'toggle' => 0,
					'return_format' => 'value',
					'save_custom' => 0,
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => -50,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'acfe_display_title' => '',
	'acfe_autosync' => array(
		0 => 'json',
	),
	'acfe_form' => 0,
	'acfe_meta' => array(
		'604dddb8749bf' => array(
			'acfe_meta_key' => '',
			'acfe_meta_value' => '',
		),
	),
	'acfe_note' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_60897d9188783',
	'title' => 'Home Page',
	'fields' => array(
		array(
			'key' => 'field_60897d918c475',
			'label' => 'Home Page',
			'name' => 'home_page_options',
			'type' => 'group',
			'instructions' => 'Set the front page on the Reading menu <a href="' . site_url() . '/wp-admin/options-reading.php">here</a>.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'acfe_seamless_style' => 0,
			'acfe_group_modal' => 0,
			'sub_fields' => array(
				array(
					'key' => 'field_60897d918d84b',
					'label' => 'Replace title',
					'name' => 'replace_title',
					'type' => 'text',
					'instructions' => 'Change the home page title or leave blank to remove the title.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'input-8',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_608989540fa5a',
					'label' => 'Remove breadcrumbs',
					'name' => 'remove_breadcrumbs',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => '',
					'ui' => 0,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'acfe_display_title' => '',
	'acfe_autosync' => '',
	'acfe_form' => 0,
	'acfe_meta' => '',
	'acfe_note' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_60898f4dbb35a',
	'title' => 'Blog Page',
	'fields' => array(
		array(
			'key' => 'field_60898f4dbe6d3',
			'label' => 'Blog Page',
			'name' => 'blog_page_options',
			'type' => 'group',
			'instructions' => 'Set the blog page on the Reading menu <a href="' . site_url() . '/wp-admin/options-reading.php">here</a>.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'acfe_seamless_style' => 0,
			'acfe_group_modal' => 0,
			'sub_fields' => array(
				array(
					'key' => 'field_60898f4dc0df5',
					'label' => 'Replace title',
					'name' => 'replace_title',
					'type' => 'text',
					'instructions' => 'Change the blog page title or leave blank to remove the title.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'input-8',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_60899328fe635',
					'label' => 'Add introductory text',
					'name' => 'add_introductory_text',
					'type' => 'wysiwyg',
					'instructions' => 'Add some introductory text to the blog page, just below the title.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 5,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'acfe_display_title' => '',
	'acfe_autosync' => '',
	'acfe_form' => 0,
	'acfe_meta' => '',
	'acfe_note' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_60ad2423d70f2',
	'title' => 'Sidebars',
	'fields' => array(
		array(
			'key' => 'field_60ad2423f28a9',
			'label' => 'Sidebars',
			'name' => 'sidebar_options',
			'aria-label' => '',
			'type' => 'group',
			'instructions' => 'Note: The default placement of the sidebar is to the right of the main content, but this can be overridden on a page by page basis from the page edit screen. Empty sidebars will force a full-width (no sidebar) layout.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'acfe_seamless_style' => 0,
			'acfe_group_modal' => 0,
			'acfe_group_modal_close' => 0,
			'acfe_group_modal_button' => '',
			'acfe_group_modal_size' => 'large',
			'sub_fields' => array(
				array(
					'key' => 'field_63d0205bdb7ac',
					'label' => 'Layout',
					'name' => 'layout',
					'aria-label' => '',
					'type' => 'radio',
					'instructions' => 'This is a global setting which affects all pages but can be overridden for any page. Does not affect archives.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'left_sidebar' => 'Left sidebar',
						'right_sidebar' => 'Right sidebar',
						'no_sidebar' => 'No sidebar (full-width)',
					),
					'default_value' => 'right_sidebar',
					'return_format' => 'value',
					'allow_null' => 0,
					'other_choice' => 0,
					'layout' => 'vertical',
					'save_other_choice' => 0,
				),
				array(
					'key' => 'field_60ad2424056e3',
					'label' => 'Tinting',
					'name' => 'tinting',
					'aria-label' => '',
					'type' => 'true_false',
					'instructions' => 'Choose sitewide tinting options for the sidebar.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'input-10',
						'id' => '',
					),
					'message' => 'Add tinting?',
					'default_value' => 0,
					'ui' => 0,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
				array(
					'key' => 'field_60ad24240575b',
					'label' => 'Tinting options',
					'name' => 'tinting_options',
					'aria-label' => '',
					'type' => 'radio',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_60ad2424056e3',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'edge' => 'Full tint (to edge of screen)',
						'fade' => 'Fade to white',
					),
					'allow_null' => 0,
					'other_choice' => 0,
					'default_value' => 'text',
					'layout' => 'vertical',
					'return_format' => 'value',
					'save_other_choice' => 0,
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 10,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'acfe_display_title' => '',
	'acfe_autosync' => '',
	'acfe_form' => 0,
	'acfe_meta' => array(
		'604dddb8749bf' => array(
			'acfe_meta_key' => '',
			'acfe_meta_value' => '',
		),
	),
	'acfe_note' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_63d14795a9eb9',
	'title' => 'Menus',
	'fields' => array(
		array(
			'key' => 'field_63d14797ecfed',
			'label' => 'Menus',
			'name' => 'menu_options',
			'aria-label' => '',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'acfe_seamless_style' => 0,
			'acfe_group_modal' => 0,
			'sub_fields' => array(
				array(
					'key' => 'field_63d147afecfee',
					'label' => 'Menu Depth',
					'name' => 'menu_depth',
					'aria-label' => '',
					'type' => 'group',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layout' => 'block',
					'acfe_seamless_style' => 0,
					'acfe_group_modal' => 0,
					'sub_fields' => array(
						array(
							'key' => 'field_63d14888ecfef',
							'label' => 'Main menu',
							'name' => 'main_menu',
							'aria-label' => '',
							'type' => 'number',
							'instructions' => 'This is your main navigation menu.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '30',
								'class' => '',
								'id' => '',
							),
							'default_value' => 2,
							'min' => 1,
							'max' => 5,
							'placeholder' => '',
							'step' => '',
							'prepend' => '',
							'append' => '',
						),
						array(
							'key' => 'field_63d148bfecff0',
							'label' => 'Top Menu',
							'name' => 'top_menu',
							'aria-label' => '',
							'type' => 'number',
							'instructions' => 'This is your utility navigation menu located at the top right of all pages.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '30',
								'class' => '',
								'id' => '',
							),
							'default_value' => 1,
							'min' => 1,
							'max' => 5,
							'placeholder' => '',
							'step' => '',
							'prepend' => '',
							'append' => '',
						),
					),
					'acfe_group_modal_close' => 0,
					'acfe_group_modal_button' => '',
					'acfe_group_modal_size' => 'large',
				),
			),
			'acfe_group_modal_close' => 0,
			'acfe_group_modal_button' => '',
			'acfe_group_modal_size' => 'large',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 13,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'acfe_display_title' => '',
	'acfe_autosync' => '',
	'acfe_form' => 0,
	'acfe_meta' => '',
	'acfe_note' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_604def119b935',
	'title' => 'Footer',
	'fields' => array(
		array(
			'key' => 'field_604df02d57f0d',
			'label' => 'Footer',
			'name' => 'footer_options',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'acfe_seamless_style' => 0,
			'acfe_group_modal' => 0,
			'sub_fields' => array(
				array(
					'key' => 'field_604df04657f0e',
					'label' => 'Address block',
					'name' => 'address_block',
					'type' => 'wysiwyg',
					'instructions' => 'Add HTML for the address block in the footer. This block contains limited space. <strong>Note: social media icons can be added or removed on the Customize page <a href="customize.php">here</a>.</strong>',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '<h2 class="h5">College of Ursine Studies</h2><p>Address<br>Cornell University<br>Ithaca, NY 14853</p><p><a class="link-block" href="#">Contact Us</a></p>',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				),
				array(
					'key' => 'field_604df0f057f0f',
					'label' => 'Heading',
					'name' => 'heading',
					'type' => 'text',
					'instructions' => 'Optionally add a heading to the primary footer area just above the menus.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => 'Heading',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => 55,
				),
				array(
					'key' => 'field_604df45cbd107',
					'label' => 'Intro text',
					'name' => 'intro_text',
					'type' => 'text',
					'instructions' => 'Optionally add some text to the primary footer area, below the heading and just above the menus. <strong>Note: menus are also optional and can be added and removed <a href="nav-menus.php">here</a></strong>.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => 'Footer note curabitur blandit tempus porttitor.',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => 55,
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 20,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'acfe_display_title' => '',
	'acfe_autosync' => '',
	'acfe_form' => 0,
	'acfe_meta' => '',
	'acfe_note' => '',
));

endif;

// Create post type options for archives section on theme options page
function acf_load_post_type_groups() {

	$checked_post_types = get_checked_post_types();

	$sub_fields = array(
		array(
			'key' => 'field_posts',
			'label' => 'Regular Posts (WP Core)',
			'name' => 'post',
			'aria-label' => '',
			'type' => 'group',
			'instructions' => '',
			'required' => false,
			'conditional_logic' => false,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'sub_fields' => array(
				array(
					'key' => 'field_hf8d7fhr62tr',
					'label' => 'Layout',
					'name' => 'layout_post',
					'aria-label' => '',
					'type' => 'radio',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'left_sidebar' => 'Left sidebar',
						'right_sidebar' => 'Right sidebar',
						'no_sidebar' => 'No sidebar (full-width)',
					),
					'allow_null' => 0,
					'other_choice' => 0,
					'default_value' => 'right_sidebar',
					'layout' => 'vertical',
					'return_format' => 'value',
					'save_other_choice' => 0,
				),
				array(
					'key' => 'field_oh5g342uyt79hf',
					'label' => 'Appearance',
					'name' => 'appearance_post',
					'aria-label' => '',
					'type' => 'select',
					'instructions' => 'Choose how archive lists should appear, as a vertical list or a card grid.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'input-10',
						'id' => '',
					),
					'choices' => array(
						'list' => 'Vertical List',
						'grid' => 'Card Grid',
					),
					'default_value' => 'list',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
					'allow_custom' => 0,
					'search_placeholder' => '',
				),
				array(
					'key' => 'field_jdud8d746lh0jhf',
					'label' => 'Metadata',
					'name' => 'metadata_post',
					'aria-label' => '',
					'type' => 'checkbox',
					'instructions' => 'Show tags and/or categories on archive pages and/or single posts.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'input-10',
						'id' => '',
					),
					'layout' => 'vertical',
					'acfe_seamless_style' => 1,
					'acfe_group_modal' => 0,
					'choices' => array(
						'tags' => 'Tags',
						'categories' => 'Categories',
						'archives' => 'On archive pages',
						'single' => 'On single posts',
						'labels' => 'Text labels',
						'icons' => 'Icons',
					),
					'allow_custom' => 0,
					'default_value' => array(
					),
					'toggle' => 0,
					'return_format' => 'value',
					'save_custom' => 0,
				),
				array(
					'key' => 'field_kg9s44se2hhh7',
					'label' => 'Excerpts',
					'name' => 'excerpt_length_post',
					'aria-label' => '',
					'type' => 'number',
					'instructions' => 'Enter the length of excerpts (in number of characters).',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'input-8',
						'id' => '',
					),
					'default_value' => 180,
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => '',
					'max' => '',
					'step' => '',
				),
				array(
					'key' => 'field_65f882b287294',
					'label' => 'Show Date?',
					'name' => 'show_date_post',
					'aria-label' => '',
					'type' => 'true_false',
					'instructions' => 'Show the post date (applies to single posts as well as archive listings).',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 1,
					'ui' => 0,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
			),
			'layout' => 'block',
			'acfe_seamless_style' => 0,
			'acfe_group_modal' => 0,
			'acfe_group_modal_close' => 0,
			'acfe_group_modal_button' => '',
			'acfe_group_modal_size' => 'large',
		),
	);

	if($checked_post_types) :

		foreach($checked_post_types as $checked_post_type) {

			$post_type = strtolower(str_replace(' ', '-', $checked_post_type));
			$post_type_uc = ucwords($checked_post_type);

			$dynamic_array = array(
				'key' => 'field_' . $post_type,
				'label' => $post_type_uc,
				'name' => $post_type,
				'aria-label' => '',
				'type' => 'group',
				'instructions' => '',
				'required' => false,
				'conditional_logic' => false,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'sub_fields' => array(
					array(
						'key' => 'field_layout_' . $post_type,
						'label' => 'Layout',
						'name' => 'layout_' . $post_type,
						'aria-label' => '',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'left_sidebar' => 'Left sidebar',
							'right_sidebar' => 'Right sidebar',
							'no_sidebar' => 'No sidebar (full-width)',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => 'right_sidebar',
						'layout' => 'vertical',
						'return_format' => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_appearance_' . $post_type,
						'label' => 'Appearance',
						'name' => 'appearance_' . $post_type,
						'aria-label' => '',
						'type' => 'select',
						'instructions' => 'Choose how archive lists should appear, as a vertical list or a card grid.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => 'input-10',
							'id' => '',
						),
						'choices' => array(
							'list' => 'Vertical List',
							'grid' => 'Card Grid',
						),
						'default_value' => 'list',
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
						'allow_custom' => 0,
						'search_placeholder' => '',
					),
					array(
						'key' => 'field_metadata_' . $post_type,
						'label' => 'Metadata',
						'name' => 'metadata_' . $post_type,
						'aria-label' => '',
						'type' => 'checkbox',
						'instructions' => 'Show tags and/or categories on archive pages and/or single posts.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => 'input-10',
							'id' => '',
						),
						'layout' => 'vertical',
						'acfe_seamless_style' => 1,
						'acfe_group_modal' => 0,
						'choices' => array(

						),
						'allow_custom' => 0,
						'default_value' => array(
						),
						'toggle' => 0,
						'return_format' => 'value',
						'save_custom' => 0,
					),
					array(
						'key' => 'field_excerpt_length_' . $post_type,
						'label' => 'Excerpts',
						'name' => 'excerpt_length_' . $post_type,
						'aria-label' => '',
						'type' => 'number',
						'instructions' => 'Enter the length of excerpts (in number of characters).',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => 'input-8',
							'id' => '',
						),
						'default_value' => 180,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_show_date_' . $post_type,
						'label' => 'Show Date?',
						'name' => 'show_date_' . $post_type,
						'aria-label' => '',
						'type' => 'true_false',
						'instructions' => 'Check this box to show the post date.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 0,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
				),
				'layout' => 'block',
				'acfe_seamless_style' => 0,
				'acfe_group_modal' => 0,
				'acfe_group_modal_close' => 0,
				'acfe_group_modal_button' => '',
				'acfe_group_modal_size' => 'large',
			);

			$sub_fields[] = $dynamic_array;
			
		}

	endif;
    
	return $sub_fields;

}

$sub_fields = acf_load_post_type_groups();

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_604dda92ef574',
        'title' => 'Archives',
        'fields' => array(
            array(
                'key' => 'field_604de6ee3ffc6',
                'label' => 'Archives',
                'name' => 'archive_options',
                'aria-label' => '',
                'type' => 'group',
                'instructions' => 'Archive pages are lists such as the main blog page, search results, and category and tag pages. Choose layout, appearance, and other options for such pages from the list below for each post type.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'acfe_seamless_style' => 0,
                'acfe_group_modal' => 0,
                'acfe_group_modal_close' => 0,
                'acfe_group_modal_button' => '',
                'acfe_group_modal_size' => 'large',
                'sub_fields' => $sub_fields,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-options',
                ),
            ),
        ),
        'menu_order' => 10,
        'position' => 'normal',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => false,
        'acfe_display_title' => '',
        'acfe_autosync' => '',
        'acfe_form' => 0,
        'acfe_meta' => array(
            '604dddb8749bf' => array(
                'acfe_meta_key' => '',
                'acfe_meta_value' => '',
            ),
        ),
        'acfe_note' => '',
    ));

endif;

if ( ! function_exists( 'cwd_base_get_tag_options' ) ) {
	
	function cwd_base_get_tag_options() {
		
		$post_type = get_post_type();
		$taxonomies_names = get_post_type_taxonomies_names($post_type);

		$archive_options = get_field('archive_options', 'options');
		if($archive_options && $post_type != 'page') { $metadata_options = $archive_options[$post_type]['metadata_' . $post_type]; }

		if(is_single()) {
			$template_type = 'single';
		}
		if(is_archive() || is_home()) {
			$template_type = 'archives';
		}

		foreach($taxonomies_names as $taxonomy) {

			if($metadata_options 
			&& in_array($taxonomy, $metadata_options) 
			&& in_array($template_type, $metadata_options)) {
				cwd_base_get_taxonomies_and_terms($post_type, $taxonomy);
			}

		}

	}
}
