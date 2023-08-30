<?php

function galleries_columns( $columns ) {
    $columns = array(
        'cb'        => '<input type="checkbox" />',
        'title'     => 'Title',
        'make_sticky'  => 'Feature on front page?',
        'gallery_tags'      =>  'Tags',
        'gallery_categories'      =>  'Categories',
        'date'      =>  'Date'
    );
    return $columns;
}
add_filter( 'manage_galleries_posts_columns', 'galleries_columns' );

function galleries_column( $column, $post_id ) {
    if ( $column == 'make_sticky' ) {
        if(get_post_meta($post_id, 'make_sticky', true) == '1') {
            echo 'Yes';
        }
    }
    if ( $column == 'gallery_tags' ) {
		$gallery_tags = get_the_terms( get_the_ID(), 'gallery_tags' ); 

		if($gallery_tags) {
			$count = count($gallery_tags);
			$i = 1;

			foreach($gallery_tags as $gallery_tag) { 
				echo '<a href="' . site_url() . '/gallery_tags/' . $gallery_tag->slug . '/">' . $gallery_tag->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
    if ( $column == 'gallery_categories' ) {
		$gallery_categories = get_the_terms( get_the_ID(), 'gallery_categories' ); 

		if($gallery_categories) {
			$count = count($gallery_categories);
			$i = 1;

			foreach($gallery_categories as $gallery_category) { 
				echo '<a href="' . site_url() . '/gallery_categories/' . $gallery_category->slug . '/">' . $gallery_category->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
}
add_action( 'manage_galleries_posts_custom_column', 'galleries_column', 10, 2 );