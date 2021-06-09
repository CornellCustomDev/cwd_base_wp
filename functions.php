<?php

/******************************************************
 All base theme functions are "pluggable" which means 
 they can be overridden in a child theme. Just copy 
 and paste the function (without the condition) into 
 your child theme's functions.php file
*******************************************************/

// Get site URL
$baseUrl = site_url();

// Required files
$cwd_includes = array(
	'/functions/theme/setup.php',
	'/functions/theme/layout.php',
	'/functions/theme/body-classes.php',
	'/functions/theme/pagination.php',
	'/functions/theme/widgets.php',
	'/functions/theme/gallery.php',
	'/functions/theme/options.php',
	'/functions/theme/dates.php',
	'/functions/theme/images.php',
	'/functions/theme/header-img.php',
	'/functions/navigation/menus.php',
	'/functions/navigation/breadcrumbs.php',
	'/functions/navigation/menu-classes.php',
	'/functions/navigation/section-nav/section-nav.php',
	'/functions/navigation/section-nav/cpt-section-nav.php',
	'/functions/customizer/device-previews.php',
	'/functions/customizer/customize-register.php',
	'/functions/theme/custom-fields/image_id.php',
	'/functions/theme/custom-fields/page_links_to.php',
	
	// Content Types: uncomment to activate 
	'/functions/content-types/news/post-type.php', 
	'/functions/content-types/events/post-type.php', 
	'/functions/content-types/people/post-type.php', 
	'/functions/content-types/slider/slider.php'
);

// Check if file exists
foreach($cwd_includes as $file){
	
	if(!$filepath = locate_template($file)) {
		trigger_error("Error locating `$file` for inclusion!", E_USER_ERROR);
	}
	require_once $filepath;
}
unset($file, $filepath);

// Set width of content
if ( ! isset( $content_width ) ) {
    $content_width = 808.39;
}
if ( ! function_exists ( 'cwd_base_adjust_content_width' ) ) {
	function cwd_base_adjust_content_width() {

		global $content_width;
		$layout = get_layout();

		if ( $layout == 'no_sidebar' ) {
			$content_width = 1280;
		}
	}
	add_action( 'template_redirect', 'cwd_base_adjust_content_width' );
}

// Enable the use of shortcodes in text widgets.
add_filter( 'widget_text', 'do_shortcode' );

// Add slider.php
if ( ! function_exists ( 'call_slider_function' ) ) {
	function call_slider_function() {
		$add_slider = get_post_meta( get_the_ID(), 'add_slider', true );
		if(is_front_page() && $add_slider == 'Yes') {
			require_once get_theme_file_path('/functions/content-types/slider/slider.php');
		}
	}
}
add_action( 'wp', 'call_slider_function' );

// Add editor styles
if ( ! function_exists ( 'cwd_base_editor_styles' ) ) {
	function cwd_base_editor_styles() {
		add_editor_style( 'css/editor-style.css');
	}
}
add_action( 'admin_init', 'cwd_base_editor_styles' );

/*--------- Custom WYSIWYG Classes ------------------------*/
if ( ! function_exists ( 'add_style_select_buttons' ) ) {
	function add_style_select_buttons( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}
	add_filter( 'mce_buttons_2', 'add_style_select_buttons' );
}

// Add custom styles to the WordPress editor
if ( ! function_exists ( 'cwd_custom_styles' ) ) {
	function cwd_custom_styles( $init_array ) {  

		$style_formats = array(  
			// These are the custom styles
			array(  
				'title' => 'Intro Text',  
				'inline' => 'span',  
				'classes' => 'intro',
			),
			array(  
				'title' => 'Link Button',  
				'selector' => 'a',  
				'classes' => 'link-button',
			)
		);  
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );  

		return $init_array;  

	} 
	// Attach callback to 'tiny_mce_before_init' 
	add_filter( 'tiny_mce_before_init', 'cwd_custom_styles' );
}


// Search template redirect
if ( ! function_exists ( 'search_template_redirect' ) ) {
	
	function search_template_redirect() {

		global $wp_query;;

		if($wp_query->is_search) {

			$selected_radio = $_GET['sitesearch'];

			if ($selected_radio == 'cornell') {
				$search_terms = urlencode($_GET['s']);
				$location = "https://www.cornell.edu/search/" . "?q=" . $search_terms;
				wp_redirect($location);
				exit();
			}

		}
	}
}
add_action( 'template_redirect', 'search_template_redirect' );

