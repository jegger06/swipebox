<?php

/*

@package Custom Swipebox
===================================================
	Custom Columns on the Custom Swipebox CPT
===================================================

*/

// Create the custom columns of Custom Swipebox CPT

function csb_set_columns( $columns ) {

	$new_columns = array();
	$new_columns['cb'] = '<input type="checkbox" >';
	$new_columns['title'] = 'Swipebox Name';
	$new_columns['shortcode'] = 'Swipebox Shortcode';
	$new_columns['author'] = 'Created By';
	$new_columns['date'] = 'Date';

	return $new_columns;

}

add_filter( 'manage_custom-swipebox_posts_columns', 'csb_set_columns' );

// Show the value of the columns
function csb_custom_columns( $column, $post_id ) {

	$slug = get_post( $post_id );
	switch ( $column ) {
		case 'shortcode':
			echo '[swipebox name="' . $slug->post_name . '"]';
			break;
	}

}

add_action( 'manage_custom-swipebox_posts_custom_column', 'csb_custom_columns', 10, 2 );