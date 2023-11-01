<?php

// Order people by last word in title
if ( ! function_exists ( 'cwd_base_people_orderby' ) ) {
	function cwd_base_people_orderby ($orderby_statement, $wp_query) {
		if ( ( $wp_query->get('post_type') === 'people' ) || ( is_tax( 'people_tags' ) || is_tax( 'people_categories' ) ) ) {
			return "RIGHT(post_title, LOCATE(' ', REVERSE(post_title)) - 1)";
		}

		return $orderby_statement;
	}

	add_filter( 'posts_orderby' , 'cwd_base_people_orderby', 10, 2 );
}
