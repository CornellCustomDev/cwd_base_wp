<?php 

$au_boolean = get_theme_mod('au_boolean');

if(!$au_boolean) { 
	get_header();
}
else {
	get_header('au');
} 

$term = get_queried_object()->slug;
$term_id = get_queried_object()->term_id;

$post_type = get_post_type();

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
				
				if( is_active_sidebar('sidebar-101') ) { 
					dynamic_sidebar('sidebar-101');
				}

				?>
				
				<p><span class="intro"><?php echo term_description($term_id); ?></span></p>
				
				<section>

					<?php $archive_options = get_field('archive_options', 'options'); ?>
						
					<div class="cwd-component cwd-basic no-overlay<?php if( $archive_options[$post_type]['appearance_' . $post_type] == 'grid' ) { echo ' tiles'; } ?>">

						<div class="cards<?php if( $archive_options[$post_type]['appearance_' . $post_type] == 'grid' ) { echo ' flex-grid'; } ?>">

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
				
				<?php 
					if( is_active_sidebar('sidebar-102') ) { 
						dynamic_sidebar('sidebar-102');
					}
				?>

				<?php if( function_exists('cwd_pagination') ) cwd_pagination(); ?>	

			</article>

			<?php get_sidebar('bottom'); ?>

		</div>

	</main>
	
</div>

<?php get_template_part('templates/page/color', 'bands'); ?>

<?php

get_footer();