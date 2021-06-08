<?php

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
			'name'          => __( 'Section One Widgets', 'cwd_base' ),
			'id'            => 'sidebar-5',
			'description'   => __( 'Appears above the footer. Change the titles of these sections using the Section Titles tab on the Customize page (under the Appearance menu).', 'cwd_base' ),
			'before_widget' => '<div class="col-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Section Two Widgets', 'cwd_base' ),
			'id'            => 'sidebar-6',
			'description'   => __( 'Appears above the footer. Change the titles of these sections using the Section Titles tab on the Customize page (under the Appearance menu).', 'cwd_base' ),
			'before_widget' => '<div class="col-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Section Three Widgets', 'cwd_base' ),
			'id'            => 'sidebar-7',
			'description'   => __( 'Appears above the footer. Change the titles of these sections using the Section Titles tab on the Customize page (under the Appearance menu).', 'cwd_base' ),
			'before_widget' => '<div class="col-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Widget Area', 'cwd_base' ),
			'id'            => 'sidebar-8',
			'description'   => __( 'Appears in the footer on all posts and pages (above the footer text area).', 'cwd_base' ),
			'before_widget' => '<div class="col-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

	}
	add_action( 'widgets_init', 'register_my_sidebars' );
}

// Clean markup means stop rewriting my HTML. Please and thank you.
function cwd_base_register_widgets() {
	
	register_widget( 'Clean_Markup_Widget' );
	
}
add_action( 'widgets_init', 'cwd_base_register_widgets' );

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
			echo wp_kses_post( $instance['markup'] );			
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