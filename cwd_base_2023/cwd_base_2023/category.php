<?php 

get_header(); 

$category = get_queried_object()->slug;
$category_id = get_queried_object()->term_id;

$post_type = get_post_type();

remove_filter('term_description','wpautop');

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
				
				<!-- Category description, if it exists -->
				<?php if(category_description($category_id)) { ?>
					<p><span class="intro"><?php echo category_description($category_id); ?></span></p>
				<?php } ?>
				
				<section>

					<?php $archive_options = get_field('archive_options', 'options'); ?>
						
					<div class="cwd-component cwd-basic no-overlay<?php if( $archive_options[$post_type]['appearance_' . $post_type] == 'grid' ) { echo ' tiles'; } ?>">

						<div class="cards<?php if( $archive_options[$post_type]['appearance_' . $post_type] == 'grid' ) { echo ' flex-grid'; } ?>">

							<?php 
							
							if (have_posts()): while (have_posts()) : the_post(); // The loop
								
								// Generic category template. To customize by post type, create /templates/post/content-category-$category.php
								get_template_part('templates/post/content-category', $category);

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