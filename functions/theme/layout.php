<?php

// Adds a meta box to the side column on edit screens for choosing the layout.
if ( ! function_exists ( 'custom_layout_add_meta_box' ) ) {
	
	function custom_layout_add_meta_box() {
		global $post;

		$page_for_posts = get_option( 'page_for_posts' );
		
		$screens = get_all_post_types();

		foreach ( $screens as $screen ) {
			
			if( $post->ID != $page_for_posts ) { // Don't show on blog page
				add_meta_box(
					'custom_layout_sectionid',
					__( 'Layout Options', 'cwd_base' ),
					'custom_layout_meta_box_callback',
					$screen, 'side', 'core'
				);
			}
		}
	}
	add_action( 'add_meta_boxes', 'custom_layout_add_meta_box' );
}

// Prints the box content
if ( ! function_exists ( 'custom_layout_meta_box_callback' ) ) {
	
	function custom_layout_meta_box_callback( $post ) {

		// Add a nonce field so we can check for it later
		wp_nonce_field( 'custom_layout_meta_box', 'custom_layout_meta_box_nonce' );
		$layout_post_meta = get_post_meta( get_the_ID() );
		
		// Set default
		if ( !array_key_exists( 'layout_option', $layout_post_meta ) || $layout_post_meta['layout_option'][0] == '' ) {
		  $layout_post_meta['layout_option'][0] = 'right_sidebar';
		}
		?>

		<p>Sidebars must contain at least one widget. Empty sidebars will not be displayed.</p>

		<p>

			<div class="layout-row-content">
				<p style="margin: .6em 0;">
					<label for="left_sidebar">
						<input type="radio" name="layout_option" id="left_sidebar" value="left_sidebar" <?php if ( isset ( $layout_post_meta['layout_option'] ) ) checked( $layout_post_meta['layout_option'][0], 'left_sidebar' ); ?> />
						<?php _e( 'Left Sidebar', 'cwd_base' )?><br />
					</label>
				</p>
				<p style="margin: .6em 0;">
					<label for="right_sidebar">
						<input type="radio" name="layout_option" id="right_sidebar" value="right_sidebar" <?php if ( isset ( $layout_post_meta['layout_option'] ) ) checked( $layout_post_meta['layout_option'][0], 'right_sidebar' ); ?> />
						<?php _e( 'Right Sidebar', 'cwd_base' )?><br />
					</label>
				</p>
				<p style="margin: .6em 0;">
					<label for="no_sidebar">
						<input type="radio" name="layout_option" id="no_sidebar" value="no_sidebar" <?php if ( isset ( $layout_post_meta['layout_option'] ) ) checked( $layout_post_meta['layout_option'][0], 'no_sidebar' ); ?> />
						<?php _e( 'No Sidebar (Full width)', 'cwd_base' )?>
					</label>
				</p>
			</div> 

		</p>

	<?php }
}

// When the post is saved, saves our custom data
if ( ! function_exists ( 'custom_layout_save_meta_box_data' ) ) {
	
	function custom_layout_save_meta_box_data( $post_id ) {

		// Check if our nonce is set.
		if ( ! isset( $_POST['custom_layout_meta_box_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['custom_layout_meta_box_nonce'], 'custom_layout_meta_box' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		// Checks for input and saves if needed
		if( isset( $_POST[ 'layout_option' ] ) ) {
			update_post_meta( $post_id, 'layout_option', $_POST[ 'layout_option' ] );
		}

	}
	add_action( 'save_post', 'custom_layout_save_meta_box_data', 999 );
}

// Get layout for the current page
if ( ! function_exists ( 'get_layout' ) ) {
	
	function get_layout() {
		
		$post_type = get_post_type();

		$sidebar_options = get_field('sidebar_options', 'options');
		$layout = $sidebar_options['layout'];
		
		if( is_archive() || is_search() || is_tag() || is_tax() || is_category() || is_home() ) {
			$archive_options = get_field('archive_options', 'options');
			$layout = $archive_options[$post_type]['layout_' . $post_type];
		}
		else {
			$layout_post_meta = get_post_meta( get_queried_object_id() );
			$layout = isset($layout_post_meta['layout_option'][0]) ? $layout_post_meta['layout_option'][0] : null;
		}
		
		// Set default layout if...
		if ($layout == '') {
			$layout = 'right_sidebar';
		}
		
		return $layout;

	}
}