// Load CSS Framework scripts
if ( ! function_exists ( 'cwd_base_scripts_and_styles' ) ) {
	
	function cwd_base_scripts_and_styles() {
		
		if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
			
				// Scripts
			wp_enqueue_script('cwd-script', get_template_directory_uri() . '/js/cwd.js' );
			wp_enqueue_script('cwd-wp-script', get_template_directory_uri() . '/js/cwd_wp.js' );
			wp_enqueue_script('cwd-card-slider-js', get_template_directory_uri() . '/js/cwd_card_slider.js' );		
			wp_enqueue_script('formidable-validation-js', get_template_directory_uri() . '/js/formidable_validation.js' );		
			wp_enqueue_script('cwd-gallery-js', get_template_directory_uri() . '/js/cwd_gallery.js' );		
			wp_enqueue_script('cwd-popups-js', get_template_directory_uri() . '/js/cwd_popups.js' );		
			wp_enqueue_script('cwd-slider-js', get_template_directory_uri() . '/js/cwd_slider.js' );		
			wp_enqueue_script('cwd-utilities-js', get_template_directory_uri() . '/js/cwd_utilities.js' );		
			wp_enqueue_script('contrib-js-swipe', get_template_directory_uri() . '/js/contrib/jquery.detect_swipe.js' );		
			wp_enqueue_script('contrib-js-debounce', get_template_directory_uri() . '/js/contrib/modernizr.js' );		
			wp_enqueue_script('contrib-js-pep', get_template_directory_uri() . '/js/contrib/pep.js' );
			wp_enqueue_script('contrib-js-fitvids', get_template_directory_uri() . '/js/contrib/jquery.fitvids.js' );
			wp_enqueue_script('siteimprove-js', get_template_directory_uri() . '/js/siteimprove.js' );		
			//wp_enqueue_script('cwd-experimental-js', get_template_directory_uri() . '/js/cwd_experimental.js' );		
						
			// jQuery UI effects
			//wp_enqueue_script('jquery-effects-core'); 
			
		}
		
			// Styles
		wp_enqueue_style('base-css', get_template_directory_uri() . '/css/base.css');
		wp_enqueue_style('cornell-css', get_template_directory_uri() . '/css/cornell.css');
		wp_enqueue_style('cornell-css', get_template_directory_uri() . '/css/cornell_basic.css');
		wp_enqueue_style('cwd-card-slider-css', get_template_directory_uri() . '/css/cwd_card_slider.css');
		wp_enqueue_style('cwd-gallery-css', get_template_directory_uri() . '/css/cwd_gallery.css');
		wp_enqueue_style('pagination-css', get_template_directory_uri() . '/css/cwd_slider.css');
		wp_enqueue_style('cwd-utilities-css', get_template_directory_uri() . '/css/cwd_utilities.css');
		wp_enqueue_style('cwd-wp-css', get_template_directory_uri() . '/css/cwd_wp.css');
		wp_enqueue_style('formidable-validation-css', get_template_directory_uri() . '/css/formidable_validation.css');
		wp_enqueue_style('cornell-font-fa', get_template_directory_uri() . '/fonts/font-awesome.min.css');
		wp_enqueue_style('cornell-font-zmdi', get_template_directory_uri() . '/fonts/material-design-iconic-font.min.css');
		//wp_enqueue_style('cornell-font-service-logos', get_template_directory_uri() . '/fonts/service-logos.css');
		//wp_enqueue_style('cornell-font-custom', get_template_directory_uri() . '/fonts/cornell-custom.css');
		//wp_enqueue_style('cornell-font-totally-cornered', get_template_directory_uri() . '/fonts/totally-cornered.css');
		
	}
	add_action('wp_enqueue_scripts', 'cwd_base_scripts_and_styles');
	
}

// Append random version number for scripts and styles
if ( ! function_exists ( 'add_random_version_number' ) ) {
	function add_random_version_number ( $src, $handle ) {                                                           
		return add_query_arg( 'r', rand(), $src );                                                                 
	}
	add_filter( 'script_loader_src', 'add_random_version_number', 10, 2 );                                          
	add_filter( 'style_loader_src', 'add_random_version_number', 10, 2 );                                           
}

// Add admin assets
if ( ! function_exists ( 'admin_assets' ) ) {
	function admin_assets() {
		wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/css/admin.css' );
		wp_enqueue_script( 'admin-scripts', get_template_directory_uri() . '/js/admin.js');
	}
	add_action( 'admin_enqueue_scripts', 'admin_assets');
}

