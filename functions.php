<?php

/******************************************************
 All base theme functions are "pluggable" which means 
 they can be overridden in a child theme. Just copy 
 and paste the function (without the condition) into 
 your child theme's functions.php file
*******************************************************/

// Required files
require_once get_theme_file_path('/functions/post-types/general.php');
require_once get_theme_file_path('/functions/theme/setup.php');
require_once get_theme_file_path('/functions/theme/minify.php');
require_once get_theme_file_path('/functions/customizer/customize-register.php');
require_once get_theme_file_path('/functions/theme/layout.php');
require_once get_theme_file_path('/functions/theme/body-classes.php');
require_once get_theme_file_path('/functions/theme/pagination.php');
require_once get_theme_file_path('/functions/theme/widgets.php');
require_once get_theme_file_path('/functions/theme/metadata.php');
require_once get_theme_file_path('/functions/theme/dates.php');
require_once get_theme_file_path('/functions/theme/images.php');
require_once get_theme_file_path('/functions/theme/header-img.php');
require_once get_theme_file_path('/functions/theme/header-slider.php');
require_once get_theme_file_path('/functions/theme/options.php');
require_once get_theme_file_path('/functions/theme/gallery.php');
require_once get_theme_file_path('/functions/theme/styles-and-scripts.php');
require_once get_theme_file_path('/functions/theme/templating-functions.php');
require_once get_theme_file_path('/functions/navigation/menus.php');
require_once get_theme_file_path('/functions/navigation/breadcrumbs.php');
require_once get_theme_file_path('/functions/navigation/menu-classes.php');
require_once get_theme_file_path('/functions/navigation/section-nav/section-nav.php');
//require_once get_theme_file_path('/functions/theme/custom-fields/featured.php');
require_once get_theme_file_path('/functions/theme/custom-fields/featured-image.php');
require_once get_theme_file_path('/functions/theme/custom-fields/header-slider.php');
require_once get_theme_file_path('/functions/theme/custom-fields/image_id.php');
require_once get_theme_file_path('/functions/theme/custom-fields/page_links_to.php');
require_once get_theme_file_path('/functions/theme/custom-fields/remove-header-image.php');
require_once get_theme_file_path('/functions/theme/custom-fields/acf-search.php');
require_once get_theme_file_path('/functions/tinymce/editor.php');
require_once get_theme_file_path('/blocks/block_functions.php');
require_once get_theme_file_path('/blocks/custom_block_fields.php');

// Initialize post types if ACF plugin is present and activated
if ( class_exists('Acf') ) {
	include_once get_theme_file_path('/functions/post-types/init.php');
}

add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_style( 'cornell-font-fa-css', get_template_directory_uri() . '/fonts/font-awesome.min.css' );
} );

// Disable ACF error notices regarding get_field() and the_field() 
add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' );
