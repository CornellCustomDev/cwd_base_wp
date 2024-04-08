<?php
/*

Widget areas: Section Navigation, Priority (Top) Sidebar, Secondary (Bottom) Sidebar, Home Page Widgets, Section One Widgets, Section Two Widgets, Section Three Widgets.

Widgets: Clean Markup Widget, Recent Posts Widget.

*/


// Widget Areas
if ( ! function_exists ( 'register_my_sidebars' ) ) {
	
	function register_my_sidebars() {
		register_sidebar(array(
			'name' => __('Section Navigation', 'cwd_base'),
			'description' => __('This area is meant solely for the Section Navigation widget. Drag and drop the widget here and select your options.', 'cwd_base'),
			'id' => 'widget-area-3',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h2 class="menu-block-title">',
			'after_title' => '</h2>'
		));

		register_sidebar(array(
			'name' => __('Priority (Top) Sidebar', 'cwd_base'),
			'description' => __('Appears above main content on mobile (but below section navigation).', 'cwd_base'),
			'id' => 'widget-area-1',
			'before_widget' => '<div id="%1$s" class="content-block %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>'
		));

		register_sidebar(array(
			'name' => __('Secondary (Bottom) Sidebar', 'cwd_base'),
			'description' => __('Appears below main content on mobile.', 'cwd_base'),
			'id' => 'widget-area-2',
			'before_widget' => '<div id="%1$s" class="content-block %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>'
		));
		
		register_sidebar( array(
			'name'          => __( 'Above Content', 'cwd_base' ),
			'id'            => 'sidebar-101',
			'description'   => __( 'Appears above the main content area below the page title. IMPORTANT: use the visiblilty settings to target specific pages or groups of pages, otherwise it will show up everywhere.', 'cwd_base' ),
			'before_widget' => '<div class="col-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		
		register_sidebar( array(
			'name'          => __( 'Below Conent', 'cwd_base' ),
			'id'            => 'sidebar-102',
			'description'   => __( 'Appears below the main content area above the footer. IMPORTANT: use the visiblilty settings to target specific pages or groups of pages, otherwise it will show up everywhere.', 'cwd_base' ),
			'before_widget' => '<div class="col-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		
	register_sidebar(array(
			'name' => __('Home Page Widgets', 'cwd_base'),
			'description' => __('Appears directly after the content on the home page, typically used for recent news and/or upcoming events.', 'cwd_base'),
			'id' => 'widget-area-4',
			'before_widget' => '<div id="%1$s" class="content-block %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>'
		));
		
		register_sidebar( array(
			'name'          => __( 'Section One Widgets', 'cwd_base' ),
			'id'            => 'sidebar-97',
			'description'   => __( 'A full-width, horizontal widget area. Appears below the content and above the footer.', 'cwd_base' ),
			'before_widget' => '<div class="col-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Section Two Widgets', 'cwd_base' ),
			'id'            => 'sidebar-98',
			'description'   => __( 'A full-width, horizontal widget area. Appears above the footer, below section one and above section three.', 'cwd_base' ),
			'before_widget' => '<div class="col-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Section Three Widgets', 'cwd_base' ),
			'id'            => 'sidebar-99',
			'description'   => __( 'A full-width, horizontal widget area. Appears directly above the footer, below sections one and two.', 'cwd_base' ),
			'before_widget' => '<div class="col-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		
		register_sidebar( array(
			'name'          => __( 'Footer Widget', 'cwd_base' ),
			'id'            => 'sidebar-100',
			'description'   => __( 'Appears in the footer between the address block and the menu, if a menu exists.', 'cwd_base' ),
			'before_widget' => '<div class="col-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		
	}
	add_action( 'widgets_init', 'register_my_sidebars' );
}

// Remove widgets from previous theme on activation
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
    add_action('admin_footer','remove_widgets');
}

if ( ! function_exists ( 'remove_widgets' ) ) {
	function remove_widgets(){
		//get all registered sidebars
		global $wp_registered_sidebars;
		//get saved widgets
		$widgets = get_option('sidebars_widgets');
		//loop over the sidebars and remove all widgets
		foreach ($wp_registered_sidebars as $sidebar => $value) {
			if($sidebar == 'sidebar-97' || $sidebar == 'sidebar-98' || $sidebar == 'sidebar-99') {
				unset($widgets[$sidebar]);
			}
		}
		//update with widgets removed
		update_option('sidebars_widgets',$widgets);
	}
}

// Register widgets
if ( ! function_exists ( 'cwd_base_register_widgets' ) ) {
	function cwd_base_register_widgets() {
		register_widget( 'Clean_Markup_Widget' );
		register_widget( 'Postswidget_Widget' );
	}
	add_action( 'widgets_init', 'cwd_base_register_widgets' );
}

// Clean markup widget: stop rewriting my HTML, WordPress! Please and thank you.
if ( ! class_exists ( 'Clean_Markup_Widget' ) ) {
	class Clean_Markup_Widget extends WP_Widget {
		
		public function __construct() {
			$id = 'clean_markup_widget';
			$title = esc_html__('Clean Markup Widget', 'custom-widget');
			$options = array(
				'classname' => 'clean-markup-widget',
				'description' => esc_html__('Adds clean markup that is not modified by WordPress.', 'custom-widget')
			);
			parent::__construct( $id, $title, $options );
		}
		
		public function widget( $args, $instance ) {
			$markup = '';		
			if ( isset( $instance['markup'] ) ) {			
				echo '<div class="content-block">' . wp_kses_post( $instance['markup'] ) . '</div>';
			}		
		}
		
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			if ( isset( $new_instance['markup'] ) && ! empty( $new_instance['markup'] ) ) {
				$instance['markup'] = $new_instance['markup'];
			}
			return $instance;
		}
		
		public function form( $instance ) {		
			$id = $this->get_field_id( 'markup' );		
			$for = $this->get_field_id( 'markup' );		
			$name = $this->get_field_name( 'markup' );		
			$label = __( 'Markup/text:', 'custom-widget' );		
			$markup = '<p>'. __( 'Clean, well-formatted markup.', 'custom-widget' ) .'</p>'; 
			
			if ( isset( $instance['markup'] ) && ! empty( $instance['markup'] ) ) {			
				$markup = $instance['markup'];			
			}
			
			?>
			
			<p>
				<label for="<?php echo esc_attr( $for ); ?>"><?php echo esc_html( $label ); ?></label>
				<textarea class="widefat" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>"><?php echo esc_textarea( $markup ); ?></textarea>
			</p>
			
			<?php
		}
	}
}

// Recent Posts Widget
if ( ! class_exists ( 'Postswidget_Widget' ) ) {
	class Postswidget_Widget extends WP_Widget {

		function __construct() {
			$widget_ops = array(
				'classname' => 'postswidget_widget',
				'description' => __( 'Display post teasers from any post type.', 'postswidget_widget' ),
			);
			parent::__construct( 'postswidget_widget', __( 'CWD Recent Posts', 'cwd_base' ), $widget_ops );
		}
		
		private $widget_fields = array(
			array(
				'label' => 'Heading',                
				'id' => 'heading_text',
				'type' => 'text',              
			),
			array(
				'label' => 'Post Type',                
				'id' => 'posttype_select',
				'type' => 'post_type_select',              
			),			
			array(
				'label' => 'Taxonomy',                
				'id' => 'taxonomy_select',
				'type' => 'taxonomy_select',              
			),			
			array(
				'label' => 'Show only upcoming events',
				'id' => 'upcoming_checkbox',
				'type' => 'upcoming_checkbox',
			),
			array(
				'label' => 'Order',                
				'id' => 'order_select',
				'type' => 'select',              
				'options' => array(                   
					'ASC',
					'DESC',                
				),
			),
			array(
				'label' => 'Entries',                
				'id' => 'entries_number',
				'type' => 'number',              
			),
			array(
				'label' => 'Format',                
				'id' => 'format_select',
				'type' => 'select',              
				'options' => array(                   
					'Vertical list',
					'Card grid',                
				),
			),
			array(
				'label' => 'Show thumbnail',                
				'id' => 'showthumbnail_checkbox',
				'type' => 'checkbox',              
			),
			array(
				'label' => 'Show date',                
				'id' => 'showdate_checkbox',
				'type' => 'checkbox',              
			),
			array(
				'label' => 'Show excerpt',                
				'id' => 'showexcerpt_checkbox',
				'type' => 'checkbox',              
			),
			array(
				'label' => 'Excerpt length (characters)',                
				'id' => 'excerptlength(characters)_number',
				'type' => 'number',              
			),
			array(
				'label' => 'View All Link',                
				'id' => 'view_all_link',
				'type' => 'text',              
			),
			array(
				'label' => 'View All Link Text',                
				'id' => 'view_all_link_text',
				'type' => 'text',              
			)
		);

		public function widget( $args, $instance ) {

			$heading = $instance['heading_text'];
			$post_type_select = $instance['posttype_select'];
			$taxonomy_select = $instance['taxonomy_select'];
			$show_upcoming_only = $instance['upcoming_checkbox'];
			$order_select = $instance['order_select'];
			$entries = $instance['entries_number'];
			$format  = $instance['format_select'];
			$show_thumb = $instance['showthumbnail_checkbox'];
			$show_date  = $instance['showdate_checkbox'];
			$show_excerpt = $instance['showexcerpt_checkbox'];
			$excerpt_length = $instance['excerptlength(characters)_number'];
			$view_all_link = $instance['view_all_link'];
			$view_all_link_text = $instance['view_all_link_text'];
					
			// To sort by date field...
			if( $post_type_select == 'News' ) {
				$args1 = array( 
					'post_type' => strtolower($post_type_select),
					'posts_per_page' => $entries,
					'meta_query' => array( array(
					'key' => 'make_sticky',
					'value' => '1',
					'compare' => '=',
					),
				) );			
				$query1 = new WP_Query($args1);	  
				$query1_post_ids = wp_list_pluck( $query1->posts, 'ID' );
				$terms = get_terms(strtolower($taxonomy_select));
				$term_ids = wp_list_pluck($terms, 'term_id');
				$args2 = array( 
					'post_type' => strtolower($post_type_select),
					'posts_per_page' => $entries,
					'tax_query' => array(
						array(
							'taxonomy' => strtolower($taxonomy_select),
							'field' => 'term_id',
							'terms' => $term_ids,
						)
					),
					'meta_key' => 'publication_date',
					'orderby' => 'meta_value',
					'order' => $order_select,
				);			
			}
			elseif( $post_type_select == 'Events' ) {
				$args1 = array( 
					'post_type' => strtolower($post_type_select),
					'posts_per_page' => $entries,
					'meta_query' => array( array(
					'key' => 'make_sticky',
					'value' => '1',
					'compare' => '=',
					),
				) );			
				$today = current_time('Ymd');
				$query1 = new WP_Query($args1);	  
				$query1_post_ids = wp_list_pluck( $query1->posts, 'ID' );
				$terms = get_terms(strtolower($taxonomy_select));
				$term_ids = wp_list_pluck($terms, 'term_id');
				
				if($show_upcoming_only == 1) { 
				
					$args2 = array( 
						'post_type' => strtolower($post_type_select),
						'posts_per_page' => $entries,
						'post__not_in' => $query1_post_ids,
						'meta_query' => array(
							array(
								'key' => 'date',
								'value' => $today,
								'compare' => '>=',
							),
						),
						'tax_query' => array(
							array(
								'taxonomy' => strtolower($taxonomy_select),
								'field' => 'term_id',
								'terms' => $term_ids,
							)
						),
						'orderby' => 'date',
						'order' => $order_select,
					);
					
				}
				else { 
				
					$args2 = array( 
						'post_type' => strtolower($post_type_select),
						'posts_per_page' => $entries,
						'post__not_in' => $query1_post_ids,
						'tax_query' => array(
							array(
								'taxonomy' => strtolower($taxonomy_select),
								'field' => 'term_id',
								'terms' => $term_ids,
							)
						),
						'meta_key' => 'date',
						'orderby' => 'meta_value',
						'order' => $order_select,
					);			
					
				}
			}
			else {
				$args1 = array( 
					'post_type' => strtolower($post_type_select),
					'posts_per_page' => $entries,
					'meta_query' => array( array(
					'key' => 'make_sticky',
					'value' => '1',
					'compare' => '=',
					),
				) );			
				$query1 = new WP_Query($args1);	  
				$query1_post_ids = wp_list_pluck( $query1->posts, 'ID' );
				$terms = get_terms(strtolower($taxonomy_select));
				$term_ids = wp_list_pluck($terms, 'term_id');
				$args2 = array( 
					'post_type' => strtolower($post_type_select),
					'posts_per_page' => $entries,
					'tax_query' => array(
						array(
							'taxonomy' => strtolower($taxonomy_select),
							'field' => 'term_id',
							'terms' => $term_ids,
						)
					),
					'orderby' => 'post_date',
					'order' => $order_select,
				);			
			}
			
			$query2 = new WP_Query($args2);	 
			
			$results = new WP_Query();	  
			$results->posts = array_merge($query1->posts, $query2->posts);
			$results->post_count = $query1->post_count + $query2->post_count;
			
			//$archive_options = get_field('archive_options', 'options'); ?>

			<div class="content-block cwd-component cwd-basic no-overlay<?php if( $format == 'Card grid' ) { echo ' tiles'; } ?>">
				
				<?php //echo $post_type_select . ' | ' . $meta_key . ' | ' . strtolower($post_type_select) . ' | ' . $entries . ' | ' . $query->found_posts; ?>

				<?php $the_sidebar = is_active_widget( false, false, $this->id_base, true ); ?> 

				<div class="header-with-button">

					<?php if($heading) { ?>
						<h2><?php echo $heading; ?></h2>
					<?php } ?>

					<?php if($view_all_link && $view_all_link_text) { ?>

						<div class="buttons<?php if(!$heading){ echo ' no-widget-heading'; } ?>">
							<?php if($the_sidebar == 'widget-area-1' || $the_sidebar == 'widget-area-2') { ?>
							<a class="link-button" href="<?php echo $view_all_link; ?>">
								<?php } else { ?>
							<a class="link-button" href="<?php echo $view_all_link; ?>" class="link-button">
								<?php } ?>
								<span><?php echo $view_all_link_text; ?></span>
								<span class="zmdi zmdi-arrow-right"></span>
							</a>
						</div>

					<?php } ?>

				</div>
						

				<div class="cards<?php if( $format == 'Vertical list' ) { echo ' flex-grid'; } ?>">
					
					<?php 
			
						if($post_type_select == 'Events') {

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
					?>

					<?php 
						if($post_type_select == 'News') {

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
					?>

					<?php $i = 1; if ($results->have_posts()): while ($results->have_posts() && ($i <= $entries)) : $results->the_post(); // The Loop: we only want $entries posts ?>

						<div id="post-<?php the_ID(); ?>" <?php post_class('card flex-4'); ?>>

							<div class="group-image">

								<a href="<?php echo the_permalink(); ?>">

									<?php 
										if($show_thumb == 1) {
											if($post_type_select == 'Galleries') {
												cwd_base_catch_that_image();
											}
											else {
												cwd_base_get_image();
											}
										}
									?>

									<div class="overlay">
										<h3>
											<span class="deco">
												<?php the_title(); ?>
											</span>
										</h3>
									</div>

								</a>

							</div>

							<div class="group-fields<?php if($show_thumb != 1) { echo ' no-thumb'; } ?>">

								<?php 
									if($show_date == 1) {
										cwd_base_get_the_date();
									}
								?>

								<?php if($show_excerpt == 1) { ?>
									<p class="summary">
										<?php echo custom_excerpt($excerpt_length); // Characters ?>
									</p>
								<?php } ?>

							</div>

						</div>

					<?php

					$i++; endwhile;
			
					else: 

						echo '<p class="no-content">Nothing to display.</p>';

					endif;

					wp_reset_postdata(); ?>

				</div>

			</div>

		<?php }

		public function field_generator( $instance ) {
			$output = '';
			foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset($widget_field['default']) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'cwd_base' );

			switch ( $widget_field['type'] ) {

				case 'checkbox':
				$output .= '<p>';
				$output .= '<input class="checkbox" type="checkbox" '.checked( $widget_value, true, false ).' id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" value="1">';
				$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'cwd_base' ).'</label>';
				$output .= '</p>';
				break;

				case 'select':
				$output .= '<p>';
				$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'cwd_base' ).':</label> ';
				$output .= '<select id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'">';
				foreach ($widget_field['options'] as $option) {
					if ($widget_value == $option) {
					$output .= '<option value="'.$option.'" selected>'.$option.'</option>';
					} else {
					$output .= '<option value="'.$option.'">'.$option.'</option>';
					}
				}
				$output .= '</select>';
				//$output .= '<p class="select help">(The format option will have no effect, if displaying this widget in the sidebar.)</p>';
				$output .= '</p>';
				break;

				case 'post_type_select':
				$output .= '<p>';
				$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'cwd_base' ).':</label> ';
				$output .= '<select id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'">';
				$all_post_types = get_post_types(array('public' => true), 'names');
				foreach ($all_post_types as $post_type) {
					$post_type = ucwords($post_type);
					if ($widget_value == $post_type && $post_type != 'Slider' && $post_type != 'Attachment' && $post_type != 'Frm_display') {
					$output .= '<option value="'.$post_type.'" selected>'.$post_type.'</option>';
					} elseif ($post_type != 'Slider' && $post_type != 'Attachment' && $post_type != 'Frm_display') {
					$output .= '<option value="'.$post_type.'">'.$post_type.'</option>';
					}
				}
				$output .= '</select>';
				$output .= '</p>';
				break;
	
				case 'taxonomy_select':
				$output .= '<p>';
				$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'cwd_base' ).':</label> ';
				$output .= '<select id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'">';
				$all_taxonomies = get_taxonomies(array('public' => true), 'names');
				foreach ($all_taxonomies as $taxonomy) {
					$taxonomy = ucwords($taxonomy);
					if ($widget_value == $taxonomy) {
					$output .= '<option value="'.$taxonomy.'" selected>'.$taxonomy.'</option>';
					} elseif ($taxonomy != 'Slider' && $taxonomy != 'Attachment' && $taxonomy != 'Frm_display') {
					$output .= '<option value="'.$taxonomy.'">'.$taxonomy.'</option>';
					}
				}
				$output .= '</select>';
				$output .= '</p>';
				break;
		
				case 'order_select':

				if ($instance['posttype_select'] != 'People') {  
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'cwd_base' ).':</label> ';
					$output .= '<select id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'">';
					foreach ($widget_field['options'] as $option) {
						if ($widget_value == $option) {
						$output .= '<option value="'.$option.'" selected>'.$option.'</option>';
						} else {
						$output .= '<option value="'.$option.'">'.$option.'</option>';
						}
					}
					$output .= '</select>';
					$output .= '</p>';
				}
				break;

				case 'upcoming_checkbox':
				if ($instance['posttype_select'] == 'Events') {  
					$output .= '<p>';
					$output .= '<input class="checkbox" type="checkbox" '.checked( $widget_value, true, false ).' id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" value="1">';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'cwd_base' ).'</label>';
					$output .= '</p>';
				}
				break;

				default:
				$output .= '<p>';
				$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'cwd_base' ).':</label> ';
				$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
				$output .= '</p>';

			} // End switch

			} // End foreach

			echo $output;

		} // End field_generator funcion

		public function form( $instance ) {
			$this->field_generator( $instance );
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();

			foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
				$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
			}
			return $instance;
		}
		
	}
}

// Get all post types
//function get_all_post_types() {
	//$post_types = get_post_types();
	//return $post_types;
//}

// Display the widget ID in the backend (all widgets)
if ( ! function_exists ( 'cwd_base_get_widget_id' ) ) {
	function cwd_base_get_widget_id($widget_instance) {
		
		if ($widget_instance->number=="__i__"){
			echo '<p class="widget-id-message">' . __('Save the widget to get its ID','cwd_base') . '</p>';
		}
		else {
			echo '<p class="widget-id-message">' . __('This widget\'s ID is:','cwd_base') . ' ' . $widget_instance->id . '</p>';
		}
		
	}
	add_action('in_widget_form', 'cwd_base_get_widget_id');
}