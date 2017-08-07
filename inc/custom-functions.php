<?php

/*

@package Custom Swipebox
===============================
	Custom functions/filters
===============================

*/

function csb_change_title( $title_placeholder ) {

	global $pagenow, $typenow;

	if ( ( $pagenow == 'post-new.php' || $pagenow == 'post.php') && $typenow == 'custom-swipebox' ) {

		$title_placeholder = 'Enter swipebox name here';

	}

	return $title_placeholder;

}

add_filter( 'enter_title_here', 'csb_change_title' );