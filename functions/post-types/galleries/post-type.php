<?php

// Post Type: Galleries
if ( ! function_exists ( 'cptui_register_my_cpts_galleries' ) ) {
	
	function cptui_register_my_cpts_galleries() {

		$labels = [
			"name" => __( "Galleries", "cwd_base" ),
			"singular_name" => __( "Gallery", "cwd_base" ),
			"menu_name" => __( "Galleries", "cwd_base" ),
			"all_items" => __( "All Galleries", "cwd_base" ),
			"add_new" => __( "Add new", "cwd_base" ),
			"add_new_item" => __( "Add new Gallery", "cwd_base" ),
			"edit_item" => __( "Edit Gallery", "cwd_base" ),
			"new_item" => __( "New Gallery", "cwd_base" ),
			"view_item" => __( "View Gallery", "cwd_base" ),
			"view_items" => __( "View Galleries", "cwd_base" ),
			"search_items" => __( "Search Galleries", "cwd_base" ),
			"not_found" => __( "No Galleries found", "cwd_base" ),
			"not_found_in_trash" => __( "No Galleries found in trash", "cwd_base" ),
			"parent" => __( "Parent Gallery:", "cwd_base" ),
			"featured_image" => __( "Featured image for this Gallery", "cwd_base" ),
			"set_featured_image" => __( "Set featured image for this Gallery", "cwd_base" ),
			"remove_featured_image" => __( "Remove featured image for this Gallery", "cwd_base" ),
			"use_featured_image" => __( "Use as featured image for this Gallery", "cwd_base" ),
			"archives" => __( "Gallery archives", "cwd_base" ),
			"insert_into_item" => __( "Insert into Gallery", "cwd_base" ),
			"uploaded_to_this_item" => __( "Upload to this Gallery", "cwd_base" ),
			"filter_items_list" => __( "Filter Galleries list", "cwd_base" ),
			"items_list_navigation" => __( "Galleries list navigation", "cwd_base" ),
			"items_list" => __( "Galleries list", "cwd_base" ),
			"attributes" => __( "Galleries attributes", "cwd_base" ),
			"name_admin_bar" => __( "Gallery", "cwd_base" ),
			"item_published" => __( "Gallery published", "cwd_base" ),
			"item_published_privately" => __( "Gallery published privately.", "cwd_base" ),
			"item_reverted_to_draft" => __( "Gallery reverted to draft.", "cwd_base" ),
			"item_scheduled" => __( "Gallery scheduled", "cwd_base" ),
			"item_updated" => __( "Gallery updated.", "cwd_base" ),
			"parent_item_colon" => __( "Parent Gallery:", "cwd_base" ),
		];

		$args = [
			"label" => __( "Galleries", "cwd_base" ),
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
			"rewrite" => [ "slug" => "galleries", "with_front" => true ],
			"query_var" => true,
			"menu_icon" => "dashicons-images-alt2",
			"supports" => [ "title", "editor", "thumbnail" ],
			"taxonomies" => [ "gallery_categories", "gallery_tags" ],
		];

		register_post_type( "galleries", $args );

	}

	add_action( 'init', 'cptui_register_my_cpts_galleries' );
}

require_once 'custom-fields.php';
require_once 'custom-taxonomies.php';
require_once 'columns.php';