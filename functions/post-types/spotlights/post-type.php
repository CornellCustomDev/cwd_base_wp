<?php

// Post Type: Spotlights
if ( ! function_exists ( 'cptui_register_my_cpts_spotlights' ) ) {
	
	function cptui_register_my_cpts_spotlights() {

		$labels = [
			"name" => __( "Spotlights", "cwd_base" ),
			"singular_name" => __( "Spotlight", "cwd_base" ),
			"menu_name" => __( "Spotlights", "cwd_base" ),
			"all_items" => __( "All Spotlights", "cwd_base" ),
			"add_new" => __( "Add new", "cwd_base" ),
			"add_new_item" => __( "Add new Spotlight", "cwd_base" ),
			"edit_item" => __( "Edit Spotlight", "cwd_base" ),
			"new_item" => __( "New Spotlight", "cwd_base" ),
			"view_item" => __( "View Spotlight", "cwd_base" ),
			"view_items" => __( "View Spotlights", "cwd_base" ),
			"search_items" => __( "Search Spotlights", "cwd_base" ),
			"not_found" => __( "No Spotlights found", "cwd_base" ),
			"not_found_in_trash" => __( "No Spotlights found in trash", "cwd_base" ),
			"parent" => __( "Parent Spotlight:", "cwd_base" ),
			"featured_image" => __( "Featured image for this Spotlight", "cwd_base" ),
			"set_featured_image" => __( "Set featured image for this Spotlight", "cwd_base" ),
			"remove_featured_image" => __( "Remove featured image for this Spotlight", "cwd_base" ),
			"use_featured_image" => __( "Use as featured image for this Spotlight", "cwd_base" ),
			"archives" => __( "Spotlight archives", "cwd_base" ),
			"insert_into_item" => __( "Insert into Spotlight", "cwd_base" ),
			"uploaded_to_this_item" => __( "Upload to this Spotlight", "cwd_base" ),
			"filter_items_list" => __( "Filter Spotlights list", "cwd_base" ),
			"items_list_navigation" => __( "Spotlights list navigation", "cwd_base" ),
			"items_list" => __( "Spotlights list", "cwd_base" ),
			"attributes" => __( "Spotlights attributes", "cwd_base" ),
			"name_admin_bar" => __( "Spotlight", "cwd_base" ),
			"item_published" => __( "Spotlight published", "cwd_base" ),
			"item_published_privately" => __( "Spotlight published privately.", "cwd_base" ),
			"item_reverted_to_draft" => __( "Spotlight reverted to draft.", "cwd_base" ),
			"item_scheduled" => __( "Spotlight scheduled", "cwd_base" ),
			"item_updated" => __( "Spotlight updated.", "cwd_base" ),
			"parent_item_colon" => __( "Parent Spotlight:", "cwd_base" ),
		];

		$args = [
			"label" => __( "Spotlights", "cwd_base" ),
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
			"rewrite" => [ "slug" => "spotlights", "with_front" => true ],
			"query_var" => true,
			"menu_icon" => "dashicons-lightbulb",
			"supports" => [ "title", "editor", "thumbnail" ],
			"taxonomies" => [ "spotlights_categories", "spotlights_tags" ],
		];

		register_post_type( "spotlights", $args );

	}

	add_action( 'init', 'cptui_register_my_cpts_spotlights' );
}

require_once 'custom-taxonomies.php';
require_once 'columns.php';