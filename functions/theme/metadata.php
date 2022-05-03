<?php

/* Any custom taxonomies not addressed here must use WP Core taxonomies: post_tag and category */

// Tags, categories, and custom taxonomies. Called from options.php
if ( ! function_exists( 'cwd_base_get_tags' ) ) {

	// WP Core tags
	function cwd_base_get_tags() { 
		
		$tags = wp_get_post_tags( get_the_ID() );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$post_metadata_options = $archive_options['metadata']['regular_posts'];

		if($tags) {
			echo $before;
		}
		
		if($post_metadata_options && $tags) {
		   	if(in_array('labels', $post_metadata_options) && !in_array('icons', $post_metadata_options)) {
				echo '<div class="field label">Tags: </div>';  // Text label
			}
		   	if(!in_array('labels', $post_metadata_options) && in_array('icons', $post_metadata_options)) {
				echo '<span class="sr-only">Tags</span><span class="fa fa-tags"></span>';  // Icon label
			}
		   	if(in_array('labels', $post_metadata_options) && in_array('icons', $post_metadata_options)) {
				echo '<span class="sr-only">Tags</span><span class="fa fa-tags"></span><span>Tags: </span>';  // Both
			}
		}
		
		if ($tags) {
			foreach($tags as $tag) {
				$tag_link = get_tag_link( $tag->term_id );
				echo '<div class="field"><a href="'.$tag_link.'"><span class="deco">'.ucwords($tag->name).'</span></a></div>';
			}
		}

		if($tags) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_categories' ) ) {
	
	// WP Core categories
	function cwd_base_get_categories() { 

		$categories = wp_get_post_categories( get_the_ID() );
		$before = '<div class="metadata-set">';
		$after = '</div>';
				
		$archive_options = get_field('archive_options', 'options');
		$post_metadata_options = $archive_options['metadata']['regular_posts'];
				
		if($categories) {
			echo $before;
		}
		
		if($post_metadata_options && $categories) {
		   	if(in_array('labels', $post_metadata_options) && !in_array('icons', $post_metadata_options)) {
				echo '<div class="field label">Categories: </div>';  // Text label
			}
		   	if(!in_array('labels', $post_metadata_options) && in_array('icons', $post_metadata_options)) {
				echo '<span class="sr-only">Categories</span><span class="fa fa-folder-open"></span>';  // Icon label
			}
		   	if(in_array('labels', $post_metadata_options) && in_array('icons', $post_metadata_options)) {
				echo '<span class="sr-only">Categories</span><span class="fa fa-folder-open"></span><span>Categories: </span>';  // Both
			}
		}
		
		if ($categories) {
			foreach($categories as $category_ID) {
				$category      = get_term( $category_ID );
        		$category_name = $category->name;
				$category_link = get_category_link( $category_ID );
				if ( strtolower( $category_name ) != 'uncategorized' ) {
					echo '<div class="field"><a href="'.$category_link.'"><span class="deco">'.ucwords($category_name).'</span></a></div>';
				}
			}
		}

		if($categories) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_news_tags' ) ) {
	
	// News tags
	function cwd_base_get_news_tags() { 

		$news_tags = wp_get_post_terms( get_the_ID(), 'news_tags' );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$news_metadata_options = $archive_options['metadata']['news'];
		
		if($news_tags) {
			echo $before;
		}
		
		if($news_metadata_options && $news_tags) {
		   	if(in_array('labels', $news_metadata_options) && !in_array('icons', $news_metadata_options)) {
				echo '<div class="field label">Tags: </div>';  // Text label
			}
		   	if(!in_array('labels', $news_metadata_options) && in_array('icons', $news_metadata_options)) {
				echo '<span class="sr-only">News tags</span><span class="fa fa-tags"></span>';  // Icon label
			}
		   	if(in_array('labels', $news_metadata_options) && in_array('icons', $news_metadata_options)) {
				echo '<span class="sr-only">News tags</span><span class="fa fa-tags"></span><span>Tags: </span>';  // Both
			}
		}
		
		if ($news_tags) {
			
			foreach($news_tags as $news_tag_ID) {
				$news_tag      = get_term( $news_tag_ID );
        		$news_tag_name = $news_tag->name;
				$news_tag_link = get_category_link( $news_tag_ID );
				if ( strtolower( $news_tag_name ) != 'uncategorized' ) {
					echo '<div class="field"><a href="'.$news_tag_link.'"><span class="deco">'.ucwords($news_tag_name).'</span></a></div>';
				}
			}
			
		}

		if($news_tags) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_news_categories' ) ) {
	
	// News categories
	function cwd_base_get_news_categories() { 

		$news_categories = wp_get_post_terms( get_the_ID(), 'news_categories' );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$news_metadata_options = $archive_options['metadata']['news'];
		
		if($news_categories) {
			echo $before;
		}
		
		if($news_metadata_options && $news_categories) {
		   	if(in_array('labels', $news_metadata_options) && !in_array('icons', $news_metadata_options)) {
				echo '<div class="field label">Categories: </div>';  // Text label
			}
		   	if(!in_array('labels', $news_metadata_options) && in_array('icons', $news_metadata_options)) {
				echo '<span class="sr-only">News categories</span><span class="fa fa-folder-open"></span>';  // Icon label
			}
		   	if(in_array('labels', $news_metadata_options) && in_array('icons', $news_metadata_options)) {
				echo '<span class="sr-only">News categories</span><span class="fa fa-folder-open"></span><span>Categories: </span>';  // Both
			}
		}
		
		if ($news_categories) {
			foreach($news_categories as $news_category_ID) {
				$news_category      = get_term( $news_category_ID );
        		$news_category_name = $news_category->name;
				$news_category_link = get_category_link( $news_category_ID );
				if ( strtolower( $news_category_name ) != 'uncategorized' ) {
					echo '<div class="field"><a href="'.$news_category_link.'"><span class="deco">'.ucwords($news_category_name).'</span></a></div>';
				}
			}
		}

		if($news_categories) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_event_tags' ) ) {
	
 /* Event tags: event taxonomies are different from other content type taxonomies, 
	and they're different on single pages and archive pages. It was just a choice, 
	because of the way the events custom fields are laid out. Seems right to just
	make event tags, types, and groups the same as the other custom fields, but 
	only on single event pages. 
*/	
	
	function cwd_base_get_event_tags() { 

		$event_tags = wp_get_post_terms( get_the_ID(), 'event_tags' );
		
		if(is_single()) {
			$before = '<div id="event-tags">';
		}
		if(is_archive()) {
			$before = '<div class="metadata-set">';
		}
		
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$events_metadata_options = $archive_options['metadata']['events'];
		
		if($event_tags) {
			echo $before;
		}
		
		if($events_metadata_options && $event_tags && is_archive()) {
		   	if(in_array('labels', $events_metadata_options) && !in_array('icons', $events_metadata_options)) {
				echo '<div class="field label">Tags: </div>';  // Text label
			}
		   	if(!in_array('labels', $events_metadata_options) && in_array('icons', $events_metadata_options)) {
				echo '<span class="sr-only">Event tags</span><span class="fa fa-tags"></span>';  // Icon label
			}
		   	if(in_array('labels', $events_metadata_options) && in_array('icons', $events_metadata_options)) {
				echo '<span class="sr-only">Event tags</span><span class="fa fa-tags"></span><span>Tags: </span>';  // Both
			}
		}
		
		if($events_metadata_options && $event_tags && is_single()) {
		   	echo '<span class="label">Tags: </span>';  // Text label
		}
		
		if ($event_tags) {
			
			$count = count($event_tags);
			$i = 1;
			
			foreach($event_tags as $event_tag_ID) {
				$event_tag      = get_term( $event_tag_ID );
        		$event_tag_name = $event_tag->name;
				$event_tag_link = get_category_link( $event_tag_ID );
				if ( strtolower( $event_tag_name ) != 'uncategorized' ) {
					echo '<div class="field"><a href="'.$event_tag_link.'"><span class="deco">'.ucwords($event_tag_name).'</span></a></div>';
				}
				
				if($i < $count && is_single()) { 
					echo ', ';
				} 

				$i++;				
			}
		}

		if($event_tags) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_event_types' ) ) {
	
	// Event types
	function cwd_base_get_event_types() { 

		$event_types = wp_get_post_terms( get_the_ID(), 'event_types' );
		
		if(is_single()) {
			$before = '<div id="event-types">';
		}
		if(is_archive()) {
			$before = '<div class="metadata-set">';
		}
		
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$events_metadata_options = $archive_options['metadata']['events'];
		
		if($event_types) {
			echo $before;
		}
		
		if($events_metadata_options && $event_types && is_archive()) {
		   	if(in_array('labels', $events_metadata_options) && !in_array('icons', $events_metadata_options)) {
				echo '<div class="field label">Type: </div>';  // Text label
			}
		   	if(!in_array('labels', $events_metadata_options) && in_array('icons', $events_metadata_options)) {
				echo '<span class="sr-only">Event types</span><span class="fa fa-folder-open"></span>';  // Icon label
			}
		   	if(in_array('labels', $events_metadata_options) && in_array('icons', $events_metadata_options)) {
				echo '<span class="sr-only">Event types</span><span class="fa fa-folder-open"></span><span>Type: </span>';  // Both
			}
		}
		
		if($events_metadata_options && $event_types && is_single()) {
		   	echo '<span class="label">Type: </span>';  // Text label
		}
		
		if ($event_types) {
			
			$count = count($event_types);
			$i = 1;
			
			foreach($event_types as $event_type_ID) {
				$event_type      = get_term( $event_type_ID );
        		$event_type_name = $event_type->name;
				$event_type_link = get_category_link( $event_type_ID );
				if ( strtolower( $event_type_name ) != 'uncategorized' ) {
					echo '<div class="field"><a href="'.$event_type_link.'"><span class="deco">'.ucwords($event_type_name).'</span></a></div>';
				}
				
				if($i < $count && is_single()) { 
					echo ', ';
				} 

				$i++;				
			}
		}

		if($event_types) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_event_groups' ) ) {
	
	// Event groups
	function cwd_base_get_event_groups() { 

		$event_groups = wp_get_post_terms( get_the_ID(), 'event_groups' );
		
		if(is_single()) {
			$before = '<div id="event-groups">';
		}
		if(is_archive()) {
			$before = '<div class="metadata-set">';
		}
		
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$events_metadata_options = $archive_options['metadata']['events'];
		
		if($event_groups) {
			echo $before;
		}
		
		if($events_metadata_options && $event_groups && is_archive()) {
		   	if(in_array('labels', $events_metadata_options) && !in_array('icons', $events_metadata_options)) {
				echo '<div class="field label">Group: </div>';  // Text label
			}
		   	if(!in_array('labels', $events_metadata_options) && in_array('icons', $events_metadata_options)) {
				echo '<span class="sr-only">Event groups</span><span class="fa fa-calendar-check-o"></span>';  // Icon label
			}
		   	if(in_array('labels', $events_metadata_options) && in_array('icons', $events_metadata_options)) {
				echo '<span class="sr-only">Event groups</span><span class="fa fa-calendar-check-o"></span><span>Group: </span>';  // Both
			}
		}
		
		if($events_metadata_options && $event_groups && is_single()) {
		   	echo '<span class="label">Group: </span>';  // Text label
		}
		
		if ($event_groups) {
			
			$count = count($event_groups);
			$i = 1;
			
			foreach($event_groups as $event_group_ID) {
				$event_group      = get_term( $event_group_ID );
        		$event_group_name = $event_group->name;
				$event_group_link = get_category_link( $event_group_ID );
				if ( strtolower( $event_group_name ) != 'uncategorized' ) {
					echo '<div class="field"><a href="'.$event_group_link.'"><span class="deco">'.ucwords($event_group_name).'</span></a></div>';
				}
				
				if($i < $count && is_single()) { 
					echo ', ';
				} 

				$i++;				
			}
		}

		if($event_tags) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_testimonial_tags' ) ) {
	
	// Testimonial tags
	function cwd_base_get_testimonial_tags() { 

		$testimonial_tags = wp_get_post_terms( get_the_ID(), 'testimonial_tags' );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$testimonials_metadata_options = $archive_options['metadata']['testimonials'];
		
		if($testimonial_tags) {
			echo $before;
		}
		
		if($testimonials_metadata_options && $testimonial_tags) {
		   	if(in_array('labels', $testimonials_metadata_options) && !in_array('icons', $testimonials_metadata_options)) {
				echo '<div class="field label">Tags: </div>';  // Text label
			}
		   	if(!in_array('labels', $testimonials_metadata_options) && in_array('icons', $testimonials_metadata_options)) {
				echo '<span class="sr-only">Tags</span><span class="fa fa-tags"></span>';  // Icon label
			}
		   	if(in_array('labels', $testimonials_metadata_options) && in_array('icons', $testimonials_metadata_options)) {
				echo '<span class="sr-only">Tags</span><span class="fa fa-tags"></span><span>Tags: </span>';  // Both
			}
		}

		foreach($testimonial_tags as $testimonial_tag_ID) {
			$testimonial_tag      = get_term( $testimonial_tag_ID );
			$testimonial_tag_name = $testimonial_tag->name;
			$testimonial_tag_link = get_category_link( $testimonial_tag_ID );
			if ( strtolower( $testimonial_tag_name ) != 'uncategorized' ) {
				echo '<div class="field"><a href="'.$testimonial_tag_link.'"><span class="deco">'.ucwords($testimonial_tag_name).'</span></a></div>';
			}

		}
		
		if($testimonial_tags) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_testimonial_categories' ) ) {
	
	// Testimonial categories
	function cwd_base_get_testimonial_categories() { 

		$testimonial_categories = wp_get_post_terms( get_the_ID(), 'testimonial_categories' );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$testimonial_metadata_options = $archive_options['metadata']['testimonials'];
		
		if($testimonial_categories) {
			echo $before;
		}
		
		if($testimonial_metadata_options && $testimonial_categories) {
		   	if(in_array('labels', $testimonial_metadata_options) && !in_array('icons', $testimonial_metadata_options)) {
				echo '<div class="field label">Categories: </div>';  // Text label
			}
		   	if(!in_array('labels', $testimonial_metadata_options) && in_array('icons', $testimonial_metadata_options)) {
				echo '<span class="sr-only">Categories</span><span class="fa fa-folder-open"></span>';  // Icon label
			}
		   	if(in_array('labels', $testimonial_metadata_options) && in_array('icons', $testimonial_metadata_options)) {
				echo '<span class="sr-only">Categories</span><span class="fa fa-folder-open"></span><span>Categories: </span>';  // Both
			}
		}
		
		if ($testimonial_categories) {
			
			foreach($testimonial_categories as $testimonial_category_ID) {
				$testimonial_category      = get_term( $testimonial_category_ID );
        		$testimonial_category_name = $testimonial_category->name;
				$testimonial_category_link = get_category_link( $testimonial_category_ID );
				if ( strtolower( $testimonial_category_name ) != 'uncategorized' ) {
					echo '<div class="field"><a href="'.$testimonial_category_link.'"><span class="deco">'.ucwords($testimonial_category_name).'</span></a></div>';
				}
				
			}
		}

		if($testimonial_categories) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_people_tags' ) ) {
	
	// People tags
	function cwd_base_get_people_tags() { 

		$people_tags = wp_get_post_terms( get_the_ID(), 'people_tags' );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$people_metadata_options = $archive_options['metadata']['people'];
		
		if($people_tags) {
			echo $before;
		}
		
		if($people_metadata_options && $people_tags) {
		   	if(in_array('labels', $people_metadata_options) && !in_array('icons', $people_metadata_options)) {
				echo '<div class="field label">Tags: </div>';  // Text label
			}
		   	if(!in_array('labels', $people_metadata_options) && in_array('icons', $people_metadata_options)) {
				echo '<span class="sr-only">Tags</span><span class="fa fa-tags"></span>';  // Icon label
			}
		   	if(in_array('labels', $people_metadata_options) && in_array('icons', $people_metadata_options)) {
				echo '<span class="sr-only">Tags</span><span class="fa fa-tags"></span><span>Tags: </span>';  // Both
			}
		}
		
		foreach($people_tags as $people_tag_ID) {
			$people_tag      = get_term( $people_tag_ID );
			$people_tag_name = $people_tag->name;
			$people_tag_link = get_category_link( $people_tag_ID );
			if ( strtolower( $people_tag_name ) != 'uncategorized' ) {
				echo '<div class="field"><a href="'.$people_tag_link.'"><span class="deco">'.ucwords($people_tag_name).'</span></a></div>';
			}

		}
		
		if($people_tags) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_people_categories' ) ) {
	
	// People categories
	function cwd_base_get_people_categories() { 

		$people_categories = wp_get_post_terms( get_the_ID(), 'people_categories' );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$people_metadata_options = $archive_options['metadata']['people'];
		
		if($people_categories) {
			echo $before;
		}
		
		if($people_metadata_options && $people_categories) {
		   	if(in_array('labels', $people_metadata_options) && !in_array('icons', $people_metadata_options)) {
				echo '<div class="field label">Categories: </div>';  // Text label
			}
		   	if(!in_array('labels', $people_metadata_options) && in_array('icons', $people_metadata_options)) {
				echo '<span class="sr-only">Categories</span><span class="fa fa-folder-open"></span>';  // Icon label
			}
		   	if(in_array('labels', $people_metadata_options) && in_array('icons', $people_metadata_options)) {
				echo '<span class="sr-only">Categories</span><span class="fa fa-folder-open"></span><span>Categories: </span>';  // Both
			}
		}
		
		if ($people_categories) {
			
			foreach($people_categories as $people_category_ID) {
				$people_category      = get_term( $people_category_ID );
        		$people_category_name = $people_category->name;
				$people_category_link = get_category_link( $people_category_ID );
				if ( strtolower( $people_category_name ) != 'uncategorized' ) {
					echo '<div class="field"><a href="'.$people_category_link.'"><span class="deco">'.ucwords($people_category_name).'</span></a></div>';
				}
				
			}
		}

		if($people_categories) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_course_tags' ) ) {
	
	// Course tags
	function cwd_base_get_course_tags() { 

		$course_tags = wp_get_post_terms( get_the_ID(), 'course_tags' );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$courses_metadata_options = $archive_options['metadata']['courses'];
		
		if($course_tags) {
			echo $before;
		}
		
		if($courses_metadata_options && $course_tags) {
		   	if(in_array('labels', $courses_metadata_options) && !in_array('icons', $courses_metadata_options)) {
				echo '<div class="field label">Tags: </div>';  // Text label
			}
		   	if(!in_array('labels', $courses_metadata_options) && in_array('icons', $courses_metadata_options)) {
				echo '<span class="sr-only">Tags</span><span class="fa fa-tags"></span>';  // Icon label
			}
		   	if(in_array('labels', $courses_metadata_options) && in_array('icons', $courses_metadata_options)) {
				echo '<span class="sr-only">Tags</span><span class="fa fa-tags"></span><span>Tags: </span>';  // Both
			}
		}
		
		foreach($course_tags as $course_tag_ID) {
			$course_tag      = get_term( $course_tag_ID );
			$course_tag_name = $course_tag->name;
			$course_tag_link = get_category_link( $course_tag_ID );
			if ( strtolower( $course_tag_name ) != 'uncategorized' ) {
				echo '<div class="field"><a href="'.$course_tag_link.'"><span class="deco">'.ucwords($course_tag_name).'</span></a></div>';
			}

		}
		
		if($course_tags) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_course_categories' ) ) {
	
	// Course categories
	function cwd_base_get_course_categories() { 

		$course_categories = wp_get_post_terms( get_the_ID(), 'course_categories' );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$courses_metadata_options = $archive_options['metadata']['courses'];
		
		if($course_categories) {
			echo $before;
		}
		
		if($courses_metadata_options && $course_categories) {
		   	if(in_array('labels', $courses_metadata_options) && !in_array('icons', $courses_metadata_options)) {
				echo '<div class="field label">Categories: </div>';  // Text label
			}
		   	if(!in_array('labels', $courses_metadata_options) && in_array('icons', $courses_metadata_options)) {
				echo '<span class="sr-only">Categories</span><span class="fa fa-folder-open"></span>';  // Icon label
			}
		   	if(in_array('labels', $courses_metadata_options) && in_array('icons', $courses_metadata_options)) {
				echo '<span class="sr-only">Categories</span><span class="fa fa-folder-open"></span><span>Categories: </span>';  // Both
			}
		}
		
		if ($course_categories) {
			
			foreach($course_categories as $course_category_ID) {
				$course_category      = get_term( $course_category_ID );
        		$course_category_name = $course_category->name;
				$course_category_link = get_category_link( $course_category_ID );
				if ( strtolower( $course_category_name ) != 'uncategorized' ) {
					echo '<div class="field"><a href="'.$course_category_link.'"><span class="deco">'.ucwords($course_category_name).'</span></a></div>';
				}
				
			}
		}

		if($course_categories) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_gallery_tags' ) ) {
	
	// Gallery tags
	function cwd_base_get_gallery_tags() { 

		$gallery_tags = wp_get_post_terms( get_the_ID(), 'gallery_tags' );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$galleries_metadata_options = $archive_options['metadata']['photo_galleries'];
		
		if($gallery_tags) {
			echo $before;
		}
		
		if($galleries_metadata_options && $gallery_tags) {
		   	if(in_array('labels', $galleries_metadata_options) && !in_array('icons', $galleries_metadata_options)) {
				echo '<div class="field label">Tags: </div>';  // Text label
			}
		   	if(!in_array('labels', $galleries_metadata_options) && in_array('icons', $galleries_metadata_options)) {
				echo '<span class="sr-only">Tags</span><span class="fa fa-tags"></span>';  // Icon label
			}
		   	if(in_array('labels', $galleries_metadata_options) && in_array('icons', $galleries_metadata_options)) {
				echo '<span class="sr-only">Tags</span><span class="fa fa-tags"></span><span>Tags: </span>';  // Both
			}
		}
		
		foreach($gallery_tags as $gallery_tag_ID) {
			$gallery_tag      = get_term( $gallery_tag_ID );
			$gallery_tag_name = $gallery_tag->name;
			$gallery_tag_link = get_category_link( $gallery_tag_ID );
			if ( strtolower( $gallery_tag_name ) != 'uncategorized' ) {
				echo '<div class="field"><a href="'.$gallery_tag_link.'"><span class="deco">'.ucwords($gallery_tag_name).'</span></a></div>';
			}

		}
		
		if($gallery_tags) {
			echo $after;
		}
		
	}
}

if ( ! function_exists( 'cwd_base_get_gallery_categories' ) ) {
	
	// Gallery categories
	function cwd_base_get_gallery_categories() { 

		$gallery_categories = wp_get_post_terms( get_the_ID(), 'gallery_categories' );
		$before = '<div class="metadata-set">';
		$after = '</div>';
		
		$archive_options = get_field('archive_options', 'options');
		$galleries_metadata_options = $archive_options['metadata']['photo_galleries'];
		
		if($gallery_categories) {
			echo $before;
		}
		
		if($galleries_metadata_options && $gallery_categories) {
		   	if(in_array('labels', $galleries_metadata_options) && !in_array('icons', $galleries_metadata_options)) {
				echo '<div class="field label">Categories: </div>';  // Text label
			}
		   	if(!in_array('labels', $galleries_metadata_options) && in_array('icons', $galleries_metadata_options)) {
				echo '<span class="sr-only">Categories</span><span class="fa fa-folder-open"></span>';  // Icon label
			}
		   	if(in_array('labels', $galleries_metadata_options) && in_array('icons', $galleries_metadata_options)) {
				echo '<span class="sr-only">Categories</span><span class="fa fa-folder-open"></span><span>Categories: </span>';  // Both
			}
		}
		
		if ($gallery_categories) {
			
			foreach($gallery_categories as $gallery_category_ID) {
				$gallery_category      = get_term( $gallery_category_ID );
        		$gallery_category_name = $gallery_category->name;
				$gallery_category_link = get_category_link( $gallery_category_ID );
				if ( strtolower( $gallery_category_name ) != 'uncategorized' ) {
					echo '<div class="field"><a href="'.$gallery_category_link.'"><span class="deco">'.ucwords($gallery_category_name).'</span></a></div>';
				}
				
			}
		}

		if($gallery_categories) {
			echo $after;
		}
		
	}
}
