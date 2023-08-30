<?php

// Post Type: News
if ( ! function_exists ( 'cptui_register_my_cpts_news' ) ) {
	
	function cptui_register_my_cpts_news() {

		$labels = [
			'name' => __( 'News', 'custom-post-type-ui' ),
			'singular_name' => __( 'News', 'custom-post-type-ui' ),
			"menu_name" => __( "News", "cwd_base" ),
			"all_items" => __( "All News", "cwd_base" ),
			"add_new" => __( "Add New", "cwd_base" ),
			"add_new_item" => __( "Add New News", "cwd_base" ),
			"edit_item" => __( "Edit News", "cwd_base" ),
			"new_item" => __( "New News", "cwd_base" ),
			"view_item" => __( "View News", "cwd_base" ),
			"view_items" => __( "View News", "cwd_base" ),
			"search_items" => __( "Search News", "cwd_base" ),
			"not_found" => __( "No News found", "cwd_base" ),
			"not_found_in_trash" => __( "No News found in trash", "cwd_base" ),
			"parent" => __( "Parent News:", "cwd_base" ),
			"featured_image" => __( "Featured image for this News", "cwd_base" ),
			"set_featured_image" => __( "Set featured image for this News", "cwd_base" ),
			"remove_featured_image" => __( "Remove featured image for this News", "cwd_base" ),
			"use_featured_image" => __( "Use as featured image for this News", "cwd_base" ),
			"archives" => __( "News archives", "cwd_base" ),
			"insert_into_item" => __( "Insert into News", "cwd_base" ),
			"uploaded_to_this_item" => __( "Upload to this News", "cwd_base" ),
			"filter_items_list" => __( "Filter News list", "cwd_base" ),
			"items_list_navigation" => __( "News list navigation", "cwd_base" ),
			"items_list" => __( "News list", "cwd_base" ),
			"attributes" => __( "News attributes", "cwd_base" ),
			"name_admin_bar" => __( "News", "cwd_base" ),
			"item_published" => __( "News published", "cwd_base" ),
			"item_published_privately" => __( "News published privately.", "cwd_base" ),
			"item_reverted_to_draft" => __( "News reverted to draft.", "cwd_base" ),
			"item_scheduled" => __( "News scheduled", "cwd_base" ),
			"item_updated" => __( "News updated.", "cwd_base" ),
			"parent_item_colon" => __( "Parent News:", "cwd_base" ),
		];

		$args = [
			'label' => __( 'News', 'custom-post-type-ui' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'has_archive' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'delete_with_user' => false,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => [
				'slug' => 'news',
				'with_front' => true,
			],
			'query_var' => true,
			'menu_icon' => 'dashicons-analytics',
			'supports' => [ 'title', 'thumbnail', 'revisions', 'page-attributes' ],
			'taxonomies' => array('news_categories', 'news_tags'),
			'menu_position' => 4,
		];

		register_post_type( 'news', $args );
	
	}

	add_action( 'init', 'cptui_register_my_cpts_news' );
}

require_once 'custom-fields.php';
require_once 'custom-taxonomies.php';
require_once 'columns.php';
require_once 'plugin/cd-news-pull-wp-plugin.php';