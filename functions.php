<?php

/******************************************************
 All base theme functions are "pluggable" which means 
 they can be overridden in a child theme. Just copy 
 and paste the function (without the condition) into 
 your child theme's functions.php file
*******************************************************/

// Required files
require_once locate_template('/functions/post-types/general.php');
require_once locate_template('/functions/theme/setup.php');
require_once locate_template('/functions/theme/minify.php');
require_once locate_template('/functions/customizer/customize-register.php');
require_once locate_template('/functions/theme/layout.php');
require_once locate_template('/functions/theme/body-classes.php');
require_once locate_template('/functions/theme/pagination.php');
require_once locate_template('/functions/theme/widgets.php');
require_once locate_template('/functions/theme/metadata.php');
require_once locate_template('/functions/theme/dates.php');
require_once locate_template('/functions/theme/images.php');
require_once locate_template('/functions/theme/header-img.php');
require_once locate_template('/functions/theme/header-slider.php');
require_once locate_template('/functions/theme/options.php');
require_once locate_template('/functions/theme/gallery.php');
require_once locate_template('/functions/theme/styles-and-scripts.php');
require_once locate_template('/functions/theme/templating-functions.php');
require_once locate_template('/functions/navigation/menus.php');
require_once locate_template('/functions/navigation/breadcrumbs.php');
require_once locate_template('/functions/navigation/menu-classes.php');
require_once locate_template('/functions/navigation/section-nav/section-nav.php');
//require_once locate_template('/functions/theme/custom-fields/featured.php');
require_once locate_template('/functions/theme/custom-fields/featured-image.php');
require_once locate_template('/functions/theme/custom-fields/header-slider.php');
require_once locate_template('/functions/theme/custom-fields/image_id.php');
require_once locate_template('/functions/theme/custom-fields/page_links_to.php');
require_once locate_template('/functions/theme/custom-fields/remove-header-image.php');
require_once locate_template('/functions/theme/custom-fields/acf-search.php');
require_once locate_template('/functions/tinymce/editor.php');
require_once locate_template('/blocks/block_functions.php');
require_once locate_template('/blocks/custom_block_fields.php');

// Initialize post types if ACF plugin is present and activated
if ( class_exists('Acf') ) {
	include_once locate_template('/functions/post-types/init.php');
}

add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_style( 'cornell-font-fa-css', get_template_directory_uri() . '/fonts/font-awesome.min.css' );
} );

// Disable ACF error notices regarding get_field() and the_field() 
add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' );