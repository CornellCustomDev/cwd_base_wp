<?php

// Custom taxonomies for spotlights content type
if ( ! function_exists ( 'cptui_register_my_taxes_spotlight_tags' ) ) {
	
	function cptui_register_my_taxes_spotlight_tags() {

		$labels = [
			"name" => __( "Spotlight tags", "cwd_base" ),
			"singular_name" => __( "Spotlight tag", "cwd_base" ),
			"menu_name" => __( "Tags", "cwd_base" ),
			"all_items" => __( "All Spotlight tags", "cwd_base" ),
			"edit_item" => __( "Edit Spotlight tag", "cwd_base" ),
			"view_item" => __( "View Spotlight tag", "cwd_base" ),
			"update_item" => __( "Update Spotlight tag name", "cwd_base" ),
			"add_new_item" => __( "Add new Spotlight tag", "cwd_base" ),
			"new_item_name" => __( "New Spotlight tag name", "cwd_base" ),
			"parent_item" => __( "Parent Spotlight tag", "cwd_base" ),
			"parent_item_colon" => __( "Parent Spotlight tag:", "cwd_base" ),
			"search_items" => __( "Search Spotlight tags", "cwd_base" ),
			"popular_items" => __( "Popular Spotlight tags", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate Spotlight tags with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove Spotlight tags", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used Spotlight tags", "cwd_base" ),
			"not_found" => __( "No Spotlight tags found", "cwd_base" ),
			"no_terms" => __( "No Spotlight tags", "cwd_base" ),
			"items_list_navigation" => __( "Spotlight tags list navigation", "cwd_base" ),
			"items_list" => __( "Spotlight tags list", "cwd_base" ),
			"back_to_items" => __( "Back to Spotlight tags", "cwd_base" ),
		];


		$args = [
			"label" => __( "Spotlight tags", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'spotlight_tags', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "spotlight_tags",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "spotlights_tags", [ "spotlights" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_spotlight_tags' );
	
}

if ( ! function_exists ( 'cptui_register_my_taxes_spotlight_categories' ) ) {
	
	function cptui_register_my_taxes_spotlight_categories() {

		$labels = [
			"name" => __( "Spotlight categories", "cwd_base" ),
			"singular_name" => __( "Spotlight category", "cwd_base" ),
			"menu_name" => __( "Categories", "cwd_base" ),
			"all_items" => __( "All Spotlight categories", "cwd_base" ),
			"edit_item" => __( "Edit Spotlight category", "cwd_base" ),
			"view_item" => __( "View Spotlight category", "cwd_base" ),
			"update_item" => __( "Update Spotlight category name", "cwd_base" ),
			"add_new_item" => __( "Add new Spotlight category", "cwd_base" ),
			"new_item_name" => __( "New Spotlight category name", "cwd_base" ),
			"parent_item" => __( "Parent Spotlight category", "cwd_base" ),
			"parent_item_colon" => __( "Parent Spotlight category:", "cwd_base" ),
			"search_items" => __( "Search Spotlight categories", "cwd_base" ),
			"popular_items" => __( "Popular Spotlight categories", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate Spotlight categories with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove Spotlight categories", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used Spotlight categories", "cwd_base" ),
			"not_found" => __( "No Spotlight categories found", "cwd_base" ),
			"no_terms" => __( "No Spotlight categories", "cwd_base" ),
			"items_list_navigation" => __( "Spotlight categories list navigation", "cwd_base" ),
			"items_list" => __( "Spotlight categories list", "cwd_base" ),
			"back_to_items" => __( "Back to Spotlight categories", "cwd_base" ),
		];


		$args = [
			"label" => __( "Spotlight categories", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'spotlight_categories', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "spotlight_categories",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "spotlights_categories", [ "spotlights" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_spotlight_categories' );
	
}