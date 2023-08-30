<?php // Colorband widgets 

$center_headings = get_theme_mod('center_headings');
$center_text = get_theme_mod('center_text');

?>

<?php if ( is_active_sidebar( 'sidebar-97' ) ) : ?>
    <div class="band colorband accent4 padded" role="complementary">
        <div class="container-fluid">
			<div class="row">
            	<?php if ( get_theme_mod('heading_one') != '' ) : ?>
					<h2 class="section-title<?php if($center_headings == 'yes'){echo ' center';} ?>">
						<?php echo get_theme_mod('heading_one', 'Heading One'); ?>
					</h2>
				<?php endif; ?>
				<div class="columns padded<?php if($center_text == 'yes'){echo ' center';} ?>">
					<?php dynamic_sidebar( 'sidebar-97' ); ?>
				</div>
			</div>
        </div>
    </div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar-98' ) ) : ?>
    <div class="band colorband accent2 padded" role="complementary">
        <div class="container-fluid">
			<div class="row">
            	<?php if ( get_theme_mod('heading_two') != '' ) : ?>
					<h2 class="section-title<?php if($center_headings == 'yes'){echo ' center';} ?>">
						<?php echo get_theme_mod('heading_two', 'Heading Two'); ?>
					</h2>
				<?php endif; ?>
				<div class="columns padded<?php if($center_text == 'yes'){echo ' center';} ?>">
					<?php dynamic_sidebar( 'sidebar-98' ); ?>
				</div>
			</div>
        </div>
    </div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar-99' ) ) : ?>
    <div class="band colorband accent1 padded" role="complementary">
        <div class="container-fluid">
			<div class="row">
            	<?php if ( get_theme_mod('heading_three') != '' ) : ?>
					<h2 class="section-title<?php if($center_headings == 'yes'){echo ' center';} ?>">
						<?php echo get_theme_mod('heading_three', 'Heading Three'); ?>
					</h2>
				<?php endif; ?>
				<div class="columns padded<?php if($center_text == 'yes'){echo ' center';} ?>">
					<?php dynamic_sidebar( 'sidebar-99' ); ?>
				</div>
			</div>
        </div>
    </div>
<?php endif; ?>
