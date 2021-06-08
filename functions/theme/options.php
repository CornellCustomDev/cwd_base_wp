<?php

if( function_exists('acf_add_options_page') ):

acf_add_options_page(array(
	'page_title' => 'Theme Options',
	'menu_title' => 'Theme Options',
	'menu_slug' => 'theme-options',
	'capability' => 'edit_posts',
	'position' => '',
	'parent_slug' => '',
	'icon_url' => '',
	'redirect' => true,
	'post_id' => 'options',
	'autoload' => false,
	'update_button' => 'Update',
	'updated_message' => 'Options Updated',
));

endif;

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_60897d9188783',
	'title' => 'Home Page',
	'fields' => array(
		array(
			'key' => 'field_60897d918c475',
			'label' => 'Home Page',
			'name' => 'home_page_options',
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
					'default_value' => 'Home',
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
					'default_value' => 1,
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
			'instructions' => 'Set the blog page on the Reading menu <a href="https://cd-demo-wp.lndo.site/wp-admin/options-reading.php">here</a>.',
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
					'default_value' => 'Latest Posts',
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
	'key' => 'group_6067499424cf7',
	'title' => 'Main navigation',
	'fields' => array(
		array(
			'key' => 'field_606749aafafc9',
			'label' => 'Main Navigation',
			'name' => 'main_nav_options',
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
					'key' => 'field_60674c69a8ffd',
					'label' => 'Menu depth',
					'name' => 'menu_depth',
					'type' => 'number',
					'instructions' => 'The default menu depth for the main navigation is 2. You can change that here, but it is not recommended to go beyond 3 levels.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'input-8',
						'id' => '',
					),
					'default_value' => 2,
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => 1,
					'max' => 3,
					'step' => '',
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
	'acfe_display_title' => '',
	'acfe_autosync' => '',
	'acfe_form' => 0,
	'acfe_meta' => '',
	'acfe_note' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_604dda92ef574',
	'title' => 'Archives',
	'fields' => array(
		array(
			'key' => 'field_604de6ee3ffc6',
			'label' => 'Archives',
			'name' => 'archive_options',
			'type' => 'group',
			'instructions' => 'Archive pages are lists such as the main blog page, search results, and category and tag pages. Choose layout and appearance options for such pages from the list below.',
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
					'key' => 'field_604de7333ffc7',
					'label' => 'Layout',
					'name' => 'layout',
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
					'key' => 'field_604de7853ffc8',
					'label' => 'Appearance',
					'name' => 'appearance',
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
				),
				array(
					'key' => 'field_6068e6015f83f',
					'label' => 'Metadata',
					'name' => 'metadata',
					'type' => 'checkbox',
					'instructions' => 'Show tags and/or categories on archive pages and/or single posts.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'input-10',
						'id' => '',
					),
					'choices' => array(
						'tags' => 'Show tags (WP Core)',
						'categories' => 'Show categories (WP Core)',
						'event_tags' => 'Show event tags',
						'event_types' => 'Show event types',
						'event_groups' => 'Show event groups',
						'archives' => 'On archive pages',
						'single' => 'On single posts',
						'labels' => 'Show labels?',
					),
					'allow_custom' => 0,
					'default_value' => array(
						0 => 'tags',
						1 => 'categories',
						2 => 'single',
						3 => 'labels',
					),
					'layout' => 'vertical',
					'toggle' => 0,
					'return_format' => 'value',
					'save_custom' => 0,
				),
				array(
					'key' => 'field_6069bdb31c366',
					'label' => 'Excerpts',
					'name' => 'excerpt_length',
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
					'key' => 'field_606c40f609252',
					'label' => 'Labels',
					'name' => 'labels',
					'type' => 'radio',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_6068e6015f83f',
								'operator' => '==contains',
								'value' => 'labels',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'text' => 'Text labels',
						'icons' => 'Icons',
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
	'menu_order' => 15,
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
	'acfe_meta' => array(
		'604dddb8749bf' => array(
			'acfe_meta_key' => '',
			'acfe_meta_value' => '',
		),
	),
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
			'sub_fields' => array(
				array(
					'key' => 'field_60ad2424056e3',
					'label' => 'Tinting',
					'name' => 'tinting',
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
					'default_value' => '<h2 class="h5">College of Ursine Studies</h2>
<p>Address<br>Cornell University<br>Ithaca, NY 14853</p>
<p><a class="link-block" href="#">Contact Us</a></p>',
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

if ( ! function_exists( 'cwd_base_get_tag_options' ) ) {
	
	function cwd_base_get_tag_options() {
		
		// Tags and taxonomies options
		$archive_options = get_field('archive_options', 'options');
		$metadata_options = $archive_options['metadata'];
		
		if(is_single()) {
			$template_type = 'single';
		}
		if(is_archive()) {
			$template_type = 'archives';
		}

		if($metadata_options 
		   && in_array('tags', $metadata_options) 
		   && in_array($template_type, $metadata_options)) { ?><!-- Tags (WP Core) -->
				<?php cwd_base_get_tags(); ?>
		<?php }

		if($metadata_options 
		   && in_array('categories', $metadata_options) 
		   && in_array($template_type, $metadata_options)) { ?><!-- Categories (WP Core) -->
				<?php cwd_base_get_categories(); ?>
		<?php }

		if($metadata_options 
		   && in_array('event_tags', $metadata_options) 
		   && in_array($template_type, $metadata_options)) { ?><!-- Event tags -->
				<?php cwd_base_get_event_tags(); ?>
		<?php }

		if($metadata_options 
		   && in_array('event_types', $metadata_options) 
		   && in_array($template_type, $metadata_options)) { ?><!-- Event types -->
				<?php cwd_base_get_event_types(); ?>
		<?php }

		if($metadata_options 
		   && in_array('event_groups', $metadata_options) 
		   && in_array($template_type, $metadata_options)) { ?><!-- Event groups -->
				<?php cwd_base_get_event_groups(); ?>
		<?php }
	}
}