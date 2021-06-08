<?php 

get_header(); 

$term = get_queried_object()->slug;
$term_id = get_queried_object()->term_id;

remove_filter('term_description','wpautop'); // No formatting

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
				
				<p><span class="intro"><?php echo term_description($term_id); ?></span></p>
				
				<section>

					<?php $archive_options = get_field('archive_options', 'options'); ?>
						
					<div class="cwd-component cwd-basic no-overlay<?php if( $archive_options['appearance'] == 'grid' ) { echo ' tiles'; } ?>">

						<div class="cards<?php if( $archive_options['appearance'] == 'grid' ) { echo ' flex-grid'; } ?>">

							<?php 
							
							if (have_posts()): while (have_posts()) : the_post(); // The loop
								
								// Generic taxonomy template. To customize by taxonomy, create /templates/post/content-taxonomy-$term.php
								get_template_part('templates/post/content-taxonomy', $term);

							endwhile;

							else: 

								get_template_part('templates/page/content', 'none');

							endif;

							?>

						</div>

					</div>

				</section>

				<?php if( function_exists('cwd_pagination') ) cwd_pagination(); ?>	

			</article>

			<?php get_sidebar('bottom'); ?>

		</div>

	</main>
	
</div>

<?php get_template_part('templates/page/color', 'bands'); ?>

<?php

get_footer();