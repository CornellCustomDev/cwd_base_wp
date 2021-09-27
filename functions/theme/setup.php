<?php 

// Theme setup
if ( ! function_exists ( 'cwd_base_setup' ) ) {
	
	function cwd_base_setup() {
		
		global $wpdb;
		
		// Force Activate ACF Pro, CPT UI, Classic Editor plugins:
		function run_activate_plugin( $plugin ) {
			$current = get_option( 'active_plugins' );
			$plugin = plugin_basename( trim( $plugin ) );

			if ( !in_array( $plugin, $current ) ) {
				$current[] = $plugin;
				sort( $current );
				do_action( 'activate_plugin', trim( $plugin ) );
				update_option( 'active_plugins', $current );
				do_action( 'activate_' . trim( $plugin ) );
				do_action( 'activated_plugin', trim( $plugin) );
			}
			
			return null;
		}
		run_activate_plugin( 'advanced-custom-fields-pro/acf.php' ); 
		run_activate_plugin( 'custom-post-type-ui/custom-post-type-ui.php' );
		run_activate_plugin( 'classic-editor/classic-editor.php' );
		run_activate_plugin( 'classic-widgets/classic-widgets.php' );
										
		// Add theme support for needed features
		add_theme_support('post-thumbnails');
		
		add_theme_support( 'title-tag' );
		
		add_theme_support('custom-header', array(
			'width'         => 1280,
			'height'        => 320,
			'default-image' => get_stylesheet_directory_uri() . '/images/wp/headers/berries.png',

			// Callbacks for styling the header and the admin preview.
			//'wp-head-callback'       => 'cwd_base_header_style',
			//'admin-head-callback'    => 'cwd_base_admin_header_style',
			//'admin-preview-callback' => 'cwd_base_admin_header_image',
		));
		
		register_default_headers( array(
			'spring' => array(
				'url'           => get_stylesheet_directory_uri() . '/images/wp/headers/spring.png',
				'thumbnail_url' => get_stylesheet_directory_uri() . '/images/wp/headers/spring_thumb.png',
				'description'   => __( 'spring', 'Spring Header Image', 'cwd_base' )
			),
			'hilltop' => array(
				'url'           => get_stylesheet_directory_uri() . '/images/wp/headers/hilltop.png',
				'thumbnail_url' => get_stylesheet_directory_uri() . '/images/wp/headers/hilltop_thumb.png',
				'description'   => __( 'hilltop', 'Hilltop Header Image', 'cwd_base' )
			),
			'grassy_knoll' => array(
				'url'           => get_stylesheet_directory_uri() . '/images/wp/headers/grassy_knoll.png',
				'thumbnail_url' => get_stylesheet_directory_uri() . '/images/wp/headers/grassy_knoll_thumb.png',
				'description'   => __( 'grassy_knoll', 'Grassy Knoll Header Image', 'cwd_base' )
			),
			'campus' => array(
				'url'           => get_stylesheet_directory_uri() . '/images/wp/headers/campus.png',
				'thumbnail_url' => get_stylesheet_directory_uri() . '/images/wp/headers/campus_thumb.png',
				'description'   => __( 'campus', 'Campus Header Image', 'cwd_base' )
			),
			'clock' => array(
				'url'           => get_stylesheet_directory_uri() . '/images/wp/headers/clock.png',
				'thumbnail_url' => get_stylesheet_directory_uri() . '/images/wp/headers/clock_thumb.png',
				'description'   => __( 'clock', 'Clock Header Image', 'cwd_base' )
			),
			'library' => array(
				'url'           => get_stylesheet_directory_uri() . '/images/wp/headers/library.png',
				'thumbnail_url' => get_stylesheet_directory_uri() . '/images/wp/headers/library_thumb.png',
				'description'   => __( 'library', 'Library Header Image', 'cwd_base' )
			),
			'berries' => array(
				'url'           => get_stylesheet_directory_uri() . '/images/wp/headers/berries.png',
				'thumbnail_url' => get_stylesheet_directory_uri() . '/images/wp/headers/berries_thumb.png',
				'description'   => __( 'berries', 'Berries Header Image', 'cwd_base' )
			),
			'tower' => array(
				'url'           => get_stylesheet_directory_uri() . '/images/wp/headers/tower.png',
				'thumbnail_url' => get_stylesheet_directory_uri() . '/images/wp/headers/tower_thumb.png',
				'description'   => __( 'tower', 'Tower Header Image', 'cwd_base' )
			),
		) );
		
		// Custom backgrounds	
		//add_theme_support('custom-background', array(
			//'default-color'          => '',
			//'default-image'          => '',
			//'random-default'         => true,
			//'default-repeat'         => 'repeat',
			//'default-position-x'     => 'left',
			//'default-position-y'     => 'top',
			//'default-size'           => 'cover',
			//'default-attachment'     => 'scroll',
			//'video'                  => true,
		//));
		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
		add_theme_support( 'title-tag' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		// Add image sizes
		add_image_size('thumbnail', 250, 250, true); // Medium Thumbnail
		add_image_size('medium', 480, 480, true); // Small Thumbnail
		add_image_size('large', 800, 800, true); // Large Thumbnail
		add_image_size('header-image', 1280, 360, true); // Header image
		add_image_size('slider-image', 1280, 560, true); // Slider image
		
		// Register menus
		register_nav_menus(array(
			'top-menu'      => __('Top Menu', 'cwd_base'), // Top Navigation
			'main-menu'   => __('Main Menu', 'cwd_base'), // Main Navigation
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
				'uploads_use_yearmonth_folders' => 0,
				'default_pingback_flag'		=> 0,
				'show_avatars'				=> 0,
				'require_name_email'		=> 0,
				'default_comment_status'	=> 1,
				'page_comments'				=> 1,
				'posts_per_page'            => 12,
				'site_icon'				    => upload_site_icon(),
				'default_comments_page'		=> 'first',
				'default_ping_status'		=> 'closed',
				'date_format'				=> 'F j, Y',
				'permalink_structure'		=> '/%category%/%postname%/'
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
			$home_page_content = 'This text is the standard body field for a basic page that has been <a href="' . $baseUrl . 'wp-admin/options-reading.php">designated as the homepage</a>. This content can be edited like any other basic page, though other features on the homepage are typically supplied dynamically by widgets and custom templates. Extra content areas below the main content and above the footer can be added and removed on the <a href="' . $baseUrl . 'wp-admin/widgets.php">widgets page</a>.';
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

			// Styleguide
			$styleguide_page_title = 'Styleguide';
			$styleguide_page_content = '<span class="intro">This is the .intro paragraph style to give extra impact to an opening sentence or two. It can serve as a tagline or short prompt for the content that follows.</span><p>This page was created using the default WordPress editor. As a content contributor, all of the styles below are available directly in the editor. Use the <strong>Paragraph</strong> dropdown menu to style headings. Use the <strong>Formats</strong> dropdown menu to apply styles elsewhere. <mark>Some styles will require you to manually add a class using the <strong>Text</strong> tab of the editor.</mark></p>
<h2 id="headings" class="toc">Heading Styles</h2>
<strong class="tutorial note">Note:</strong> Heading levels for a basic page should start at <strong>Heading 2</strong>, since Heading 1 is reserved for the page title. The WordPress editor\'s <strong>Paragraph</strong> menu will also reflect this.
<div class="panel padded fill heavy-left">
<h2 class="toc">Primary Section Title (Heading 2)</h2>
Basic paragraph text for comparison lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae. Fusce id tellus libero.
<h3>Secondary Section Title (Heading 3)</h3>
Basic paragraph text for comparison lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae. Fusce id tellus libero.
<h4>Tertiary Section Title (Heading 4)</h4>
Basic paragraph text for comparison lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae. Fusce id tellus libero.
<h5>Subsection Title (Heading 5)</h5>
Basic paragraph text for comparison lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae. Fusce id tellus libero.
<h6>Subsection Title (Heading 6)</h6>
Basic paragraph text for comparison lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae. Fusce id tellus libero.

</div>
<a class="back-to-toc" title="Back to Top" href="#main-article"><span class="sr-only">Back to Top</span></a>
<h2 id="hrs" class="toc">Horizontal Rules</h2>
<strong class="tutorial note">Note:</strong> The latest <a href="http://www.w3.org/TR/html-markup/hr.html">W3C HTML5 Specification</a> changes the semantic definition of the <code>&lt;HR&gt;</code> tag, to represent a "thematic break," rather than a traditional stylistic divider. However, we expect that most content contributors will continue to use them in their traditional way, so the following options are provided:
<h3 class="h4 toc">Default</h3>

<hr />

<h3 class="h4 toc">Blue-Green</h3>

<hr class="accent1" />

<h3 class="h4">Blue</h3>

<hr class="accent2" />

<h3 class="h4">Purple</h3>

<hr class="accent3" />

<h3 class="h4">Gold</h3>

<hr class="accent4" />

<h3 class="h4">Green</h3>

<hr class="accent5" />

<h3 class="h4">Invisible <small>(no visible line, spacer only)</small></h3>

<hr class="invisible" />

<h3 class="h4">Dotted</h3>

<hr class="dotted" />

<h3 class="h4">Dashed</h3>

<hr class="dashed" />

<h3 class="h4">Double</h3>

<hr class="double" />

<h3 class="h4">Heavy</h3>

<hr class="heavy" />

<h3 class="h4">Extra-Heavy</h3>

<hr class="extra-heavy" />

<h3 class="h4">Faded</h3>

<hr class="fade" />

<h3 class="h4">Flourish</h3>

<hr class="flourish" />

<h3 class="h4">Cornell Icon</h3>

<hr class="bigred" />

<h3 class="h4">Section Break <small>(section divider with extra spacing)</small></h3>

<hr class="section-break" />

<a class="back-to-toc" title="Back to Top" href="#main-article"><span class="sr-only">Back to Top</span></a>
<h2 id="images">Images, Figures, Asides</h2>
Images may be placed within paragraphs of text, or placed in-between paragraphs, centered or floated, with or without a caption.

[caption id="attachment_1029" align="aligncenter" width="1200"]<img class="wp-image-1029 size-full" src="/wp-content/themes/cwd_base/images/wp/image-alignment-1200x400.jpg" alt="Image Alignment 1200x400" width="1200" height="400" /> <strong class="tutorial note">Note:</strong> An optional caption can be added to any image using the media dialog caption field. Large images will be scaled to fit the content container.[/caption]
<h3>Alignment Options</h3>
Use the <strong>Add Media</strong> button to place images within the content of the page. When choosing an image from the media library (or uploading a new image), you will have the option to float them to the left or right of surrounding text. Floated images will be sized fluidly, at <strong>up to 40%</strong> of content width. However, <strong>images will only be scaled down, not up</strong>. Small images will not be scaled up if their natural width is less than 40% of the container. This allows for the use of different images sizes, without blurry upscaling or unnecessary waste of space.

<aside><strong class="tutorial note">Note:</strong> On phones, below <strong>480px</strong> wide, images will try to fill the width of their container, regardless of alignment. For this reason, it is recommended that all content images have a native size that is no smaller than 480px wide.</aside>
<h3>Align Left</h3>
Floated images <strong>larger than 40%</strong> of the content area can be scaled down <strong>or</strong> cropped. When inserting an image, you can choose from four set image sizes or choose a custom size. The following left-aligned image is <strong>full size</strong> <strong>(scaled down)</strong>. Any image size you choose other than full size will require cropping. <img class="alignleft wp-image-1029 size-full" src="/wp-content/themes/cwd_base/images/wp/image-alignment-1200x400.jpg" alt="Image Alignment 1200x400" width="1200" height="400" />Ut id nisl quis enim dignissim sagittis. Phasellus nec sem in justo pellentesque facilisis. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Vivamus quis mi. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nam commodo suscipit quam. Praesent ut ligula non mi varius sagittis. Praesent adipiscing. Etiam rhoncus. Phasellus nec sem in justo pellentesque facilisis. Aenean ut eros et nisl sagittis vestibulum. Praesent turpis. Morbi nec metus. Morbi ac felis. Suspendisse eu ligula. Phasellus tempus. Curabitur blandit mollis lacus. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Nullam sagittis.
<h3>Align Right</h3>
The following right-aligned image is not full size. Instead, it uses one of the preset image sizes: <strong>large (cropped)</strong>. Morbi nec metus. Aliquam erat volutpat. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Phasellus nec sem in justo pellentesque facilisis. <img class="alignright wp-image-1029 size-large" src="/wp-content/themes/cwd_base/images/wp/image-alignment-1200x400-800x800.jpg" alt="Image Alignment 1200x400" width="800" height="400" />Morbi ac felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse potenti. Sed fringilla mauris sit amet nibh. Sed augue ipsum, egestas nec, vestibulum et, malesuada adipiscing, dui. Fusce fermentum odio nec arcu. Mauris sollicitudin fermentum libero. Praesent ac sem eget est egestas volutpat. Phasellus magna. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Pellentesque auctor neque nec urna. In auctor lobortis lacus. Quisque rutrum. Duis lobortis massa imperdiet quam.
<h3>Align Center</h3>
Donec vitae orci sed dolor rutrum auctor. Cras non dolor. Nullam accumsan lorem in dui. Cras risus ipsum, faucibus ut, ullamcorper id, varius ac, leo. Phasellus magna. <img class="alignnone wp-image-967 size-full" style="display: block;" src="/wp-content/themes/cwd_base/images/wp/image-alignment-580x300.jpg" alt="Image Alignment 580x300" width="580" height="300" />Praesent blandit laoreet nibh. Praesent adipiscing. Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Maecenas nec odio et ante tincidunt tempus. Suspendisse nisl elit, rhoncus eget, elementum ac, condimentum eget, diam. Pellentesque ut neque. Nunc nec neque. Duis leo. In ut quam vitae odio lacinia tincidunt. <img class="alignleft wp-image-968 size-full" src="/wp-content/themes/cwd_base/images/wp/image-alignment-150x150.jpg" alt="Image Alignment 150x150" width="150" height="150" /> Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Suspendisse feugiat. Nullam accumsan lorem in dui. Aliquam erat volutpat. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Nam pretium turpis et arcu. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Nulla consequat massa quis enim. Fusce risus nisl, viverra et, tempor et, pretium in, sapien.
<h3>Aside</h3>
Ut id nisl quis enim dignissim sagittis. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.

<aside>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Suspendisse feugiat. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Nam adipiscing. Etiam ut purus mattis mauris sodales aliquam.</aside>Vestibulum dapibus nunc ac augue. Phasellus accumsan cursus velit. In auctor lobortis lacus. Sed a libero. Suspendisse feugiat. Proin faucibus arcu quis ante. Cras sagittis. Fusce fermentum odio nec arcu. Fusce convallis metus id felis luctus adipiscing. Quisque id odio.
<h3>Aside right</h3>
<aside class="sidebar">Sed augue ipsum, egestas nec, vestibulum et, malesuada adipiscing, dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</aside>In ac dui quis mi consectetuer lacinia. Nunc sed turpis. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Curabitur at lacus ac velit ornare lobortis. Curabitur at lacus ac velit ornare lobortis. Mauris sollicitudin fermentum libero. Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. Etiam iaculis nunc ac metus. Nam eget dui. Nulla porta dolor. In ac felis quis tortor malesuada pretium. Vivamus consectetuer hendrerit lacus. Praesent vestibulum dapibus nibh. Phasellus ullamcorper ipsum rutrum nunc. Ut leo. Vestibulum eu odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc nec neque.
<h3>Aside column</h3>
<aside class="column">Duis vel nibh at velit scelerisque suscipit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Pellentesque ut neque. Aenean massa. Nam commodo suscipit quam.</aside>Donec posuere vulputate arcu. Vivamus elementum semper nisi. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam tincidunt adipiscing enim. Ut a nisl id ante tempus hendrerit. Praesent ac massa at ligula laoreet iaculis. Fusce pharetra convallis urna. In hac habitasse platea dictumst. Donec vitae sapien ut libero venenatis faucibus. Fusce vel dui. Maecenas vestibulum mollis diam. Vivamus quis mi. Vivamus laoreet. Praesent porttitor, nulla vitae posuere iaculis, arcu nisl dignissim dolor, a pretium mi sem ut ipsum. Sed libero. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Praesent egestas neque eu enim. Maecenas malesuada. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. <a class="back-to-toc" title="Back to Top" href="#main-article"><span class="sr-only">Back to Top</span></a>
<h2 id="inline">Inline Styles</h2>
Sed libero. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Praesent egestas neque eu enim. Maecenas malesuada. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.
<h3>Text Highlights</h3>
<mark class="text-highlight-blue">Vestibulum purus quam</mark>, scelerisque ut, mollis sed, nonummy id, metus. Suspendisse feugiat. Etiam ultricies nisi vel augue. Praesent nonummy mi in odio. Quisque id odio. <mark>Phasellus nec sem in justo</mark> pellentesque facilisis. Suspendisse feugiat. Pellentesque commodo eros a enim. Aenean vulputate eleifend tellus. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. <mark class="text-highlight-green">Donec vitae orci</mark> sed dolor rutrum auctor. Praesent blandit laoreet nibh. Phasellus blandit leo ut odio. Fusce commodo aliquam arcu. Suspendisse nisl elit, rhoncus eget, elementum ac, condimentum eget, diam. <mark class="text-highlight-yellow">Nullam vel sem</mark>. Quisque ut nisi. Vestibulum eu odio. Fusce egestas elit eget lorem. Fusce vel dui. <mark class="text-highlight-red">Fusce convallis</mark> metus id felis luctus adipiscing. Vivamus laoreet. Aenean vulputate eleifend tellus. Phasellus consectetuer vestibulum elit. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. <mark class="text-highlight-purple">Vestibulum ante ipsum</mark> primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Sed hendrerit. Sed a libero. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Suspendisse eu ligula. <a class="back-to-toc" title="Back to Top" href="#main-article"><span class="sr-only">Back to Top</span></a>
<h2 id="blockquotes">Blockquotes</h2>
Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Suspendisse feugiat. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Nam adipiscing. Etiam ut purus mattis mauris sodales aliquam. Vestibulum dapibus nunc ac augue. Phasellus accumsan cursus velit. In auctor lobortis lacus. Sed a libero. Suspendisse feugiat.
<h3>Impact</h3>
Morbi vestibulum volutpat enim. Praesent venenatis metus at tortor pulvinar varius. Praesent venenatis metus at tortor pulvinar varius. Praesent ut ligula non mi varius sagittis.
<blockquote class="impact">Some have called Cornell the “first American university.</blockquote>
Morbi vestibulum volutpat enim. Praesent venenatis metus at tortor pulvinar varius. Praesent venenatis metus at tortor pulvinar varius. Praesent ut ligula non mi varius sagittis. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Vivamus consectetuer hendrerit lacus. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Ut id nisl quis enim dignissim sagittis. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Vestibulum dapibus nunc ac augue. Phasellus accumsan cursus velit. In auctor lobortis lacus. Sed a libero. Suspendisse feugiat.
<h3>Offset</h3>
Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Aliquam lobortis. Quisque rutrum. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Sed in libero ut nibh placerat accumsan.
<blockquote class="offset">Some have called Cornell the “first American university."</blockquote>
Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula. Morbi nec metus. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Cras dapibus. Fusce fermentum odio nec arcu. Cras dapibus. Aenean vulputate eleifend tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur a felis in nunc fringilla tristique. Praesent ac sem eget est egestas volutpat. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Vivamus consectetuer hendrerit lacus. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Ut id nisl quis enim dignissim sagittis. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Suspendisse feugiat. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Nam adipiscing. Etiam ut purus mattis mauris sodales aliquam. <a class="back-to-toc" title="Back to Top" href="#main-article"><span class="sr-only">Back to Top</span></a>
<h2 id="panels">Panels and Accent Options</h2>
<h3>Panels</h3>
<div class="panel">Default (<code>class="panel"</code>)</div>
<div class="accent-blue-green panel">Blue-Green (<code>class="panel accent-blue-green"</code>)</div>
<div class="accent-blue panel">Blue (<code>class="panel accent-blue"</code>)</div>
<div class="accent-purple panel">Purple (<code>class="panel accent-purple"</code>)</div>
<div class="accent-gold panel">Gold (<code>class="panel accent-gold"</code>)</div>
<div class="accent-green panel">Green (<code>class="panel accent-green"</code>)</div>
<div class="accent-red panel">Red (<code>class="panel accent-red"</code>)</div>
<h3>Fill Background</h3>
<strong class="tip tutorial">Hint:</strong> Use the <code>.no-border</code> class to omit the default 1px border.
<div class="fill panel">Default (<code>class="panel fill"</code>)</div>
<div class="accent-blue-green fill panel">Blue-Green (<code>class="panel accent-blue-green fill"</code>)</div>
<div class="accent-blue fill panel">Blue (<code>class="panel accent-blue fill"</code>)</div>
<div class="accent-purple fill panel">Purple (<code>class="panel accent-purple fill"</code>)</div>
<div class="accent-gold fill panel">Gold (<code>class="panel accent-gold fill"</code>)</div>
<div class="accent-green fill panel">Green (<code>class="panel accent-green fill"</code>)</div>
<div class="accent-red fill panel">Red (<code>class="panel accent-red fill"</code>)</div>
<h3>Heavy Border (left or top, with or without fills)</h3>
<div class="fill heavy-left panel">Default (<code>class="panel fill heavy-left"</code>)</div>
<div class="accent-blue-green heavy-left panel">Blue-Green (<code>class="panel accent-blue-green heavy-left"</code>)</div>
<div class="accent-blue fill heavy-left panel">Blue (<code>class="panel accent-blue fill heavy-left"</code>)</div>
<div class="accent-purple heavy-top panel">Purple (<code>class="panel accent-purple heavy-top"</code>)</div>
<div class="accent-gold fill heavy-top panel">Gold (<code>class="panel accent-gold fill heavy-top"</code>)</div>
<div class="accent-green heavy-top panel">Green (<code>class="panel accent-green heavy-top"</code>)</div>
<div class="accent-red fill heavy-top panel">Red (<code>class="panel accent-red fill heavy-top"</code>)</div>
<h3>Indenting</h3>
<div class="indent1 panel">Indent 1 Step (<code>class="panel indent1"</code>)</div>
<div class="indent2 panel">Indent 2 Steps (<code>class="panel indent2"</code>)</div>
<div class="indent3 panel">Indent 3 Steps (<code>class="panel indent3"</code>)</div>
<div class="indent4 panel">Indent 4 Steps (<code>class="panel indent4"</code>)</div>
<a class="back-to-toc" title="Back to Top" href="#main-article"><span class="sr-only">Back to Top</span></a>
<h2 id="lists">Lists</h2>
<h3>Unordered List</h3>
<ul>
 	<li>List Item</li>
 	<li>List Item
<ul>
 	<li>Nested List Item</li>
 	<li>Nested list item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae.</li>
 	<li>Double Nested
<ul>
 	<li>Nested List Item</li>
 	<li>Nested List Item</li>
</ul>
</li>
 	<li>Nested List Item</li>
 	<li><a href="#">Nested List Item</a></li>
 	<li>Nested List Item</li>
</ul>
</li>
 	<li>List Item</li>
 	<li>Nested Ordered:
<ol>
 	<li>Nested List Item
<ul>
 	<li>Nested Unordered List Item</li>
 	<li>Nested Unordered List Item</li>
</ul>
</li>
 	<li>Nested List Item</li>
</ol>
</li>
 	<li>List Item</li>
</ul>
<ul class="toc">
 	<li><a href="#">Introduction</a></li>
 	<li><a href="#">Section One Title</a></li>
 	<li><a href="#">Section Two Title</a></li>
 	<li><a href="#">Section Three Title</a></li>
 	<li><a href="#">Section Four Title</a></li>
</ul>
<h3>Ordered Lists</h3>
<div class="three-col">
<div>
<ol>
 	<li>List Item</li>
 	<li>List Item</li>
 	<li>List Item</li>
</ol>
<ol class="decimal-leading-zero"><!-- note: this numbering style can only be done with CSS -->
 	<li>List Item</li>
 	<li>List Item</li>
 	<li>List Item</li>
</ol>
</div>
<div>
<ol type="a">
 	<li>List Item</li>
 	<li>List Item</li>
 	<li>List Item</li>
</ol>
<ol type="A">
 	<li>List Item</li>
 	<li>List Item</li>
 	<li>List Item</li>
</ol>
</div>
<div>
<ol type="i">
 	<li>List Item</li>
 	<li>List Item</li>
 	<li>List Item</li>
</ol>
<ol type="I">
 	<li>List Item</li>
 	<li>List Item</li>
 	<li>List Item</li>
</ol>
</div>
</div>
<h3>Custom Unordered List</h3>
Icon-driven bullets can be used for higher visual impact. The <code>.custom</code> class on its own will only apply to direct children in the list structure, allowing finer control (custom bullets are often best-suited to single-level lists). In a case where you\'d like the icons to appear for all nested list items as well, include the <code>.recursive</code> class. It will apply to all Unordered List descendants, but will not apply to any Ordered Lists that are mixed in. By default, Custom Unordered List bullets use a <a href="https://fontawesome.com/v4.7.0/cheatsheet/">FontAwesome</a> caret glyph. A few other out-of-the-box options are also provided below. The <strong>Status</strong> option uses <a href="http://zavoloklom.github.io/material-design-iconic-font/cheatsheet.html">Material Design Iconic</a> glpyhs.
<h4>Simple (<code>ul.custom</code>)</h4>
<ul class="custom">
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae.</li>
 	<li>List Item</li>
 	<li>Nested Ordered:
<ol>
 	<li>Nested List Item
<ul>
 	<li>Nested Unordered List Item</li>
 	<li>Nested Unordered List Item</li>
</ul>
</li>
 	<li>Nested List Item</li>
</ol>
</li>
 	<li>List Item</li>
</ul>
<h4>Recursive (<code>ul.custom.recursive</code>)</h4>
<ul class="custom recursive">
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae.</li>
 	<li>List Item</li>
 	<li>Nested Ordered:
<ol>
 	<li>Nested List Item
<ul>
 	<li>Nested Unordered List Item</li>
 	<li>Nested Unordered List Item</li>
</ul>
</li>
 	<li>Nested List Item</li>
</ol>
</li>
 	<li>List Item</li>
</ul>
<h4>Chevrons (<code>ul.custom.chevrons</code>)</h4>
<ul class="custom chevrons">
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae.</li>
 	<li>List Item</li>
</ul>
<h4>Success Checkmarks (<code>ul.custom.success</code>)</h4>
<ul class="custom success">
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae.</li>
 	<li>List Item</li>
</ul>
<h4>Failure X\'s (<code>ul.custom.failure</code>)</h4>
<ul class="custom failure">
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae.</li>
 	<li>List Item</li>
</ul>
<h4>Failure Warnings (<code>ul.custom.warning</code>)</h4>
<ul class="custom warning">
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae.</li>
 	<li>List Item</li>
</ul>
<h4>Notifications (<code>ul.custom.notifications</code>)</h4>
<ul class="custom notifications">
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae.</li>
 	<li>List Item</li>
</ul>
<h4>Status Message (<code>ul.custom.status</code>)</h4>
<ul class="custom status">
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae.</li>
 	<li>List Item</li>
</ul>
<h4 class="low-margin">On/Off (<code>ul.custom.on-off</code>)</h4>
<p class="smallprint">Use the <code>.on</code> or <code>.off</code> class on</p>

<ul>
 	<li>tags to mark each item.
<ul class="custom on-off">
 	<li class="on">This item is on/enabled/passed.</li>
 	<li class="off">This item is off/disabled/failed.</li>
 	<li>This one\'s unknown or not set. Oh no!</li>
</ul>
<h4 class="low-margin">On/Off as Steps (<code>ul.custom.on-off-steps</code>)</h4>
<p class="smallprint">Use the <code>.on</code> or <code>.off</code> class on</p>
</li>
 	<li></li>
 	<li>tags to mark each item.
<ul class="custom on-off-steps">
 	<li class="on">This step is complete.</li>
 	<li class="off">This step is not.</li>
 	<li>This one\'s unknown or not set. Oh no!</li>
</ul>
<h4 class="low-margin">On/Off as Toggle (<code>ul.custom.on-off-toggle</code>)</h4>
<p class="smallprint">Use the <code>.on</code> or <code>.off</code> class on</p>
</li>
 	<li></li>
 	<li>tags to mark each item. Note: These would typically be made into buttons, to provide the expected user experience.
<ul class="custom on-off-toggle">
 	<li class="on">This option is enabled.</li>
 	<li class="off">This option is disabled.</li>
 	<li>This one\'s unknown or not set. Oh no!</li>
</ul>
<h4>Nerdy List (<code>ul.custom.nerd</code>)</h4>
<ul class="custom nerd">
 	<li>A nerdy list item.</li>
 	<li>A nerdy list item.</li>
 	<li class="off">Not a nerdy item. (how\'d this get in here?)</li>
 	<li>A nerdy item once more. (thank goodness!)</li>
</ul>
</li>
</ul>
<h3>Custom Ordered List</h3>
Prominent numbered bullets can be used to communicate an emphasized sense of sequence. Custom Ordered Lists follow the same recursion rules as Unordered Lists above. They utilize styled typography and automatic numbering.
<h4>Simple (<code>ol.custom</code>)</h4>
<ol class="custom">
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae.</li>
 	<li>List Item</li>
 	<li>Nested Unordered:
<ul>
 	<li>Nested List Item
<ol>
 	<li>Nested Ordered List Item</li>
 	<li>Nested Ordered List Item</li>
</ol>
</li>
 	<li>Nested List Item</li>
</ul>
</li>
 	<li>List Item</li>
</ol>
<h4>Recursive (<code>ol.custom.recursive</code>)</h4>
<ol class="custom recursive">
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae.</li>
 	<li>List Item</li>
 	<li>Nested Unordered:
<ul>
 	<li>Nested List Item
<ol>
 	<li>Nested Ordered List Item</li>
 	<li>Nested Ordered List Item</li>
</ol>
</li>
 	<li>Nested List Item</li>
</ul>
</li>
 	<li>List Item</li>
</ol>
<h4>Large (<code>ol.custom.large</code>)</h4>
<ol class="custom large">
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae adipiscing elit.</li>
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae adipiscing elit.</li>
 	<li>List item ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam fermentum lacus, ut sagittis dui porttitor vitae adipiscing elit.</li>
</ol>
<a class="back-to-toc" title="Back to Top" href="#main-article"><span class="sr-only">Back to Top</span></a>
<h2 id="lists-as-menus">Lists as Menus</h2>
The <code>.list-menu</code> system quickly removes bullets and adjusts the layout of list items to fit many common use-cases.

<!--  This system is also used as the foundation for the <strong>section navigation</strong> appearing in the <strong class="tutorial">Priority Sidebar</strong> above. -->
<h3>Basic</h3>
<h4>List Menu (<code>ul.list-menu</code>)</h4>
<ul class="list-menu">
 	<li><a href="#">Academics</a></li>
 	<li><a href="#">Admissions</a></li>
 	<li><a href="#">Teaching &amp; Research</a></li>
 	<li><a href="#">News &amp; Events</a></li>
 	<li><a href="#">Contact</a></li>
</ul>
<h4>Vertical List Menu (<code>ul.list-menu.vertical</code>)</h4>
<ul class="list-menu vertical">
 	<li><a href="#">Academics</a></li>
 	<li><a href="#">Admissions</a></li>
 	<li><a href="#">Teaching &amp; Research</a></li>
 	<li><a href="#">News &amp; Events</a></li>
 	<li><a href="#">Contact</a></li>
</ul>
<h3>With Dividers</h3>
<h4>List Menu (<code>ul.list-menu.divs</code>)</h4>
<ul class="list-menu divs">
 	<li><a href="#">Academics</a></li>
 	<li><a href="#">Admissions</a></li>
 	<li><a href="#">Teaching &amp; Research</a></li>
 	<li><a href="#">News &amp; Events</a></li>
 	<li><a href="#">Contact</a></li>
</ul>
<h4>Vertical List Menu (<code>ul.list-menu.vertical.divs</code>)</h4>
<ul class="list-menu vertical divs">
 	<li><a href="#">Academics</a></li>
 	<li><a href="#">Admissions</a></li>
 	<li><a href="#">Teaching &amp; Research</a></li>
 	<li><a href="#">News &amp; Events</a></li>
 	<li><a href="#">Contact</a></li>
</ul>
<h3>With Button Links</h3>
<h4>List Menu (<code>ul.list-menu.links</code>)</h4>
<ul class="list-menu links">
 	<li><a href="#">Academics</a></li>
 	<li><a href="#">Admissions</a></li>
 	<li><a href="#">Teaching &amp; Research</a></li>
 	<li><a href="#">News &amp; Events</a></li>
 	<li><a href="#">Contact</a></li>
</ul>
<h4>Vertical List Menu (<code>ul.list-menu.vertical.links</code>)</h4>
<ul class="list-menu vertical links">
 	<li><a href="#">Academics</a></li>
 	<li><a href="#">Admissions</a></li>
 	<li><a href="#">Teaching &amp; Research</a></li>
 	<li><a href="#">News &amp; Events</a></li>
 	<li><a href="#">Contact</a></li>
</ul>
<a class="back-to-toc" title="Back to Top" href="#main-article"><span class="sr-only">Back to Top</span></a>
<h2 id="tables">Tables</h2>
To minimize incompatibility with other table-based functionality, custom styles are only applied to tables which include a <code>.table</code> class. While options are included for borderless tables, a cell border will always be included when printed, since background colors are commonly omitted when printing from a web browser.

<aside><strong class="tutorial note">Note:</strong> Accessible data tables should include <code>&lt;caption&gt;</code> tags and properly identified and scoped headers for columns and rows (e.g., <code>&lt;th scope="col"&gt;</code>). Some styles also expect the scope attribute to be present, and may not work without it.</aside>
<h3>CSS Class Options <small><code>TABLE<strong>.class</strong></code></small></h3>
<ul class="list-menu vertical">
 	<li><code>.table</code> - <span class="smallprint">The base class needed to activate custom styles. Nothing below will work without it.</span></li>
 	<li><code>.bordered</code> - <span class="smallprint">Activates full bordering on all table cells for a traditional spreadsheet look (mutually exclusive with .flat).</span></li>
 	<li><code>.flat</code> - <span class="smallprint">Removes all borders, relying instead on subtle tinting (mutually exclusive with .bordered).</span></li>
 	<li><code>.striped</code> - <span class="smallprint">Applies an alternating row tint for easier readability. This option can be paired with all other options (bordered, flat, colored, etc).</span></li>
 	<li><code>.colored</code> - <span class="smallprint">Applies a subtle blue color palette with gray row headers. Lookin sharp!</span></li>
 	<li><code>.rainbow</code> - <span class="smallprint">Applies a not-so-subtle multi-color palette in which columns cycle through five colors for easier differentiation. While a bit whimsical in its default appearance, it can provide a model by which the <code>:nth-child</code> configuration is altered to communicate a data relationship by grouping columns together visually (e.g., the first two columns might be blue and have a shared header, the next three are white with simple table data, and the last is yellow differentiating it somehow from the nearby white columns).</span></li>
 	<li><code>.compact</code> - <span class="smallprint">Lessens the font size and padding of table cells, allowing slightly more data to fit the space.</span></li>
 	<li><code>.sectioned</code> - <span class="smallprint">If multiple <code>&lt;tbody&gt;</code> tags are used, this class creates a visual gap between them. The practical use of this is to break a table into sections <em>visually</em> without needing to use multiple tables.</span></li>
</ul>
<h3>Examples</h3>
<table class="table"><caption>Basic Table (<code>.table</code>)</caption>
<thead>
<tr>
<th></th>
<th scope="col">Col 1</th>
<th scope="col">Col 2</th>
<th scope="col">Col 3</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">Row 1</th>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
</tr>
<tr>
<th scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
</tr>
<tr>
<th scope="row">Row 3</th>
<td>R3 C1</td>
<td>R3 C2</td>
<td>R3 C3</td>
</tr>
</tbody>
</table>
<table class="table bordered"><caption>Bordered Table (<code>.table.bordered</code>)</caption>
<thead>
<tr>
<th></th>
<th scope="col">Col 1</th>
<th scope="col">Col 2</th>
<th scope="col">Col 3</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">Row 1</th>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
</tr>
<tr>
<th scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
</tr>
<tr>
<th scope="row">Row 3</th>
<td>R3 C1</td>
<td>R3 C2</td>
<td>R3 C3</td>
</tr>
</tbody>
</table>
<table class="table flat"><caption>Flat Table (<code>.table.flat</code>)</caption>
<thead>
<tr>
<th></th>
<th scope="col">Col 1</th>
<th scope="col">Col 2</th>
<th scope="col">Col 3</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">Row 1</th>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
</tr>
<tr>
<th scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
</tr>
<tr>
<th scope="row">Row 3</th>
<td>R3 C1</td>
<td>R3 C2</td>
<td>R3 C3</td>
</tr>
</tbody>
</table>
<table class="table striped"><caption>Striped Table (<code>.table.striped</code>)</caption>
<thead>
<tr>
<th></th>
<th scope="col">Col 1</th>
<th scope="col">Col 2</th>
<th scope="col">Col 3</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">Row 1</th>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
</tr>
<tr>
<th scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
</tr>
<tr>
<th scope="row">Row 3</th>
<td>R3 C1</td>
<td>R3 C2</td>
<td>R3 C3</td>
</tr>
<tr>
<th scope="row">Row 4</th>
<td>R4 C1</td>
<td>R4 C2</td>
<td>R4 C3</td>
</tr>
<tr>
<th scope="row">Row 5</th>
<td>R5 C1</td>
<td>R5 C2</td>
<td>R5 C3</td>
</tr>
</tbody>
</table>
<table class="table flat striped"><caption>Striped Table (<code>.table.flat.striped</code>)</caption>
<thead>
<tr>
<th></th>
<th scope="col">Col 1</th>
<th scope="col">Col 2</th>
<th scope="col">Col 3</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">Row 1</th>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
</tr>
<tr>
<th scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
</tr>
<tr>
<th scope="row">Row 3</th>
<td>R3 C1</td>
<td>R3 C2</td>
<td>R3 C3</td>
</tr>
<tr>
<th scope="row">Row 4</th>
<td>R4 C1</td>
<td>R4 C2</td>
<td>R4 C3</td>
</tr>
<tr>
<th scope="row">Row 5</th>
<td>R5 C1</td>
<td>R5 C2</td>
<td>R5 C3</td>
</tr>
</tbody>
</table>
<table class="table striped colored"><caption>Colored Table (<code>.table.striped.colored</code>)</caption>
<thead>
<tr>
<th></th>
<th scope="col">Col 1</th>
<th scope="col">Col 2</th>
<th scope="col">Col 3</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">Row 1</th>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
</tr>
<tr>
<th scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
</tr>
<tr>
<th scope="row">Row 3</th>
<td>R3 C1</td>
<td>R3 C2</td>
<td>R3 C3</td>
</tr>
</tbody>
</table>
<table class="table flat striped colored"><caption>Flat + Colored Table (<code>.table.flat.striped.colored</code>)</caption>
<thead>
<tr>
<th></th>
<th scope="col">Col 1</th>
<th scope="col">Col 2</th>
<th scope="col">Col 3</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">Row 1</th>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
</tr>
<tr>
<th scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
</tr>
<tr>
<th scope="row">Row 3</th>
<td>R3 C1</td>
<td>R3 C2</td>
<td>R3 C3</td>
</tr>
</tbody>
</table>
<table class="table striped rainbow"><caption>Rainbow Table. Come on, you know it\'s fun! (<code>.table.striped.rainbow</code>)</caption>
<thead>
<tr>
<th scope="col">Col 1</th>
<th scope="col">Col 2</th>
<th scope="col">Col 3</th>
<th scope="col">Col 4</th>
<th scope="col">Col 5</th>
<th scope="col">Col 6</th>
<th scope="col">Col 7</th>
</tr>
</thead>
<tbody>
<tr>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
<td>R1 C4</td>
<td>R1 C5</td>
<td>R1 C6</td>
<td>R1 C7</td>
</tr>
<tr>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
<td>R2 C4</td>
<td>R2 C5</td>
<td>R2 C6</td>
<td>R2 C7</td>
</tr>
<tr>
<td>R3 C1</td>
<td>R3 C2</td>
<td>R3 C3</td>
<td>R3 C4</td>
<td>R3 C5</td>
<td>R3 C6</td>
<td>R3 C7</td>
</tr>
<tr>
<td>R4 C1</td>
<td>R4 C2</td>
<td>R4 C3</td>
<td>R4 C4</td>
<td>R4 C5</td>
<td>R4 C6</td>
<td>R4 C7</td>
</tr>
<tr>
<td>R5 C1</td>
<td>R5 C2</td>
<td>R5 C3</td>
<td>R5 C4</td>
<td>R5 C5</td>
<td>R5 C6</td>
<td>R5 C7</td>
</tr>
</tbody>
</table>
<table class="table flat striped rainbow"><caption>Flat Rainbow Table with Row Headers (<code>.table.flat.striped.rainbow</code>)</caption>
<thead>
<tr>
<th></th>
<th scope="col">Col 1</th>
<th scope="col">Col 2</th>
<th scope="col">Col 3</th>
<th scope="col">Col 4</th>
<th scope="col">Col 5</th>
<th scope="col">Col 6</th>
<th scope="col">Col 7</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">Row 1</th>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
<td>R1 C4</td>
<td>R1 C5</td>
<td>R1 C6</td>
<td>R1 C7</td>
</tr>
<tr>
<th scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
<td>R2 C4</td>
<td>R2 C5</td>
<td>R2 C6</td>
<td>R2 C7</td>
</tr>
<tr>
<th scope="row">Row 3</th>
<td>R3 C1</td>
<td>R3 C2</td>
<td>R3 C3</td>
<td>R3 C4</td>
<td>R3 C5</td>
<td>R3 C6</td>
<td>R3 C7</td>
</tr>
<tr>
<th scope="row">Row 4</th>
<td>R4 C1</td>
<td>R4 C2</td>
<td>R4 C3</td>
<td>R4 C4</td>
<td>R4 C5</td>
<td>R4 C6</td>
<td>R4 C7</td>
</tr>
<tr>
<th scope="row">Row 5</th>
<td>R5 C1</td>
<td>R5 C2</td>
<td>R5 C3</td>
<td>R5 C4</td>
<td>R5 C5</td>
<td>R5 C6</td>
<td>R5 C7</td>
</tr>
</tbody>
</table>
<table class="table bordered"><caption>Table with Nested Column and Row Headings</caption>
<thead>
<tr>
<th colspan="2" rowspan="2"></th>
<th rowspan="2" scope="col">Col 1</th>
<th class="text-center" colspan="2" scope="col">Col 2</th>
</tr>
<tr>
<th scope="col">Col 2a</th>
<th scope="col">Col 2b</th>
</tr>
</thead>
<tbody>
<tr>
<th rowspan="2" scope="row">Row 1</th>
<th scope="row">Row 1a</th>
<td>R1a C1</td>
<td>R1a C2a</td>
<td>R1a C2b</td>
</tr>
<tr>
<th scope="row">Row 1b</th>
<td>R1b C1</td>
<td>R1b C2a</td>
<td>R1b C2b</td>
</tr>
<tr>
<th colspan="2" scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2a</td>
<td>R2 C2b</td>
</tr>
</tbody>
</table>
<table class="table flat striped colored sectioned"><caption>Table with a <code>&lt;thead&gt;</code> and Multiple <code>&lt;tbody&gt;</code> Tags (add <code>.sectioned</code> to activate spacing)</caption>
<thead>
<tr>
<th></th>
<th scope="col">Col 1</th>
<th scope="col">Col 2</th>
<th scope="col">Col 3</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">Row 1</th>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
</tr>
<tr>
<th scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
</tr>
</tbody>
<tbody>
<tr>
<th scope="row">Row 1</th>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
</tr>
<tr>
<th scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
</tr>
</tbody>
<tbody>
<tr>
<th scope="row">Row 1</th>
<td>R1 C1</td>
<td>R1 C2</td>
<td>R1 C3</td>
</tr>
<tr>
<th scope="row">Row 2</th>
<td>R2 C1</td>
<td>R2 C2</td>
<td>R2 C3</td>
</tr>
</tbody>
</table>
<a class="back-to-toc" title="Back to Top" href="#main-article"><span class="sr-only">Back to Top</span></a>
<h2 id="columns">Columns and Grid System</h2>
You can apply a <code>.two-col</code>, <code>.three-col</code>, or <code>.four-col</code> class to most containers, to distribute their direct child nodes evenly in two, three, or four simple columns. This is the easiest way to render columns without the need for special HTML markup. Rows are maintained even when nodes are different heights (as seen in the Four Column example below).
<h3>Two Even Columns</h3>
<div class="two-col margined"><img class="alignnone size-medium wp-image-6544" src="/wp-content/themes/cwd_base/images/photos/plantations.jpg" alt="" width="300" height="300" /><img class="alignnone wp-image-6529 size-medium" src="/wp-content/themes/cwd_base/images/photos/plantations.jpg" alt="" width="300" height="300" /></div>
<h3>Three Even Columns</h3>
<div class="three-col margined"><img class="alignnone size-medium wp-image-6497" src="/wp-content/themes/cwd_base/images/photos/plantations.jpg" alt="" width="300" height="300" /><img class="alignnone size-medium wp-image-6499" src="/wp-content/themes/cwd_base/images/photos/plantations.jpg" alt="" width="300" height="300" /><img class="alignnone size-medium wp-image-6495" src="/wp-content/themes/cwd_base/images/photos/plantations.jpg" alt="" width="300" height="300" /></div>
<h3>Four Even Columns</h3>
<div class="four-col margined"><img class="alignnone wp-image-770 size-medium" src="/wp-content/themes/cwd_base/images/photos/plantations.jpg" alt="Huatulco Coastline" width="300" height="300" /><img class="alignnone wp-image-766 size-medium" src="/wp-content/themes/cwd_base/images/photos/plantations.jpg" alt="Big Sur" width="300" height="300" /><img class="alignnone size-medium wp-image-769" src="/wp-content/themes/cwd_base/images/photos/plantations_square.jpg" alt="Brazil Beach" width="300" height="300" /><img class="alignnone wp-image-765 size-medium" src="/wp-content/themes/cwd_base/images/photos/plantations.jpg" alt="Sea and Rocks" width="300" height="300" /><img class="alignnone wp-image-770 size-medium" src="/wp-content/themes/cwd_base/images/photos/plantations_square.jpg" alt="Huatulco Coastline" width="300" height="300" /><img class="alignnone wp-image-766 size-medium" src="/wp-content/themes/cwd_base/images/photos/plantations.jpg" alt="Big Sur" width="300" height="300" /><img class="alignnone size-medium wp-image-769" src="/wp-content/themes/cwd_base/images/photos/plantations_square.jpg" alt="Brazil Beach" width="300" height="300" /><img class="alignnone wp-image-765 size-medium" src="/wp-content/themes/cwd_base/images/photos/plantations.jpg" alt="Sea and Rocks" width="300" height="300" /></div>
<h3>Two Columns (Padded)</h3>
<div class="two-col padded">
<div>Lorem ipsum dolor sit amet, amet eu hic, arcu at eros, odio sed vel ante morbi at aenean, eget leo donec turpis ligula. Felis vehicula, lacinia sed mauris, fusce accumsan adipiscing in id proin ullamcorper, enim ac arcu sed amet.</div>
<div>Lorem ipsum dolor sit amet, amet eu hic, arcu at eros, odio sed vel ante morbi at aenean, eget leo donec turpis ligula. Felis vehicula, lacinia sed mauris, fusce accumsan adipiscing in id proin ullamcorper, enim ac arcu sed amet.</div>
</div>
<a class="back-to-toc" title="Back to Top" href="#main-article"><span class="sr-only">Back to Top</span></a>';
			$styleguide_page_template = '';

			$styleguide_page_check = get_page_by_title($styleguide_page_title);
			$styleguide_page_ = array(
					'post_type' => 'page',
					'post_title' => $styleguide_page_title,
					'post_content' => $styleguide_page_content,
					'post_status' => 'publish',
					'post_author' => 1,
			);
			if(!isset($styleguide_page_check->ID)){
				$styleguide_page_id = wp_insert_post($styleguide_page_);
				if(!empty($styleguide_page_template)){
					update_post_meta($styleguide_page_id, '_wp_page_template', $styleguide_page_template);
				}
			}

			//////////////////////////////////// MAIN MENU //////////////////////////////////////////
			$main_menu_name = 'Main Menu';

			// Check if it exists
			$main_menu_exists = wp_get_nav_menu_object( $main_menu_name );

			if(!$main_menu_exists) {

				// Create it, if it doesn't exist
				$main_menu_id = wp_create_nav_menu($main_menu_name);

				// Add pages
				$homePage = wp_update_nav_menu_item($main_menu_id, 0, array(
					'menu-item-object-id' => get_page_by_path('home')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $home_page_title,
					'menu-item-status' => 'publish',
				));
				$samplePage = wp_update_nav_menu_item($main_menu_id, 0, array(
					'menu-item-object-id' => get_page_by_path('sample-page-1')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $sample_page_1_title,
					'menu-item-status' => 'publish',
				));
				$styleguidePage = wp_update_nav_menu_item($main_menu_id, 0, array(
					'menu-item-object-id' => get_page_by_path('styleguide')->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-title' => $styleguide_page_title,
					'menu-item-status' => 'publish',
				));

			}

			// Set main menu location
			$main_menu_location = get_theme_mod('nav_menu_locations');
			$main_menu_location['main-menu'] = $main_menu_id;
			set_theme_mod( 'nav_menu_locations', $main_menu_location );


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
			$top_menu_location = get_theme_mod('nav_menu_locations');
			$top_menu_location['top-menu'] = $top_menu_id;
			set_theme_mod( 'nav_menu_locations', $top_menu_location );
			

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
			$footer_menu_1_location = get_theme_mod('nav_menu_locations');
			$footer_menu_1_location['footer-menu-1'] = $footer_menu_1_id;
			set_theme_mod( 'nav_menu_locations', $footer_menu_1_location );
			

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
			$footer_menu_2_location = get_theme_mod('nav_menu_locations');
			$footer_menu_2_location['footer-menu-2'] = $footer_menu_2_id;
			set_theme_mod( 'nav_menu_locations', $footer_menu_2_location );

			// Use Home page as front page
			$home = get_page_by_title( 'Home' );
			update_option( 'page_on_front', $home->ID );
			update_option( 'show_on_front', 'page' );
			
			// Stop WordPress automatically assigning privacy policy page
			update_option( 'wp_page_for_privacy_policy', '');
			
			// Initialize post type options, set defaults
			
				// Home page options
			add_option('options_home_page_options_replace_title', 'Home');
			add_option('_options_home_page_options_replace_title', 'field_60897d918d84b');
			add_option('options_home_page_options_remove_breadcrumbs', '1');
			add_option('_options_home_page_options_remove_breadcrumbs', 'field_608989540fa5a');
			add_option('options_home_page_options', '');
			add_option('_options_home_page_options', 'field_60897d918c475');

				// Blog page options
			add_option('options_blog_page_options_replace_title', 'Latest Posts');
			add_option('_options_blog_page_options_replace_title', 'field_60898f4dc0df5');
			add_option('options_blog_page_options_add_introductory_text', '');
			add_option('_options_blog_page_options_add_introductory_text', 'field_60899328fe635');
			add_option('options_blog_page_options', '');
			add_option('_options_blog_page_options', 'field_60898f4dbe6d3');
			
				// Archive options
			add_option('options_archive_options_layout', 'right_sidebar');
			add_option('_options_archive_options_layout', 'field_604de7333ffc7');
			add_option('options_archive_options_appearance', 'list');
			add_option('_options_archive_options_appearance', 'field_604de7853ffc8');
			add_option('options_archive_options_excerpt_length', '180');
			add_option('_options_archive_options_excerpt_length', 'field_6069bdb31c366');
			add_option('options_archive_options', '');
			add_option('_options_archive_options', 'field_604de6ee3ffc6');
			
				// Footer options
			add_option('options_footer_options_address_block', '<h2 class="h5">College of Ursine Studies</h2>Address<br>Cornell University<br>Ithaca, NY 14853<br><a class="link-block" href="#">Contact Us</a>');
			add_option('options_footer_options_intro_text', 'Footer note curabitur blandit tempus porttitor.');
			add_option('options_footer_options_heading', 'Heading');
			add_option('_options_footer_options_address_block', 'field_604df04657f0e');
			add_option('_options_footer_options_intro_text', 'field_604df45cbd107');
			add_option('_options_footer_options_heading', 'field_604df0f057f0f');
			add_option('options_footer_options', '');
			add_option('_options_footer_options', 'field_604df02d57f0d');

			// When finished, we update our status to make sure we don't duplicate everytime we activate.
			update_option( 'theme_setup_status', '1' );
			
		} 
				
	}
	
	add_action( 'after_setup_theme', 'cwd_base_setup', 11 );

}