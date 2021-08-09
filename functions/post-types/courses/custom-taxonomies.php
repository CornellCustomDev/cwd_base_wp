<?php

// Custom taxonomies for courses content type
if ( ! function_exists ( 'cptui_register_my_taxes' ) ) {
	
	function cptui_register_my_taxes() {

		$labels = [
			"name" => __( "Course tags", "cwd_base" ),
			"singular_name" => __( "Course tag", "cwd_base" ),
			"menu_name" => __( "Tags", "cwd_base" ),
			"all_items" => __( "All Course tags", "cwd_base" ),
			"edit_item" => __( "Edit Course tag", "cwd_base" ),
			"view_item" => __( "View Course tag", "cwd_base" ),
			"update_item" => __( "Update Course tag name", "cwd_base" ),
			"add_new_item" => __( "Add new Course tag", "cwd_base" ),
			"new_item_name" => __( "New Course tag name", "cwd_base" ),
			"parent_item" => __( "Parent Course tag", "cwd_base" ),
			"parent_item_colon" => __( "Parent Course tag:", "cwd_base" ),
			"search_items" => __( "Search Course tags", "cwd_base" ),
			"popular_items" => __( "Popular Course tags", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate Course tags with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove Course tags", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used Course tags", "cwd_base" ),
			"not_found" => __( "No Course tags found", "cwd_base" ),
			"no_terms" => __( "No Course tags", "cwd_base" ),
			"items_list_navigation" => __( "Course tags list navigation", "cwd_base" ),
			"items_list" => __( "Course tags list", "cwd_base" ),
			"back_to_items" => __( "Back to Course tags", "cwd_base" ),
		];


		$args = [
			"label" => __( "Course tags", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'course_tags', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "course_tags",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "course_tags", [ "courses" ], $args );

		$labels = [
			"name" => __( "Course categories", "cwd_base" ),
			"singular_name" => __( "Course category", "cwd_base" ),
			"menu_name" => __( "Categories", "cwd_base" ),
			"all_items" => __( "All Course Categories", "cwd_base" ),
			"edit_item" => __( "Edit Course Category", "cwd_base" ),
			"view_item" => __( "View Course Category", "cwd_base" ),
			"update_item" => __( "Update Course Category name", "cwd_base" ),
			"add_new_item" => __( "Add new Course Category", "cwd_base" ),
			"new_item_name" => __( "New Course Category name", "cwd_base" ),
			"parent_item" => __( "Parent Course Category", "cwd_base" ),
			"parent_item_colon" => __( "Parent Course Category:", "cwd_base" ),
			"search_items" => __( "Search Course Categories", "cwd_base" ),
			"popular_items" => __( "Popular Course Categories", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate Course Categories with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove Course Categories", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used Course Categories", "cwd_base" ),
			"not_found" => __( "No Course Categories found", "cwd_base" ),
			"no_terms" => __( "No Course Categories", "cwd_base" ),
			"items_list_navigation" => __( "Course Categories list navigation", "cwd_base" ),
			"items_list" => __( "Course Categories list", "cwd_base" ),
			"back_to_items" => __( "Back to Course Categories", "cwd_base" ),
		];

		$args = [
			"label" => __( "Course categories", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'course_categories', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "course_categories",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "course_categories", [ "courses" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes' );
	
}