// Show/hide slider admin menu
if ( ! function_exists ( 'add_slider' ) ) {
	function add_slider() {

		if( !is_admin() ) {
			return;
		}

		global $post;

		$front_page_id = get_option('page_on_front');

		$add_slider = get_post_meta( $front_page_id, 'add_slider', true );

		if($add_slider == 'Yes') {
			echo '<style>#menu-posts-slider { display: block; }</style>';
		}
		else {
			echo '<style>#menu-posts-slider { display: none; }</style>';
		}
	}
	add_action('admin_head', 'add_slider');
}

// Remove auto p in excerpts
remove_filter ('the_excerpt', 'wpautop');

// Limit excerpt length
if ( ! function_exists( 'custom_excerpt' ) ) {
	function custom_excerpt($characters){
		
		$excerpt = get_the_content();
		
		if( has_excerpt(get_the_ID()) ) {
			$excerpt = the_excerpt();
		}
		if( get_post_type() == 'news' ) {
			$excerpt = get_field('info');
		}
		if( get_post_type() == 'events' ) {
			$excerpt = get_field('description');
		}
		
		$excerpt = preg_replace(" ([.*?])",'',$excerpt);
		$excerpt = strip_shortcodes($excerpt);
		$excerpt = strip_tags($excerpt);
		$excerpt = substr($excerpt, 0, $characters);
		$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
		$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
		$excerpt = $excerpt.'...';
		return $excerpt;
	}
}

