<?php

function people_columns( $columns ) {
    $columns = array(
        'cb'        => '<input type="checkbox" />',
        'title'     => 'Title',
        'make_sticky'  => 'Feature on front page?',
        'people_tags'      =>  'Tags',
        'people_categories'      =>  'Categories',
        'date'      =>  'Date'
    );
    return $columns;
}
add_filter( 'manage_people_posts_columns', 'people_columns' );

function people_column( $column, $post_id ) {
    if ( $column == 'make_sticky' ) {
        if(get_post_meta($post_id, 'make_sticky', true) == '1') {
            echo 'Yes';
        }
    }
    if ( $column == 'people_tags' ) {
		$people_tags = get_the_terms( get_the_ID(), 'people_tags' ); 

		if($people_tags) {
			$count = count($people_tags);
			$i = 1;

			foreach($people_tags as $people_tag) { 
				echo '<a href="' . site_url() . '/people_tags/' . $people_tag->slug . '/">' . $people_tag->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
    if ( $column == 'people_categories' ) {
		$people_categories = get_the_terms( get_the_ID(), 'people_categories' ); 

		if($people_categories) {
			$count = count($people_categories);
			$i = 1;

			foreach($people_categories as $people_category) { 
				echo '<a href="' . site_url() . '/people_categories/' . $people_category->slug . '/">' . $people_category->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
}
add_action( 'manage_people_posts_custom_column', 'people_column', 10, 2 );