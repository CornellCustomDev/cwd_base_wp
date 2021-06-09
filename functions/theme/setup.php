<?php 

// Theme setup
if ( ! function_exists ( 'cwd_base_setup' ) ) {
	
	function cwd_base_setup() {
		
		// Add theme support for needed features
		add_theme_support('post-thumbnails');
		
		add_theme_support( 'title-tag' );
		
		add_theme_support('custom-header', array(
			'width'         => 1280,
			'height'        => 320,
			'default-image' => get_template_directory_uri() . '/images/wp/headers/campus.jpg',
		));
		
		register_default_headers( array(
			'default-image' => array(
				'url'           => get_stylesheet_directory_uri() . '/images/wp/headers/campus.jpg',
				'thumbnail_url' => get_stylesheet_directory_uri() . '/images/wp/headers/campus_thumb.jpg',
				'description'   => __( 'Default Header Image', 'textdomain' )
			),
		) );
		
		add_theme_support('custom-background', array(
			'default-color'          => '',
			'default-image'          => '',
			'default-repeat'         => 'repeat',
			'default-position-x'     => 'left',
			'default-position-y'     => 'top',
			'default-size'           => 'cover',
			'default-attachment'     => 'scroll',
		));
		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
		add_theme_support( 'title-tag' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		// Add image sizes
		add_image_size('thumbnail', 250, 250, true); // Medium Thumbnail
		add_image_size('medium', 480, 480, true); // Small Thumbnail
		add_image_size('large', 800, 800, true); // Large Thumbnail
		add_image_size('header-image', 1280, 360, true); // Slider image
		add_image_size('slider-image', 1280, 560, true); // Slider image
		
		// Register menus
		register_nav_menus(array(
			'header-menu'   => __('Header Menu', 'cwd_base'), // Main Navigation
			'top-menu'      => __('Top Menu', 'cwd_base'), // Top Navigation
			'footer-menu-1' => __('Footer Menu 1', 'cwd_base'), // Footer Quick Links (left column)
			'footer-menu-2' => __('Footer Menu 2', 'cwd_base'), // Footer Quick Links (right column)
		));

		// Check to see if default theme settings have been applied yet
		$the_theme_status = get_option( 'theme_setup_status' );
		
		// Use this to toggle setup status on/off when testing theme activation
		  //update_option( 'theme_setup_status', '1' );

		// If the theme has not yet been used we want to run our default settings, create sample pages and menus, and assign menu locations.
		if ( $the_theme_status !== '1' ) {

			// Setup Default WordPress settings
			$core_settings = array(
				'default_ping_status'		=> 0,
				'default_pingback_flag'		=> 0,
				'show_avatars'				=> 0,
				'require_name_email'		=> 0,
				'default_comment_status'	=> 1,
				'page_comments'				=> 1,
				'posts_per_page'            => 12,
				'default_comments_page'		=> 'first',
				'date_format'				=> 'F j, Y'
			);

			// Setup Default theme settings
			$theme_mods = array(
				'facebook'	=> 'facebook.com',                                                  
				'twitter'	=> 'twitter.com',                                                  
				'youtube'	=> 'youtube.com',
				'logo_size'	=> 'small',
				'heading_one'	=> 'Heading One',
				'heading_two'	=> 'Heading Two',
				'heading_three'	=> 'Heading Three',
				'center_headings'	=> 'yes',
				'center_text'	=> 'yes'
			);

			foreach ( $core_settings as $k => $v ) {
					update_option( $k, $v );
			}
			foreach ( $theme_mods as $key => $value ) {
					set_theme_mod( $key, $value );
			}
		
			// Create home page
			$home_page_title = 'Home';
			$home_page_content = 'This text is the standard body field for a basic page that has been <a href="' . $baseUrl . 'wp-admin/options-reading.php">designated as the homepage</a>. This content can be edited like any other basic page, though other features on the homepage are typically supplied dynamically by widgets and custom templates. The three colored bands below the content and above the footer can be added and removed on the <a href="' . $baseUrl . 'wp-admin/widgets.php">widgets page</a>.';
			$home_page_template = '';

			$home_page_check = get_page_by_title($home_page_title);
			$home_page = array(
					'post_type' => 'page',
					'post_title' => $home_page_title,
					'post_content' => $home_page_content,
					'post_status' => 'publish',
					'post_author' => 1,
			);
			if(!isset($home_page_check->ID)){
				$home_page_id = wp_insert_post($home_page);
				if(!empty($home_page_template)){
					update_post_meta($home_page_id, '_wp_page_template', $home_page_template);
				}
			}

			// Create sample page 1
			$sample_page_1_title = 'Sample Page 1';
			$sample_page_1_content = '';
			$sample_page_1_template = '';

			$sample_page_1_check = get_page_by_title($sample_page_1_title);
			$sample_page_1_ = array(
					'post_type' => 'page',
					'post_title' => $sample_page_1_title,
					'post_content' => $sample_page_1_content,
					'post_status' => 'publish',
					'post_author' => 1,
			);
			if(!isset($sample_page_1_check->ID)){
				$sample_page_1_id = wp_insert_post($sample_page_1_);
				if(!empty($sample_page_1_template)){
					update_post_meta($sample_page_1_id, '_wp_page_template', $sample_page_1_template);
				}
			}

			// Create sample page 2
			$sample_page_2_title = 'Sample Page 2';
			$sample_page_2_content = '';
			$sample_page_2_template = '';

			$sample_page_2_check = get_page_by_title($sample_page_2_title);
			$sample_page_2_ = array(
					'post_type' => 'page',
					'post_title' => $sample_page_2_title,
					'post_content' => $sample_page_2_content,
					'post_status' => 'publish',
					'post_author' => 1,
			);
			if(!isset($sample_page_2_check->ID)){
				$sample_page_2_id = wp_insert_post($sample_page_2_);
				if(!empty($sample_page_2_template)){
					update_post_meta($sample_page_2_id, '_wp_page_template', $sample_page_2_template);
				}
			}

			// Create sample page 3
			$sample_page_3_title = 'Sample Page 3';
			$sample_page_3_content = '';
			$sample_page_3_template = '';

			$sample_page_3_check = get_page_by_title($sample_page_3_title);
			$sample_page_3_ = array(
					'post_type' => 'page',
					'post_title' => $sample_page_3_title,
					'post_content' => $sample_page_3_content,
					'post_status' => 'publish',
					'post_author' => 1,
			);
			if(!isset($sample_page_3_check->ID)){
				$sample_page_3_id = wp_insert_post($sample_page_3_);
				if(!empty($sample_page_3_template)){
					update_post_meta($sample_page_3_id, '_wp_page_template', $sample_page_3_template);
				}
			}

			//////////////////////////////////// MAIN MENU //////////////////////////////////////////
			$menu_name = 'Header Menu';

			// Check if it exists
			$menu_exists = wp_get_nav_menu_object( $menu_name );

			if(!$menu_exists) {

				// Create it, if it doesn't exist
				$menu_id = wp_create_nav_menu($menu_name);

				// Add pages
				$homePage = wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-object-id' => get_page_by_path('home')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $home_page_title,
					'menu-item-status' => 'publish',
				));
				$samplePage = wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-object-id' => get_page_by_path('sample-page-1')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $sample_page_1_title,
					'menu-item-status' => 'publish',
				));

			}

			// Set main menu location
			$locations = get_theme_mod('nav_menu_locations');
			$locations['header-menu'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );


			//////////////////////////////////// TOP MENU //////////////////////////////////////////
			$top_menu_name = 'Top Menu';

			// Check if it exists
			$top_menu_exists = wp_get_nav_menu_object( $top_menu_name );

			if(!$top_menu_exists) {

				// Create it, if it doesn't exist
				$top_menu_id = wp_create_nav_menu($top_menu_name);

				// Add pages
				$samplePage1 = wp_update_nav_menu_item($top_menu_id, 0, array(
					'menu-item-object-id' => get_page_by_path('sample-page-1')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $sample_page_1_title,
					'menu-item-status' => 'publish',
				));
				$samplePage2 = wp_update_nav_menu_item($top_menu_id, 0, array(
					'menu-item-object-id' => get_page_by_path('sample-page-2')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $sample_page_2_title,
					'menu-item-status' => 'publish',
				));
				$samplePage3 = wp_update_nav_menu_item($top_menu_id, 0, array(
					'menu-item-object-id' => get_page_by_path('sample-page-3')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $sample_page_3_title,
					'menu-item-status' => 'publish',
				));

			}

			// Set top menu location
			$location = get_theme_mod('nav_menu_locations');
			$location['top-menu'] = $top_menu_id;
			set_theme_mod( 'nav_menu_locations', $location );
			

			//////////////////////////////////// FOOTER MENU 1 //////////////////////////////////////////
			$footer_menu_1_name = 'Quick Links 1';

			// Check if it exists
			$footer_menu_1_exists = wp_get_nav_menu_object( $footer_menu_1_name );

			if(!$footer_menu_1_exists) {

				// Create it, if it doesn't exist
				$footer_menu_1_id = wp_create_nav_menu($footer_menu_1_name);

				// Add pages
				$samplePage1 = wp_update_nav_menu_item($footer_menu_1_id, 0, array(
					'menu-item-object-id' => get_page_by_path('sample-page-1')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $sample_page_1_title,
					'menu-item-status' => 'publish',
				));
				$samplePage2 = wp_update_nav_menu_item($footer_menu_1_id, 0, array(
					'menu-item-object-id' => get_page_by_path('sample-page-2')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $sample_page_2_title,
					'menu-item-status' => 'publish',
				));
				$samplePage3 = wp_update_nav_menu_item($footer_menu_1_id, 0, array(
					'menu-item-object-id' => get_page_by_path('sample-page-3')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $sample_page_3_title,
					'menu-item-status' => 'publish',
				));

			}

			// Set footer menu 1 location
			$location = get_theme_mod('nav_menu_locations');
			$location['footer-menu-1'] = $footer_menu_1_id;
			set_theme_mod( 'nav_menu_locations', $location );
			

			//////////////////////////////////// FOOTER MENU 2 //////////////////////////////////////////
			$footer_menu_2_name = 'Quick Links 2';

			// Check if it exists
			$footer_menu_2_exists = wp_get_nav_menu_object( $footer_menu_2_name );

			if(!$footer_menu_2_exists) {

				// Create it, if it doesn't exist
				$footer_menu_2_id = wp_create_nav_menu($footer_menu_2_name);

				// Add pages
				$samplePage1 = wp_update_nav_menu_item($footer_menu_2_id, 0, array(
					'menu-item-object-id' => get_page_by_path('sample-page-1')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $sample_page_1_title,
					'menu-item-status' => 'publish',
				));
				$samplePage2 = wp_update_nav_menu_item($footer_menu_2_id, 0, array(
					'menu-item-object-id' => get_page_by_path('sample-page-2')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $sample_page_2_title,
					'menu-item-status' => 'publish',
				));
				$samplePage3 = wp_update_nav_menu_item($footer_menu_2_id, 0, array(
					'menu-item-object-id' => get_page_by_path('sample-page-3')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $sample_page_3_title,
					'menu-item-status' => 'publish',
				));

			}

			// Set footer menu 2 location
			$location = get_theme_mod('nav_menu_locations');
			$location['footer-menu-2'] = $footer_menu_2_id;
			set_theme_mod( 'nav_menu_locations', $location );

			// Use Home page as front page
			$home = get_page_by_title( 'Home' );
			update_option( 'page_on_front', $home->ID );
			update_option( 'show_on_front', 'page' );
			
			// Stop WordPress automatically assigning privacy policy page
			update_option( 'wp_page_for_privacy_policy', '');

			// When finished, we update our status to make sure we don't duplicate everytime we activate.
			update_option( 'theme_setup_status', '1' );
			
		} 
		
	}
	add_action( 'after_setup_theme', 'cwd_base_setup' );

}