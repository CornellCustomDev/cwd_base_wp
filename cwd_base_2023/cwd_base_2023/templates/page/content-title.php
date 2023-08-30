<?php // Page titles 

if( is_search() ) $searchTerm = sanitize_text_field($_GET['s']); 
if( is_category() ) $category = single_cat_title('', false); 
if( is_tax() ) $taxonomy = single_term_title('', false); 
if( is_tag() ) $tag = single_tag_title('', false); 

// Front page replace title option. Default: "Welcome"
if( is_front_page() ) {
	$home_page_options = get_field('home_page_options', 'options');
	if($home_page_options['replace_title']) {
		echo '<h1>' . $home_page_options['replace_title'] . '</h1>';
	}
}

// Blog page replace title option. Default: "Latest Posts"
elseif( is_home() ) {
	$blog_page_options = get_field('blog_page_options', 'options');
	echo '<h1>' . $blog_page_options['replace_title'] . '</h1>'; 
}

// Regular pages and single posts
elseif( !is_front_page() && (is_page() || is_single()) ) { 
	echo  '<h1>' . get_the_title() . '</h1>';
	if('courses' == get_post_type()) {
		if(get_field('additional_text')) {
			echo ' - <span>' . get_field("additional_text") . '</span>';
		}
	}
}

// All post types
elseif( is_post_type_archive() ) echo  '<h1>' . post_type_archive_title('', false) . '</h1>';

// Taxonomies
elseif( is_tax() ) echo '<h1><span class="archive-title">' . $taxonomy . '</span></h1>';

// NOTE: it is usually preferable not to prepend these taxonomy titles, so I'm commenting them out for now.

//elseif( is_tax('event_tags') ) echo 'Event Tag: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('event_types') ) echo 'Event Type: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('event_groups') ) echo 'Event Group: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('news_tags') ) echo 'News Tag: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('news_categories') ) echo 'News Category: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('people_tags') ) echo 'People Tag: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('people_categories') ) echo 'People Category: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('course_tags') ) echo 'Course Tag: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('course_categories') ) echo 'Course Category: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('spotlight_tags') ) echo 'Spotlight Tag: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('spotlight_categories') ) echo 'Spotlight Category: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('gallery_tags') ) echo 'Gallery Tag: <span class="archive-title">' . $taxonomy . '</span>';
//elseif( is_tax('gallery_categories') ) echo 'Gallery Category: <span class="archive-title">' . $taxonomy . '</span>';

// WP Core
elseif( is_tag() ) echo '<h1><span class="archive-title">' . $tag . '</span></h1>'; 
elseif( is_category() ) echo '<h1><span class="archive-title">' . $category . '</span></h1>'; 
elseif( is_search() ) echo '<h1>Search Results for: <span class="archive-title">' . $searchTerm . '</span></h1>';