<?php

$classes = array(
	'view cwd-component cwd-component-rows card-slider side-padding max-1 ',
	$block['className'] ?? null
);

?>

<div class="<?php echo implode( ' ', array_filter( $classes ) ); ?>">

	<div class="view-content cards">

		<?php if( have_rows('card_slider') ) : while( have_rows('card_slider') ) : the_row(); ?>

			<div class="views-row card" tabindex="-1">

				<div class="node">

					<div class="group-image field-group field-group-html-element">

						<div class="field field-name-field-image">

							<?php if( get_sub_field('title_link_url') ) { ?>
								<a href="<?php the_sub_field('title_link_url'); ?>">
							<?php } ?>
								<?php if( get_sub_field('image_id') ) { ?>
									<?php echo wp_get_attachment_image(get_sub_field('image_id'), 'card-slider'); ?>
								<?php } ?>
							<?php if( get_sub_field('title_link_url') ) { ?>
								</a>
							<?php } ?>

						</div>

					</div>

					<div class="group-fields field-group field-group-html-element">

						<div class="field field-name-title title">
							<h3 class="sans">
								<?php if( get_sub_field('title_link_url') ) { ?>
									<a class="designer" href="<?php the_sub_field('title_link_url'); ?>">
								<?php } ?>
								<?php if( get_sub_field('title') ) { ?>
									<span class="deco">
										<?php the_sub_field('title'); ?>
									</span>
								<?php } ?>
								<?php if( get_sub_field('title_link_url') ) { ?>
									</a>
								<?php } ?>
							</h3>
						</div>

						<?php if( get_sub_field('body') ) { ?>
							<div class="field field-name-summary summary">
								<p><?php the_sub_field('body'); ?></p>
							</div>
						<?php } ?>

						<div class="group-meta field-group field-group-html-element metadata-set metadata-blocks">

							<?php if(have_rows('links')) : while(have_rows('links')) : the_row(); ?>

								<?php $link_button_color = get_sub_field('link_color'); ?>

								<div class="field field-name-field-default <?php echo $link_button_color; ?>">
									<a href="<?php the_sub_field('link_url'); ?>">
										<span class="deco">
											<?php the_sub_field('link_text'); ?>
										</span>
									</a>
								</div>

							<?php endwhile; endif; ?>

						</div>

					</div>

				</div>

			</div>

		<?php endwhile; endif; ?>

	</div>

</div>