<?php

// Post Type: Testimonials
if ( ! function_exists ( 'cptui_register_my_cpts_testimonials' ) ) {
	
	function cptui_register_my_cpts_testimonials() {

		$labels = [
			"name" => __( "Testimonials", "cwd_base" ),
			"singular_name" => __( "Testimonial", "cwd_base" ),
			"menu_name" => __( "Testimonials", "cwd_base" ),
			"all_items" => __( "All Testimonials", "cwd_base" ),
			"add_new" => __( "Add new", "cwd_base" ),
			"add_new_item" => __( "Add new Testimonial", "cwd_base" ),
			"edit_item" => __( "Edit Testimonial", "cwd_base" ),
			"new_item" => __( "New Testimonial", "cwd_base" ),
			"view_item" => __( "View Testimonial", "cwd_base" ),
			"view_items" => __( "View Testimonials", "cwd_base" ),
			"search_items" => __( "Search Testimonials", "cwd_base" ),
			"not_found" => __( "No Testimonials found", "cwd_base" ),
			"not_found_in_trash" => __( "No Testimonials found in trash", "cwd_base" ),
			"parent" => __( "Parent Testimonial:", "cwd_base" ),
			"featured_image" => __( "Featured image for this Testimonial", "cwd_base" ),
			"set_featured_image" => __( "Set featured image for this Testimonial", "cwd_base" ),
			"remove_featured_image" => __( "Remove featured image for this Testimonial", "cwd_base" ),
			"use_featured_image" => __( "Use as featured image for this Testimonial", "cwd_base" ),
			"archives" => __( "Testimonial archives", "cwd_base" ),
			"insert_into_item" => __( "Insert into Testimonial", "cwd_base" ),
			"uploaded_to_this_item" => __( "Upload to this Testimonial", "cwd_base" ),
			"filter_items_list" => __( "Filter Testimonials list", "cwd_base" ),
			"items_list_navigation" => __( "Testimonials list navigation", "cwd_base" ),
			"items_list" => __( "Testimonials list", "cwd_base" ),
			"attributes" => __( "Testimonials attributes", "cwd_base" ),
			"name_admin_bar" => __( "Testimonial", "cwd_base" ),
			"item_published" => __( "Testimonial published", "cwd_base" ),
			"item_published_privately" => __( "Testimonial published privately.", "cwd_base" ),
			"item_reverted_to_draft" => __( "Testimonial reverted to draft.", "cwd_base" ),
			"item_scheduled" => __( "Testimonial scheduled", "cwd_base" ),
			"item_updated" => __( "Testimonial updated.", "cwd_base" ),
			"parent_item_colon" => __( "Parent Testimonial:", "cwd_base" ),
		];

		$args = [
			"label" => __( "Testimonials", "cwd_base" ),
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
			"rewrite" => [ "slug" => "testimonials", "with_front" => true ],
			"query_var" => true,
			"menu_icon" => "dashicons-editor-quote",
			"supports" => [ "title", "editor", "thumbnail" ],
			"taxonomies" => [ "testimonial_categories", "testimonial_tags" ],
		];

		register_post_type( "testimonials", $args );

	}

	add_action( 'init', 'cptui_register_my_cpts_testimonials' );
}

require_once 'custom-fields.php';
require_once 'custom-taxonomies.php';
require_once 'columns.php';