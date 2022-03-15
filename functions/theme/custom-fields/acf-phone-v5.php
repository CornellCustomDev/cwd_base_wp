<?php

if( !class_exists('acf_field_phone') ) :
	class acf_field_phone extends acf_field {

		function __construct( $settings ) {

			$this->name = 'phone';

			$this->label = __('Phone Number', 'acf-phone');

			$this->category = 'basic';

			$this->l10n = array(
				'error'	=> __('Error! Please enter a valid phone number.', 'acf-phone'),
			);

			$this->defaults = array(
				'default_value'	=> '',
				'placeholder'	=> '',
				'prepend'		=> '',
				'append'		=> ''
			);

			$this->settings = $settings;

			// do not delete!
			parent::__construct();

		}

		function render_field_settings( $field ) {

			// default_value
			acf_render_field_setting( $field, array(
				'label'			=> __('Default Value','acf-phone'),
				'instructions'	=> __('Appears when creating a new post','acf-phone'),
				'type'			=> 'text',
				'name'			=> 'default_value',
			));

			// placeholder
			acf_render_field_setting( $field, array(
				'label'			=> __('Placeholder Text','acf-phone'),
				'instructions'	=> __('Appears within the input','acf-phone'),
				'type'			=> 'text',
				'name'			=> 'placeholder',
			));

			// prepend
			acf_render_field_setting( $field, array(
				'label'			=> __('Prepend','acf-phone'),
				'instructions'	=> __('Appears before the input','acf-phone'),
				'type'			=> 'text',
				'name'			=> 'prepend',
			));

			// append
			acf_render_field_setting( $field, array(
				'label'			=> __('Append','acf-phone'),
				'instructions'	=> __('Appears after the input','acf-phone'),
				'type'			=> 'text',
				'name'			=> 'append',
			));

		}

		function render_field( $field ) {

			// vars
			$atts = array();
			$o = array( 'type', 'id', 'class', 'name', 'value', 'placeholder' );
			$s = array( 'readonly', 'disabled' );
			$e = '';
			$field[ 'type' ] = 'text';

			// prepend
			if( $field['prepend'] !== "" ) {

				$field['class'] .= ' acf-is-prepended';
				$e .= '<div class="acf-input-prepend">' . $field['prepend'] . '</div>';

			}

			// append
			if( $field['append'] !== "" ) {

				$field['class'] .= ' acf-is-appended';
				$e .= '<div class="acf-input-append">' . $field['append'] . '</div>';

			}

			// append atts
			foreach( $o as $k ) {

				$atts[ $k ] = $field[ $k ];

			}

			// append special atts
			foreach( $s as $k ) {

				if( !empty($field[ $k ]) ) $atts[ $k ] = $k;

			}

			// render
			$e .= '<div class="acf-input-wrap">';
			$e .= '<input ' . acf_esc_attr( $atts ) . ' />';
			$e .= '</div>';

			// return
			echo $e;

		}

		function input_admin_enqueue_scripts() {

			// vars
			$url = $this->settings['url'];
			$version = $this->settings['version'];

			// register & include JS
			wp_register_script( 'acf-masked-input', "{$url}assets/js/jquery.maskedinput.min.js", array(), $version );
			wp_enqueue_script('acf-masked-input');

			// register & include JS
			wp_register_script( 'acf-input-phone', "{$url}assets/js/input.js", array('acf-input'), $version );
			wp_enqueue_script('acf-input-phone');

		}

		function load_value( $value, $post_id, $field ) {

			return $value;

		}

		function update_value( $value, $post_id, $field ) {

			return $value;

		}

		function format_value( $value, $post_id, $field ) {

			// bail early if no value
			if( empty($value) ) {

				return $value;

			}

			// return
			return $value;
		}

		function validate_value( $valid, $value, $field, $input )
		{

			if ( empty( $value ) ) {
				return $valid;
			}

			if( ! preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $value) )
			{
				if ( ! preg_match("/(\(\d{3}+\)+ \d{3}+\-\d{4}+)/", $value) )
				{
					$valid = __('Please enter valid phone number!','acf-phone');
				}
			}

			// return
			return $valid;

		}

		function load_field( $field ) {

			return $field;

		}

		function update_field( $field ) {

			return $field;

		}

	}

	new acf_field_phone( $this->settings );

endif;