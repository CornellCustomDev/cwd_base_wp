<?php 

// Get header image? Maybe. Maybe a slider.
if ( ! function_exists ( 'get_header_img_url' ) ) {
	function get_header_img_url() {

		global $post;

		$header_img_url = get_header_image(); // Customizer image
		$ancestor_ids = get_post_ancestors($post->ID); // Section image
		$remove_header_on_page = get_post_meta( get_the_ID(), 'remove_this_header', true ); // No image 

		if ( (is_page() || is_single()) && has_post_thumbnail() ) {
			$header_img_url = get_the_post_thumbnail_url($post->ID, 'header-image'); // Use the featured image
		}
		else if ($ancestor_ids) { // Use the section image
			foreach ($ancestor_ids as $ancestor_id) { 

				// This will take the featured image url from the topmost parent
				$parent_featured_image = wp_get_attachment_url( get_post_thumbnail_id($ancestor_id), 'header-image' ); 

				if ( $parent_featured_image ) {
					$header_img_url = $parent_featured_image; // If there is one, use it
				}
				else {
					continue; // If not, do nothing
				}
			}
		}
		if ( $remove_header_on_page == 'Yes') {
			$header_img_url = ''; // Remove header image
		}

		$add_slider = get_add_slider();

		if ( is_front_page() && $add_slider == 'Yes') {
			$header_img_url = ''; // Remove header image
		}

		return $header_img_url;

	}
}

if ( ! function_exists ( 'get_add_slider' ) ) {
	function get_add_slider() {

		$add_slider = get_post_meta( get_the_ID(), 'add_slider', true ); // Replace header image with slider 

		return $add_slider;
	}
}