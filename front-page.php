<?php 

get_header(); 

?>

<div id="main-content" class="band">

	<main id="main" class="container-fluid aria-target" tabindex="-1">

		<div class="row">
			
			<?php get_sidebar('top'); ?>

			<article id="main-article" class="primary">

				<?php 
				
					if (function_exists('cwd_base_breadcrumbs')) cwd_base_breadcrumbs();
				
					get_template_part('templates/page/content', 'title');
				
					if (have_posts()): while (have_posts()) : the_post(); // The loop
				
						get_template_part('templates/page/content', 'page');
				
						if ( comments_open() || get_comments_number() ) {
							comments_template('/templates/comments.php');
						}
				
					endwhile;
				
					else: 
				
						get_template_part('templates/page/content', 'none');
				
					endif;
				
				?>
				
			</article>

			<?php get_sidebar('bottom'); ?>

		</div>

	</main>
	
</div>

<?php get_template_part('templates/page/color', 'bands'); ?>

<?php

get_footer();