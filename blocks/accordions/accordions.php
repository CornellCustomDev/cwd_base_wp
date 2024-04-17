<?php
$classes = array(
	'expander scripted',
	$block['className'] ?? null
);

?>

<div class="<?php echo implode( ' ', array_filter( $classes ) ); ?>">
	<?php if ( have_rows('accordions') ): ?>
		<?php while( have_rows('accordions') ) : the_row(); ?>
			<?php
				$title = get_sub_field('clickable_title');
				$heading_level = get_sub_field('heading_level');
				$content = get_sub_field('hidden_content');

				if ( $title && $content):
			?>
				<<?php echo $heading_level; ?> class="block-accordion-header"><?php echo $title; ?></<?php echo $heading_level; ?>> <!-- First accordion -->

				<div>
					
					<?php echo $content; ?>

					<?php if ( have_rows('nested_accordion') ): ?>
						<?php while( have_rows('nested_accordion') ) : the_row(); ?>
							<?php
								$title = get_sub_field('clickable_title');
								$heading_level = get_sub_field('heading_level');
								$content = get_sub_field('hidden_content');

								if ( $title && $content):
							?>
								<<?php echo $heading_level; ?> class="block-accordion-header"><?php echo $title; ?></<?php echo $heading_level; ?>> <!-- Nested accordion -->

								<div>
					
									<?php echo $content; ?>

									<?php if ( have_rows('nested_accordion_again') ): ?>
										<?php while( have_rows('nested_accordion_again') ) : the_row(); ?>
											<?php
												$title = get_sub_field('clickable_title');
												$heading_level = get_sub_field('heading_level');
												$content = get_sub_field('hidden_content');

												if ( $title && $content):
											?>
												<<?php echo $heading_level; ?> class="block-accordion-header"><?php echo $title; ?></<?php echo $heading_level; ?>> <!-- Nested accordion again -->

												<div><?php echo $content; ?></div>

											<?php endif; ?>
										<?php endwhile; ?>
									<?php endif; ?>

								</div>

							<?php endif; ?>
						<?php endwhile; ?>
					<?php endif; ?>

				</div>

			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
