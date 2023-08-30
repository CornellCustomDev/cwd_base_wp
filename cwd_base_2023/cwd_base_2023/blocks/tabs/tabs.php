<?php
$classes = array(
	'content-tabs tabs-aria ',
	'active-tab-' . get_field('tabbed_content_tab_color'),
	'layout-' . get_field('layout'),
	$block['className'] ?? null
);
?>

<ul class="<?php echo implode( ' ', array_filter( $classes ) ); ?>">
	<?php while( have_rows('tabbed_content_tabs') ) : the_row(); ?>
		<?php if ( $tab_label = get_sub_field('tab_label') ): ?>
			<li>
				<?php if ( $tab_content = get_sub_field('tab_content') ): ?>
					<h4><?php echo $tab_label; ?></h4>
					<p><?php echo $tab_content; ?></p>
					<?php if ( $tab_button = get_sub_field('tab_button') ): ?>
						<a class="link-button" href="<?php echo $tab_button['url']; ?>">
							<?php if ( $tab_button['title'] == $tab_label ): ?>
								<span class="sr-only">Learn more about</span>
							<?php endif; ?>
							<?php echo $tab_button['title']; ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>
			</li>
		<?php endif; ?>
	<?php endwhile; ?>
</ul>
