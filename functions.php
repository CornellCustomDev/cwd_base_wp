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
	'/functions/theme/metadata.php',
	'/functions/theme/dates.php',
	'/functions/theme/images.php',
	'/functions/theme/header-img.php',
	'/functions/theme/options.php',
	'/functions/plugins/og-tags/og-tags.php',
	'/functions/plugins/widget-context/widget-context.php',
	'/functions/plugins/simple-widget-title-links/simple-widget-title-links.php',
	'/functions/navigation/menus.php',
	'/functions/navigation/breadcrumbs.php',
	'/functions/navigation/menu-classes.php',
	'/functions/navigation/section-nav/section-nav.php',
	'/functions/customizer/device-previews.php',
	'/functions/customizer/customize-register.php',
	'/functions/theme/custom-fields/featured.php',
	'/functions/theme/custom-fields/image_id.php',
	'/functions/theme/custom-fields/page_links_to.php',
	'/functions/tinymce/editor.php',
	'/functions/post-types/slider/slider.php',
);

// Check if include file exists
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

// Use this to inject code directly after the opening body tag
if ( ! function_exists ( 'cwd_base_after_body_tag' ) ) {
	function cwd_base_after_body_tag() {
		 // Do stuff
	}
	add_action( 'wp_body_open', 'cwd_base_after_body_tag' );
}

// Enable the use of shortcodes in text widgets.
add_filter( 'widget_text', 'do_shortcode' );

// Add slider.php
if ( ! function_exists ( 'call_slider_function' ) ) {
	function call_slider_function() {
		$add_slider = get_post_meta( get_the_ID(), 'add_slider', true );
		if(is_front_page() && $add_slider == 'Yes') {
			require_once get_theme_file_path('/functions/post-types/slider/slider.php');
		}
	}
}
add_action( 'wp', 'call_slider_function' );

// Enqueue admin assets
if ( ! function_exists ( 'cwd_base_admin_assets' ) ) {
	function cwd_base_admin_assets() {
		wp_enqueue_style( 'admin-styles', get_stylesheet_directory_uri() . '/css/admin.css' );
		wp_enqueue_script( 'admin-scripts', get_stylesheet_directory_uri() . '/js/admin.js');
	}
	add_action( 'admin_enqueue_scripts', 'cwd_base_admin_assets');
	add_action( 'acf/input/admin_enqueue_scripts', 'cwd_base_admin_assets');
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
			wp_enqueue_script('cwd-script-js', get_template_directory_uri() . '/js/cwd.js' );
			wp_enqueue_script('cwd-wp-script-js', get_template_directory_uri() . '/js/cwd_wp.js' );
			wp_enqueue_script('cwd-card-slider-js', get_template_directory_uri() . '/js/cwd_card_slider.js' );		
			wp_enqueue_script('cwd-formidable-validation-js', get_template_directory_uri() . '/js/formidable_validation.js' );		
			wp_enqueue_script('cwd-gallery-js', get_template_directory_uri() . '/js/cwd_gallery.js' );		
			wp_enqueue_script('cwd-popups-js', get_template_directory_uri() . '/js/cwd_popups.js' );		
			wp_enqueue_script('cwd-slider-js', get_template_directory_uri() . '/js/cwd_slider.js' );		
			wp_enqueue_script('cwd-utilities-js', get_template_directory_uri() . '/js/cwd_utilities.js' );		
			wp_enqueue_script('cwd-twitter-widget-js', get_template_directory_uri() . '/js/twitter-widget.js' );		
			wp_enqueue_script('contrib-js-swipe-js', get_template_directory_uri() . '/js/contrib/jquery.detect_swipe.js' );		
			wp_enqueue_script('contrib-js-debounce-js', get_template_directory_uri() . '/js/contrib/modernizr.js' );		
			wp_enqueue_script('contrib-js-pep-js', get_template_directory_uri() . '/js/contrib/pep.js' );
			wp_enqueue_script('contrib-js-fitvids-js', get_template_directory_uri() . '/js/contrib/jquery.fitvids.js' );
			wp_enqueue_script('cwd-siteimprove-js', get_template_directory_uri() . '/js/siteimprove.js' );		
			wp_enqueue_script('cwd-experimental-js', get_template_directory_uri() . '/js/cwd_experimental.js', array('jquery'),'',true );		
						
			// jQuery UI effects
			wp_enqueue_script('jquery-effects-core'); 
			
		}
		
			// Styles
		if(get_theme_mod('freight') == true) {
			wp_enqueue_style('freight-css', 'https://use.typekit.net/nwp2wku.css'); // Freight Text and Sans
		}
		wp_enqueue_style('cwd-base-css', get_template_directory_uri() . '/css/base.css');
		wp_enqueue_style('cornell-css', get_template_directory_uri() . '/css/cornell.css');
		wp_enqueue_style('cwd-card-slider-css', get_template_directory_uri() . '/css/cwd_card_slider.css');
		wp_enqueue_style('cwd-gallery-css', get_template_directory_uri() . '/css/cwd_gallery.css');
		wp_enqueue_style('cwd-pagination-css', get_template_directory_uri() . '/css/cwd_slider.css');
		wp_enqueue_style('cwd-utilities-css', get_template_directory_uri() . '/css/cwd_utilities.css');
		wp_enqueue_style('cwd-wp-css', get_template_directory_uri() . '/css/cwd_wp.css');
		wp_enqueue_style('cwd-twitter-widget-css', get_template_directory_uri() . '/css/twitter-widget.css');
		wp_enqueue_style('cwd-formidable-validation-css', get_template_directory_uri() . '/css/formidable_validation.css');
		wp_enqueue_style('cornell-font-fa-css', get_template_directory_uri() . '/fonts/font-awesome.min.css');
		wp_enqueue_style('cornell-font-zmdi-css', get_template_directory_uri() . '/fonts/material-design-iconic-font.min.css');
		//wp_enqueue_style('cornell-font-service-logos', get_template_directory_uri() . '/fonts/service-logos.css');
		//wp_enqueue_style('cornell-font-custom', get_template_directory_uri() . '/fonts/cornell-custom.css');
		//wp_enqueue_style('cornell-font-totally-cornered', get_template_directory_uri() . '/fonts/totally-cornered.css');
		wp_enqueue_script('jquery-effects-core');
		
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
		
		if($characters == '') {
			$characters = 0;
		}
		
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
		if($excerpt) {
			$excerpt = $excerpt . '...';
		}
		else {
			$excerpt = $excerpt;
		}
		return $excerpt;
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
		$screens = array( 'post', 'page', 'news', 'events', 'people', 'projects', 'courses', 'galleries', 'testimonials' );

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
if ( ! function_exists ( 'cwd_base_cpt_archives' ) ) {
	function cwd_base_cpt_archives( $query ) {
		if ( $query->is_tag() || is_category() && $query->is_main_query() && !is_admin() ) {
			$query->set( 'post_type', array('post', 'page', 'news', 'events', 'people', 'courses', 'testimonials', 'galleries') );
		}
	}
	add_action( 'pre_get_posts', 'cwd_base_cpt_archives' );
}

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
//if ( ! function_exists ( 'cwd_base_post_tags_meta_box_remove' ) ) {
	//function cwd_base_post_tags_meta_box_remove() {
		//$id = 'tagsdiv-post_tag';
		//$post_type = array('post', 'page', 'news', 'people');
		//$position = 'side';
		//remove_meta_box( $id, $post_type, $position );
	//}
	//add_action( 'admin_menu', 'cwd_base_post_tags_meta_box_remove');
