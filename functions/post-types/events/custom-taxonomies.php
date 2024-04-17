<?php

// Custom taxonomies for events content type
if ( ! function_exists ( 'create_events_tags' ) ) {
	function create_events_tags() {
		$labels = array(
			'name' => _x( 'Tags', 'taxonomy general name' ), // Tags
			'singular_name' => _x( 'Event Tag', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Event Tags' ),
			'popular_items' => __( 'Popular Event Tags' ),
			'all_items' => __( 'All Event Tags' ),
			'parent_item' => __( 'Parent Event Tag' ),
			'parent_item_colon' => __( 'Parent Event Tag:' ),
			'edit_item' => __( 'Edit Event Tag' ),
			'update_item' => __( 'Update Event Tag' ),
			'add_new_item' => __( 'Add New Event Tag' ),
			'new_item_name' => __( 'New Event Tag Name' ),
		);
		register_taxonomy('event_tags', ['events'], [
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'event_tags' ),
			"show_admin_column" => true,
			'meta_box_cb' => 'post_categories_meta_box',

		]);
	}
	add_action( 'init', 'create_events_tags', 0 );
}

if ( ! function_exists ( 'create_events_group' ) ) {
	function create_events_group() {
		$labels = array(
			'name' => _x( 'Groups', 'taxonomy general name' ), // Groups
			'singular_name' => _x( 'Event Group', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Event Groups' ),
			'popular_items' => __( 'Popular Event Groups' ),
			'all_items' => __( 'All Event Groups' ),
			'parent_item' => __( 'Parent Event Group' ),
			'parent_item_colon' => __( 'Parent Event Group:' ),
			'edit_item' => __( 'Edit Event Group' ),
			'update_item' => __( 'Update Event Group' ),
			'add_new_item' => __( 'Add New Event Group' ),
			'new_item_name' => __( 'New Event Group Name' ),
		);
		register_taxonomy('event_groups', ['events'], [
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'event_groups' ),
			"show_admin_column" => true,
			'meta_box_cb' => 'post_categories_meta_box',

		]);
	}
	add_action( 'init', 'create_events_group', 0 );
}

if ( ! function_exists ( 'create_events_type' ) ) {
	function create_events_type() {
		$labels = array(
			'name' => _x( 'Types', 'taxonomy general name' ),
			'singular_name' => _x( 'Event Type', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Event Types' ),
			'popular_items' => __( 'Popular Event Types' ),
			'all_items' => __( 'All Event Types' ),
			'parent_item' => __( 'Parent Event Type' ),
			'parent_item_colon' => __( 'Parent Event Type:' ),
			'edit_item' => __( 'Edit Event Type' ),
			'update_item' => __( 'Update Event Type' ),
			'add_new_item' => __( 'Add New Event Type' ),
			'new_item_name' => __( 'New Event Type Name' ),
		);
		register_taxonomy('event_types', ['events'], [
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'event_types' ),
			"show_admin_column" => true,
			'meta_box_cb' => 'post_categories_meta_box',

		]);
	}
	add_action( 'init', 'create_events_type', 0 );
}

// programs-and-institutes - departments <---- MAYBE ADD DEPARTMENTS AND THEMES LATER??
// if(!function_exists('create_events_departments')) {
// 	function create_events_departments() {
// 		$labels = array(
// 			'name' => _x( 'Programs and Institutes', 'taxonomy general name' ), // programs-and-institutes
// 			'singular_name' => _x( 'Program or Institute', 'taxonomy singular name' ),
// 			'search_items' =>  __( 'Search Programs and Institutes' ),
// 			'popular_items' => __( 'Popular Programs and Institutes' ),
// 			'all_items' => __( 'All Programs and Institutes' ),
// 			'parent_item' => __( 'Parent Program or Institute' ),
// 			'parent_item_colon' => __( 'Parent Program or Institute:' ),
// 			'edit_item' => __( 'Edit Program or Institute' ),
// 			'update_item' => __( 'Update Program or Institute' ),
// 			'add_new_item' => __( 'Add New Program or Institute' ),
// 			'new_item_name' => __( 'New Program or Institute Name' ),
// 		);
// 		register_taxonomy('programs-and-institutes', ['events'], [
// 			'hierarchical' => false,
// 			'labels' => $labels,
// 			'show_ui' => true,
// 			'query_var' => true,
// 			'rewrite' => array( 'slug' => 'programs-and-institutes' ),
// 			"show_admin_column" => true,
// 			'meta_box_cb' => 'post_categories_meta_box',

// 		]);
// 	}
// 	add_action( 'init', 'create_events_departments', 0 );

// }

// // Themes
// if(!function_exists('create_events_themes')) {
// 	function create_events_themes() {
// 		$labels = array(
// 			'name' => _x( 'Themes', 'taxonomy general name' ), // themes
// 			'singular_name' => _x( 'Theme', 'taxonomy singular name' ),
// 			'search_items' =>  __( 'Search Themes' ),
// 			'popular_items' => __( 'Popular Themes' ),
// 			'all_items' => __( 'All Themes' ),
// 			'parent_item' => __( 'Parent Theme' ),
// 			'parent_item_colon' => __( 'Parent Theme:' ),
// 			'edit_item' => __( 'Edit Theme' ),
// 			'update_item' => __( 'Update Theme' ),
// 			'add_new_item' => __( 'Add New Theme' ),
// 			'new_item_name' => __( 'New Theme Name' ),
// 		);
// 		register_taxonomy('themes', ['events'], [
// 			'hierarchical' => false,
// 			'labels' => $labels,
// 			'show_ui' => true,
// 			'query_var' => true,
// 			'rewrite' => array( 'slug' => 'themes' ),
// 			"show_admin_column" => true,
// 			'meta_box_cb' => 'post_categories_meta_box',

// 		]);
// 	}
// 	add_action( 'init', 'create_events_themes', 0 );

// }
