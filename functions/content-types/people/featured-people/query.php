<?php

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$featured_people_args = array( 
	'post_type' => 'people',
    'posts_per_page' => 4,
    'paged' => $paged,
	'meta_query' => array(  array(
	   'key' => 'make_sticky',
	   'value' => '1',
	   'compare' => '=',
    ),
) );			
$featured_people_query = new WP_Query($featured_people_args);