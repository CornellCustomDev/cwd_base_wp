<?php

 // TO DO: add projects, alerts, announcements, and any other post types we creaate

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
						'news' => 'News',
						'events' => 'Events',
						'people' => 'People',
						'courses' => 'Courses',
						'testimonials' => 'Testimonials',
						'galleries' => 'Photo Galleries',
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
	'key' => 'group_60897d9188783',
	'title' => 'Home Page',
	'fields' => array(
		array(
			'key' => 'field_60897d918c475',
			'label' => 'Home Page',
			'name' => 'home_page_options',
			'type' => 'group',
			'instructions' => 'Set the front page on the Reading menu <a href="/wp-admin/options-reading.php">here</a>.',
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
					'type' => 'group',
					'instructions' => 'Show tags and/or categories on archive pages and/or single posts.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'input-10',
						'id' => '',
					),
					'layout' => 'block',
					'acfe_seamless_style' => 1,
					'acfe_group_modal' => 0,
					'sub_fields' => array(
						array(
							'key' => 'field_60e83d8f31bd0',
							'label' => 'Regular Posts',
							'name' => 'regular_posts',
							'type' => 'checkbox',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
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
							'layout' => 'vertical',
							'toggle' => 0,
							'return_format' => 'value',
							'save_custom' => 0,
						),
						array(
							'key' => 'field_60e83df931bd2',
							'label' => 'News',
							'name' => 'news',
							'type' => 'checkbox',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array(
								'news_tags' => 'News tags',
								'news_categories' => 'News categories',
								'archives' => 'On archive pages',
								'single' => 'On single posts',
								'labels' => 'Text labels',
								'icons' => 'Icons',
							),
							'allow_custom' => 0,
							'default_value' => array(
							),
							'layout' => 'vertical',
							'toggle' => 0,
							'return_format' => 'value',
							'save_custom' => 0,
						),
						array(
							'key' => 'field_60eb6d55d9792',
							'label' => 'Events',
							'name' => 'events',
							'type' => 'checkbox',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array(
								'event_tags' => 'Event tags',
								'event_types' => 'Event types',
								'event_groups' => 'Event groups',
								'archives' => 'On archive pages',
								'single' => 'On single posts',
								'labels' => 'Text labels',
								'icons' => 'Icons',
							),
							'allow_custom' => 0,
							'default_value' => array(
							),
							'layout' => 'vertical',
							'toggle' => 0,
							'return_format' => 'value',
							'save_custom' => 0,
						),
						array(
							'key' => 'field_60eb6db8e3ae9',
							'label' => 'People',
							'name' => 'people',
							'type' => 'checkbox',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array(
								'people_tags' => 'People tags',
								'people_categories' => 'People categories',
								'archives' => 'On archive pages',
								'single' => 'On single posts',
								'labels' => 'Text labels',
								'icons' => 'Icons',
							),
							'allow_custom' => 0,
							'default_value' => array(
							),
							'layout' => 'vertical',
							'toggle' => 0,
							'return_format' => 'value',
							'save_custom' => 0,
						),
						array(
							'key' => 'field_60ec4edb53105',
							'label' => 'Courses',
							'name' => 'courses',
							'type' => 'checkbox',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array(
								'course_tags' => 'Course tags',
								'course_categories' => 'Course categories',
								'archives' => 'On archive pages',
								'single' => 'On single posts',
								'labels' => 'Text labels',
								'icons' => 'Icons',
							),
							'allow_custom' => 0,
							'default_value' => array(
							),
							'layout' => 'vertical',
							'toggle' => 0,
							'return_format' => 'value',
							'save_custom' => 0,
						),
						array(
							'key' => 'field_60ec4f332ab1a',
							'label' => 'Testimonials',
							'name' => 'testimonials',
							'type' => 'checkbox',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array(
								'testimonial_tags' => 'Testimonial tags',
								'testimonial_categories' => 'Testimonial categories',
								'archives' => 'On archive pages',
								'single' => 'On single posts',
								'labels' => 'Text labels',
								'icons' => 'Icons',
							),
							'allow_custom' => 0,
							'default_value' => array(
							),
							'layout' => 'vertical',
							'toggle' => 0,
							'return_format' => 'value',
							'save_custom' => 0,
						),
						array(
							'key' => 'field_60ec4f83e77e8',
							'label' => 'Photo galleries',
							'name' => 'photo_galleries',
							'type' => 'checkbox',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array(
								'gallery_tags' => 'Photo gallery tags',
								'gallery_categories' => 'Photo gallery categories',
								'archives' => 'On archive pages',
								'single' => 'On single posts',
								'labels' => 'Text labels',
								'icons' => 'Icons',
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

if ( ! function_exists( 'cwd_base_get_tag_options' ) ) {
	
	function cwd_base_get_tag_options() {
		
		$post_type = get_post_type();

		// Tags and taxonomies options
		$archive_options = get_field('archive_options', 'options');
		$post_metadata_options = $archive_options['metadata']['regular_posts'];
		$news_metadata_options = $archive_options['metadata']['news'];
		$events_metadata_options = $archive_options['metadata']['events'];
		$people_metadata_options = $archive_options['metadata']['people'];
		$courses_metadata_options = $archive_options['metadata']['courses'];
		$testimonials_metadata_options = $archive_options['metadata']['testimonials'];
		$galleries_metadata_options = $archive_options['metadata']['photo_galleries'];

		if(is_single()) {
			$template_type = 'single';
		}
		if(is_archive() || is_home()) {
			$template_type = 'archives';
		}

		if($post_metadata_options 
		   && $post_type == 'post' 
		   && in_array('tags', $post_metadata_options) 
		   && in_array($template_type, $post_metadata_options)) { ?><!-- Tags (WP Core) -->
				<?php cwd_base_get_tags(); ?>
		<?php }

		if($post_metadata_options 
		   && $post_type == 'post' 
		   && in_array('categories', $post_metadata_options) 
		   && in_array($template_type, $post_metadata_options)) { ?><!-- Categories (WP Core) -->
				<?php cwd_base_get_categories(); ?>
		<?php }

		if($events_metadata_options 
		   && $post_type == 'events' 
		   && in_array('event_tags', $events_metadata_options) 
		   && in_array($template_type, $events_metadata_options)) { ?><!-- Event tags -->
				<?php cwd_base_get_event_tags(); ?>
		<?php }

		if($events_metadata_options 
		   && $post_type == 'events' 
		   && in_array('event_types', $events_metadata_options) 
		   && in_array($template_type, $events_metadata_options)) { ?><!-- Event types -->
				<?php cwd_base_get_event_types(); ?>
		<?php }

		if($events_metadata_options 
		   && $post_type == 'events' 
		   && in_array('event_groups', $events_metadata_options) 
		   && in_array($template_type, $events_metadata_options)) { ?><!-- Event groups -->
				<?php cwd_base_get_event_groups(); ?>
		<?php }
		
		if($news_metadata_options 
		   && $post_type == 'news' 
		   && in_array('news_tags', $news_metadata_options) 
		   && in_array($template_type, $news_metadata_options)) { ?><!-- News tags -->
				<?php cwd_base_get_news_tags(); ?>
		<?php }

		if($news_metadata_options 
		   && $post_type == 'news' 
		   && in_array('news_categories', $news_metadata_options) 
		   && in_array($template_type, $news_metadata_options)) { ?><!-- News categories -->
				<?php cwd_base_get_news_categories(); ?>
		<?php }
		
		if($testimonials_metadata_options 
		   && $post_type == 'testimonials' 
		   && in_array('testimonial_tags', $testimonials_metadata_options) 
		   && in_array($template_type, $testimonials_metadata_options)) { ?><!-- Testimonial tags -->
				<?php cwd_base_get_testimonial_tags(); ?>
		<?php }

		if($testimonials_metadata_options 
		   && $post_type == 'testimonials' 
		   && in_array('testimonial_categories', $testimonials_metadata_options) 
		   && in_array($template_type, $testimonials_metadata_options)) { ?><!-- Testimonial categories -->
				<?php cwd_base_get_testimonial_categories(); ?>
		<?php }
		
		if($people_metadata_options 
		   && $post_type == 'people' 
		   && in_array('people_tags', $people_metadata_options) 
		   && in_array($template_type, $people_metadata_options)) { ?><!-- People tags -->
				<?php cwd_base_get_people_tags(); ?>
		<?php }

		if($people_metadata_options 
		   && $post_type == 'people' 
		   && in_array('people_categories', $people_metadata_options) 
		   && in_array($template_type, $people_metadata_options)) { ?><!-- People categories -->
				<?php cwd_base_get_people_categories(); ?>
		<?php }
		
		if($galleries_metadata_options 
		   && $post_type == 'galleries' 
		   && in_array('gallery_tags', $galleries_metadata_options) 
		   && in_array($template_type, $galleries_metadata_options)) { ?><!-- Gallery tags -->
				<?php cwd_base_get_gallery_tags(); ?>
		<?php }

		if($galleries_metadata_options 
		   && $post_type == 'galleries' 
		   && in_array('gallery_categories', $galleries_metadata_options) 
		   && in_array($template_type, $galleries_metadata_options)) { ?><!-- Gallery categories -->
				<?php cwd_base_get_gallery_categories(); ?>
		<?php }
		
		if($courses_metadata_options 
		   && $post_type == 'courses' 
		   && in_array('course_tags', $courses_metadata_options) 
		   && in_array($template_type, $courses_metadata_options)) { ?><!-- Gallery tags -->
				<?php cwd_base_get_course_tags(); ?>
		<?php }

		if($courses_metadata_options 
		   && $post_type == 'courses' 
		   && in_array('course_categories', $courses_metadata_options) 
		   && in_array($template_type, $courses_metadata_options)) { ?><!-- Gallery categories -->
				<?php cwd_base_get_course_categories(); ?>
		<?php }
		
	}
}