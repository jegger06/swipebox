<?php

/*

@package Custom Swipebox
=================================
	Plugins Meta Boxes
=================================

*/

function csb_swipebox_meta_box() {

	add_meta_box( 
		'swipebox_metabox',
		'Swipebox Image Uploader',
		'swipebox_metabox_cb',
		'custom-swipebox',
		'normal',
		'high'
	);

}

function swipebox_metabox_cb( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'swipebox_nonce' );
	require_once( SWIPEBOX . 'inc/admin/swipebox-metabox-fields.php' );

}

function csb_swipebox_meta_save( $post_id ) {

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['swipebox_nonce'] ) && wp_verify_nonce( $_POST['swipebox_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exists script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}	

	if ( isset( $_POST['swipebox_image'] ) ) {
		// echo '<pre>';
		$image_data = json_decode( stripslashes( $_POST['swipebox_image'] ) );
		$arrayContainer = array();
		if ( is_object( $image_data[0] ) ) {
			for ($i=0; $i < count($image_data); $i++) { 
				array_push($arrayContainer, array( 'id' => intval( $image_data[$i]->id ), 'src' => esc_url_raw( $image_data[$i]->src ) ));
			}
		$image_data = $arrayContainer;
		} else {
			$image_data = array();
		}

		update_post_meta( $post_id, 'swipebox_image', $image_data );
	}

}

add_action( 'save_post', 'csb_swipebox_meta_save' );