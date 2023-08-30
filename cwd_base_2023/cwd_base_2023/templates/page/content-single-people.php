<?php // The people content ?>

<section id="post-<?php the_ID(); ?>" <?php post_class('cwd-component'); ?>>

	<figure class="image align-left">
		<?php cwd_base_get_image(); ?>
		<?php cwd_base_get_image_caption(); ?>
	</figure>

	<div class="summary">
		<?php the_content(); ?>
	</div>
			
	<?php if(get_field('professional_title') || get_field('department') || get_field('affiliations') || get_field('website_url')) { ?>
	
		<div class="custom-fields" class="clear">
			
			<?php if(get_field('professional_title')) { ?>
			
				<div id="professional_title">
					
					<span class="label">Title: </span>
			
					<span class="field">
						<?php the_field('professional_title'); ?>
					</span>
					
				</div>
			
			<?php } ?>
			
			<?php if(get_field('department')) { ?>
			
				<div id="department">
					
					<span class="label">Department: </span>

					<span class="field">
						<?php the_field('department'); ?>
					</span>
			
				</div>
			
			<?php } ?>
			
			<?php if(get_field('website_url')) { ?>
			
				<div id="website_url">
					
					<span class="label">Website: </span>

					<span class="field">
						<a href="<?php the_field('website_url'); ?>">
							<?php the_field('website_url'); ?>
						</a>
					</span>
			
				</div>
			
			<?php } ?>
			
		</div>
	
	<?php } ?>
	
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