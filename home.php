<?php

$au_boolean = get_theme_mod('au_boolean');

if(!$au_boolean) {
	get_header();
}
else {
	get_header('au');
}

// Add custom intro text for posts page, if present in theme options
$blog_page_options = get_field('blog_page_options', 'options');
$intro_text = $blog_page_options['add_introductory_text'];

// Blog layout (single or multi-column)
$blog_layout = get_option('blog_layout');

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

					<?php if ( $intro_text ): ?>
						<?php echo $intro_text; ?>
					<?php endif; ?>

					<div class="cwd-component cwd-basic no-overlay<?php if( $blog_layout == 'multicolumnblog' ) { echo ' tiles'; } ?>">

						<div class="cards<?php if( $blog_layout == 'multicolumnblog' ) { echo ' flex-grid'; } ?>">

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
