<?php

// Option name for exclusion data
define( 'CDSN_EP_OPTION_NAME', 'cdsn_exclude_pages' );

/**
 * Create and register the widget.
 */
require_once 'class-section-nav.php';
add_action( 'widgets_init', function() {
	return register_widget( 'Section_Nav' );
} );


/**
 * Display section-based navigation.
 *
 * Arguments include: 'show_all' (boolean), 'exclude' (comma delimited list of page IDs),
 * 'show_on_home' (boolean), 'show_empty' (boolean), sort_by (any valid page sort string),
 * 'a_heading' (boolean), 'before_widget' (string), 'after_widget' (strong)
 *
 * @param array|string $args Optional. Override default arguments.
 * @param bool         $echo Optional. Whether or not to output HTML
 *                           immediately. Set to false to return HTML instead.
 * @return string HTML content, if not displaying.
 */
function section_nav( $args = '', $echo = true ) {

	$args = wp_parse_args( $args, array(
		'show_all'         => false,
		'exclude'          => '',
		'hide_on_excluded' => true,
		'show_on_home'     => false,
		'show_empty'       => false,
		'sort_by'          => 'menu_order',
		'a_heading'        => false,
		'before_widget'    => '<div>',
		'after_widget'     => '</div>',
		'before_title'     => '<h2 class="widgettitle">',
		'after_title'      => '</h2>',
		'title'            => '',
	) );

	if ( ! $echo ) {
		ob_start();
	}

	the_widget(
		'Section_Nav',
		$args,
		array(
			'before_widget' => $args['before_widget'],
			'after_widget'  => $args['after_widget'],
			'before_title'  => $args['before_title'],
			'after_title'   => $args['after_title'],
		)
	);

	if ( ! $echo ) {
		return ob_get_clean();
	}
}

/**
 * Register activation hook
 */
register_activation_hook( __FILE__, 'cdsn_activate' );
