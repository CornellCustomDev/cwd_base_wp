<?php
// Only render content if any buttons are present
if ( !have_rows('cta_buttons') ) {
	return;
}

$classes = array(
	'cta-buttons',
	'buttons-' . get_field('cta_button_color'),
	'buttons-' . count( get_field('cta_buttons') ),
	$block['className'] ?? null
);
?>

<div class="<?php echo implode( ' ', array_filter( $classes ) ); ?>">
	<ul>
		<?php while( have_rows('cta_buttons') ) : the_row(); ?>
			<li>
				<?php if ( $label = get_sub_field('cta_button_label') ) : ?>
					<span class="button-text"><?php echo $label; ?></span>
				<?php endif; ?>

				<?php if ( $cta_link = get_sub_field('cta_button_link') ): ?>
					<a href="<?php echo $cta_link['url']; ?>"><span class="button-text"><?php echo $cta_link['title']; ?></span></a>
				<?php endif; ?>
			</li>
		<?php endwhile; ?>
	</ul>
</div>