//}

		// Add meta box
//if ( ! function_exists ( 'cwd_base_add_new_tags_metabox' ) ) {
	//function cwd_base_add_new_tags_metabox(){
		//$id = 'cwd_base_tagsdiv-post_tag'; // it should be unique
		//$heading = 'Tags'; // meta box heading
		//$callback = 'cwd_base_metabox_content'; // the name of the callback function
		//$post_type = array('post', 'page', 'news', 'people');
		//$position = 'side';
		//$pri = 'default'; // priority, 'default' is good for us
		//add_meta_box( $id, $heading, $callback, $post_type, $position, $pri );
	//}
	//add_action( 'admin_menu', 'cwd_base_add_new_tags_metabox');
//}

		// Fill
//if ( ! function_exists ( 'cwd_base_metabox_content' ) ) {
	//function cwd_base_metabox_content($post) {  

		// get all blog post tags as an array of objects
		//$all_tags = get_terms( array('taxonomy' => 'post_tag', 'hide_empty' => 0) ); 

		// get all tags assigned to a post
		//$all_tags_of_post = get_the_terms( $post->ID, 'post_tag' );  

		// create an array of post tags ids
		//$ids = array();
		//if ( $all_tags_of_post ) {
			//foreach ($all_tags_of_post as $tag ) {
				//$ids[] = $tag->term_id;
			//}
		//}

		// HTML
		//echo '<div id="taxonomy-post_tag" class="categorydiv">';
		//echo '<input type="hidden" name="tax_input[post_tag][]" value="0" />';
		//echo '<ul>';
		//foreach( $all_tags as $tag ){
			// unchecked by default
			//$checked = "";
			// if an ID of a tag in the loop is in the array of assigned post tags - then check the checkbox
			//if ( in_array( $tag->term_id, $ids ) ) {
				//$checked = " checked='checked'";
			//}
			//$id = 'post_tag-' . $tag->term_id;
			//echo "<li id='{$id}'>";
			//echo "<label><input type='checkbox' name='tax_input[post_tag][]' id='in-$id'". $checked ." value='$tag->slug' /> $tag->name</label><br />";
			//echo "</li>";
		//}
		//echo '</ul></div>'; // end HTML
	//}
//}

// Remove title field from news 
add_action( 'init', function() {
    remove_post_type_support( 'news', 'title' );
}, 99);

// Modify news sort order
function cwd_base_news_query( $query ) {
 
	$post_type = get_query_var('post_type');   

    if( $query->is_main_query() && $post_type == 'news' ) {
        $query->set( 'meta_key', 'publication_date' );
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'order', 'DESC' );
    }
}
add_action( 'pre_get_posts', 'cwd_base_news_query' );

