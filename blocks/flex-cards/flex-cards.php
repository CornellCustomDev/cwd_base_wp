<?php
$layout = get_field('flex_cards_layout');

$classes = array(
	'flex-cards full-width',
	$layout == 'full-width' ? '' : 'flex-grid',
	$block['className'] ?? null
);
?>

<div class="<?php echo implode( ' ', array_filter( $classes ) ); ?>">
	<?php
		while( have_rows('flex_cards') ) : the_row();
			$img = get_sub_field('flex_card_image');
			$text = get_sub_field('flex_card_text');

			// Default classes
			$card_classes = 'flex-card ' . get_field('flex_cards_bg');
			$img_class = 'card-image';
			$text_class = 'card-text';

			// For full-width cards with both image and text, display elements side-by-side
			if ( $layout == 'full-width' && $img && $text ) {
				$card_classes .= ' flex-grid';

				$img_class .= ' flex-4';
				$text_class .= ' flex-8';
			}
	?>
		<div class="<?php echo $layout; ?>">
			<div class="<?php echo $card_classes; ?>">
				<?php if ( $img ): ?>
					<div class="<?php echo $img_class; ?>">
						<img src="<?php echo $img['sizes']['medium']; ?>" alt="<?php echo $img['alt']; ?>" />
					</div>
				<?php endif; ?>

				<?php if ( $text ): ?>
					<div class="<?php echo $text_class; ?>">
						<?php the_sub_field('flex_card_text'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endwhile; ?>
</div>
