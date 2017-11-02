<?php
/*
Plugin Name: Homes
Description: Declares a plugin that will create a custom post type displaying homes.
Version: 1.0
Author: zig & sully, Reach Maine Marketing.
Author URI: https://www.reachmaine.com
License: GPLv2
*/

/******* Custom Post type for homes ***********/
add_action ('init', 'create_homes_posttype');
if (!function_exists('create_homes_posttype')) {
	function create_homes_posttype() {

		register_post_type( 'homes',
		    array (
		      'labels' => array(
		        'name' => __( 'Homes' ),
		        'singular_name' => __( 'Home' )
		    ),
		      'taxonomies' => array('category', 'post_tag'),
		      'public' => true,
		      'has_archive' => true,
		      'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes' ),
          'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
          // 'menu_icon' => 'dashicons-admin-multisite',
		      'rewrite' => array('slug' => 'homes'),
		)   );
		//flush_rewrite_rules();
	}
}

add_filter( 'template_include', 'include_template_function', 1 );
function include_template_function( $template_path ) {
    if ( get_post_type() == 'homes' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-homes.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-homes.php';
            }
        }
    }
    return $template_path;
}
?>
