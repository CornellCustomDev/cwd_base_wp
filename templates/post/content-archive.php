<?php // Archive listings 

$post_type = get_post_type();

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('card flex-4'); ?>>

	<div class="group-image">

		<a href="<?php echo the_permalink(); ?>">

			<?php cwd_base_get_image(); ?>

			<div class="overlay">
				<h2 class="h3">
					<span class="deco">
						<?php the_title(); ?>
					</span>
				</h2>
			</div>

		</a>

	</div>

	<div class="group-fields">

		<?php
			$excerpt_length = 180; // Default
			$archive_options = get_field('archive_options', 'options');
			
			if($archive_options && $post_type != 'page') { $excerpt_length = $archive_options[$post_type]['excerpt_length_' . $post_type]; }
			if($archive_options && $post_type != 'page') { $show_date = $archive_options[$post_type]['show_date_' . $post_type]; }
		?>

		<?php if($show_date) { cwd_base_get_the_date(); } ?>

		<p class="summary">					
			<?php echo custom_excerpt($excerpt_length); // Characters ?>
		</p>
			
		<?php cwd_base_get_tag_options(); ?>

	</div>

</div>