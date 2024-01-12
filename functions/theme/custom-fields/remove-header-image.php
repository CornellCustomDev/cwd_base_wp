<?php

// Add a meta box to remove header image
if ( ! function_exists ( 'remove_this_header_add_meta_box' ) ) {
	function remove_this_header_add_meta_box() {
		$screens = get_all_post_types();

		foreach ( $screens as $screen ) {
			add_meta_box(
				'remove_this_header_sectionid',
				'Remove header image?',
				'remove_this_header_meta_box_callback',
				$screen, 'side', 'core'
			);
		}
	}

	add_action( 'add_meta_boxes', 'remove_this_header_add_meta_box' );
}

// Print the box content
if ( ! function_exists ( 'remove_this_header_meta_box_callback' ) ) {
	function remove_this_header_meta_box_callback( $post ) {
		// Add a nonce field so we can check for it later
		wp_nonce_field( 'remove_this_header_meta_box', 'remove_this_header_meta_box_nonce' );
		$remove_this_header_post_meta = get_post_meta( get_the_ID() ); ?>

		<p>
			<div class="layout-row-content">
				<p style="margin: .6em 0;">
					<label for="remove_this_header1id">
						<input type="radio" name="remove_this_header" id="remove_this_header1id" value="Yes" <?php if ( isset ( $remove_this_header_post_meta['remove_this_header'] ) ) checked( $remove_this_header_post_meta['remove_this_header'][0], 'Yes' ); ?>>
						<?php _e( 'Yes', 'cwd_base' )?><br />
					</label>
					<label for="remove_this_header2id">
						<input type="radio" name="remove_this_header" id="remove_this_header2id" value="No" <?php if ( !isset ( $remove_this_header_post_meta['remove_this_header'] ) ) echo 'checked="checked"'; ?><?php if ( isset ( $remove_this_header_post_meta['remove_this_header'] ) ) checked( $remove_this_header_post_meta['remove_this_header'][0], 'No' ); ?>>
						<?php _e( 'No', 'cwd_base' )?>
					</label>
				</p>
			</div>
		</p>

	<?php

	}
}

// When the post is saved, saves our custom data
if ( ! function_exists ( 'remove_this_header_save_meta_box_data' ) ) {
	function remove_this_header_save_meta_box_data( $post_id ) {
		// Checks for input and saves if needed
		if( isset( $_POST[ 'remove_this_header' ] ) ) {
			update_post_meta( $post_id, 'remove_this_header', $_POST[ 'remove_this_header' ] );
		}
	}

	add_action( 'save_post', 'remove_this_header_save_meta_box_data' );
}