// Modify events sort order
function cwd_base_events_query( $query ) {
 
	$post_type = get_query_var('post_type');   

    if( $query->is_main_query() && $post_type == 'events' ) { // && ! is_admin() 
        $query->set( 'meta_key', 'date' );
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'order', 'DESC' );
    }
}
add_action( 'pre_get_posts', 'cwd_base_events_query' );

// Change admin menu sort order
function cwd_base_custom_menu_order() {
    return array( 'index.php', 'upload.php', 'edit.php', 'edit.php?post_type=page', 'edit.php?post_type=news', 'edit.php?post_type=events', 'edit.php?post_type=people', 'edit.php?post_type=testimonials', 'edit.php?post_type=courses', 'edit.php?post_type=galleries', 'themes.php', 'admin.php?page=theme-options', 'users.php', 'edit-comments.php', 'plugins.php', 'tools.php', 'options-general.php' );
}
add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', 'cwd_base_custom_menu_order' );

// Testimonial template for the WYSIWYG
function cwd_base_default_content( $content, $post ) {
 
    switch( $post->post_type ) {
        case 'testimonials':
            $content = '<div class="testimonial">This is the default testimonial style. Simply replace this text with your own. To remove this styling, highlight the text and click on the <em>Clear formatting</em> button in the toolbar. Click undo to go back.</div>';
        break;
        default:
            $content = '';
        break;
    }
    return $content;
}
add_filter( 'default_content', 'cwd_base_default_content', 10, 2 );


if (isset($_GET['debugsidebar'])) {
	add_action('init', 'debug_sidebar');
}  

function debug_sidebar() {

    $id = $_GET['debugsidebar'];
    $sidebarswidgets = get_option('sidebars_widgets');

    if (is_active_sidebar($id)) {
		$status = " Active";
	} 
	else {
		$status = "Inactive";
	}
	
    echo "Sidebar ID: ".$id." (".$status.")<br>";
	
    if (array_key_exists($id, $sidebarswidgets)) {
		
        $found = "Sidebar Found";
		
        if (is_array($sidebarswidgets[$id])) {
            $widgets = count($sidebarswidgets[$id])." Widgets Found";
        } 
		else {
			$widgets = "Widget Array not Found!";
		}
		
        echo $found."<br".$widgets."<br>";
		
	}
	else {
		echo "Sidebar Not Found<br>";
	}

    echo "<br>All Sidebars Widgets: ".print_r($sidebarswidgets,true)."<br>"; 
		
    exit;
}

// Process dates for news and events
function cwd_base_date_processing() {

	$post_type = get_post_type();   

	if($post_type == 'events') {

		// Custom events query to manipulate date fields
		$events_args = array( 
			'post_type' => 'events',
			'posts_per_page' => -1,
		);	

		$events_query = new WP_Query($events_args);	

		// Get all events
		$events_query = $events_query->get_posts();	

		foreach($events_query as $event) {

			// Get the dates
			$date = get_field( 'date', $event->ID );

			// Convert them
			$new_date = date( 'Ymd', strtotime( $date ) );

			// Update them in the database
			update_field('date', $new_date, $event->ID);

		}

		wp_reset_query(); // Nothing to see here. Move along.
	}
	
	if($post_type == 'news') {

		// Custom news query to manipulate date fields
		$news_args = array( 
			'post_type' => 'news',
			'posts_per_page' => -1,
		);	

		$news_query = new WP_Query($news_args);	

		// Get all news
		$news_query = $news_query->get_posts();	

		foreach($news_query as $news) {

			// Get the dates
			$date = get_field( 'publication_date', $news->ID );

			// Convert them
			$new_date = date( 'Ymd', strtotime( $date ) );

			// Update them in the database
			update_field('publication_date', $new_date, $news->ID);

		}

		wp_reset_query(); // Nothing to see here. Move along.
	}
}
//add_action( 'pre_get_posts', 'cwd_base_date_processing' );

// Remove items from the admin menu
function cwd_base_remove_menu_items(){
	remove_submenu_page( 'options-general.php', 'options-media.php' ); // Media
	remove_submenu_page( 'options-general.php', 'og-tags-options' ); // OG tags
	remove_submenu_page( 'themes.php', 'widget_context_settings' ); // Widget context settings
	remove_submenu_page( 'themes.php', 'pagination.php' ); // Pagination settings
	remove_action('admin_menu', '_add_themes_utility_last', 101); // Disallow file edit
}
add_action( 'admin_menu', 'cwd_base_remove_menu_items' );

if( class_exists('Acf') ) {
	require_once get_template_directory() . '/functions/post-types/init.php';
}

// Prevent WP using 'Auto Draft' as the post title (wtf?)
function filter_the_title($title, $id) {
	
	$post_type = get_post_type($id);
	
	if($post_type == 'news' && $title == 'Auto Draft') {
		$title = get_field('title', $id);
	}
	return $title;
}
add_filter( 'the_title', 'filter_the_title', 10, 2 );