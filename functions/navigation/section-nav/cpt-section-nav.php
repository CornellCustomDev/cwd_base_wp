<?php

// Section navigation for the projects custom post type
function cwd_base_list_project_child_pages() {
	
	global $post;
	
	$post_parent = get_post($post->post_parent); 
	$post_parent_slug = $post_parent->post_name; 
		
	if((get_post_type() == 'projects') 
	   && $post_parent 
	   && !is_archive() 
	   && has_tag($post_parent_slug, $post->ID)) { ?>


			<h2 class="menu-block-title">
				<a href="<?php echo get_permalink($post->post_parent); ?>" class="current_page_item">
					<?php echo $post_parent->post_title; ?>
				</a>
			</h2>

			<nav class="secondary-navigation mobile-expander">
				
				<ul class="menu">
					<?php 
						wp_list_pages(array(
						   'post_type' => 'projects',
						   'sort_column' => 'menu_order',
						   'child_of' => $post->post_parent,
						   'title_li' => ''
						));
					?>
				</ul>

			</nav>

	<?php } 
	
}
add_shortcode('cwd_base_cpt_childpages', 'cwd_base_list_project_child_pages');