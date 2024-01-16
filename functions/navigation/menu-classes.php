<?php

// Add current menu item class to custom post type archives
if ( ! function_exists( 'nav_parent_class' ) ) {
	function nav_parent_class( $classes, $item ) {
		
		$current_menu_item_slug = basename($item->url);

		if( $current_menu_item_slug == get_post_type() && ! is_admin() ) {
			$classes[] = 'current-page-ancestor';
		}

		return $classes;
	}
	add_filter( 'nav_menu_css_class', 'nav_parent_class', 10, 2 );
}