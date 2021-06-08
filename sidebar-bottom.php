<?php 

$layout = get_layout();

// Bottom sidebar
if( is_active_sidebar('widget-area-2') && $layout != 'no_sidebar' ) { ?>

	<div id="sidebar-bottom" class="secondary" role="complementary">
		<?php dynamic_sidebar('widget-area-2'); ?>
	</div>

<?php }
