<?php

// Flush rewrite rules when a custom post type post is saved, but only once for each custom post type
if ( ! function_exists ( 'cwd_flush_rewrite_rules' ) ) {
	function cwd_flush_rewrite_rules() {
		global $post;

		// If no post object, do nothing
		if ( !$post ) {
			return;
		}

		$post_type = $post->post_type;

		if ( $post_type == 'page' || $post_type == 'post' || $post_type.'_already_flushed' == '1' ) {
			return;
		}

		flush_rewrite_rules();

		add_option($post_type.'_already_flushed', '1', '', 'yes');
	}

	add_action('save_post', 'cwd_flush_rewrite_rules', 999);
}

// Get all custom post types
if ( ! function_exists ( 'get_all_custom_post_types' ) ) {
	function get_all_custom_post_types() {
		$cptui_post_types = cptui_get_post_type_slugs();
		$local_post_types = array('courses', 'events', 'galleries', 'news', 'people', 'spotlights');
		$all_custom_post_types = array_merge($cptui_post_types, $local_post_types);

		return $all_custom_post_types;
	}
}

if ( ! function_exists ( 'get_all_post_types' ) ) {
	function get_all_post_types() {
		$all_custom_post_types = get_all_custom_post_types();
		$built_in_post_types = array('post', 'page');
		$all_post_types = array_merge($all_custom_post_types, $built_in_post_types);

		return $all_post_types;
	}
}

// Include all post types in all archives
if ( ! function_exists ( 'cwd_base_cpt_archives' ) ) {
	function cwd_base_cpt_archives( $query ) {
		if ( $query->is_tag() || is_category() && $query->is_main_query() && !is_admin() ) {
			$query->set( 'post_type', 'any' );
		}
	}

	add_action( 'pre_get_posts', 'cwd_base_cpt_archives' );
}

// Filter the permalink for post and custom post type URLs (Page links to...)
if ( ! function_exists ( 'cwd_base_filter_permalink' ) ) {
	function cwd_base_filter_permalink( $url, $post ) {
		$page_links_to = get_field( 'page_links_to', $post->ID );

		$link = isset($page_links_to['point_this_content_to']) ? $page_links_to['point_this_content_to'] : null;

		if ( $link == 'custom' ) {
			$url = $page_links_to['custom_url'];

			return $url;
		}
		else {
			return $url;
		}
	}

	add_filter( 'post_link', 'cwd_base_filter_permalink', 10, 2 ); // Posts
	add_filter( 'post_type_link', 'cwd_base_filter_permalink', 10, 2 ); // Custom Post Types
}

// Filter the permalink for page URLs (Page links to...)
if ( ! function_exists ( 'cwd_base_filter_page_permalink' ) ) {
	function cwd_base_filter_page_permalink( $url, $post ) {

		$page_links_to = get_field( 'page_links_to', $post );
		$link = isset($page_links_to['point_this_content_to']) ? $page_links_to['point_this_content_to'] : null;

		if ( $link == 'custom' ) {

			$url = $page_links_to['custom_url'];

			return $url;

		}
		else {
			return $url;
		}
	}

	add_filter( 'page_link', 'cwd_base_filter_page_permalink', 10, 2 ); // Pages
}


// Filter the permalink for post and custom post type URLs (Page links to...)
if ( ! function_exists ( 'cwd_base_filter_permalink' ) ) {
	function cwd_base_filter_permalink( $url, $post ) {

		$page_links_to = get_field( 'page_links_to', $post->ID );
		$link = isset($page_links_to['point_this_content_to']) ? $page_links_to['point_this_content_to'] : null;

		if ( $link == 'custom' ) {

			$url = $page_links_to['custom_url'];

			return $url;

		}
		else {
			return $url;
		}
	}
	add_filter( 'post_link', 'cwd_base_filter_permalink', 10, 2 ); // Posts
	add_filter( 'post_type_link', 'cwd_base_filter_permalink', 10, 2 ); // Custom Post Types
}

// Filter the permalink for page URLs (Page links to...)
if ( ! function_exists ( 'cwd_base_filter_page_permalink' ) ) {
	function cwd_base_filter_page_permalink( $url, $post ) {

		$page_links_to = get_field( 'page_links_to', $post );
		$link = isset($page_links_to['point_this_content_to']) ? $page_links_to['point_this_content_to'] : null;

		if ( $link == 'custom' ) {

			$url = $page_links_to['custom_url'];

			return $url;

		}
		else {
			return $url;
		}
	}
	add_filter( 'page_link', 'cwd_base_filter_page_permalink', 10, 2 ); // Pages
}

// Toggle metatag options for each post type
/* function metatags_field_visbility ($field) {

	$post_type_options = get_field('post_type_options', 'options', true);
	$post_type_choices = $post_type_options['post_types'];

	if (in_array('news', $post_type_choices)) {
		return $field;
	}
}
 *///add_filter('acf/load_field/key=field_60e83df931bd2', 'metatags_field_visbility');

/* foreach(get_chosen_post_types() as $chosen_post_type) {

	add_filter('acf/load_field/key=field_6345b945b9d85', function ($field) use ($chosen_post_type) {
		$field['sub_fields'] = array(
			array(
				'label' => ucwords(str_replace('_', ' ', $chosen_post_type)),
				'name' => $chosen_post_type,
				'type' => 'group',
			),
		);
		return $field;
	});

} */
