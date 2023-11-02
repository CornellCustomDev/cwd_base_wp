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
	register_block_type( __DIR__ . '/flex-cards' );
	register_block_type( __DIR__ . '/full-width/cards' );
	register_block_type( __DIR__ . '/full-width/events' );
	register_block_type( __DIR__ . '/news' );
	register_block_type( __DIR__ . '/quote' );
	register_block_type( __DIR__ . '/tabs' );
	register_block_type( __DIR__ . '/wysiwyg' );
	register_block_type( __DIR__ . '/accordions' );

}

/*
 * Add custom fields to blocks
 */
include_once( 'custom_block_fields.php' );

/*
 * Events block query
 */
function cwd_base_events_block_query( $count, $taxonomy_terms ) {
	$query_args = array(
		'post_type' => 'events',
		'posts_per_page' => $count,
		'meta_query' => array(
			array(
				'key' => 'date',
				'value' => current_time('Ymd'),
				'compare' => '>=',
			),
		),
		'orderby' => 'meta_value',
		'meta_key' => 'date',
		'order' => 'ASC'
	);

	// If a taxonomy term is set in the filter field
	if ( $taxonomy_terms ) {
		$tax_query = _cwd_base_generate_tax_query( $taxonomy_terms );

		// Add taxonomy query to main query args
		$query_args['tax_query'] = $tax_query;
	}

	return new WP_Query( $query_args );
}

/*
 * News block query
 */
function cwd_base_news_block_query( $taxonomy_terms ) {
	$query_args = array(
		'post_type' => 'news',
		'posts_per_page' => 3,
		'orderby' => 'meta_value',
		'meta_key' => 'publication_date',
		'order' => 'DESC'
	);

	// If a taxonomy term is set in the filter field
	if ( $taxonomy_terms ) {
		$tax_query = _cwd_base_generate_tax_query( $taxonomy_terms );

		// Add taxonomy query to main query args
		$query_args['tax_query'] = $tax_query;
	}

	return new WP_Query( $query_args );
}

/*
 * Create taxonomy query array for both Events & News blocks
 */
function _cwd_base_generate_tax_query( $taxonomy_terms ) {
	$tax_query = array();

	// For multiple terms, add relation
	if ( count( $taxonomy_terms ) > 1 ) {
		$tax_query['relation'] = 'OR';
	}

	foreach( $taxonomy_terms as $term ) {
		// Add query array for each term
		$term_query = array(
			'taxonomy' => $term->taxonomy,
			'terms' => $term->term_id
		);

		array_push( $tax_query, $term_query );
	}

	return $tax_query;
}

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
			'core/file',
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
			//'core/freeform',
			//'core/group',
			//'core/heading',
			//'core/html',
			//'core/list',
			//'core/list-item',
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
			//'core/table',
			//'core/text-columns',
			'core/verse',
			'core/video',
			//'formidable/simple-form',
			'formidable/calculator',
			'core/post-comments',
			'sbi/sbi-feed-block',
			//'core/row',
			'core/query-loop',
		);

		// Filter the unwanted blocks out of the array
		$allowed_blocks = array_filter( $all_blocks, function( $block ) use( $disallowed_blocks ) {
			return !in_array( $block->name, $disallowed_blocks );
		});

		return array_keys( $allowed_blocks );
	}
}
