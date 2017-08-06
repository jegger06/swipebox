<?php

/*

@package Custom Swipebox
====================================================
	Modiy the action links on viewing all posts
====================================================

*/

function csb_modify_action_links( $actions, $post ) {

	if ( $post->post_type == 'custom-swipebox' ) {
		unset( $actions['view'] );
		unset( $actions['inline hide-if-no-js'] );
	}

	return $actions;

}

add_filter( 'post_row_actions', 'csb_modify_action_links', 10, 2 );