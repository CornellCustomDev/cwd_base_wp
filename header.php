<!DOCTYPE html>

<html <?php language_attributes(); ?>>
	
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script type="text/javascript"> // Avoid flash of unstyled content
		var elm=document.getElementsByTagName("html")[0];
		elm.style.display="none";
		document.addEventListener("DOMContentLoaded",function(event) { elm.style.display="block"; });
	</script>

	<link rel="profile" href="//gmpg.org/xfn/11">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	
	<!-- Enhanced comments -->
	<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
	
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<div id="skipnav"><a href="#main">Skip to main content</a></div>
	
	<div id="cu-search" class="cu-search">
		<div class="container-fluid">
			<form id="cu-search-form" tabindex="-1" role="search" action="<?php echo site_url(); ?>">
				<label for="cu-search-query" class="sr-only">Search:</label>
				<input type="text" id="cu-search-query" name="s" value="" size="30">
				<button name="btnG" id="cu-search-submit" type="submit" value="go"><span class="sr-only">Submit Search</span></button>

				<fieldset class="search-filters" role="radiogroup">
					<legend class="sr-only">Search Filters</legend>
					<input type="radio" id="cu-search-filter1" name="sitesearch" value="thissite" checked="checked">
					<label for="cu-search-filter1"><span class="sr-only">Search </span>This Site</label> 
					<input type="radio" id="cu-search-filter2" name="sitesearch" value="cornell">
					<label for="cu-search-filter2"><span class="sr-only">Search </span>Cornell</label>
				</fieldset>
			</form>
		</div>
	</div>

	<?php 
	
	$header_img_url = get_header_img_url(); 
	$has_slider = get_add_slider(); 
	
	?>

	<div id="super-header" <?php if($header_img_url || $has_slider == 'Yes') { echo 'class="has_header_image"'; } ?>>
		
		<header id="cu-header">
			<div class="cu45-helper"></div>
			<div class="container-fluid cu-brand">
				<h1 class="cu-logo"><a href="//www.cornell.edu"><img class="sr-only" src="<?php echo get_stylesheet_directory_uri(); ?>/images/cornell/bold_cornell_logo_simple_b31b1b.svg" alt="Cornell University" width="245" height="62"></a></h1>
				<div class="cu-unit">
					<?php if (get_bloginfo('name')) { ?><h2><a href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a></h2><?php } ?>
					<?php if (get_bloginfo('description')) { ?><h3 class="sans"><?php bloginfo('description'); ?></h3><?php } ?>
				</div>
				<div class="buttons">
					<button class="mobile-button" id="mobile-nav">Main Menu</button>
					<button class="mobile-button" id="cu-search-button">Toggle Search Form</button>
					<nav id="utility-navigation" aria-label="Supplementary Navigation">
						<?php cwd_base_nav_top(); ?>
					</nav>
				</div>
			</div>
		</header>
		
		<header id="site-header">
			<nav class="dropdown-menu dropdown-menu-on-demand" id="main-navigation" aria-label="Main Navigation">
				<div class="container-fluid">
					<a id="mobile-home" href="<?php echo site_url(); ?>">
						<span class="sr-only">Home</span>
					</a>
					<?php cwd_base_nav(); ?>
				</div>
			</nav>
		</header>
				
		<?php if($header_img_url) { ?>
			<div id="image-band" class="band" aria-label="Site Banner" style="background-image: url(<?php echo $header_img_url; ?>)"></div>
		<?php } ?>
		
		<?php if(is_front_page() && $has_slider == 'Yes') { ?>
		
			<?php $slide_count = wp_count_posts('slider'); // Are there any published slides? ?>
		
			<div class="band slider-container">
				<div class="container-fluid">
					<div id="slider-caption" class="slider-caption"><?php if($slide_count->publish < 1) echo '<p id="no-active-slides">Add images to activate the slider. You can add images <a href="' . site_url() . '/wp-admin/edit.php?post_type=slider">here</a>.</p>'; ?></div>
				</div>
			</div>
		
		<?php } ?>
		
	</div>