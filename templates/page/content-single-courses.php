<?php // The single course content ?>

<section id="post-<?php the_ID(); ?>" <?php post_class('cwd-component'); ?>>

	<figure class="image align-left">
		<?php cwd_base_get_image(); ?>
		<?php cwd_base_get_image_caption(); ?>
	</figure>

	<div class="custom-fields" class="clear">

		<?php if(get_field('semester') || get_field('year')) { ?>
		
			<div id="semester">

				<?php if(get_field('semester')) { ?>
	
					<span class="label">Semester: </span>

					<span class="field">
						<?php the_field('semester'); ?>
					</span>

				<?php } ?>
				
				<?php if(get_field('year')) { ?>

					<span class="field">
						<?php the_field('year'); ?>
					</span>

				<?php } ?>

			</div>

		<?php } ?>

		<?php if(get_field('professor_instructor')) { ?>

			<div id="professor_instructor">

				<span class="label">Professor/Instructor: </span>

				<span class="field">
					<?php the_field('professor_instructor'); ?>
				</span>

			</div>

		<?php } ?>

		<?php if(get_field('location')) { ?>

			<div id="location">

				<span class="label">Location: </span>

				<span class="field">
					<?php the_field('location'); ?>
				</span>

			</div>

		<?php } ?>

	</div>
		
	<div class="summary">
		<?php the_content(); ?>
	</div>
			
	<?php cwd_base_get_tag_options(); ?>

	<?php // For paginated pages using the <!--nextpage--> quicktag
		wp_link_pages(array(
			'before' => '<nav class="navigation"><ol class="cwd-pagination wp_link_pages">' . __('<span class="title">Pages:</span>'),
			'after' => '</ol></nav>',
			'next_or_number' => 'next_and_number',
			'nextpagelink' => __('&raquo;', 'cwd_base'),
			'previouspagelink' => __('&laquo;', 'cwd_base'),
			'pagelink' => '%'
		));
	?>
	
</section>