<h1>Cornell Branded Theme 2021</h1>
<p>A WordPress theme based on <a href="https://github.com/CU-CommunityApps/cwd_framework">cwd_framework</a> primarily for use on Campus Press. It is not intended to be used as a parent theme, to minimize the effect of future updates. Themes based on this theme should be standalone, custom themes that can be updated individually.</p>

<p><strong>Tags:</strong> accessibility-ready, blog, custom-background, custom-colors, custom-<span class="glossary-item-container tippy-active" tabindex="0" aria-describedby="tippy-11">header, </span>custom-menu, editor-style, featured-image-header, featured-images, footer-widgets, full-width-template, grid-layout, left-sidebar, one-column, right-sidebar, sticky-post, theme-options, threaded-comments, two-columns, wide-blocks</p>

<h2>Updating</h2>
<p>As the <a href="https://github.com/CU-CommunityApps/cwd_base">cwd_base</a> theme is updated, the goal here is to apply those updates to this theme without overwriting any WordPress-specific files or code. This is easily done. Just five portable folders are required for framework updates:</p>

<p>
/css<br>
/fonts<br>
/js<br>
/sass<br>
/images<br>
</p>
  
<em>This theme contains three extra SASS files:</em>

cwd_wp.scss<br>
admin.scss<br>
editor-style.scss<br>

<em>Four extra JS files:</em>

cwd_wp.js<br>
admin.js<br>
siteimprove.js<br>
formidable_validation.js (a11y helper for Formidable Forms)

<em>And an extra image folder:</em>

/images/wp

<h2>File Structure</h2>
<p><em>Functions</em></p>

<p><strong>ALL</strong> theme functions exist in the /functions folder or are called from functions.php.</p>

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

<ol><li>WordPress requests a regular page, and page.php provides the basic markup. When it reaches the content loop, it looks for the template part called content-page.php. That will be the default page loop for all pages, but if you need to customize the loop for the About page (as an example), simply copy content-page.php and rename it content-page-about.php.</li>

<li>The news archive page is requested by WordPress and archive.php will provide the basic page markup. The loop, however, looks for a template part, and the first template part it will look for is content-archive-news.php. If it doesn't find content-archive-news.php, then it will just use content-archive.php. Copy content-archive.php and rename it content-archive-news.php to customize the news listings.</li></ol>

The same structure applies for single posts, categories, and tag and taxonomy templates.
<h2>Post Types (content types)</h2>
Three post types are included in this theme: News, Events, and People, since these are the most common custom post types requested on Campus Press. Each contains the most common custom fields which can be edited, added or removed. When developing your custom theme, you can toggle these post types on an off in the functions.php file:<br><br>

<em> &lt;!-- Content Types: uncomment to activate --&gt;</em><br>
'/functions/content-types/news/post-type.php',<br>
'/functions/content-types/events/post-type.php',<br>
'/functions/content-types/people/post-type.php',<br>

TO DO: add these post types (and others) as options on the Theme Options page.

Note: The news and events content types are based on two CD plugins by <a href="https://github.com/CU-CommunityApps/cd-news-pull-wp-plugin/commits?author=philwilliammee">philwilliammee</a> located here:

News: <a href="https://github.com/CU-CommunityApps/cd-news-pull-wp-plugin" data-pjax="#js-repo-pjax-container">cd-news-pull-wp-plugin</a><br>
Events: <a href="https://github.com/CU-CommunityApps/cd-events-pull-wp-plugin" data-pjax="#js-repo-pjax-container">cd-events-pull-wp-plugin</a><br>

Both plugins are still under active development, but can be found and updated within this theme in the /functions/content-type folders.
<h2>Theme Options</h2>
To be cont'd...
