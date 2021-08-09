<?php

// Register post type and add custom fields
require_once 'post-type.php';
require_once 'custom-fields.php';

if ( ! function_exists ( 'slider' ) ) {

	function slider() {

		$sliderContainerId = 'slider-container';
		$sliderCaptionId = 'slider-caption';

		function cwd_slider() {

			$slides = get_posts(array(
				'numberposts' => -1,
				'post_type' => 'slider',
				'meta_key' => 'slide_order',
				'orderby' => 'meta_value',
				'order' => 'ASC'
			));
			?>

			<script type="text/javascript">

				var image_array1 = [];
				var count = 0;

				<?php foreach ($slides as $slide) { ?>

					image_array1[count] = <?php
					  echo "['";
					  echo get_the_post_thumbnail_url($slide->ID, 'slider-image', true);
					  echo "','";
					  echo esc_html(get_field('text', $slide->ID));
					  echo "','";
					  echo '';
					  echo "','";
					  if (get_field('no_link', $slide->ID)) {
						echo '';
					  } else {
						  if (get_field('is_internal_link', $slide->ID)) {
							echo get_field('internal_link', $slide->ID);
						  } else {
							echo get_field('external_link', $slide->ID);
						  };
					  }
					  echo "',''";
					  echo "]";
					?>

					count++;
				<?php } ?>

			</script>

		<?php 

		} 
		add_action('wp_footer', 'cwd_slider');

		wp_enqueue_script('cwd-slider-js', get_template_directory_uri() . '/js/cwd_slider.js' );	
		wp_enqueue_style('pagination-css', get_template_directory_uri() . '/css/cwd_slider.css');

		?>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				// Reference: cwd_slider(div,caption,time,speed,auto,random,height,path,bg,heading2)
				cwd_slider('.<?php echo $sliderContainerId ?>','.<?php echo $sliderCaptionId ?>',4,1,true,false,'','','','<div>');
			});
		</script>

	<?php 

	}
	add_action('wp_head', 'slider');
}