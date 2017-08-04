<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
Plugin Name: Custom Swipebox
Plugin URI: https://jpsaren.com/plugins/custom-swipebox
Description: Swipebox is a jQuery "lightbox" plugin for desktop, mobile and tablet. Swipe gestures for mobile. Keyboard Navigation for desktop. CSS transitions with jQuery fallback. Retina support for UI icons. Easy CSS customization.
Version: 1.4.4
Author: Jegger Saren
Author URI: https://jpsaren.com
*/

define( 'SWIPEBOX', plugin_dir_path( __FILE__ ) );


require_once ( SWIPEBOX . '/inc/custom-post-type.php' );
require_once ( SWIPEBOX . '/inc/taxonomies.php' );
require_once ( SWIPEBOX . '/inc/meta-boxes.php' );
require_once ( SWIPEBOX . '/inc/enqueue.php' );
