<?php
$img = get_field('quote_image');

$classes = array(
	'quote',
	$img ? 'with-image' : 'without-image',
	$block['className'] ?? null
);
?>

<div class="<?php echo implode( ' ', array_filter( $classes ) ); ?>">
	<?php if ( $img ): ?>
		<img src="<?php echo get_field('quote_image')['sizes']['medium']; ?>" alt="<?php echo get_field('quote_image')['alt']; ?>" />
	<?php endif; ?>

	<?php if ( $quote = get_field( 'quote_text' ) ): ?>
		<blockquote>
			<p><?php echo $quote; ?></p>

			<?php if ( $attribution = get_field( 'quote_attribution' ) ): ?>
				<p> &ndash; <?php echo $attribution; ?></p>
			<?php endif; ?>
		</blockquote>
	<?php endif; ?>
</div>
