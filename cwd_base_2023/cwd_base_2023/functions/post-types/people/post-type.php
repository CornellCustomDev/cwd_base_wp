<?php

// Post Type: People
if ( ! function_exists ( 'cptui_register_my_cpts_people' ) ) {
	
	function cptui_register_my_cpts_people() {
		$labels = [
			"name" => __( "People", "cwd_base" ),
			"singular_name" => __( "Person", "cwd_base" ),
			"menu_name" => __( "People", "cwd_base" ),
			"all_items" => __( "All People", "cwd_base" ),
			"add_new" => __( "Add new", "cwd_base" ),
			"add_new_item" => __( "Add new Person", "cwd_base" ),
			"edit_item" => __( "Edit Person", "cwd_base" ),
			"new_item" => __( "New Person", "cwd_base" ),
			"view_item" => __( "View Person", "cwd_base" ),
			"view_items" => __( "View People", "cwd_base" ),
			"search_items" => __( "Search People", "cwd_base" ),
			"not_found" => __( "No People found", "cwd_base" ),
			"not_found_in_trash" => __( "No People found in trash", "cwd_base" ),
			"parent" => __( "Parent Person:", "cwd_base" ),
			"featured_image" => __( "Featured image for this Person", "cwd_base" ),
			"set_featured_image" => __( "Set featured image for this Person", "cwd_base" ),
			"remove_featured_image" => __( "Remove featured image for this Person", "cwd_base" ),
			"use_featured_image" => __( "Use as featured image for this Person", "cwd_base" ),
			"archives" => __( "Person archives", "cwd_base" ),
			"insert_into_item" => __( "Insert into Person", "cwd_base" ),
			"uploaded_to_this_item" => __( "Upload to this Person", "cwd_base" ),
			"filter_items_list" => __( "Filter People list", "cwd_base" ),
			"items_list_navigation" => __( "People list navigation", "cwd_base" ),
			"items_list" => __( "People list", "cwd_base" ),
			"attributes" => __( "People attributes", "cwd_base" ),
			"name_admin_bar" => __( "Person", "cwd_base" ),
			"item_published" => __( "Person published", "cwd_base" ),
			"item_published_privately" => __( "Person published privately.", "cwd_base" ),
			"item_reverted_to_draft" => __( "Person reverted to draft.", "cwd_base" ),
			"item_scheduled" => __( "Person scheduled", "cwd_base" ),
			"item_updated" => __( "Person updated.", "cwd_base" ),
			"parent_item_colon" => __( "Parent Person:", "cwd_base" ),
		];

		$args = [
			"label" => __( "People", "cwd_base" ),
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
			"rewrite" => [ "slug" => "people", "with_front" => true ],
			"query_var" => true,
			"menu_icon" => "dashicons-admin-users",
			"supports" => [ "title", "editor", "thumbnail" ],
			"taxonomies" => [ "people_categories", "people_tags" ],
			'menu_position' => 6,
		];

		register_post_type( "people", $args );

	}
	add_action( 'init', 'cptui_register_my_cpts_people' );
}

require_once 'custom-fields.php';
require_once 'custom-taxonomies.php';
require_once 'columns.php';