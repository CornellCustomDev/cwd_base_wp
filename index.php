<?php 

$au_boolean = get_theme_mod('au_boolean');

if(!$au_boolean) { 
	get_header();
}
else {
	get_header('au');
} 

$post_type = get_post_type();

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

				<section>

					<?php $archive_options = get_field('archive_options', 'options'); ?>
						
					<div class="cwd-component cwd-basic no-overlay<?php if( $archive_options[$post_type]['appearance_' . $post_type] == 'grid' ) { echo ' tiles'; } ?>">

						<div class="cards<?php if( $archive_options[$post_type]['appearance_' . $post_type] == 'grid' ) { echo ' flex-grid'; } ?>">

							<?php 

							if (have_posts()): while (have_posts()) : the_post(); // The loop

								get_template_part('templates/post/content', 'archive');

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