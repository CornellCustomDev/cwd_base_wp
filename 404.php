<?php 

$au_boolean = get_theme_mod('au_boolean');

if(!$au_boolean) { 
	get_header();
}
else {
	get_header('au');
} 

?>

<div id="main-content" class="band">

	<main id="main" class="container-fluid aria-target" tabindex="-1">

		<div class="row">
			
			<article id="main-article" class="primary">
					
				<?php if (function_exists('cwd_base_breadcrumbs')) cwd_base_breadcrumbs(); ?>

				<h1>Page Not Found</h1>

				<section>
					<p>The requested page could not be found.</p>
				</section>

			</article>

			<?php get_sidebar('top'); ?>
			<?php get_sidebar('bottom'); ?>

		</div>

	</main>
	
</div>

<?php get_template_part('templates/page/color', 'bands'); ?>

<?php

get_footer();