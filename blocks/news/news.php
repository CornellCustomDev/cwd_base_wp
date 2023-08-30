<?php
$filter = get_field('news_filter');
$news = cwd_news_block_query( $filter );

// Use fallback image from block field, if present
$block_fallback_img = get_field('news_fallback_img');
$fallback_img = $block_fallback_img ? wp_get_attachment_image_url($block_fallback_img, 'news-listing-image') : null;

$classes = array( 'news-block', $block['className'] ?? null );
?>

<?php if ( $all_link = get_field('news_view_all_link') ): ?>
	<div class="buttons buttons-page-block"><a href="<?php echo $all_link['url']; ?>" class="link-more"><?php echo $all_link['title']; ?></a></div>
<?php endif; ?>

<div class="<?php echo implode( ' ', array_filter( $classes ) ); ?>">
	<?php if ( $news->have_posts() ) : ?>
		<div class="flex-grid">
			<div class="flex-12 news-tiles">
				<div class="cwd-component cwd-basic cwd-news tiles no-overlay max-3">
					<?php cwd_news_cards_markup( $news, $fallback_img); ?>
				</div>
			</div>
		</div>
	<?php else: ?>
		<p>No news items found.</p>
	<?php endif; ?>
</div>
