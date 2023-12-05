<?php

// Modify events sort order
if ( ! function_exists ( 'cwd_base_events_query' ) ) {
	function cwd_base_events_query( $query ) {
		if ( $query->is_main_query() && get_query_var('post_type') == 'events' ) {
			$query->set( 'meta_key', 'date' );
			$query->set( 'orderby', 'meta_value' );
			$query->set( 'order', 'DESC' );
		}
	}

	add_action( 'pre_get_posts', 'cwd_base_events_query' );
}

// Fix event dates in the database
if ( ! function_exists ( 'cwd_base_reformat_event_dates' ) ) {
	function cwd_base_reformat_event_dates($query) {
		if ( get_query_var('post_type') == 'events' ) {
			// Get the dates
			if ( $date = get_field( 'date', get_the_ID() ) ) {
				// Convert them
				$new_date = date( 'Ymd', strtotime( $date ) );

				// Update them in the database
				update_field('date', $new_date, get_the_ID() );
			}
		}
	}

	add_action( 'pre_get_posts', 'cwd_base_reformat_event_dates' );
}
