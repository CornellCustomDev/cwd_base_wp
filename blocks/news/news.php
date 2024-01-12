<?php
$filter = get_field('news_filter');
$news = cwd_base_news_block_query( $filter );

// Use fallback image from block field, if present
$block_fallback_img = get_field('news_fallback_img');
$theme_fallback_img = get_template_directory_uri() . '/images/photos/plantations.jpg';

$fallback_img = $block_fallback_img ? wp_get_attachment_image_url($block_fallback_img, 'news-listing-image') : $theme_fallback_img;

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
					<div class="cards">
					  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
					    <div class="card">
					      <div class="group-image">
					        <?php
					          $img_id = get_field('image_id', get_the_ID());
					          $img_url = $img_id ? wp_get_attachment_image_url($img_id, 'news-listing-image') : get_field('image', get_the_ID());

					          $listing_img = $img_url ?: $fallback_img;
					        ?>
					          <a href="<?php the_permalink(); ?>">

					          <div class="landscape"><img src="<?php echo $listing_img; ?>" alt=""></div>

					          <div class="overlay">
					            <h3 class="designer">
					              <span class="deco"><?php the_title(); ?></span>
					            </h3>

					            <sub-heading>News</sub-heading>

					            <p class="summary"><?php print_r(custom_excerpt(120)); ?></p>
					          </div>
					        </a>
					      </div>
					    </div>
					  <?php endwhile; ?>

					  <?php wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php else: ?>
		<p>No news items found.</p>
	<?php endif; ?>
</div>
