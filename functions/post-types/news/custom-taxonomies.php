<?php

// Custom taxonomies for galleries content type
if ( ! function_exists ( 'cptui_register_my_taxes_news_tags' ) ) {
	
	function cptui_register_my_taxes_news_tags() {

		$labels = [
			"name" => __( "News tags", "cwd_base" ),
			"singular_name" => __( "News tag", "cwd_base" ),
			"menu_name" => __( "Tags", "cwd_base" ),
			"all_items" => __( "All News tags", "cwd_base" ),
			"edit_item" => __( "Edit News tag", "cwd_base" ),
			"view_item" => __( "View News tag", "cwd_base" ),
			"update_item" => __( "Update News tag name", "cwd_base" ),
			"add_new_item" => __( "Add new News tag", "cwd_base" ),
			"new_item_name" => __( "New News tag name", "cwd_base" ),
			"parent_item" => __( "Parent News tag", "cwd_base" ),
			"parent_item_colon" => __( "Parent News tag:", "cwd_base" ),
			"search_items" => __( "Search News tags", "cwd_base" ),
			"popular_items" => __( "Popular News tags", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate News tags with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove News tags", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used News tags", "cwd_base" ),
			"not_found" => __( "No News tags found", "cwd_base" ),
			"no_terms" => __( "No News tags", "cwd_base" ),
			"items_list_navigation" => __( "News tags list navigation", "cwd_base" ),
			"items_list" => __( "News tags list", "cwd_base" ),
			"back_to_items" => __( "Back to News tags", "cwd_base" ),
		];


		$args = [
			"label" => __( "News tags", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'news_tags', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "news_tags",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "news_tags", [ "news" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_news_tags' );
	
}

if ( ! function_exists ( 'cptui_register_my_taxes_news_categories' ) ) {
	
	function cptui_register_my_taxes_news_categories() {

		$labels = [
			"name" => __( "News categories", "cwd_base" ),
			"singular_name" => __( "News category", "cwd_base" ),
			"menu_name" => __( "Categories", "cwd_base" ),
			"all_items" => __( "All News categories", "cwd_base" ),
			"edit_item" => __( "Edit News category", "cwd_base" ),
			"view_item" => __( "View News category", "cwd_base" ),
			"update_item" => __( "Update News category name", "cwd_base" ),
			"add_new_item" => __( "Add new News category", "cwd_base" ),
			"new_item_name" => __( "New News category name", "cwd_base" ),
			"parent_item" => __( "Parent News category", "cwd_base" ),
			"parent_item_colon" => __( "Parent News category:", "cwd_base" ),
			"search_items" => __( "Search News categories", "cwd_base" ),
			"popular_items" => __( "Popular News categories", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate News categories with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove News categories", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used News categories", "cwd_base" ),
			"not_found" => __( "No News categories found", "cwd_base" ),
			"no_terms" => __( "No News categories", "cwd_base" ),
			"items_list_navigation" => __( "News categories list navigation", "cwd_base" ),
			"items_list" => __( "News categories list", "cwd_base" ),
			"back_to_items" => __( "Back to News categories", "cwd_base" ),
		];


		$args = [
			"label" => __( "News categories", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'news_categories', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "news_categories",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "news_categories", [ "news" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_news_categories' );
	
}