<?php

// Slider content type
if ( ! function_exists ( 'cptui_register_my_cpts_slider' ) ) {
	
	function cptui_register_my_cpts_slider() {

		$labels = [
			"name" => __( "Slider", "cwd_cornell" ),
			"singular_name" => __( "Slider", "cwd_cornell" ),
		];

		$args = [
			"label" => __( "Slider", "cwd_base" ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"has_archive" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => [ "slug" => "slider", "with_front" => true ],
			"query_var" => true,
			"menu_icon" => "dashicons-format-gallery",
			"supports" => [ "title", "editor", "thumbnail" ],
			'menu_position' => 7,
		];

		register_post_type( "slider", $args );

	}
	add_action( 'init', 'cptui_register_my_cpts_slider' );
}

require_once 'custom-fields.php';
require_once 'slider.php';