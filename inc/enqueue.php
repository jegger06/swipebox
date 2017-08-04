<?php

/*

@package Custom Swipebox

========================
	ENQUEUE SCRIPTS
========================

*/

function csb_enqueue_scripts() {

	global $pagenow, $typenow;
	if ( ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) && $typenow == 'custom-swipebox' ) {
		wp_enqueue_style( 'admin-swipebox', plugin_dir_url( __FILE__ ) . 'admin/css/swipebox-upload.css', array(), '0.0.1', 'all' );
		wp_enqueue_script( 'swipebox', plugin_dir_url( __FILE__  ) . 'admin/js/swipebox-upload.js', array( 'jquery', 'media-upload' ), '0.0.1', true );
		wp_localize_script( 'swipebox', 'swipeboxUploads', array( 'imageData' => get_post_meta( get_the_ID(), 'swipebox_image', true ) ) );
	}

}

add_action( 'admin_enqueue_scripts', 'csb_enqueue_scripts' );