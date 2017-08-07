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
		wp_enqueue_media();
		wp_enqueue_script( 'swipebox', plugin_dir_url( __FILE__  ) . 'admin/js/swipebox-upload.js', array( 'jquery', 'media-upload' ), '0.0.1', true );
		wp_localize_script( 'swipebox', 'swipeboxUploads', array( 'imageData' => get_post_meta( get_the_ID(), 'swipebox_image', true ) ) );
		wp_enqueue_script( 'custom-validation', plugin_dir_url( __FILE__ ) . 'admin/js/validation.js', array('jquery'), '0.0.1', true );
	}

}

add_action( 'admin_enqueue_scripts', 'csb_enqueue_scripts' );


// For front-end stuff
function csb_register_script() {

	wp_register_style( 'swipebox-css', plugin_dir_url( __FILE__ ) . 'frontend/css/swipebox.min.css', array(), '1.3.0', 'all' );
	wp_register_style( 'custom-swipebox-css', plugin_dir_url( __FILE__ ) . 'frontend/css/custom.swipebox.css', array(), '0.0.1', 'all' );
	wp_register_script( 'swipebox-script', plugin_dir_url( __FILE__ ) . 'frontend/js/jquery.swipebox.min.js', array( 'jquery' ), '1.3.0', true );
	wp_register_script( 'custom-swipebox-script', plugin_dir_url( __FILE__ ) . 'frontend/js/custom.swipebox.js', array( 'jquery' ), '0.0.1', true );


}

add_action( 'wp_enqueue_scripts', 'csb_register_script' );