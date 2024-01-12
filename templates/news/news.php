<?php 

// Subsite people pages get special header
$header_footer_args = sopp_page_is_in_subsite( get_the_ID() ) ? 'ci' : '';
get_header( $header_footer_args );

// Get correct page of results
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

// Set up default query args
$query_args = array(
	'posts_per_page' => 10,
	'post_type' => 'news',
	'paged' => $paged,
);

// Get program/center of current page
$programs = wp_get_post_terms( get_the_ID(), 'programs-and-institutes', array( 'fields' => 'slugs' ) );

// If on a program/center News page, filter by that program/center
// (Account for multiple programs even though it shouldn't happen)
if ( count( $programs ) ) {
	// Add programs to tax query
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'programs-and-institutes',
			'field' => 'slug',
			'terms' => $programs
		)
	);
}

// Create the query
$news_query = new WP_Query( $query_args );

// Get archive options for news
$archive_options = get_field('archive_options', 'option')['news'];

?>

<div id="main-content" class="band">

	<main id="main" class="container-fluid aria-target" tabindex="-1">

		<div class="row">

			<?php get_sidebar('top'); ?>

			<article id="main-article" class="primary">

				<?php

				if (function_exists('cwd_base_breadcrumbs')) cwd_base_breadcrumbs();

				get_template_part('templates/page/content', 'title');

				?>

				<?php if ( get_the_content() != '' ): ?>

					<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php the_content(); ?>

					</section>

				<?php endif; ?>

				<section>

					<div class="cwd-component cwd-basic no-overlay<?php if( $archive_options['appearance_news'] == 'grid' ) { echo ' tiles'; } ?>">

						<div class="cards<?php if( $archive_options['appearance_news'] == 'grid' ) { echo ' flex-grid'; } ?>">

							<?php if ( $news_query->have_posts() ): ?>

								<?php while ($news_query->have_posts()) : $news_query->the_post();?>

									<div id="post-<?php the_ID(); ?>" <?php post_class('card flex-4'); ?>>

										<div class="group-image">

											<a href="<?php echo the_permalink(); ?>">

												<div class="square"><?php cwd_base_get_image(); ?></div>

												<div class="overlay">
													<h2 class="h3">
														<span class="deco">
															<?php the_title(); ?>
														</span>
													</h2>
												</div>

											</a>

										</div>

										<div class="group-fields">

											<?php //cwd_base_get_the_date(); ?>

											<p class="summary">

												<?php

												$excerpt_length = $archive_options['excerpt_length_news'];

												echo custom_excerpt($excerpt_length);

												?>
											</p>

											<?php echo sopp_get_metadata_markup(); ?>

										</div>

									</div>

								<?php endwhile; ?>

							<?php

							else:

								get_template_part('templates/page/content', 'none');

							endif;

							?>

						</div>

					</div>

				</section>

				<?php if( function_exists('cwd_pagination') ) cwd_pagination($news_query); ?>

			</article>

			<?php get_sidebar('bottom'); ?>

		</div>

	</main>

</div>

<?php get_template_part('templates/page/color', 'bands'); ?>

<?php

get_footer( $header_footer_args );
