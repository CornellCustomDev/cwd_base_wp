<?php 

get_header(); 

$page_object = get_post(get_the_ID());
$page_name = $page_object->post_name;

/* $all_custom_post_types = get_all_custom_post_types();

foreach($all_custom_post_types as $k => $v) {
	echo $v . ' => ' . ucwords(str_replace('_', ' ', $v)) . '<br>';
}

echo '<br>------------<br><br>';

var_dump($all_custom_post_types);

$custom_post_types = get_all_custom_post_types();
var_dump($custom_post_types);

the_sub_field('options_post_type_options_post_types');

if( get_field('post_type_options_post_types') ) {
	the_field('post_type_options_post_types');
} */

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

					if (have_posts()):  // The loop

						while (have_posts()) : the_post();

							// Generic page template. To customize by page, create /templates/page/content-page-$page_name.php
							get_template_part('templates/page/content-page', $page_name);

							if ( comments_open() || get_comments_number() ) {
								comments_template('/templates/comments.php');
							}

						endwhile;

					else: 

						get_template_part('templates/page/content', 'none');

					endif;
				
				?>
				
				<?php 
					if( is_active_sidebar('sidebar-102') ) { 
						dynamic_sidebar('sidebar-102');
					}
				?>

			</article>

			<?php get_sidebar('bottom'); ?>

		</div>

	</main>
	
</div>

<?php get_template_part('templates/page/color', 'bands'); ?>

<?php

get_footer();