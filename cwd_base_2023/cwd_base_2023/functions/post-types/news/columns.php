<?php

function news_columns( $columns ) {
    $columns = array(
        'cb'        => '<input type="checkbox" />',
        'title'     => 'Title',
        'make_sticky'  => 'Feature on front page?',
        'news_tags'      =>  'Tags',
        'news_categories'      =>  'Categories',
        'custom_date'      =>  'Publication Date'
    );
    return $columns;
}
add_filter( 'manage_news_posts_columns', 'news_columns' );

function news_column( $column, $post_id ) {
    if ( $column == 'make_sticky' ) {
        if(get_post_meta($post_id, 'make_sticky', true) == '1') {
            echo 'Yes';
        }
    }
    if ( $column == 'news_tags' ) {
		$news_tags = get_the_terms( get_the_ID(), 'news_tags' ); 

		if($news_tags) {
			$count = count($news_tags);
			$i = 1;

			foreach($news_tags as $news_tag) { 
				echo '<a href="' . site_url() . '/news_tags/' . $news_tag->slug . '/">' . $news_tag->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
    if ( $column == 'news_categories' ) {
		$news_categories = get_the_terms( get_the_ID(), 'news_categories' ); 

		if($news_categories) {
			$count = count($news_categories);
			$i = 1;

			foreach($news_categories as $news_category) { 
				echo '<a href="' . site_url() . '/news_categories/' . $news_category->slug . '/">' . $news_category->name . '</a>';
				if($i < $count) { 
					echo ', ';
				} 
				$i++;
			}
		}
    }
    if ( $column == 'custom_date' ) {
		
		$pub_date = get_field( 'publication_date', $news->ID );
		$date = date( 'F d, Y', strtotime( $pub_date ) );
		
        echo $date;
    }
}
add_action( 'manage_news_posts_custom_column', 'news_column', 10, 2 );