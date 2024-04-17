<?php
/*
 * Style block previews in block editor
 */
add_theme_support( 'editor-styles' );

add_action( 'enqueue_block_editor_assets', 'cwd_base_enqueue_block_editor_styles' );

function cwd_base_enqueue_block_editor_styles() {
	// Apply front-end styles to blocks
	wp_enqueue_style( 'block-editor-freight', '//use.typekit.net/nwp2wku.css');
	wp_enqueue_style( 'block-editor-helper-styles', get_template_directory_uri() . '/css/block_editor.css' );
}

/*
 * Allow blocks to be set to full-width alignment
 */
add_theme_support( 'align-wide' );

/*
 * Add custom block categories to editor
 */
add_filter( 'block_categories_all', 'cwd_base_block_categories', 10, 2 );

function cwd_base_block_categories( $block_categories, $block_editor_context ) {
	// General CWD blocks
	array_unshift( $block_categories, array(
		'slug'  => 'cwd-general',
		'title' => 'Custom Web Development'
	) );

	// Full-width blocks
	array_unshift( $block_categories, array(
		'slug'  => 'cwd-full-width',
		'title' => 'Full-Width'
	) );

	return $block_categories;
}

/*
 * Register custom CWD blocks
 */
add_action( 'init', 'cwd_base_register_blocks' );

function cwd_base_register_blocks() {
	// General-use blocks
	register_block_type( __DIR__ . '/accordions' );
	register_block_type( __DIR__ . '/flex-cards' );
	register_block_type( __DIR__ . '/card-slider' );
	register_block_type( __DIR__ . '/wysiwyg' );
}

/*
 * Add custom fields to blocks
 */
include_once( 'custom_block_fields.php' );

/*
 * Limit block types allowed in editor
 */
if ( ! function_exists( 'cwd_base_allowed_block_types' ) ) {
	add_filter( 'allowed_block_types_all', 'cwd_base_allowed_block_types', 10, 2 );

	function cwd_base_allowed_block_types( $allowed_block_types, $block_editor_context ) {
		// $allowed_block_types defaults to true so we still need to get the full list
		$all_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

		// Comment out blocks to include them in editor
		// Or add blocks to remove them from editor
		// (This is a complete list at time of writing but new plugins may add blocks)
		$disallowed_blocks = array(
			'core/legacy-widget',
			'core/widget-group',
			'core/archives',
			'core/avatar',
			'core/calendar',
			'core/categories',
			'core/comment-author-name',
			'core/comment-content',
			'core/comment-date',
			'core/comment-edit-link',
			'core/comment-reply-link',
			'core/comment-template',
			'core/comments',
			'core/comments-pagination',
			'core/comments-pagination-next',
			'core/comments-pagination-numbers',
			'core/comments-pagination-previous',
			'core/comments-title',
			'core/cover',
			'core/details',
			'core/file',
			'core/footnotes',
			'core/gallery',
			'core/home-link',
			//'core/image',
			'core/latest-comments',
			'core/latest-posts',
			'core/loginout',
			'core/navigation',
			'core/navigation-link',
			'core/navigation-submenu',
			'core/page-list',
			'core/pattern',
			'core/post-author',
			'core/post-author-biography',
			'core/post-author-name',
			'core/post-comments-form',
			'core/post-content',
			'core/post-date',
			'core/post-excerpt',
			'core/post-featured-image',
			'core/post-navigation-link',
			'core/post-template',
			'core/post-terms',
			'core/post-title',
			'core/query',
			'core/query-no-results',
			'core/query-pagination',
			'core/query-pagination-next',
			'core/query-pagination-numbers',
			'core/query-pagination-previous',
			'core/query-title',
			'core/read-more',
			'core/rss',
			'core/search',
			//'core/shortcode',
			'core/site-logo',
			'core/site-tagline',
			'core/site-title',
			'core/social-link',
			'core/tag-cloud',
			'core/template-part',
			'core/term-description',
			'core/audio',
			'core/button',
			'core/buttons',
			'core/code',
			//'core/column',
			//'core/columns',
			'core/embed',
			'core/freeform',
			//'core/group',
			//'core/heading',
			//'core/html',
			'core/list',
			'core/list-item',
			//'core/media-text',
			'core/missing',
			'core/more',
			'core/nextpage',
			//'core/paragraph',
			'core/preformatted',
			'core/pullquote',
			'core/quote',
			'core/separator',
			'core/social-links',
			'core/spacer',
			'core/table',
			//'core/text-columns',
			'core/verse',
			'core/video',
			//'formidable/simple-form',
			'formidable/calculator',
			'core/post-comments',
			'sbi/sbi-feed-block',
			//'core/row',
			//'core/query-loop',
		);

		// Current page information
		$post = $block_editor_context->post->ID;
		$page_layout = get_post_meta( $post, 'layout_option' )[0]; // sidebar?

		// Add additional blocks to the disallowed list based on block category
		foreach ( $all_blocks as $block ) {
			// If the page is not full-width, disallow full-width blocks
			if ( $page_layout != 'no_sidebar' && $block->category == 'cwd-full-width' ) {
				array_push( $disallowed_blocks, $block->name );
			}
		}

		// Filter the unwanted blocks out of the array
		$allowed_blocks = array_filter( $all_blocks, function( $block ) use( $disallowed_blocks ) {
			return !in_array( $block->name, $disallowed_blocks );
		});

		return array_keys( $allowed_blocks );
	}
}
