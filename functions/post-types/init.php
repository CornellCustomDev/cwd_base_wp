<?php

// Get cptui post types
$cptui_post_types = cptui_get_post_type_slugs();

// Get checked post types
$checked_post_types = get_checked_post_types();

// Initialize built-in post types
if($checked_post_types) :
	foreach($checked_post_types as $checked_post_type) {

		if(file_exists(get_template_directory() . '/functions/post-types/' . $checked_post_type . '/post-type.php')) {
			require_once get_template_directory() . '/functions/post-types/' . $checked_post_type . '/post-type.php';
		}

	}
endif;

// Toggle cptui post types
foreach($cptui_post_types as $cptui_post_type) {

	$filter_string = 'cptui_disable_' . $cptui_post_type . '_cpt';

	if(!in_array($cptui_post_type, $checked_post_types)) {
		add_filter( $filter_string, '__return_true' );
	}
	else {
		add_filter( $filter_string, '__return_false' );
	}

}
