<?php

// Add wide class to alignment options
add_theme_support ('align-wide');

// Set width of content
if ( ! isset( $content_width ) ) {
    $content_width = 808.39;
}

if ( ! function_exists ( 'cwd_base_adjust_content_width' ) ) {
	function cwd_base_adjust_content_width() {
		global $content_width;
		$layout = get_layout();

		if ( $layout == 'no_sidebar' ) {
			$content_width = 1280;
		}
	}
	add_action( 'template_redirect', 'cwd_base_adjust_content_width' );
}

// Search template redirect
if ( ! function_exists ( 'search_template_redirect' ) ) {
	function search_template_redirect() {

		global $wp_query;;

		if($wp_query->is_search) {

			if(isset($_GET['sitesearch'])) {
				$selected_radio = $_GET['sitesearch'];
			}

			if (isset($_GET['sitesearch']) && $selected_radio == 'cornell') {
				$search_terms = urlencode($_GET['s']);
				$location = "https://www.cornell.edu/search/" . "?q=" . $search_terms;
				wp_redirect($location);
				exit();
			}

		}
	}

	add_action( 'template_redirect', 'search_template_redirect' );
}

// Remove auto p in excerpts
remove_filter ('the_excerpt', 'wpautop');

// Limit excerpt length
if ( ! function_exists( 'custom_excerpt' ) ) {
	function custom_excerpt($characters){
		$excerpt = get_the_content();

		if($characters == '') {
			$characters = 0;
		}

		if( has_excerpt(get_the_ID()) ) {
			$excerpt = the_excerpt();
		}
		if( get_post_type() == 'news' ) {
			$excerpt = get_field('info');
		}
		if( get_post_type() == 'events' ) {
			$excerpt = get_field('description');
		}

		$excerpt = preg_replace("`[[^]]*]`",'',$excerpt);
		$excerpt = strip_shortcodes($excerpt);
		$excerpt = strip_tags($excerpt);
		$excerpt = substr($excerpt, 0, $characters);
		$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
		$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
		if($excerpt) {
			$excerpt = $excerpt . '...';
		}
		else {
			$excerpt = $excerpt;
		}
		return $excerpt;
	}
}

// Target parent pages and their children
if ( ! function_exists ( 'is_tree' ) ) {
	function is_tree($pid) {  // $pid = parent id
		global $post;
		if(is_page()&&($post->post_parent==$pid||is_page($pid)))
			return true;
		else
			return false;
	}
}

// Pull info from a page with the same slug as custom post type
function get_page_data($post_type) {
	// Interrupt the default query to grab some content for custom post type archive pages.
	// The page slug MUST be the same as the post type slug for this to work.
	$new_query = new WP_Query( 'pagename=' . $post_type );
	if( $new_query->have_posts() ) : $new_query->the_post();
		return the_content();
	endif;
}
