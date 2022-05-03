<?php

// Include post types
$post_type_options = get_field('post_type_options', 'options', true);
$post_type_choices = $post_type_options['post_types'];
$home_page_id = get_option('page_on_front');
$add_slider = get_post_meta( $home_page_id, 'add_slider', true );

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
if( $post_type_options && in_array('alerts', $post_type_choices) ) {
	require_once locate_template('/functions/post-types/alerts/post-type.php');
}
if( $post_type_options && in_array('announcements', $post_type_choices) ) {
	require_once locate_template('/functions/post-types/announcements/post-type.php');
}
if( $post_type_options && in_array('projects', $post_type_choices) ) {
	require_once locate_template('/functions/post-types/projects/post-type.php');
}
if($add_slider == 'Yes') {
	require_once locate_template('/functions/post-types/slider/post-type.php');
}