<?php // Testimonial listings ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('card flex-4'); ?>>

	<div class="group-fields">
		
		<?php //remove_filter('content', 'wpautop', 10); ?>

		<div class="summary">
			<?php the_content(); ?>
			<?php if(get_field('quotee')) { ?>
				<div class="quotee">
					<?php the_field('quotee'); ?>
				</div>
			<?php } ?>
		</div>
			
		<?php //add_filter('content', 'wpautop', 10); ?>

		<?php cwd_base_get_tag_options(); ?>

	</div>

</div>
