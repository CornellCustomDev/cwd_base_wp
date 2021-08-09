<?php

// Custom taxonomies for testimonials content type
if ( ! function_exists ( 'cptui_register_my_taxes_testimonial_tags' ) ) {
	
	function cptui_register_my_taxes_testimonial_tags() {

		$labels = [
			"name" => __( "Testimonial tags", "cwd_base" ),
			"singular_name" => __( "Testimonial tag", "cwd_base" ),
			"menu_name" => __( "Tags", "cwd_base" ),
			"all_items" => __( "All Testimonial tags", "cwd_base" ),
			"edit_item" => __( "Edit Testimonial tag", "cwd_base" ),
			"view_item" => __( "View Testimonial tag", "cwd_base" ),
			"update_item" => __( "Update Testimonial tag name", "cwd_base" ),
			"add_new_item" => __( "Add new Testimonial tag", "cwd_base" ),
			"new_item_name" => __( "New Testimonial tag name", "cwd_base" ),
			"parent_item" => __( "Parent Testimonial tag", "cwd_base" ),
			"parent_item_colon" => __( "Parent Testimonial tag:", "cwd_base" ),
			"search_items" => __( "Search Testimonial tags", "cwd_base" ),
			"popular_items" => __( "Popular Testimonial tags", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate Testimonial tags with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove Testimonial tags", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used Testimonial tags", "cwd_base" ),
			"not_found" => __( "No Testimonial tags found", "cwd_base" ),
			"no_terms" => __( "No Testimonial tags", "cwd_base" ),
			"items_list_navigation" => __( "Testimonial tags list navigation", "cwd_base" ),
			"items_list" => __( "Testimonial tags list", "cwd_base" ),
			"back_to_items" => __( "Back to Testimonial tags", "cwd_base" ),
		];


		$args = [
			"label" => __( "Testimonial tags", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'testimonial_tags', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "testimonial_tags",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "testimonial_tags", [ "testimonials" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_testimonial_tags' );
	
}

if ( ! function_exists ( 'cptui_register_my_taxes_testimonial_categories' ) ) {
	
	function cptui_register_my_taxes_testimonial_categories() {

		$labels = [
			"name" => __( "Testimonial categories", "cwd_base" ),
			"singular_name" => __( "Testimonial category", "cwd_base" ),
			"menu_name" => __( "Categories", "cwd_base" ),
			"all_items" => __( "All Testimonial categories", "cwd_base" ),
			"edit_item" => __( "Edit Testimonial category", "cwd_base" ),
			"view_item" => __( "View Testimonial category", "cwd_base" ),
			"update_item" => __( "Update Testimonial category name", "cwd_base" ),
			"add_new_item" => __( "Add new Testimonial category", "cwd_base" ),
			"new_item_name" => __( "New Testimonial category name", "cwd_base" ),
			"parent_item" => __( "Parent Testimonial category", "cwd_base" ),
			"parent_item_colon" => __( "Parent Testimonial category:", "cwd_base" ),
			"search_items" => __( "Search Testimonial categories", "cwd_base" ),
			"popular_items" => __( "Popular Testimonial categories", "cwd_base" ),
			"separate_items_with_commas" => __( "Separate Testimonial categories with commas", "cwd_base" ),
			"add_or_remove_items" => __( "Add or remove Testimonial categories", "cwd_base" ),
			"choose_from_most_used" => __( "Choose from the most used Testimonial categories", "cwd_base" ),
			"not_found" => __( "No Testimonial categories found", "cwd_base" ),
			"no_terms" => __( "No Testimonial categories", "cwd_base" ),
			"items_list_navigation" => __( "Testimonial categories list navigation", "cwd_base" ),
			"items_list" => __( "Testimonial categories list", "cwd_base" ),
			"back_to_items" => __( "Back to Testimonial categories", "cwd_base" ),
		];


		$args = [
			"label" => __( "Testimonial categories", "cwd_base" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'testimonial_categories', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"rest_base" => "testimonial_categories",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			"show_in_graphql" => false,
			"meta_box_cb" => "post_categories_meta_box",
		];
		register_taxonomy( "testimonial_categories", [ "testimonials" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_testimonial_categories' );
	
}