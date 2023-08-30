<?php

// Custom taxonomies for galleries content type
if ( ! function_exists ( 'cptui_register_my_taxes_gallery_tags' ) ) {
	
	function cptui_register_my_taxes_gallery_tags() {

		$labels = [
			"name" => __( "Gallery tags", "cwd_base" ),
			"singular_name" => __( "Gallery tag", "cwd_base" ),
			"menu_name" => __( "Tags", "cwd_base" ),
			"all_items" => __( "All Gallery tags", "cwd_base" ),
			"edit_item" => __( "Edit Gallery tag", "cwd_base" ),
			"view_item" => __( "View Gallery tag", "cwd_base" ),
			"update_item" => __( "Update Gallery tag name", "cwd_base" ),
			"add_new_item" => __( "Add new Gallery tag", "cwd_base" ),
			"new_item_name" => __( "New Gallery tag name", "cwd_base" ),
			"parent_item" => __( "Parent Gallery tag", "cwd_base" ),
			"parent_item_colon" => __( "Parent Gallery tag:", "cwd_base" ),
			"search_items" => __( "Search Gallery tags", "cwd_base" ),
			"popular_items" => __( "Popular Gallery tags", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate Gallery tags with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove Gallery tags", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used Gallery tags", "cwd_base" ),
			"not_found" => __( "No Gallery tags found", "cwd_base" ),
			"no_terms" => __( "No Gallery tags", "cwd_base" ),
			"items_list_navigation" => __( "Gallery tags list navigation", "cwd_base" ),
			"items_list" => __( "Gallery tags list", "cwd_base" ),
			"back_to_items" => __( "Back to Gallery tags", "cwd_base" ),
		];


		$args = [
			"label" => __( "Gallery tags", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'gallery_tags', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "gallery_tags",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "gallery_tags", [ "galleries" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_gallery_tags' );
	
}

if ( ! function_exists ( 'cptui_register_my_taxes_gallery_categories' ) ) {
	
	function cptui_register_my_taxes_gallery_categories() {

		$labels = [
			"name" => __( "Gallery categories", "cwd_base" ),
			"singular_name" => __( "Gallery category", "cwd_base" ),
			"menu_name" => __( "Categories", "cwd_base" ),
			"all_items" => __( "All Gallery categories", "cwd_base" ),
			"edit_item" => __( "Edit Gallery category", "cwd_base" ),
			"view_item" => __( "View Gallery category", "cwd_base" ),
			"update_item" => __( "Update Gallery category name", "cwd_base" ),
			"add_new_item" => __( "Add new Gallery category", "cwd_base" ),
			"new_item_name" => __( "New Gallery category name", "cwd_base" ),
			"parent_item" => __( "Parent Gallery category", "cwd_base" ),
			"parent_item_colon" => __( "Parent Gallery category:", "cwd_base" ),
			"search_items" => __( "Search Gallery categories", "cwd_base" ),
			"popular_items" => __( "Popular Gallery categories", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate Gallery categories with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove Gallery categories", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used Gallery categories", "cwd_base" ),
			"not_found" => __( "No Gallery categories found", "cwd_base" ),
			"no_terms" => __( "No Gallery categories", "cwd_base" ),
			"items_list_navigation" => __( "Gallery categories list navigation", "cwd_base" ),
			"items_list" => __( "Gallery categories list", "cwd_base" ),
			"back_to_items" => __( "Back to Gallery categories", "cwd_base" ),
		];


		$args = [
			"label" => __( "Gallery categories", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'gallery_categories', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "gallery_categories",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "gallery_categories", [ "galleries" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_gallery_categories' );
	
}