<?php

// Feature on front page? custom field for all post types
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_60eddc3f3017d',
	'title' => 'Featured',
	'fields' => array(
		array(
			'key' => 'field_60eddc7f94a71',
			'label' => 'Feature on front page?',
			'name' => 'make_sticky',
			'type' => 'true_false',
			'instructions' => 'Feature this item on the front page, if the theme allows it.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_60ede2e594a72',
			'label' => 'Teaser Text',
			'name' => 'teaser_text',
			'type' => 'textarea',
			'instructions' => 'Use this text field for the home page teaser.',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_60eddc7f94a71',
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
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
			'acfe_textarea_code' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'all',
			),
			array(
				'param' => 'post_type',
				'operator' => '!=',
				'value' => 'slider',
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
	'label_placement' => 'above',
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