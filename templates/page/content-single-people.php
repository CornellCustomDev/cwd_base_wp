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
		<div class="fields clear">
			<?php if(get_field('professional_title')) { ?>
			<div class="field"><span>Title: </span><?php the_field('professional_title'); ?></div>
			<?php } ?>
			<?php if(get_field('department')) { ?>
				<div class="field"><span>Department: </span><?php the_field('department'); ?></div>
			<?php } ?>
			<?php if(get_field('affiliations')) { ?>
				<div class="field"><span>Affiliations: </span><?php the_field('affiliations'); ?></div>
			<?php } ?>
			<?php if(get_field('website_url')) { ?>
			<div class="field"><span>Website: </span><a href="<?php the_field('website_url'); ?>"><?php the_field('website_url'); ?></a></div>
			<?php } ?>
		</div>
	<?php } ?>
	
	<?php //cwd_base_get_tag_options(); ?>

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