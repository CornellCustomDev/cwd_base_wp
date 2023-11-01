<?php

// Modify news sort order
if ( ! function_exists ( 'cwd_base_news_query' ) ) {
	function cwd_base_news_query( $query ) {
		if( $query->is_main_query() && get_query_var( 'post_type' ) == 'news' ) {
			$query->set( 'meta_key', 'publication_date' );
			$query->set( 'orderby', 'meta_value' );
			$query->set( 'order', 'DESC' );
		}
	}

	add_action( 'pre_get_posts', 'cwd_base_news_query' );
}

// Fix news dates in the database
if ( ! function_exists ( 'cwd_base_reformat_news_dates' ) ) {
	function cwd_base_reformat_news_dates($query) {
		if ( get_query_var( 'post_type' ) == 'news' ) {
			// Get the dates
			$date = get_field( 'publication_date', get_the_ID() );

			// Convert them
			$new_date = date( 'Ymd', strtotime( $date ) );

			// Update them in the database
			update_field( 'publication_date', $new_date, get_the_ID() );
		}
	}

	add_action( 'pre_get_posts', 'cwd_base_reformat_news_dates' );
}

// Prevent WP using 'Auto Draft' as the post title
if ( ! function_exists ( 'cwd_base_filter_news_title' ) ) {
	function cwd_base_filter_news_title($title, $id) {
		if( get_post_type( $id ) == 'news' && $title == 'Auto Draft' ) {
			$title = get_field( 'title', $id );
		}

		return $title;
	}

	add_filter( 'the_title', 'cwd_base_filter_news_title', 10, 2 );
}
