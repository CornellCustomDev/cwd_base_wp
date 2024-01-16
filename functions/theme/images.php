<?php

// Get the image. Featured images are also used as page headers
if ( ! function_exists( 'cwd_base_get_image' ) ) {
	
	function cwd_base_get_image() {
		
		global $post;
		
		$image_size = 'thumbnail'; 
		$image_width = 150; 
		$image_height = 150; 
		
		$image   = get_field('image'); // News
		$photo_url   = get_field('photo_url'); // Events
		$image_id   = get_field('image_id'); // Everything else
		$post_id = $post->ID;
		
		$image_size = 'medium'; 
		$image_width = 480; 
		$image_height = 480; 
		
		if(get_field('image')) { 
			
			$headers = get_headers($image, true);

			// If there is no image there, get the fallback image and leave
			if( $headers['Content-Type'] != 'image/jpeg' ) {
				cwd_base_get_fallback_image();
				return false;
			}
			else {
				echo '<img src="' . $image . '" alt= "" />'; 
				
			}
			
		}
		elseif(get_field('photo_url')) {
									
			$headers = get_headers($photo_url, true);

			// If there is no image there, get the fallback image and leave
			if( $headers['Content-Type'] != 'image/jpeg' ) {
				cwd_base_get_fallback_image();
				return false;
			}
			else {
				echo '<img src="' . $photo_url . '" alt= "" />'; 
				
			}
			
		}
		elseif (get_field('image_id')) {
			echo wp_get_attachment_image($image_id, $image_size); // ACF image field				
		} 
		elseif ( has_post_thumbnail() ) {     
			the_post_thumbnail($image_size); // Featured image
		}
		else {
			cwd_base_get_fallback_image(); // Fallback image
		}
	}
	
}

// Fallback image tag
if ( ! function_exists( 'cwd_base_get_fallback_image') ) {
	function cwd_base_get_fallback_image() {
		
		$image_size = 'thumbnail'; 
		$image_width = 150; 
		$image_height = 150; 
		
		if(is_single()) {
			$image_size = 'medium'; 
			$image_width = 480; 
			$image_height = 480; 
		}
		
		echo '<img width="'.$image_width.'" height="'.$image_height.'" class="attachment-'.$image_size.' size-'.$image_size.'" src="' . get_template_directory_uri() . '/images/wp/cu-seal-large.png" alt="" />';
	}
}

// Get image meta
if ( ! function_exists ( 'cwd_base_get_attachment_meta' ) ) {
	
	function cwd_base_get_attachment_meta( $attachment_id ) {
		$attachment = get_post( $attachment_id );
		return array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => get_permalink( $attachment->ID ),
			'src' => $attachment->guid,
			'title' => $attachment->post_title
		);
	}
	
}

// Get image caption for ACF image field images
if ( ! function_exists( 'cwd_base_get_image_caption') ) {
	function cwd_base_get_image_caption() {
		$attachment = cwd_base_get_attachment_meta( get_field( 'image_id' ) );
		if($attachment['caption']) {
			echo '<figcaption>' . $attachment['caption'] . '</figcaption>';
		}
	}
}

// Grab first image from content
if ( ! function_exists( 'cwd_base_catch_that_image' ) ) {
	function cwd_base_catch_that_image() {
		
		global $post;
		$first_img_url = '';
		
		ob_start();
		ob_end_clean();

		// Process any shortcodes first (galleries)
		$transformed_content = apply_filters('the_content', $post->post_content); 

		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $transformed_content, $matches);
		$first_img_url = $matches[1][0];

		if(empty($first_img_url)){
			$first_img_url = cwd_base_get_fallback_image();
		}
		echo '<img src="' . $first_img_url . '" alt="">'; 
		
	}
}

// Allow image upscaling
if( ! class_exists('ThumbnailUpscaler') ) {
	class ThumbnailUpscaler {

		static function image_resize_dimensions($default, $orig_w, $orig_h, $new_w, $new_h, $crop) {
			
			if(!$crop)
				return null;

			$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
		
			$crop_w = round($new_w / $size_ratio);
			$crop_h = round($new_h / $size_ratio);
		
			$s_x = floor( ($orig_w - $crop_w) / 2 );
			$s_y = floor( ($orig_h - $crop_h) / 2 );

			if(is_array($crop)) {

				if($crop[ 0 ] === 'left') {
					$s_x = 0;
				} 
				else if($crop[ 0 ] === 'right') {
					$s_x = $orig_w - $crop_w;
				}

				if($crop[ 1 ] === 'top') {
					$s_y = 0;
				} 
				else if($crop[ 1 ] === 'bottom') {
					$s_y = $orig_h - $crop_h;
				}
			}
		
			return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
		}
	}
	add_filter('image_resize_dimensions', array('ThumbnailUpscaler', 'image_resize_dimensions'), 10, 6);
}

// Add default site icon
if ( ! function_exists( 'upload_site_icon' ) ) {
	function upload_site_icon() {
		
		include_once( ABSPATH . 'wp-admin/includes/admin.php' );
		
		$url = get_template_directory_uri() . '/images/wp/square-old-seal.png';

		$image = '';
		
		if($url != '') {
			$file = array();
			$file['name'] = $url;
			$file['tmp_name'] = download_url($url);
	
			if (is_wp_error($file['tmp_name'])) {
				@unlink($file['tmp_name']);
				var_dump( $file['tmp_name']->get_error_messages() );
			} 
			else {
				$src = media_sideload_image($url, '', '', 'src');
				$attachment_id = attachment_url_to_postid($src);
			}
		}
		return $attachment_id;
	}
}