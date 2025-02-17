	<?php 

		// Check if footer menus are being used
		$menu_1_name = 'footer-menu-1';
		$menu_2_name = 'footer-menu-2';

		$locations = get_nav_menu_locations();

		$menu_1_id   = isset($locations[ $menu_1_name ]);
		$menu_2_id   = isset($locations[ $menu_2_name ]);

		$footer_menu_1 = wp_get_nav_menu_object( $menu_1_id );
		$footer_menu_2 = wp_get_nav_menu_object( $menu_2_id );

		// Check for other footer options
		$footer_options = get_field('footer_options', 'options');
		$menu_heading = isset($footer_options['heading']);
		$intro_text = isset($footer_options['intro_text']);
		$address_block = isset($footer_options['address_block']);

	?>

	<footer>
		
		<!-- Only show main footer if it's not empty -->
		<?php 
				if( $footer_menu_1 
					|| $footer_menu_2 
					|| $menu_heading 
					|| $intro_text 
					|| $address_block
					|| get_theme_mod( 'facebook' ) 
					|| get_theme_mod( 'twitter' ) 
					|| get_theme_mod( 'instagram' ) 
					|| get_theme_mod( 'youtube' ) 
					|| get_theme_mod( 'linkedin' ) 
				) { 
		?>
		
			<div class="main-footer">
				<div class="container-fluid sidebar-left">
					<div class="row">
						<div class="primary">

							<?php 
								$heading_and_intro = get_field('footer_options', 'options'); 
								if( $heading_and_intro ) {
									if( $heading_and_intro['heading'] ) {
										echo '<h2 class="h3">' . $heading_and_intro['heading'] . '</h3>';
									}
									if( $heading_and_intro['intro_text'] ) {
										echo '<p>' . $heading_and_intro['intro_text'] . '</p>';
									}
								}
							?>

							<div class="three-col padded footer-links">
								<?php if(has_nav_menu( 'footer-menu-1' )) : ?>
									<div>
										<?php $menu_obj = cwd_base_get_menu_by_location('footer-menu-1'); ?>
										<?php echo '<h3 class="h6">' . esc_html($menu_obj->name) . '</h3>'; ?>
										<?php cwd_base_nav_footer1(); ?>
									</div>
								<?php endif; ?>
								<?php if(has_nav_menu( 'footer-menu-2' )) : ?>
									<div>
										<?php $menu_obj = cwd_base_get_menu_by_location('footer-menu-2'); ?>
										<?php echo '<h3 class="h6">' . esc_html($menu_obj->name) . '</h3>'; ?>
										<?php cwd_base_nav_footer2(); ?>
									</div>
								<?php endif; ?>
								<?php if( ( is_active_sidebar('sidebar-100') ) ) { ?>
									<div>
										<?php dynamic_sidebar('sidebar-100'); ?>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="secondary">

							<?php 
								$address = get_field('footer_options', 'options'); 
								if($address) {
									echo $address['address_block'];
								}
							?>

							<?php 
							
							if ( get_theme_mod( 'facebook' )
								|| get_theme_mod( 'twitter' )
								|| get_theme_mod( 'youtube' )
								|| get_theme_mod( 'instagram' )
								|| get_theme_mod( 'linkedin' ) ) { ?>

								<div class="social">
									<h3 class="sr-only">Follow us on:</h3>
									<?php if ( get_theme_mod( 'facebook' ) ) { ?>
										<a href="<?php echo esc_url( get_theme_mod( 'facebook' ) )?>"><img alt="Facebook" src="<?php echo get_template_directory_uri(); ?>/images/layout/icon_facebook.svg"></a>
									<?php } ?>
									<?php if ( get_theme_mod( 'twitter' ) ) { ?>
										<a href="<?php echo esc_url( get_theme_mod( 'twitter' ) )?>"><img alt="X (formerly known as Twitter)" src="<?php echo get_template_directory_uri(); ?>/images/wp/icon_x.svg"></a>
									<?php } ?>
									<?php if ( get_theme_mod( 'youtube' ) ) { ?>
										<a href="<?php echo esc_url( get_theme_mod( 'youtube' ) )?>"><img alt="YouTube" src="<?php echo get_template_directory_uri(); ?>/images/layout/icon_youtube.svg"></a>
									<?php } ?>
									<?php if ( get_theme_mod( 'instagram' ) ) { ?>
										<a href="<?php echo esc_url( get_theme_mod( 'instagram' ) )?>"><img alt="Instagram" src="<?php echo get_template_directory_uri(); ?>/images/layout/icon_instagram.svg"></a>
									<?php } ?>
									<?php if ( get_theme_mod( 'linkedin' ) ) { ?>
										<a href="<?php echo esc_url( get_theme_mod( 'linkedin' ) )?>"><img alt="LinkedIn" src="<?php echo get_template_directory_uri(); ?>/images/layout/icon_linkedin.svg"></a>
									<?php } ?>
								</div>

							<?php } ?>

						</div>
					</div>
				</div>
			</div>
		
		<?php } ?>
		
		<div class="sub-footer">
			<div class="container-fluid sidebar-left">
				<div class="row">
					<div class="content">
						<div class="two-col">
							<div>
								<ul class="custom inline no-bullet">
									<li><a href="https://www.cornell.edu">Cornell University</a> &copy;<?php echo date("Y"); ?></li>
									<li><a href="https://privacy.cornell.edu/">University Privacy</a></li>
								</ul>
							</div>
							<div>
								<ul class="custom inline no-bullet">
									<li><a href="https://www.cornell.edu/accessibility-assistance.cfm">Web Accessibility Assistance</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</footer>
	
	<?php wp_footer(); ?>
	
</body>
</html>