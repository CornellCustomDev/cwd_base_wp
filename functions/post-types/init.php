<?php

// Include post types
$post_type_options = get_field('post_type_options', 'options', true);
$post_type_choices = $post_type_options['post_types'];

if( $post_type_options && in_array('news', $post_type_choices) ) {
	require_once locate_template('/functions/post-types/news/post-type.php');
}
if( $post_type_options && in_array('events', $post_type_choices) ) {
	require_once locate_template('/functions/post-types/events/post-type.php');
}
if( $post_type_options && in_array('people', $post_type_choices) ) {
	require_once locate_template('/functions/post-types/people/post-type.php');
}
if( $post_type_options && in_array('courses', $post_type_choices) ) {
	require_once locate_template('/functions/post-types/courses/post-type.php');
}
if( $post_type_options && in_array('testimonials', $post_type_choices) ) {
	require_once locate_template('/functions/post-types/testimonials/post-type.php');
}
if( $post_type_options && in_array('galleries', $post_type_choices) ) {
	require_once locate_template('/functions/post-types/galleries/post-type.php');
}

