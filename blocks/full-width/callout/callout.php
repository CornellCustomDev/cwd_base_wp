<?php
$classes = array( 'callout band padded complementary', $block['className'] ?? null );

$anchor = $block['anchor'] ?? null;
$id_attr = $anchor ? ' id="' . $anchor . '"' : '';
?>

<div class="<?php echo implode( ' ', array_filter( $classes ) ); ?>" style="background-image: url(<?php the_field('callout_bg'); ?>);"<?php echo $id_attr; ?>>
	<div class="container-fluid">
		<div class="row">
			<div class="content <?php the_field('callout_alignment'); ?>">
				<div class="prompt">
					<p>
						<?php if ( $label = get_field('callout_label') ): ?>
							<?php echo $label; ?>
						<?php endif; ?>

						<a href="<?php echo get_field('callout_link')['url'] ?>">
							<?php the_field('callout_title') ?>
						</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
