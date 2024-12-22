<h1>Cornell Branded Theme 2024</h1>
A WordPress theme based on <a href="https://github.com/CU-CommunityApps/cwd_framework">cwd_framework</a>.<br><br>

<strong>Tags:</strong> accessibility-ready, blog, custom-background, custom-colors, custom-<span class="glossary-item-container tippy-active" tabindex="0" aria-describedby="tippy-11">header, </span>custom-menu, editor-style, featured-image-header, featured-images, footer-widgets, full-width-template, grid-layout, left-sidebar, one-column, right-sidebar, sticky-post, theme-options, threaded-comments, two-columns, wide-blocks
<h2>Updating</h2>
As the <a href="https://github.com/CU-CommunityApps/cwd_base">cwd_base</a> theme is updated, the goal here is to apply those updates to this theme without overwriting any WordPress-specific files or code. This is easily done. Just five portable folders are required for framework updates:<br><br>

/css<br>
/fonts<br>
/js<br>
/sass<br>
/images<br>

<em>This theme contains three extra SASS files:</em>

cwd_wp.scss<br>
admin.scss<br>
editor-style.scss<br>

<em>Four extra JS files:</em>

cwd_wp.js<br>
admin.js<br>
siteimprove.js<br>
formidable_validation.js (a11y helper for Formidable Forms)<br>

<em>And an extra image folder:</em>

/images/wp<br>
<h2>File Structure</h2>

<em>Functions</em>

<strong>ALL</strong> theme functions exist in the /functions folder or are called from functions.php.

<em>Templates</em>

WordPress default templates in the root folder are called first:

archive.php<br>
category.php<br>
footer.php<br>
front-page.php<br>
header.php<br>
index.php<br>
page.php<br>
search.php<br>
single.php<br>
sidebar-top.php<br>
sidebar-bottom.php<br>
tag.php<br>
taxonomy.php<br>

<em>Template parts</em>

The bulk of any customizations will happen in the /templates folder. Template parts are called from the default templates, and naming conventions are based on post types, categories, terms (tags and custom taxonomies).

Examples:
<ol>
 	<li>WordPress requests a regular page, and <strong>page.php</strong> provides the basic markup. When it reaches the content loop, it looks for the template part called content-page.php. That will be the default page loop for all pages, but if you need to customize the loop for the About page (as an example), simply copy <strong>content-page.php</strong> and rename it <strong>content-page-about.php</strong>.</li>
 	<li>The news archive page is requested by WordPress and <strong>archive.php</strong> will provide the basic page markup. The loop, however, looks for a template part, and the first template part it will look for is content-archive-news.php. If it doesn't find content-archive-news.php, then it will just use <strong>content-archive.php</strong>. Copy content-archive.php and rename it <strong>content-archive-news.php</strong> to customize the news listings.</li>
</ol>
The same structure applies for single posts, categories, and tag and taxonomy templates.
<h2>Post Types (content types)</h2>
Three post types are included in this theme: News, Events, and People, since these are the most common custom post types requested on Campus Press. Each contains the most common custom fields which can be edited, added or removed. When developing your custom theme, you can toggle these post types on an off in the functions.php file:<br><br>

<em> &lt;!-- Content Types: uncomment to activate --&gt;</em><br>
'/functions/content-types/news/post-type.php',<br>
'/functions/content-types/events/post-type.php',<br>
'/functions/content-types/people/post-type.php',<br>

<strong>TO DO:</strong> add these post types (and others) as options on the Theme Options page.

<strong>Note:</strong> The news and events content types are based on two CD plugins by <a href="https://github.com/CU-CommunityApps/cd-news-pull-wp-plugin/commits?author=philwilliammee">philwilliammee</a> located here:

News: <a href="https://github.com/CU-CommunityApps/cd-news-pull-wp-plugin" data-pjax="#js-repo-pjax-container">cd-news-pull-wp-plugin</a><br>
Events: <a href="https://github.com/CU-CommunityApps/cd-events-pull-wp-plugin" data-pjax="#js-repo-pjax-container">cd-events-pull-wp-plugin</a>

Both plugins are still under active development, but can be found and updated within this theme in the /functions/content-type folders.

<em>Custom fields</em>

<strong>People:</strong> name, description, image, title, department, and website URL<br>
<strong>News:</strong> image, title, description, date of publication<br>
<strong>Events: </strong>image, title, description, start date, end date, start time, end time, all day, location, room, event URL, Zoom link, contact email<br>

*All custom post types have the "Feature on front page" option built-in, including the WP_Query required for such an option. Call it a time saver.

<em>Custom taxonomies</em>

The news content types uses the default (WP core) tags and categories, but the events content type uses three custom taxonomies:

event_tags<br>
event_types<br>
event_groups<br>

