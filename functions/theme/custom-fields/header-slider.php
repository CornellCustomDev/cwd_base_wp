<?php

// Add a meta box to replace header image with slider -- next 3 functions
if ( ! function_exists ( 'add_slider_add_meta_box' ) ) {

	function add_slider_add_meta_box() {
		global $post;

		if( $post->ID == get_option( 'page_on_front' ) ) {
			$screens = get_all_post_types();

			foreach ( $screens as $screen ) {
				add_meta_box(
					'add_slider_sectionid',
					__( 'Replace header image on the home page with a slider?', 'cwd_base_textdomain' ),
					'add_slider_meta_box_callback',
					$screen, 'side', 'core'
				);
			}
		}
	}

	add_action( 'add_meta_boxes', 'add_slider_add_meta_box' );
}

// Print the box content
if ( ! function_exists ( 'add_slider_meta_box_callback' ) ) {
	function add_slider_meta_box_callback( $post ) {
		global $post;

		if( $post->ID == get_option( 'page_on_front' ) ) {
			wp_nonce_field( 'add_slider_meta_box', 'add_slider_meta_box_nonce' );
			$add_slider_post_meta = get_post_meta( get_the_ID() ); ?>

			<p><?php echo 'Use the slider menu on the left to add slides or click '; ?><a href="<?php echo admin_url('edit.php?post_type=slider'); ?>">here</a>.</p>

			<p>
				<div class="layout-row-content">
					<p style="margin: .6em 0;">
						<label for="add_slider1id">
							<input type="radio" name="add_slider" id="add_slider1id" value="Yes" <?php if ( isset ( $add_slider_post_meta['add_slider'] ) ) checked( $add_slider_post_meta['add_slider'][0], 'Yes' ); ?>>
							<?php _e( 'Yes', 'cwd_base' )?><br />
						</label>
						<label for="add_slider2id">
							<input type="radio" name="add_slider" id="add_slider2id" value="No" <?php if ( !isset ( $add_slider_post_meta['add_slider'] ) ) echo 'checked="checked"'; ?><?php if ( isset ( $add_slider_post_meta['add_slider'] ) ) checked( $add_slider_post_meta['add_slider'][0], 'No' ); ?>>
							<?php _e( 'No', 'cwd_base' )?>
						</label>
					</p>
				</div>
			</p>

	<?php }

	}
}

// When the post is saved, saves our custom data
if ( ! function_exists ( 'add_slider_save_meta_box_data' ) ) {
	function add_slider_save_meta_box_data( $post_id ) {
		global $post;

		if( isset( $_POST[ 'add_slider' ] ) ) {
			update_post_meta( $post_id, 'add_slider', $_POST[ 'add_slider' ] );
		}
	}

	add_action( 'save_post', 'add_slider_save_meta_box_data' );
}
