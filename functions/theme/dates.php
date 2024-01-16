<?php

// Get the date depending on post type. Add more as needed. 
// Assumes the ACF date field is named 'custom_date' and used for all (or most?) custom post types.
if ( ! function_exists( 'cwd_base_get_the_date' ) ) {
	
	function cwd_base_get_the_date() {
		
		if(get_field('publication_date')) { // News ?>

			<span class="subheading sans">
				<?php the_field('publication_date'); ?>
			</span>

		<?php }
		
		elseif(get_field('date')) { // Events ?>

			<span class="subheading sans">
				<?php the_field('date'); ?>
			</span>

		<?php }

		elseif(get_field('custom_date')) { // ACF datepicker ?>
			<span class="subheading sans">
				<?php the_field('custom_date'); ?>
			</span>
		<?php }

		else { ?>
			<span class="subheading sans">
				<?php echo get_the_date('F j, Y'); // Date (WP core) ?>
			</span>
		<?php }
		
	}
	
}

// Make today's date the default date for all new posts (news, events, and custom date field)
if ( ! function_exists( 'cwd_base_default_date' ) ) {
	function cwd_base_default_date($field) {
		$field['default_value'] = date('Ymd');
		return $field;
	}
}
add_filter('acf/load_field/name=date', 'cwd_base_default_date');
add_filter('acf/load_field/name=publication_date', 'cwd_base_default_date');
add_filter('acf/load_field/name=custom_date', 'cwd_base_default_date');