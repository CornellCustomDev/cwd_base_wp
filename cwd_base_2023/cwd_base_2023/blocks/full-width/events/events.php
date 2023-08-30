<?php
$filter = get_field('events_filter');
$events = cwd_events_block_query( get_field('events_number'), $filter );

$classes = array(
	'band padded alignfull complementary',
	'important-dates cwd-component cwd-basic cwd-events tiles max-4-2',
	'bg-' . get_field('events_bg'),
	$block['className'] ?? null
);

$anchor = $block['anchor'] ?? null;
$id_attr = $anchor ? ' id="' . $anchor . '"' : '';
?>

<?php if ( $events->have_posts() ) : ?>
	<div class="<?php echo implode( ' ', array_filter( $classes ) ); ?>"<?php echo $id_attr; ?>>
		<div class="container-fluid">
			<div class="row">
				<div class="content">
					<div class="header-with-button">
						<?php if ( $title = get_field('events_heading') ): ?>
							<h2><?php echo $title; ?></h2>
						<?php endif; ?>

						<?php if ( $all_link = get_field('events_view_all_link') ): ?>
							<div class="buttons">
								<a href="<?php echo $all_link['url']; ?>" class="link-more">
									<?php echo $all_link['title']; ?>
								</a>
							</div>
						<?php endif; ?>
					</div>

					<div class="cards">
						<?php while ( $events->have_posts() ) : $events->the_post(); ?>
							<div class="card">
								<div class="group-noimage">
									<a href="<?php the_permalink(); ?>">
										<div class="overlay">
											<h3 class="designer">
												<span class="deco"><?php the_title(); ?></span>
											</h3>
										</div>

										<?php $date = new DateTime( get_field( 'date', get_the_ID() ) );?>

										<time title="<?php echo $date->format('F jS'); ?>" datetime="<?php echo $date->format('Y-m-d'); ?>">
											<span class="month"><?php echo $date->format('M'); ?></span>
											<span class="day"><?php echo $date->format('d'); ?></span>
										</time>
									</a>
								</div>
							</div>
						<?php endwhile; ?>

						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
