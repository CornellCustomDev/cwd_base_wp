<?php

// Get the date depending on post type. Add more as needed. 
// Assumes the ACF date field is named 'custom_date'.
if ( ! function_exists( 'cwd_base_get_the_date' ) ) {
	
	function cwd_base_get_the_date() {
		
		if(get_field('publication_date')) { // News ?>
			<h4 class="subheading sans">
				<?php the_field('publication_date'); ?>
			</h4>
		<?php }
		
		elseif(get_field('date')) { // Events ?>
			<h4 class="subheading sans">
				<?php the_field('date'); ?>
			</h4>
		<?php }

		elseif(get_field('custom_date')) { // ACF datepicker ?>
			<h4 class="subheading sans">
				<?php the_field('custom_date'); ?>
			</h4>
		<?php }

		else { ?>
			<h4 class="subheading sans">
				<?php echo get_the_date('F j, Y'); // Date (WP core) ?>
			</h4>
		<?php }
		
	}
	
}