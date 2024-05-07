<?php // The event content ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="cwd-component page">
		
		<figure class="image align-left">
			<?php cwd_base_get_image(); ?>
			<?php cwd_base_get_image_caption(); ?>
		</figure>

		<?php if(get_field('description')) { ?>
			<div class="summary">
				<?php the_field('description'); ?>
			</div>
		<?php } ?>
		
		<div class="custom-fields" class="clear">

			<?php if ( get_field('date') ) : ?>

				<div id="start-date" class="clear">

					<span class="label">Start Date: </span>

					<span class="field">
						<?php 
							$original_date = get_field('date');
							$new_date = date('F j, Y', strtotime($original_date));
							echo $new_date;
						?>
					</span>

				</div>

			<?php endif; ?>

			<?php if ( get_field('end_date') ) : ?>

				<div id="end-date">

					<span class="label">End Date: </span>

					<span class="field">
						<?php 
							$original_end_date = get_field('end_date');
							$new_end_date = date('F j, Y', strtotime($original_end_date));
							echo $new_end_date;
						?>
					</span>

				</div>

			<?php endif; ?>

			<?php if ( get_field('start_time') ) : ?>

				<div id="start-time">

					<span class="label">Start Time: </span>

					<span class="field">
						<?php 
							$original_start_time = get_field('start_time');
							$new_start_time = date('g:i a', strtotime($original_start_time));
							echo $new_start_time;
						?>
					</span>

				</div>

			<?php endif; ?>

			<?php if ( get_field('end_time') ) : ?>

				<div id="end-time">

					<span class="label">End Time: </span>

					<span class="field">
						<?php 
							$original_start_time = get_field('end_time');
							$new_start_time = date('g:i a', strtotime($original_start_time));
							echo $new_start_time;
						?>
					</span>

				</div>

			<?php endif; ?>

			<?php if ( get_field('is_all_day') == 1 ) : ?>

				<div id="is-all-day">

					<span class="label">All Day Event? </span>

					<span class="field">Yes</span>

				</div>

			<?php endif; ?>

			<?php if ( get_field('location') ) : ?>

				<div id="location">

					<span class="label">Location: </span>

					<span class="field">
						<?php the_field('location'); ?>
					</span>

				</div>

			<?php endif; ?>

			<?php if ( get_field('room') ) : ?>

				<div id="room">

					<span class="label">Room: </span>

					<span class="field">
						<?php the_field('room'); ?>
					</span>

				</div>

			<?php endif; ?>

			<?php if ( get_field('event_url') ) : ?>

				<div id="event-url">

					<span class="label">Event URL: </span>

					<span class="field">
						<a href="<?php the_field('event_url'); ?>"><?php the_field('event_url'); ?></a>
					</span>

				</div>

			<?php endif; ?>

			<?php if ( get_field('zoom_link') ) : ?>

				<div id="zoom-link">

					<span class="label">Zoom Link: </span>

					<span class="field">
						<a href="<?php the_field('zoom_link'); ?>"><?php the_field('zoom_link'); ?></a>
					</span>

				</div>

			<?php endif; ?>

			<?php if ( get_field('email') ) : ?>

				<div id="contact-email">

					<span class="label">Contact Email: </span>

					<span class="field">
						<a href="mailto:<?php the_field('email'); ?>">
							<?php the_field('email'); ?>
						</a>
					</span>

				</div>

			<?php endif; ?>
			
			<?php cwd_base_get_tag_options(); ?>
			
		</div>

		<p><?php edit_post_link(); ?></p>
		
	</div>

</section>