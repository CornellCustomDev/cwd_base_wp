<?php 

// Get header image
if ( ! function_exists ( 'get_header_img_url' ) ) {
	function get_header_img_url() {

		global $post;

		$header_img_url = get_header_image(); // Customizer image
		$ancestor_ids = $post ? get_post_ancestors($post->ID) : null; // Section image
		$remove_header_on_page = get_post_meta( get_the_ID(), 'remove_this_header', true ); // No image 

		if ( (is_page() || is_single()) && has_post_thumbnail() ) {
			$header_img_url = get_the_post_thumbnail_url($post->ID, 'header-image'); // Use the featured image
		}
		else if ($ancestor_ids) { // Use the section image
			foreach ($ancestor_ids as $ancestor_id) { 

				// This will take the featured image url from the topmost parent
				$parent_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($ancestor_id), 'header-image' ); 

				if ( $parent_featured_image ) {
					$header_img_url = $parent_featured_image[0]; // If there is one, use it
				}
				else {
					continue; // If not, do nothing
				}
			}
		}
		if ( $remove_header_on_page == 'Yes') {
			$header_img_url = ''; // Remove header image
		}

		return $header_img_url;

	}
}
