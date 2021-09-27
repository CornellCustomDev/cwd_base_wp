	<footer>
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
						
						<div class="two-col padded footer-links">
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
						</div>
					</div>
					<div class="secondary">
						
						<?php 
							$address = get_field('footer_options', 'options'); 
							if($address) {
								echo $address['address_block'];
							}
						?>
						
						<div class="social">
							<h3 class="sr-only">Follow us on:</h3>
							<?php if ( get_theme_mod( 'facebook' ) ) { ?>
								<a href="<?php echo esc_url( get_theme_mod( 'facebook' ) )?>"><img alt="Facebook" src="<?php echo get_template_directory_uri(); ?>/images/layout/icon_facebook.svg"></a>
							<?php } ?>
							<?php if ( get_theme_mod( 'twitter' ) ) { ?>
								<a href="<?php echo esc_url( get_theme_mod( 'twitter' ) )?>"><img alt="Twitter" src="<?php echo get_template_directory_uri(); ?>/images/layout/icon_twitter.svg"></a>
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
						
					</div>
				</div>
			</div>
		</div>
		
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