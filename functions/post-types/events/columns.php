<?php

function events_columns( $columns ) {
    $columns = array(
        'cb'        => '<input type="checkbox" />',
        'title'     => 'Title',
        'make_sticky'  => 'Feature on front page?',
        'event_tags'      =>  'Tags',
        'event_groups'      =>  'Groups',
        'event_types'      =>  'Types',
        'custom_date'      =>  'Event Date'
    );
    return $columns;
}
add_filter( 'manage_events_posts_columns', 'events_columns' );

function events_column( $column, $post_id ) {
    if ( $column == 'make_sticky' ) {
        if(get_post_meta($post_id, 'make_sticky', true) == '1') {
            echo 'Yes';
        }
    }
    if ( $column == 'event_tags' ) {
		$event_tags = get_the_terms( get_the_ID(), 'event_tags' ); 

		if($event_tags) {
			$count = count($event_tags);
			$i = 1;

			foreach($event_tags as $event_tag) { 
				echo '<a href="' . site_url() . '/event_tags/' . $event_tag->slug . '/">' . $event_tag->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
    if ( $column == 'event_groups' ) {
		$event_groups = get_the_terms( get_the_ID(), 'event_groups' ); 

		if($event_groups) {
			$count = count($event_groups);
			$i = 1;

			foreach($event_groups as $event_group) { 
				echo '<a href="' . site_url() . '/event_groups/' . $event_group->slug . '/">' . $event_group->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
    if ( $column == 'event_types' ) {
		$event_types = get_the_terms( get_the_ID(), 'event_types' ); 

		if($event_types) {
			$count = count($event_types);
			$i = 1;

			foreach($event_types as $event_type) { 
				echo '<a href="' . site_url() . '/event_types/' . $event_type->slug . '/">' . $event_type->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
    if ( $column == 'custom_date' ) {
		
		$pub_date = get_field( 'date', $post_id );
		$date = date( 'F d, Y', strtotime( $pub_date ) );
		
        echo $date;
    }
}
add_action( 'manage_events_posts_custom_column', 'events_column', 10, 2 );