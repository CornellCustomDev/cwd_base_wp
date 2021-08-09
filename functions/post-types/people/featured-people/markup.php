<?php include get_theme_file_path( '/includes/featured-people/query.php' ); ?>

<?php if($featured_people_query->have_posts()) : while($featured_people_query->have_posts() ) : $featured_people_query->the_post(); ?>

<?php $text = get_field('teaser_text'); ?>


<div class="card"> 
	<div class="group-image">
		<a href="<?php the_permalink(); ?>">
			<?php cwd_base_get_image(); ?> <!-- recommend 480x480, blank alt text should be used since the link encapsulates the headline below -->
			<div class="overlay">
				<h3> <!-- .designer class provides fancier link behavior (and makes our WA team grind their teeth), omit the .designer class for standard link behavior -->
					<span class="deco"><?php echo $text; ?></span> <!-- include an interior span.deco either way, for more advanced text-decoration when needed -->
				</h3>
			</div>
		</a>
	</div>
</div>

<?php endwhile; endif; wp_reset_postdata(); ?>