<?php

/*

@package Custom Swipebox
=================================
	Plugins Custom Post Type
=================================

*/

// Swipebox Gallery CPT
function csb_cpt_swipebox() {

	$singular = 'Swipebox Image';
	$plural = 'Swipebox Images';

	$labels = array(
		'name'					=> $plural,
		'singular_name'			=> $singular,
		'add_new'				=> 'Add New',
		'add_new_item'			=> 'Add New ' . $singular,
		'all_items'				=> 'All ' . $plural,
		'edit'					=> 'Edit',
		'edit_item'				=> 'Edit ' . $singular,
		'new_item'				=> 'New ' . $singular,
		'view'					=> 'View ' . $singular,
		'view_item'				=> 'View ' . $singular,
		'search_item'			=> 'Search ' . $plural,
		'parent'				=> 'Parent ' . $singular,
		'not_found'				=> 'No ' . $plural . ' found',
		'not_found_in_trash' 	=> 'No ' . $plural . ' in Trash'
	);

	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'publicly_queryable'	=> true,
		'exclude_from_search'	=> false,
		'show_in_nav_menus'		=> false,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'show_in_admin_bar'		=> true,
		'menu_position' 		=> 115,
		'menu_icon' 			=> 'dashicons-images-alt2',
		'can_export'			=> true,
		'delete_with_user'		=> false,
		'hierarchical'			=> false,
		'has_archive'			=> true,
		'query_var'				=> true,
		'capability_type'		=> 'post',
		'map_meta_cap'			=> true,
		// 'capabilities'			=> array(),
		'rewrite'				=> array(),
		// 'taxonomies'			=> array( 'gallery' ),
		'supports'				=> array(
			'title',
			// 'author'
		),
		'register_meta_box_cb'	=> 'csb_swipebox_meta_box'
	);

	register_post_type( 'custom-swipebox', $args );

}

add_action( 'init', 'csb_cpt_swipebox' );