if ( ! function_exists( 'cwd_base_get_tags' ) ) {
	
	function cwd_base_get_tags() { // WP Core
		
		$tags_icon = '<span class="sr-only">Tags</span><span class="fa fa-tags"></span>';
		$tags = wp_get_post_tags( get_the_ID() );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$metadata_options = $archive_options['metadata'];
		
		if($tags) {
			echo $before;
		}
		
		if($metadata_options 
		   && $tags
		   && in_array('labels', $metadata_options)) {
			   
				//echo $tags_icon;
				echo '<div class="field label">Tags: </div>';  // Choose icon or text label
		}
		
		if ($tags) {
			foreach($tags as $tag) {
				$tag_link = get_tag_link( $tag->term_id );
				echo '<div class="field"><a href="'.$tag_link.'"><span class="deco">'.ucwords($tag->name).'</span></a></div>';
			}
		}

		if($tags) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_categories' ) ) {
	
	function cwd_base_get_categories() { // WP Core

		$categories_icon = '<span class="sr-only">Categories</span><span class="fa fa-folder-open-o"></span>';
		$categories = wp_get_post_categories( get_the_ID() );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$metadata_options = $archive_options['metadata'];
		
		if($categories) {
			echo $before;
		}
		
		if($metadata_options 
		   && $categories
		   && in_array('labels', $metadata_options)) {
			   
				//echo $categories_icon; 
				echo '<div class="field label">Categories: </div>'; // Choose icon or text label
		}
		
		if ($categories) {
			foreach($categories as $category_ID) {
				$category      = get_term( $category_ID );
        		$category_name = $category->name;
				$category_link = get_category_link( $category_ID );
				if ( strtolower( $category_name ) != 'uncategorized' ) {
					echo '<div class="field"><a href="'.$category_link.'"><span class="deco">'.ucwords($category_name).'</span></a></div>';
				}
			}
		}

		if($categories) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_event_tags' ) ) {
	
	function cwd_base_get_event_tags() { // Event tags

		$event_tags_icon = '<span class="sr-only">Event tags</span><span class="fa fa-tags"></span>';
		$event_tags = wp_get_post_terms( get_the_ID(), 'event_tags' );
		$before = '<div id="event-tags">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$metadata_options = $archive_options['metadata'];
		
		if($event_tags) {
			echo $before;
		}
		
		if($metadata_options 
		   && $event_tags
		   && in_array('labels', $metadata_options)) {
			   
				//echo $event_tags_icon; 
				echo '<span class="label">Event Tags: </span>'; // Choose icon or text label
		}
		
		if ($event_tags) {
			
			$count = count($event_tags);
			$i = 1;
			
			foreach($event_tags as $event_tag_ID) {
				$event_tag      = get_term( $event_tag_ID );
        		$event_tag_name = $event_tag->name;
				$event_tag_link = get_category_link( $event_tag_ID );
				if ( strtolower( $event_tag_name ) != 'uncategorized' ) {
					echo '<span class="field event-tag"><a href="'.$event_tag_link.'">'.ucwords($event_tag_name).'</a></span>';
				}
				
				if($i < $count) { 
					echo ', ';
				} 

				$i++;				
			}
		}

		if($event_tags) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_event_types' ) ) {
	
	function cwd_base_get_event_types() { // Event types

		$event_types_icon = '<span class="sr-only">Event types</span><span class="fa fa-folder-open-o"></span>';
		$event_types = wp_get_post_terms( get_the_ID(), 'event_types' );
		$before = '<div id="event-types">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$metadata_options = $archive_options['metadata'];
		
		if($event_types) {
			echo $before;
		}
		
		if($metadata_options 
		   && $event_types
		   && in_array('labels', $metadata_options)) {
			   
				//echo $event_types_icon; 
				echo '<span class="label">Event Type: </span>'; // Choose icon or text label (not sure what icon to use here)
		}
		
		if ($event_types) {
			foreach($event_types as $event_type_ID) {
				$event_type      = get_term( $event_type_ID );
        		$event_type_name = $event_type->name;
				$event_type_link = get_category_link( $event_type_ID );
				if ( strtolower( $event_type_name ) != 'uncategorized' ) {
					echo '<span class="field"><a href="'.$event_type_link.'">'.ucwords($event_type_name).'</a></span>';
				}
			}
		}

		if($event_types) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_event_groups' ) ) {
	
	function cwd_base_get_event_groups() { // Event groups

		$event_groups_icon = '<span class="sr-only">Event groups</span><span class="fa fa-folder-open-o"></span>';
		$event_groups = wp_get_post_terms( get_the_ID(), 'event_groups' );
		$before = '<div id="event-groups">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$metadata_options = $archive_options['metadata'];
		
		if($event_groups) {
			echo $before;
		}
		
		if($metadata_options 
		   && $event_groups
		   && in_array('labels', $metadata_options)) {
			   
				//echo $event_groups_icon;
				echo '<span class="label">Event Group: </span>'; // Choose icon or text label (not sure what icon to use here)
		}
		
		if ($event_groups) {
			
			$count = count($event_groups);
			$i = 1;
			
			foreach($event_groups as $event_group_ID) {
				$event_group      = get_term( $event_group_ID );
        		$event_group_name = $event_group->name;
				$event_group_link = get_category_link( $event_group_ID );
				if ( strtolower( $event_group_name ) != 'uncategorized' ) {
					echo '<span class="field"><a href="'.$event_group_link.'">'.ucwords($event_group_name).'</a></span>';
				}
				
				if($i < $count) { 
					echo ', ';
				} 

				$i++;				
			}
		}

		if($event_groups) {
			echo $after;
		}
		
	}
}

// Target parent pages and their children
if ( ! function_exists ( 'is_tree' ) ) {
	function is_tree($pid) {  // $pid = parent id
		global $post;         
		if(is_page()&&($post->post_parent==$pid||is_page($pid))) 
			return true;
		else 
			return false;
	}
}

//Modify TinyMCE editor to hide h1 heading
if ( ! function_exists ( 'tiny_mce_remove_unused_formats' ) ) {
	function tiny_mce_remove_unused_formats( $initFormats ) {
		// Add block format elements you want to show in dropdown
		$initFormats['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';
		return $initFormats;
	}
	add_filter( 'tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );
}

// Disable Quick Press widget on dashboard
if ( ! function_exists ( 'remove_dashboard_widgets' ) ) {
	function remove_dashboard_widgets() {
		global $wp_meta_boxes;
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	}
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
}

// Add a meta box to remove header image -- next three functions.
if ( ! function_exists ( 'remove_this_header_add_meta_box' ) ) {
	function remove_this_header_add_meta_box() {

		// So, 'any' or 'all' doesn't seem to work. Hmmm...
		$screens = array( 'post', 'page', 'news', 'events', 'people', 'projects', 'resources', 'galleries', 'testimonials' );

		foreach ( $screens as $screen ) {

			add_meta_box(
				'remove_this_header_sectionid',
				'Remove header image?',
				'remove_this_header_meta_box_callback',
				$screen, 'side', 'core'
			);
		}
	}
	add_action( 'add_meta_boxes', 'remove_this_header_add_meta_box' );
}

// Print the box content
if ( ! function_exists ( 'remove_this_header_meta_box_callback' ) ) {
	
	function remove_this_header_meta_box_callback( $post ) {

		// Add a nonce field so we can check for it later
		wp_nonce_field( 'remove_this_header_meta_box', 'remove_this_header_meta_box_nonce' );
		$remove_this_header_post_meta = get_post_meta( get_the_ID() ); ?>

		<p>			  
			<div class="layout-row-content">
				<p style="margin: .6em 0;">
					<label for="remove_this_header1id">
						<input type="radio" name="remove_this_header" id="remove_this_header1id" value="Yes" <?php if ( isset ( $remove_this_header_post_meta['remove_this_header'] ) ) checked( $remove_this_header_post_meta['remove_this_header'][0], 'Yes' ); ?>>
						<?php _e( 'Yes', 'cwd_base' )?><br />
					</label>
					<label for="remove_this_header2id">
						<input type="radio" name="remove_this_header" id="remove_this_header2id" value="No" <?php if ( !isset ( $remove_this_header_post_meta['remove_this_header'] ) ) echo 'checked="checked"'; ?><?php if ( isset ( $remove_this_header_post_meta['remove_this_header'] ) ) checked( $remove_this_header_post_meta['remove_this_header'][0], 'No' ); ?>>
						<?php _e( 'No', 'cwd_base' )?>
					</label>
				</p>
			</div> 
		</p>

	<?php

	}
}

// When the post is saved, saves our custom data
if ( ! function_exists ( 'remove_this_header_save_meta_box_data' ) ) {
	function remove_this_header_save_meta_box_data( $post_id ) {

		// Checks for input and saves if needed
		if( isset( $_POST[ 'remove_this_header' ] ) ) {
			update_post_meta( $post_id, 'remove_this_header', $_POST[ 'remove_this_header' ] );
		}

	}
	add_action( 'save_post', 'remove_this_header_save_meta_box_data' );
}

// Add a meta box to replace header image with slider -- next 3 functions
if ( ! function_exists ( 'add_slider_add_meta_box' ) ) {
	
	function add_slider_add_meta_box() {

		global $post;

		if( $post->ID == get_option( 'page_on_front' ) ) {

			$screens = array( 'post', 'page' );

			foreach ( $screens as $screen ) {

				add_meta_box(
					'add_slider_sectionid',
					__( 'Replace header image on the home page with a slider?', 'cwd_base_textdomain' ),
					'add_slider_meta_box_callback',
					$screen, 'side', 'core'
				);
			}
		}

	}
	add_action( 'add_meta_boxes', 'add_slider_add_meta_box' );
}

// Print the box content
if ( ! function_exists ( 'add_slider_meta_box_callback' ) ) {
	
	function add_slider_meta_box_callback( $post ) {

		global $post;

		if( $post->ID == get_option( 'page_on_front' ) ) {

			wp_nonce_field( 'add_slider_meta_box', 'add_slider_meta_box_nonce' );
			$add_slider_post_meta = get_post_meta( get_the_ID() ); ?>

			<p><?php echo 'Use the slider menu on the left to add slides or click '; ?><a href="<?php echo admin_url('edit.php?post_type=slider'); ?>">here</a>.</p>

			<p>			  
				<div class="layout-row-content">
					<p style="margin: .6em 0;">
						<label for="add_slider1id">
							<input type="radio" name="add_slider" id="add_slider1id" value="Yes" <?php if ( isset ( $add_slider_post_meta['add_slider'] ) ) checked( $add_slider_post_meta['add_slider'][0], 'Yes' ); ?>>
							<?php _e( 'Yes', 'cwd_base' )?><br />
						</label>
						<label for="add_slider2id">
							<input type="radio" name="add_slider" id="add_slider2id" value="No" <?php if ( !isset ( $add_slider_post_meta['add_slider'] ) ) echo 'checked="checked"'; ?><?php if ( isset ( $add_slider_post_meta['add_slider'] ) ) checked( $add_slider_post_meta['add_slider'][0], 'No' ); ?>>
							<?php _e( 'No', 'cwd_base' )?>
						</label>
					</p>
				</div> 
			</p>

	<?php } 
		
	}
}

// When the post is saved, saves our custom data
if ( ! function_exists ( 'add_slider_save_meta_box_data' ) ) {
	
	function add_slider_save_meta_box_data( $post_id ) {

		global $post;

		//if( $post->ID == get_option( 'page_on_front' ) ) {

			if( isset( $_POST[ 'add_slider' ] ) ) {
				update_post_meta( $post_id, 'add_slider', $_POST[ 'add_slider' ] );
			}
		//}

	}
	add_action( 'save_post', 'add_slider_save_meta_box_data' );
}

// Remove custom post type from post_class()
if ( ! function_exists ( 'cwd_remove_postclass' ) ) {
	function cwd_remove_postclass($classes, $class, $post_id) {
		$classes = array_diff( $classes, array(
			get_post_type($post_id),
		) );
		return $classes;
	}
	add_filter('post_class', 'cwd_remove_postclass', 10, 3);
}

// Include all post types in all archives
//if ( ! function_exists ( 'cwd_base_cpt_archives' ) ) {
	//function cwd_base_cpt_archives( $query ) {
		//if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
			//$query->set( 'post_type', 'any' );
		//}
	//}
	//add_action( 'pre_get_posts', 'cwd_base_cpt_archives' );
//}

// Filter the permalink for custom URLs (Page links to...)
if ( ! function_exists ( 'cwd_base_filter_permalink' ) ) {
	function cwd_base_filter_permalink( $url, $post ) {

		$page_links_to = get_field( 'page_links_to', $post->ID );

		if ( $page_links_to['point_this_content_to'] == 'custom' ) {

			$url = $page_links_to['custom_url'];

			return $url;

		}
		else {
			return $url;
		}
	}
	add_filter( 'post_type_link', 'cwd_base_filter_permalink', 10, 2 );
}

// Change Featured image text
if ( ! function_exists ( 'cwd_base_featured_image_html' ) ) {
	function cwd_base_featured_image_html( $content ) {
		return $content = str_replace( __( 'Set featured image' ), __( 'Set the header image' ), $content); 
	}
	add_filter( 'admin_post_thumbnail_html', 'cwd_base_featured_image_html' );
}
	
// Make tags interface look like category checkboxes (next three functions)
if ( ! function_exists ( 'cwd_base_post_tags_meta_box_remove' ) ) {
	function cwd_base_post_tags_meta_box_remove() {
		$id = 'tagsdiv-post_tag';
		$post_type = array('post', 'page', 'news', 'events', 'people');
		$position = 'side';
		remove_meta_box( $id, $post_type, $position );
	}
	add_action( 'admin_menu', 'cwd_base_post_tags_meta_box_remove');
}

		// Add meta box
if ( ! function_exists ( 'cwd_base_add_new_tags_metabox' ) ) {
	function cwd_base_add_new_tags_metabox(){
		$id = 'cwd_base_tagsdiv-post_tag'; // it should be unique
		$heading = 'Tags'; // meta box heading
		$callback = 'cwd_base_metabox_content'; // the name of the callback function
		$post_type = array('post', 'page', 'news', 'events', 'people');
		$position = 'side';
		$pri = 'default'; // priority, 'default' is good for us
		add_meta_box( $id, $heading, $callback, $post_type, $position, $pri );
	}
	add_action( 'admin_menu', 'cwd_base_add_new_tags_metabox');
}

		// Fill
if ( ! function_exists ( 'cwd_base_metabox_content' ) ) {
	function cwd_base_metabox_content($post) {  

		// get all blog post tags as an array of objects
		$all_tags = get_terms( array('taxonomy' => 'post_tag', 'hide_empty' => 0) ); 

		// get all tags assigned to a post
		$all_tags_of_post = get_the_terms( $post->ID, 'post_tag' );  

		// create an array of post tags ids
		$ids = array();
		if ( $all_tags_of_post ) {
			foreach ($all_tags_of_post as $tag ) {
				$ids[] = $tag->term_id;
			}
		}

		// HTML
		echo '<div id="taxonomy-post_tag" class="categorydiv">';
		echo '<input type="hidden" name="tax_input[post_tag][]" value="0" />';
		echo '<ul>';
		foreach( $all_tags as $tag ){
			// unchecked by default
			$checked = "";
			// if an ID of a tag in the loop is in the array of assigned post tags - then check the checkbox
			if ( in_array( $tag->term_id, $ids ) ) {
				$checked = " checked='checked'";
			}
			$id = 'post_tag-' . $tag->term_id;
			echo "<li id='{$id}'>";
			echo "<label><input type='checkbox' name='tax_input[post_tag][]' id='in-$id'". $checked ." value='$tag->slug' /> $tag->name</label><br />";
			echo "</li>";
		}
		echo '</ul></div>'; // end HTML
	}
}