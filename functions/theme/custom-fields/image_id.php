<?php

// Custom image field
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_60af88ab3499d',
	'title' => 'Image',
	'fields' => array(
		array(
			'key' => 'field_60af88b5744d7',
			'label' => 'Image',
			'name' => 'image_id',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'uploader' => '',
			'acfe_thumbnail' => 0,
			'return_format' => 'id',
			'preview_size' => 'thumbnail',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
			'library' => 'all',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '!=',
				'value' => 'news',
			),
			array(
				'param' => 'post_type',
				'operator' => '!=',
				'value' => 'events',
			),
			array(
				'param' => 'post_type',
				'operator' => '!=',
				'value' => 'slider',
			),
			array(
				'param' => 'post_type',
				'operator' => '!=',
				'value' => 'frm_display',
			),
			array(
				'param' => 'post_type',
				'operator' => '!=',
				'value' => 'galleries',
			),
			array(
				'param' => 'page_type',
				'operator' => '!=',
				'value' => 'front_page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'left',
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