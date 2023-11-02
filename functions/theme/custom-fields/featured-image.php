<?php

// Customize the Featured Image metabox
if ( ! function_exists ( 'cwd_base_custom_featured_image_text' ) ) {
	function cwd_base_custom_featured_image_text( $content ) {
	    return '<p>' . __('Override the default header image for this page or post.') . '</p>' . $content;
	}

	add_filter( 'admin_post_thumbnail_html', 'cwd_base_custom_featured_image_text' );
}
