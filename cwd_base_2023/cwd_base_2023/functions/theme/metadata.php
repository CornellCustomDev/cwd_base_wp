<?php

// Tags, categories, and custom taxonomies. Called from options.php
if ( ! function_exists( 'cwd_base_get_taxonomies_and_terms' ) ) {
	
	function cwd_base_get_taxonomies_and_terms($post_type, $taxonomy) { 

		$terms = wp_get_post_terms( get_the_ID(), $taxonomy );

		$taxonomy_object = get_taxonomy($taxonomy);

		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$metadata_options = $archive_options[$post_type]['metadata_' . $post_type];

		if($terms) {
			echo $before;
		}
		
		if($metadata_options && $terms) {

			if(in_array('labels', $metadata_options) && !in_array('icons', $metadata_options)) {
				echo '<div class="field label">' . $taxonomy_object->label . ': </div>';  // Text label
			}
			if(!in_array('labels', $metadata_options) && in_array('icons', $metadata_options)) {
				echo '<span class="sr-only">' . $taxonomy_object->label . '</span><span class="fa fa-tags"></span>';  // Icon label
			}
			if(in_array('labels', $metadata_options) && in_array('icons', $metadata_options)) {
				echo '<span class="sr-only">' . $taxonomy_object->label . '</span><span class="fa fa-tags"></span><span>' . $taxonomy_object->label . ': </span>';  // Both
			}

		}
		
		if ($terms) {
			foreach($terms as $term) {
				$term_link = get_tag_link( $term->term_id );
				echo '<div class="field"><a href="' . $term_link . '"><span class="deco">'.ucwords($term->name).'</span></a></div>';
			}
		}

		if($terms) {
			echo $after;
		}
		
	}
}