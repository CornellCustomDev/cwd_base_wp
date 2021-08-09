<?php // Page titles 

if( is_search() ) $searchTerm = sanitize_text_field($_GET['s']); 
if( is_category() ) $category = single_cat_title('', false); 
if( is_tax() ) $taxonomy = single_term_title('', false); 
if( is_tag() ) $tag = single_tag_title('', false); 

?>

<h1>
	
	<?php 
	
		// Front page replace title option. Default: "Welcome"
		if( is_front_page() ) {
			$home_page_options = get_field('home_page_options', 'options');
			echo $home_page_options['replace_title']; 
		}
		
		// Blog page replace title option. Default: "Latest Posts"
		elseif( is_home() ) {
			$blog_page_options = get_field('blog_page_options', 'options');
			echo $blog_page_options['replace_title']; 
		}
	
		// Regular pages and single posts
		elseif( !is_front_page() && (is_page() || is_single()) ) { 
			echo get_the_title();
		}
	
		// People
		elseif( is_post_type_archive('people') ) echo 'People';
	
		// News
		elseif( is_post_type_archive('news') ) echo 'News';
	
		// Course
		elseif( is_post_type_archive('courses') ) echo 'Courses';
	
		// Testimonials
		elseif( is_post_type_archive('testimonials') ) echo 'Testimonials';
	
		// Galleries
		elseif( is_post_type_archive('galleries') ) echo 'Galleries';
	
		// Events
		elseif( is_post_type_archive('events') ) echo 'Events';
	
		// Taxonomies
		elseif( is_tax('event_tags') ) echo 'Event Tag: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('event_types') ) echo 'Event Type: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('event_groups') ) echo 'Event Group: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('news_tags') ) echo 'News Tag: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('news_categories') ) echo 'News Category: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('people_tags') ) echo 'People Tag: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('people_categories') ) echo 'People Category: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('course_tags') ) echo 'Course Tag: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('course_categories') ) echo 'Course Category: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('testimonial_tags') ) echo 'Testimonial Tag: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('testimonial_categories') ) echo 'Testimonial Category: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('gallery_tags') ) echo 'Gallery Tag: <span class="archive-title">' . $taxonomy . '</span>';
		elseif( is_tax('gallery_categories') ) echo 'Gallery Category: <span class="archive-title">' . $taxonomy . '</span>';
	
		// WP Core
		elseif( is_tag() ) echo 'Tag: <span class="archive-title">' . $tag . '</span>'; 
		elseif( is_category() ) echo 'Category: <span class="archive-title">' . $category . '</span>'; 
		elseif( is_search() ) echo 'Search Results for: <span class="archive-title">' . $searchTerm . '</span>';
	
	?>

</h1>