<strong>Important!</strong> This theme does not use pages for custom post type archives. It uses the default slug that is programmed when the content type is created. This slug can be anything, but it does <em>not</em> require or use an actual page with the same name. This can be confusing, because if a page with the same name <em>does</em> exist (such as a news page for news archives), then none of the in-page options will apply to the archive listings and keeping such a page in the page hierarchy is essentially meaningless. <em>However</em>, this theme makes use of the hitherto useless and meaningless page by inserting the editor content from that page above the archive listings, if such content exists.

<strong>TO DO:</strong> make use of the other in-page options of meaningless pages, not just the editor content, such as sidebar and header image options.
<h2>Theme Options</h2>
<em>Customizer</em><br><br>

<strong>Site Identity:</strong> site name and tagline<br>
<strong>Banner:</strong> color, logo, logo size, and mobile<br>
<strong>Header image:</strong> the header image that is assigned in the customizer will be the sitewide header, unless overridden on a per page (or per section) basis. Cropped to 1280x320.<br>
<strong>Background image:</strong> this theme supports background images for the main body of the page, but it is debatable whether or not this should be an option. With the right image, it could be great, but sometimes we do things just to see if we can :)<br>
<strong>Menus:</strong> core menu options, also available on the Settings-&gt;Menu page<br>
<strong>Widgets:</strong> core widget options, also available on the Settings-&gt;Widgets page<br>
<strong>Homepage Settings:</strong> set home and blog pages, also available on the Settings-&gt;Reading page<br>
<strong>Additional CSS:</strong> self-explanatory<br>
<strong>Section Titles:</strong> three widget areas below the main content and above the footer. Add a title to these sections with the option to center the title and/or center the text (if it is a text widget).<br>
<strong>Social icons:</strong> add a social media URL to show the corresponding icon in the footer. There are only five available now, but many more are available in footer.php. Just uncomment them to activate them. Uses .svg icons available in the base framework.<br>

<em>In-page options</em>

The options available on individual pages include sidebar positioning, header images, and custom URLs for pointing any content to an external URL.

The so-called featured images are used as banner images only, so an extra image field has been added to provide the usual featured functionality which provides thumbnails and/or main content area images.

The home page contains an additional option to replace the home page featured image with a slider. This is a one-click option which will insert a slider and instruct the user how to add images.

<em>Theme Options Page</em>

<strong>Home Page:</strong> change, remove, or replace the home page title , remove breadcrumbs from the home page.<br>
<strong>Blog Page:</strong> change, remove, or replace the blog page title, add introductory text<br>
<strong>Main navigation:</strong> change the menu depth from the default 2. Choices: 1, 2, or 3<br>
<strong>Sidebars: </strong>default placement of the sidebar is to the right of the main content, but this can be overridden on a page by page basis from the page edit screen. Empty sidebars will force a full-width (no sidebar) layout, regardless of individual page options. The theme options page allows you to choose tinting options from the base theme: tinting or no tinting, full tint or fade to white.<br>
<strong>Archives: </strong>archives do not contain in-page options, since they are not pages: the main blog page, custom post type archives, search results, and category and tag pages. Choose sidebar position, appearance (list or grid), and metadata options for all such archives. Also choose the excerpt length in number of characters.<br>
<strong>Footer:</strong> primary and secondary footer areas. The primary footer area can optionally contain up to two menus. The secondary footer area is usually reserved as an address block. These options allow you to edit the address block and optionally add headings and introductory text above the menus in the primary footer area.<br>
<h2>Miscellaneous</h2>
This theme uses a sidebar widget area intended exclusively for section navigation. Simply insert the section navigation widget into the dedicated sidebar area, and add settings.<br><br>

The default WordPress image gallery has been adapted to use the markup and classes from the base theme framework.<br>

Pagination options can be found in the main menu under Appearance-&gt;Pagination.<br><br>

<h2>To Do (6/9/21)</h2>
<ul>
<li>Convert this document for customer use</li>
<li>Add editor styles</li>
<li>Left align editor content</li>
<li>Fix active state for utility navigation menu</li>
<li>Add some default header images to options.</li>
<li>Upload images from news and events feeds to media library</li>
<li>Create advanced theme for Pantheon. Need to figure out what that means.</li>
<li>Prepare demo site for testing</li>
<li>Fix default theme settings and test theme activation and switching</li>
<li>Discuss and remediate date formatting with Phil</li>
<li>Styling for news, events, and people custom fields.</li>
<li>Convert in-page tag options to category meta boxes</li>
<li>Add admin columns for custom fields and custom taxonomies</li>
<li>Work on date formatting and ordering with Phil</li>
<li>QA/WA/functionality testing and fixes</li>
</ul>
