<?php

function spotlights_columns( $columns ) {
    $columns = array(
        'cb'        => '<input type="checkbox" />',
        'title'     => 'Title',
        //'make_sticky'  => 'Feature on front page?',
        'spotlights_tags'      =>  'Tags',
        'spotlights_categories'      =>  'Categories',
        'date'      =>  'Date'
    );
    return $columns;
}
add_filter( 'manage_spotlights_posts_columns', 'spotlights_columns' );

function spotlights_column( $column, $post_id ) {
    // if ( $column == 'make_sticky' ) {
    //     if(get_post_meta($post_id, 'make_sticky', true) == '1') {
    //         echo 'Yes';
    //     }
    // }
    if ( $column == 'spotlights_tags' ) {
		$spotlight_tags = get_the_terms( get_the_ID(), 'spotlights_tags' ); 

		if($spotlight_tags) {
			$count = count($spotlight_tags);
			$i = 1;

			foreach($spotlight_tags as $spotlight_tag) { 
				echo '<a href="' . site_url() . '/spotlights_tags/' . $spotlight_tag->slug . '/">' . $spotlight_tag->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
    if ( $column == 'spotlights_categories' ) {
		$spotlight_categories = get_the_terms( get_the_ID(), 'spotlights_categories' ); 

		if($spotlight_categories) {
			$count = count($spotlight_categories);
			$i = 1;

			foreach($spotlight_categories as $spotlight_category) { 
				echo '<a href="' . site_url() . '/spotlights_categories/' . $spotlight_category->slug . '/">' . $spotlight_category->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
}
add_action( 'manage_spotlights_posts_custom_column', 'spotlights_column', 10, 2 );