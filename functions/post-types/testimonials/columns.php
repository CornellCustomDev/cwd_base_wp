<?php

function testimonials_columns( $columns ) {
    $columns = array(
        'cb'        => '<input type="checkbox" />',
        'title'     => 'Title',
        'make_sticky'  => 'Feature on front page?',
        'testimonial_tags'      =>  'Tags',
        'testimonial_categories'      =>  'Categories',
        'date'      =>  'Date'
    );
    return $columns;
}
add_filter( 'manage_testimonials_posts_columns', 'testimonials_columns' );

function testimonials_column( $column, $post_id ) {
    if ( $column == 'make_sticky' ) {
        if(get_post_meta($post_id, 'make_sticky', true) == '1') {
            echo 'Yes';
        }
    }
    if ( $column == 'testimonial_tags' ) {
		$testimonial_tags = get_the_terms( get_the_ID(), 'testimonial_tags' ); 

		if($testimonial_tags) {
			$count = count($testimonial_tags);
			$i = 1;

			foreach($testimonial_tags as $testimonial_tag) { 
				echo '<a href="' . site_url() . '/testimonial_tags/' . $testimonial_tag->slug . '/">' . $testimonial_tag->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
    if ( $column == 'testimonial_categories' ) {
		$testimonial_categories = get_the_terms( get_the_ID(), 'testimonial_categories' ); 

		if($testimonial_categories) {
			$count = count($testimonial_categories);
			$i = 1;

			foreach($testimonial_categories as $testimonial_category) { 
				echo '<a href="' . site_url() . '/testimonial_categories/' . $testimonial_category->slug . '/">' . $testimonial_category->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
}
add_action( 'manage_testimonials_posts_custom_column', 'testimonials_column', 10, 2 );