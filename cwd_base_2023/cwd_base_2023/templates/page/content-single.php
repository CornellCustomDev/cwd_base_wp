<?php // The page content ?>

<section id="post-<?php the_ID(); ?>" <?php post_class('cwd-component'); ?>>
			
	<figure class="image align-left">
		<?php cwd_base_get_image(); ?>
		<?php cwd_base_get_image_caption(); ?>
	</figure>

	<?php cwd_base_get_the_date(); ?>

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