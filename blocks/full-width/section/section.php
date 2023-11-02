<?php
$title_class = get_field('section_title_color') == 'red' ? 'title-red' : '';

$classes = array(
	'band padded alignfull complementary',
	'bg-' . get_field('section_bg'),
	$title_class,
	$block['className'] ?? null
);

$anchor = $block['anchor'] ?? null;
$id_attr = $anchor ? ' id="' . $anchor . '"' : '';
?>

<div class="<?php echo implode( ' ', array_filter( $classes ) ); ?>" <?php echo $id_attr; ?>>
	<div class="container-fluid">
		<div class="row">
			<div class="content">
				<?php if ( get_field('section_display_title') && $title = get_field('section_title') ): ?>
					<h2><?php echo $title; ?></h2>
				<?php endif; ?>

				<InnerBlocks />
			</div>
		</div>
	</div>
</div>
