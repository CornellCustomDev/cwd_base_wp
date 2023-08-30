<?php

// Post Type: Courses
if ( ! function_exists ( 'cptui_register_my_cpts_courses' ) ) {
	
	function cptui_register_my_cpts_courses() {
		$labels = [
			"name" => __( "Courses", "cwd_base" ),
			"singular_name" => __( "Course", "cwd_base" ),
			"menu_name" => __( "Courses", "cwd_base" ),
			"all_items" => __( "All Courses", "cwd_base" ),
			"add_new" => __( "Add new", "cwd_base" ),
			"add_new_item" => __( "Add new Course", "cwd_base" ),
			"edit_item" => __( "Edit Course", "cwd_base" ),
			"new_item" => __( "New Course", "cwd_base" ),
			"view_item" => __( "View Course", "cwd_base" ),
			"view_items" => __( "View Courses", "cwd_base" ),
			"search_items" => __( "Search Courses", "cwd_base" ),
			"not_found" => __( "No Courses found", "cwd_base" ),
			"not_found_in_trash" => __( "No Courses found in trash", "cwd_base" ),
			"parent" => __( "Parent Course:", "cwd_base" ),
			"featured_image" => __( "Featured image for this Course", "cwd_base" ),
			"set_featured_image" => __( "Set featured image for this Course", "cwd_base" ),
			"remove_featured_image" => __( "Remove featured image for this Course", "cwd_base" ),
			"use_featured_image" => __( "Use as featured image for this Course", "cwd_base" ),
			"archives" => __( "Course archives", "cwd_base" ),
			"insert_into_item" => __( "Insert into Course", "cwd_base" ),
			"uploaded_to_this_item" => __( "Upload to this Course", "cwd_base" ),
			"filter_items_list" => __( "Filter Courses list", "cwd_base" ),
			"items_list_navigation" => __( "Courses list navigation", "cwd_base" ),
			"items_list" => __( "Courses list", "cwd_base" ),
			"attributes" => __( "Courses attributes", "cwd_base" ),
			"name_admin_bar" => __( "Course", "cwd_base" ),
			"item_published" => __( "Course published", "cwd_base" ),
			"item_published_privately" => __( "Course published privately.", "cwd_base" ),
			"item_reverted_to_draft" => __( "Course reverted to draft.", "cwd_base" ),
			"item_scheduled" => __( "Course scheduled", "cwd_base" ),
			"item_updated" => __( "Course updated.", "cwd_base" ),
			"parent_item_colon" => __( "Parent Course:", "cwd_base" ),
		];

		$args = [
			"label" => __( "Courses", "cwd_base" ),
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
			"rewrite" => [ "slug" => "courses", "with_front" => true ],
			"query_var" => true,
			"menu_icon" => "dashicons-book-alt",
			"supports" => [ "title", "editor", "thumbnail" ],
			"taxonomies" => [ "course_categories", "course_tags" ],
		];

		register_post_type( "courses", $args );

	}

	add_action( 'init', 'cptui_register_my_cpts_courses' );
}

require_once 'custom-fields.php';
require_once 'custom-taxonomies.php';
require_once 'columns.php';