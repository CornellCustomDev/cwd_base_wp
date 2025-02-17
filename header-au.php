<!DOCTYPE html>

<html <?php language_attributes(); ?>>
	
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Enhanced comments -->
	<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
	
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	
	<?php wp_body_open(); ?>

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
	$has_slider = get_field('use_slider_in_header'); 
	
	?>

	<div id="super-header" <?php if($header_img_url || $has_slider == 'Yes') { echo 'class="has_header_image"'; } ?>>
		
		<header id="cu-header" aria-label="Cornell Header">
			<div class="cu45-helper"></div>
			<div class="container-fluid cu-brand">

				<h1 class="cu-logo">

					<?php $au_boolean = get_theme_mod('au_boolean'); ?>
					<?php //echo 'Checked? ' . $au_boolean; ?>

					<?php 
						$au_logo = get_theme_mod('au_logo');
						$au_label = str_replace('-', ' ', $au_logo);
						$au_label = ucwords($au_label);						
					?>

					<div id="academic-unit">
						<a href="https://cornell.edu">
							<img class="sr-only" src="<?php echo get_stylesheet_directory_uri(); ?>/images/wp/CHE_logo_1line_black_SimpleSeal_red.png" alt="Cornell University" width="504" height="73">
						</a>
						<a href="https://human.cornell.edu"><p class="sr-only"><?php echo $au_label; ?></p></a>
					</div>

				</h1>

				<div class="cu-unit">
					<?php if (display_header_text()==true) { ?>
						<h2><a href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a></h2>
						<?php if(get_bloginfo('description')) { ?>
							<h3 class="sans"><?php bloginfo('description'); ?></h3>
						<?php } ?>
					<?php } ?>
				</div>

				<div class="buttons">
					<button class="mobile-button" id="mobile-nav">Main Menu</button>
					<button class="mobile-button" id="cu-search-button">Toggle Search Form</button>
					<nav id="utility-navigation" aria-label="Supplementary Navigation" class="dropdown-menu dropdown-menu-on-demand">
						<?php cwd_base_nav_top(); ?>
					</nav>
				</div>
			</div>
		</header>
		
		<header id="site-header" aria-label="Site Header">
			
			<?php if ( $has_slider ): ?>
			<div class="band slider-container">
				<div class="container-fluid">
				<div id="slider-caption" class="slider-caption align-caption-<?php the_field('slider_align'); ?>"></div>
				</div>
			</div>
			<?php elseif ( $header_img_url ): ?>
				<div id="image-band" class="band" aria-label="Site Banner" style="background-image: url(<?php echo $header_img_url; ?>)"></div>
			<?php endif; ?>
			
			<nav class="dropdown-menu dropdown-menu-on-demand" id="main-navigation" aria-label="Main Navigation">
				<div class="container-fluid">
					<a id="mobile-home" href="<?php echo site_url(); ?>">
						<span class="sr-only">Home</span>
					</a>
					<?php cwd_base_nav(); ?>
				</div>
			</nav>
			
		</header>
		
	</div>