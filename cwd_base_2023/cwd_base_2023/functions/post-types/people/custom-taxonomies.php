<?php

// Custom taxonomies for people content type
if ( ! function_exists ( 'cptui_register_my_taxes_people_tags' ) ) {
	
	function cptui_register_my_taxes_people_tags() {

		$labels = [
			"name" => __( "People tags", "cwd_base" ),
			"singular_name" => __( "People tag", "cwd_base" ),
			"menu_name" => __( "Tags", "cwd_base" ),
			"all_items" => __( "All People tags", "cwd_base" ),
			"edit_item" => __( "Edit People tag", "cwd_base" ),
			"view_item" => __( "View People tag", "cwd_base" ),
			"update_item" => __( "Update People tag name", "cwd_base" ),
			"add_new_item" => __( "Add new People tag", "cwd_base" ),
			"new_item_name" => __( "New People tag name", "cwd_base" ),
			"parent_item" => __( "Parent People tag", "cwd_base" ),
			"parent_item_colon" => __( "Parent People tag:", "cwd_base" ),
			"search_items" => __( "Search People tags", "cwd_base" ),
			"popular_items" => __( "Popular People tags", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate People tags with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove People tags", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used People tags", "cwd_base" ),
			"not_found" => __( "No People tags found", "cwd_base" ),
			"no_terms" => __( "No People tags", "cwd_base" ),
			"items_list_navigation" => __( "People tags list navigation", "cwd_base" ),
			"items_list" => __( "People tags list", "cwd_base" ),
			"back_to_items" => __( "Back to People tags", "cwd_base" ),
		];


		$args = [
			"label" => __( "People tags", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'people_tags', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "people_tags",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "people_tags", [ "people" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_people_tags' );
	
}

if ( ! function_exists ( 'cptui_register_my_taxes_people_categories' ) ) {
	
	function cptui_register_my_taxes_people_categories() {

		$labels = [
			"name" => __( "People categories", "cwd_base" ),
			"singular_name" => __( "People category", "cwd_base" ),
			"menu_name" => __( "Categories", "cwd_base" ),
			"all_items" => __( "All People categories", "cwd_base" ),
			"edit_item" => __( "Edit People category", "cwd_base" ),
			"view_item" => __( "View People category", "cwd_base" ),
			"update_item" => __( "Update People category name", "cwd_base" ),
			"add_new_item" => __( "Add new People category", "cwd_base" ),
			"new_item_name" => __( "New People category name", "cwd_base" ),
			"parent_item" => __( "Parent People category", "cwd_base" ),
			"parent_item_colon" => __( "Parent People category:", "cwd_base" ),
			"search_items" => __( "Search People categories", "cwd_base" ),
			"popular_items" => __( "Popular People categories", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate People categories with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove People categories", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used People categories", "cwd_base" ),
			"not_found" => __( "No People categories found", "cwd_base" ),
			"no_terms" => __( "No People categories", "cwd_base" ),
			"items_list_navigation" => __( "People categories list navigation", "cwd_base" ),
			"items_list" => __( "People categories list", "cwd_base" ),
			"back_to_items" => __( "Back to People categories", "cwd_base" ),
		];


		$args = [
			"label" => __( "People categories", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'people_categories', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "people_categories",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "people_categories", [ "people" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_people_categories' );
	
}