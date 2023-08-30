<?php
$title_class = get_field('cards_title_color') == 'red' ? 'title-red' : '';

$classes = array(
	'band padded bg-gray complementary',
	$title_class,
	$block['className'] ?? null
);

$anchor = $block['anchor'] ?? null;
$id_attr = $anchor ? ' id="' . $anchor . '"' : '';
?>

<div class="<?php echo implode( ' ', array_filter( $classes ) ); ?>"<?php echo $id_attr; ?>>
	<div class="container-fluid">
		<div class="row">
			<div class="content">
				<?php if ( $title = get_field('cards_title') ): ?>
					<h2><?php echo $title; ?></h2>
				<?php endif; ?>

				<div class="cards flex-grid">
					<?php while( have_rows('cards') ) : the_row(); ?>
						<?php if ( $link = get_sub_field('card_link') ): ?>
							<a class="flex-4" href="<?php echo $link; ?>">
						<?php else: ?>
							<div class="flex-4">
						<?php endif; ?>
							<div class="card-content">
								<?php if ( $card_title = get_sub_field('card_title') ): ?>
									<h3><?php echo $card_title; ?></h3>
								<?php endif; ?>

								<?php if ( $card_body = get_sub_field('card_body') ): ?>
									<div class="link">
										<?php echo $card_body; ?>
									</div>
								<?php endif; ?>
							</div>
						</<?php echo $link ? 'a' : 'div'; ?>>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</div>
