<?php

// Slider custom fields
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5bcd3b9fe9808',
	'title' => 'Slider Fields',
	'fields' => array(
		array(
			'key' => 'field_5bcd3bad5afa3',
			'label' => 'Text',
			'name' => 'text',
			'type' => 'textarea',
			'instructions' => 'No HTML tags allowed.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => 80,
			'rows' => 4,
			'new_lines' => '',
		),
		array(
			'key' => 'field_5bcd3c24c90c8',
			'label' => 'Slide Order',
			'name' => 'slide_order',
			'type' => 'number',
			'instructions' => 'Numeric. This is used to control the order of the slides. Lower numbers are first.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_5bcd3c5ec90c9',
			'label' => 'Link to internal page?',
			'name' => 'is_internal_link',
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
		array(
			'key' => 'field_5bcd3cbaa93f2',
			'label' => 'Internal Link',
			'name' => 'internal_link',
			'type' => 'page_link',
			'instructions' => 'Link to a page on this site',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5bcd3c5ec90c9',
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
			'post_type' => '',
			'taxonomy' => '',
			'allow_null' => 0,
			'allow_archives' => 1,
			'multiple' => 0,
		),
		array(
			'key' => 'field_5bcd3d192291a',
			'label' => 'External Link',
			'name' => 'external_link',
			'type' => 'text',
			'instructions' => 'Link to an external site',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5bcd3c5ec90c9',
						'operator' => '!=',
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
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'slider',
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
));

endif;