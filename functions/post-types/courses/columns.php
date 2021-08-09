<?php

function courses_columns( $columns ) {
    $columns = array(
        'cb'        => '<input type="checkbox" />',
        'title'     => 'Title',
        'make_sticky'  => 'Feature on front page?',
        'course_tags'      =>  'Tags',
        'course_categories'      =>  'Categories',
        'date'      =>  'Date'
    );
    return $columns;
}
add_filter( 'manage_courses_posts_columns', 'courses_columns' );

function courses_column( $column, $post_id ) {
    if ( $column == 'make_sticky' ) {
        if(get_post_meta($post_id, 'make_sticky', true) == '1') {
            echo 'Yes';
        }
    }
    if ( $column == 'course_tags' ) {
		$course_tags = get_the_terms( get_the_ID(), 'course_tags' ); 

		if($course_tags) {
			$count = count($course_tags);
			$i = 1;

			foreach($course_tags as $course_tag) { 
				echo '<a href="' . site_url() . '/course_tags/' . $course_tag->slug . '/">' . $course_tag->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
    if ( $column == 'course_categories' ) {
		$course_categories = get_the_terms( get_the_ID(), 'course_categories' ); 

		if($course_categories) {
			$count = count($course_categories);
			$i = 1;

			foreach($course_categories as $course_category) { 
				echo '<a href="' . site_url() . '/course_categories/' . $course_category->slug . '/">' . $course_category->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
}
add_action( 'manage_courses_posts_custom_column', 'courses_column', 10, 2 );