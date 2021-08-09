<?php include get_theme_file_path( '/functions/post-types/courses/featured-courses/query.php' ); ?>

<?php if($featured_courses_query->have_posts()) : while($featured_courses_query->have_posts() ) : $featured_courses_query->the_post(); ?>

<?php $text = get_field('teaser_text'); ?>


<div class="card"> 
	<div class="group-image">
		<a href="<?php the_permalink(); ?>">
			<?php cwd_base_get_image(); ?>
			<div class="overlay">
				<h3>
					<span class="deco"><?php echo $text; ?></span>
				</h3>
			</div>
		</a>
	</div>
</div>

<?php endwhile; endif; wp_reset_postdata(); ?>