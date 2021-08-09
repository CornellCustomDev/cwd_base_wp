<?php

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$featured_courses_args = array( 
	'post_type' => 'courses',
    'posts_per_page' => 3,
    'paged' => $paged,
	'meta_query' => array(  array(
	   'key' => 'make_sticky',
	   'value' => '1',
	   'compare' => '=',
    ),
) );			
$featured_courses_query = new WP_Query($featured_courses_args);