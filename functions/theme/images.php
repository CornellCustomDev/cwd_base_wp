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

			// Get the upload directory and create a filepath
			$dir = wp_upload_dir();
			//echo '<strong>Directory parts: </strong><br>';
			//foreach($dir as $d) {
				//echo $d.'<br><br>';
			//}
			
			$path_to_file = $dir['path'].'/'.$temp_url; 
			//echo '<strong>Path to file: </strong>'.$path_to_file.'<br>';
			
			// Hey, it's a new image and it doesn't exist yet!
			if(!file_exists($path_to_file)) { 
				
				// Download to a temporary file, then upload it
				$image_url = cwd_base_upload_image($image, $post_id); 
				//echo '<strong>Image URL: </strong>'.$image_url.'<br>';
				
				// Now create an image id
				$image_id = attachment_url_to_postid($image_url); 
				
				// Now with an id you can get the file
				$filename = strtolower(basename(get_attached_file($image_id))); 
				
				// New name, new path
				$dir = wp_upload_dir();
				$path_to_file = $dir['path'].'/'.$filename; 
				
				// Send it to the image editor
				$editor = wp_get_image_editor($path_to_file); 
				
				// Resize it
				//$editor->resize( 478, 478, true ); 
				
				// Save it
				//$editor->save($editor->generate_filename()); 
				
				// Explode it on the dots
				$new_image_part = explode('.', $temp_url); 
				
				// Remove everything after the last dot
				unset($new_image_part[count($new_image_part) - 1]); 
				
				//Put it back together
				$new_image_part = implode('.', $new_image_part); 
				
				// Name your newly resized image
				if( strpos($temp_url, '.jpeg') ) {
					$new_image_url = $new_image_part.'-480x480.jpeg';
				}
				elseif( strpos($temp_url, '.png') ) {
					$new_image_url = $new_image_part.'-480x480.png';
				}
				else {
					$new_image_url = $new_image_part.'-480x480.jpg';
				}

			}
			else {
				
				// It (the original image) already esists, but we still need to pass a URL to the image tag
				$new_image_part = explode('.', $temp_url); 
				unset($new_image_part[count($new_image_part) - 1]);
				$new_image_part = implode('.', $new_image_part);

				if( strpos($temp_url, '.jpeg') ) {
					$new_image_url = $new_image_part.'-480x480.jpeg';
				}
				elseif( strpos($temp_url, '.png') ) {
					$new_image_url = $new_image_part.'-480x480.png';
				}
				else {
					$new_image_url = $new_image_part.'-480x480.jpg';
				}
			}
			
			// Et voila. We can do the same thing for events feed images
			echo '<img src="' . $dir['url'] . '/' . $new_image_url . '" alt= "" />'; 
			//echo '<img src="' . $image . '" alt= "" />'; 
			
		}
		elseif(get_field('photo_url')) {
						
			/* Here we will upload images from the events feed and resize them to square.
			 * Events feed images are various sizes, but we upload them to the media 
			 * library and crop them down to 480x480. All image sizes will be
			 * created. */
			
			// Grab the base name and sanitize
			$temp_url = basename($photo_url);
			$temp_url = strtolower(sanitize_file_name($temp_url)); 
			//echo '<strong>Temp image name: </strong>'.$temp_url.'<br>';

			// Get the upload directory and create a filepath
			$dir = wp_upload_dir();
			//echo '<strong>Directory parts: </strong><br>';
			//foreach($dir as $d) {
				//echo $d.'<br><br>';
			//}
			
			$path_to_file = $dir['path'].'/'.$temp_url; 
			//echo '<strong>Path to file: </strong>'.$path_to_file.'<br>';
			
			// Hey, it's a new image and it doesn't exist yet!
			if(!file_exists($path_to_file)) { 
				
				// Download to a temporary file, then upload it
				$image_url = cwd_base_upload_image($photo_url, $post_id); 
				//echo '<strong>Image URL: </strong>'.$image_url.'<br>';

				// Now create an image id
				$image_id = attachment_url_to_postid($image_url); 
				//echo '<strong>Image ID: </strong>'.$image_id.'<br>';

				// Now with an id you can get the file
				$filename = strtolower(basename(get_attached_file($image_id))); 
				//echo '<strong>Filename: </strong>'.$filename.'<br>';

				// New name, new path
				$dir = wp_upload_dir();
				$path_to_file = $dir['path'].'/'.$filename; 
				
				// Send it to the image editor
				$editor = wp_get_image_editor($path_to_file); 
				
				// Resize it
				//$editor->resize( 480, 480, true ); 
				
				// Save it
				//$editor->save($editor->generate_filename()); 
				
				// Explode it on the dots
				$new_image_part = explode('.', $temp_url); 
				
				// Remove everything after the last dot
				unset($new_image_part[count($new_image_part) - 1]); 
				
				//Put it back together
				$new_image_part = implode('.', $new_image_part); 
				
				// Name your newly resized image
				$new_image_url = $new_image_part.'-480x480.jpg'; 

			}
			else {
				
				$new_image_part = explode('.', $temp_url); 
				unset($new_image_part[count($new_image_part) - 1]);
				$new_image_part = implode('.', $new_image_part);
				$new_image_url = $new_image_part.'-480x480.jpg';
			}
			
			// Et voila. 
			echo '<img src="' . $dir['url'] . '/' . $new_image_url . '" alt= "" />'; 
			//echo '<img src="' . $photo_url . '" alt= "" />'; 
			
		}
		elseif (get_field('image_id')) {
			echo wp_get_attachment_image($image_id, $image_size); // ACF image field
			echo 'Hello, world!';
				
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