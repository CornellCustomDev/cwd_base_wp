<?php

// Post Type: Events
if ( ! function_exists ( 'cptui_register_my_cpts_events' ) ) {
	
	function cptui_register_my_cpts_events() {

		$labels = [
			"name" => __( "Events", "cwd_base" ),
			"singular_name" => __( "Event", "cwd_base" ),
			"menu_name" => __( "Events", "cwd_base" ),
			"all_items" => __( "All Events", "cwd_base" ),
			"add_new" => __( "Add new", "cwd_base" ),
			"add_new_item" => __( "Add new Event", "cwd_base" ),
			"edit_item" => __( "Edit Event", "cwd_base" ),
			"new_item" => __( "New Event", "cwd_base" ),
			"view_item" => __( "View Event", "cwd_base" ),
			"view_items" => __( "View Events", "cwd_base" ),
			"search_items" => __( "Search Events", "cwd_base" ),
			"not_found" => __( "No Events found", "cwd_base" ),
			"not_found_in_trash" => __( "No Events found in trash", "cwd_base" ),
			"parent" => __( "Parent Event:", "cwd_base" ),
			"featured_image" => __( "Featured image for this Event", "cwd_base" ),
			"set_featured_image" => __( "Set featured image for this Event", "cwd_base" ),
			"remove_featured_image" => __( "Remove featured image for this Event", "cwd_base" ),
			"use_featured_image" => __( "Use as featured image for this Event", "cwd_base" ),
			"archives" => __( "Event archives", "cwd_base" ),
			"insert_into_item" => __( "Insert into Event", "cwd_base" ),
			"uploaded_to_this_item" => __( "Upload to this Event", "cwd_base" ),
			"filter_items_list" => __( "Filter Events list", "cwd_base" ),
			"items_list_navigation" => __( "Events list navigation", "cwd_base" ),
			"items_list" => __( "Events list", "cwd_base" ),
			"attributes" => __( "Events attributes", "cwd_base" ),
			"name_admin_bar" => __( "Event", "cwd_base" ),
			"item_published" => __( "Event published", "cwd_base" ),
			"item_published_privately" => __( "Event published privately.", "cwd_base" ),
			"item_reverted_to_draft" => __( "Event reverted to draft.", "cwd_base" ),
			"item_scheduled" => __( "Event scheduled", "cwd_base" ),
			"item_updated" => __( "Event updated.", "cwd_base" ),
			"parent_item_colon" => __( "Parent Event:", "cwd_base" ),
		];

		$args = [
			'label' => __( 'Events', 'custom-post-type-ui' ),
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
			'hierarchical' => true,
			'rewrite' => [
				'slug' => 'events',
				'with_front' => true,
			],
			'query_var' => true,
			'menu_icon' => 'dashicons-calendar-alt',
			'supports' => [ 'title', 'thumbnail', 'revisions', 'page-attributes' ],
			'taxonomies' => [ 'event_tags', 'event_groups', 'event_types' ],
			'menu_position' => 5,
		];

		register_post_type( 'events', $args );
	}
	add_action( 'init', 'cptui_register_my_cpts_events' );
}

require_once 'custom-fields.php';
require_once 'custom-taxonomies.php';
require_once 'columns.php';
require_once 'plugin/class-cd-events-pull-wp-plugin.php';