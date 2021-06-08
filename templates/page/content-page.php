<?php // The page content ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="cwd-component page">
		<?php the_content(); ?>
	</div>
	
	<?php // For paginated pages using the <!--next--> quicktag
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