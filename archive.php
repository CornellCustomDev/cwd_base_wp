<?php 

get_header(); 

$post_type = get_queried_object()->name;

?>

<div id="main-content" class="band">

	<main id="main" class="container-fluid aria-target" tabindex="-1">

		<div class="row">
			
			<?php get_sidebar('top'); ?>

			<article id="main-article" class="primary">

				<?php 
				
				if (function_exists('cwd_base_breadcrumbs')) cwd_base_breadcrumbs();
				
				get_template_part('templates/page/content', 'title');
				
				// Interrupt the default query to grab some content from custom post type archive main 
				// pages. Need to add more content types as needed. The page name MUST be the same as 
				// the post type slug for this to work.
				if($post_type == 'news' || $post_type == 'events' || $post_type == 'people' || $post_type == 'courses' || $post_type == 'testimonials' || $post_type == 'photo_galleries') {
					
					$new_query = new WP_Query( 'pagename='.$post_type );
					if( $new_query->have_posts() ) : $new_query->the_post();
						the_content();
					endif;

					wp_reset_postdata();
				
				}
				
				?>
				
				<section>

					<?php $archive_options = get_field('archive_options', 'options'); ?>
						
					<div class="cwd-component cwd-basic no-overlay<?php if( $archive_options['appearance'] == 'grid' ) { echo ' tiles'; } ?>">

						<div class="cards<?php if( $archive_options['appearance'] == 'grid' ) { echo ' flex-grid'; } ?>">
							
							<?php 
								if($post_type == 'events') {
									
									// Custom events query to manipulate date fields
									$events_args = array( 
										'post_type' => 'events',
										'posts_per_page' => -1,
									);	
									
									$events_query = new WP_Query($events_args);	
									
									// Get all events
									$events_query = $events_query->get_posts();	
									
									foreach($events_query as $event) {
										
										// Get the dates
										$date = get_field( 'date', $event->ID );

										// Convert them
										$new_date = date( 'Ymd', strtotime( $date ) );

										// Update them in the database
										update_field('date', $new_date, $event->ID);

									}
									
									wp_reset_query(); // Nothing to see here. Move along.
								}
							?>
							
							<?php 
								if($post_type == 'news') {
									
									// Custom news query to manipulate date fields
									$news_args = array( 
										'post_type' => 'news',
										'posts_per_page' => -1,
									);	
									
									$news_query = new WP_Query($news_args);	
									
									// Get all news
									$news_query = $news_query->get_posts();	
									
									foreach($news_query as $news) {
										
										// Get the dates
										$date = get_field( 'publication_date', $news->ID );

										// Convert them
										$new_date = date( 'Ymd', strtotime( $date ) );

										// Update them in the database
										update_field('publication_date', $new_date, $news->ID);

									}
									
									wp_reset_query(); // Nothing to see here. Move along.
								}
							?>
							
							<?php 
							
							// The Loop
							if (have_posts()): while (have_posts()) : the_post(); // The loop
								
								// Generic archives template. To customize by post type, create /templates/post/content-archive-$post_type.php
								get_template_part('templates/post/content-archive', $post_type);

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