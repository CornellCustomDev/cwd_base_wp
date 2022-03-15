<?php

// Get the image. Featured images are also used as page headers
if ( ! function_exists( 'cwd_base_get_image' ) ) {
	
	/**
	 * @Dave should this just check if get_post_thumbnail_id($post_id)?
	 * If we keep this should this also check last years folder? 
	 * I could see issue at the new year where the folder path is not found.
	 * 
	 * This function loops through all folders by month and checks if it is found and returns the url.
	 * 
	 * @param string $file_name
	 * @return mixed image url|false
	 */
	function get_events_photo_url($file_name) {
		$possible_image_url = false;
		$months_to_check = [
			'01',
			'02',
			'03',
			'04',
			'05',
			'06',
			'07',
			'08',
			'09',
			'10',
			'11',
			'12',
		];
		$path_to_file_parts = explode('/', wp_upload_dir()['path']);
		
		// check and see if it is stored in any folder /YYYY/**/FILE_NAME
		foreach ($months_to_check as $month) {
			$path_to_file_parts[5] = $month;
			$possible_image_url = implode('/', $path_to_file_parts) . '/' . $file_name;
			if (file_exists($possible_image_url)) {
				// on pantheon we need to return the url not the file path.
				return str_replace('code/', '', $possible_image_url);
			}
		}
		return false;
	}
	
	function format_image_url($url, $width=480, $height=480) {
		if( strpos($url, '.jpeg') ) {
			$url = str_replace('.jpeg', "-{$width}x{$height}.jpeg", $url);
		}
		elseif( strpos($url, '.png') ) {
			$url = str_replace('.png', "-{$width}x{$height}.png", $url);
		}
		elseif( strpos($url, '.jpg') ) {
			$url = str_replace('.jpg', "-{$width}x{$height}.jpg", $url);
		}
		return $url;
	}
	
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
		
		if($image) { 
			
			/* Here we will upload images from the news feed and resize them to square.
			 * News feed images normally are 850x478, so we upload them to the media 
			 * library in order to crop them down to 480x480 (slight upsizing, just two 
			 * pixels). */
			
			// Grab everything before the question mark
			$new_image = substr($image, 0, strpos($image, '?'));
			//echo '<strong style="margin-top: 100px; display: block;">Image: </strong>'.$new_image.'<br>';
			
			// Grab the base name and sanitize
			$temp_url = basename($new_image);
			$temp_url = strtolower(sanitize_file_name($temp_url)); 
			//echo '<strong>Temp image name: </strong>'.$temp_url.'<br>';
			
			$temp_url = format_image_url($temp_url, $image_width, $image_height);
			$new_image_url = get_events_photo_url($temp_url);
			
			// Hey, it's a new image and it doesn't exist yet!
			if(!$new_image_url) { 
				// Download to a temporary file, then upload it
				$image_url = cwd_base_upload_image($image, $post_id);
				$new_image_url = get_events_photo_url($temp_url);
			}

			echo '<img src="' . $new_image_url . '" alt= "" />';

		}
		elseif($photo_url) {
			
			/* Here we will upload images from the events feed and resize them to square.
			 * Events feed images are various sizes, but we upload them to the media 
			 * library and crop them down to 480x480. All image sizes will be
			 * created. */
			
			// Grab the base name and sanitize
			$temp_file_name = basename($photo_url);
			$temp_file_name = strtolower(sanitize_file_name($temp_file_name));
			$temp_file_name = format_image_url($temp_file_name, $image_width, $image_height);
			// echo '<strong>Temp image name: </strong>'.$temp_file_name.'<br>';
			
			$new_image_url = get_events_photo_url($temp_file_name);
			
			// Hey, it's a new image and it doesn't exist yet!
			if(!$new_image_url) {
				// Download to a temporary file, then upload it
				$image_url = cwd_base_upload_image($photo_url, $post_id);
				$new_image_url = get_events_photo_url($temp_file_name);
			}
			
			// Et voila. 
			$new_image_url = $new_image_url ?: get_template_directory_uri() . '/images/wp/cu-seal-large.png';
			echo '<img src="' . $new_image_url . '" alt= "" />';
		}
		elseif (get_field('image_id')) {
			echo wp_get_attachment_image($image_id, $image_size); // ACF image field
			//echo 'Hello, world!';
				
		} 
		elseif ( has_post_thumbnail() ) {
			the_post_thumbnail($image_size); // Featured image
		}
		else {
			//if(!is_single()) {
				cwd_base_get_fallback_image(); // Fallback image
			//}
		}
	}
	
}

// Upload an image from a URL 
if ( ! function_exists( 'cwd_base_upload_image') ) {
	
	function cwd_base_upload_image($url, $post_id) {
		
		if( !is_admin() ) {
			
			//echo '<strong>URL: </strong>'.$url.'<br>';
			//echo '<strong>Post ID: </strong>'.$post_id.'<br>';
		
			include_once( ABSPATH . 'wp-admin/includes/admin.php' );
			//define('ALLOW_UNFILTERED_UPLOADS', true);

			$image = '';
			if($url != '') {

				$file = array();
				$file['name'] = basename(strtolower($url));
				if(strpos($file['name'], '?')) {
					$file['name'] = substr($file['name'], 0, strpos($file['name'], '?'));
				}
				$file['tmp_name'] = download_url($url); // Download to temporary file
				
				//foreach($file as $k=>$v) {
					//echo '<strong>'.$k.'</strong> => '.$v.'<br>';
				//}
				
				//echo '<strong>Basename: </strong>'.basename($file['tmp_name']).'<br>';

				if (is_wp_error($file['tmp_name'])) {
					@unlink($file['tmp_name']);
					var_dump( $file['tmp_name']->get_error_messages( ) );
				} 
				else {
					$attachmentId = media_handle_sideload($file, $post_id); // Sideloading it (as opposed to uploading it)
					
					//echo '<strong>Attachment ID: </strong>'.$attachmentId.'<br>';

					if ( is_wp_error($attachmentId) ) {
						@unlink($file['tmp_name']);
						var_dump( $attachmentId->get_error_messages( ) );
					} 
					else {                
						$image = strtolower(wp_get_attachment_url($attachmentId)); // Gimme it (the url)
						//echo '<strong>Attachment URL: </strong>'.$image.'<br>';
					}
				}
			}
			return $image; // Return it
		}
	}
}


// Fallback image
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
		
		echo '<img width="'.$image_width.'" height="'.$image_height.'" class="attachment-'.$image_size.' size-'.$image_size.'" src="' . get_template_directory_uri() . '/images/wp/cu-seal-large.png" alt="Cornell University seal" />';
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

// Allow image upscaling
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

// Add default site icon
function upload_site_icon() {
	
	include_once( ABSPATH . 'wp-admin/includes/admin.php' );
	
	$url = site_url('/') . 'wp-content/themes/cwd_base/images/wp/square-old-seal.png';
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