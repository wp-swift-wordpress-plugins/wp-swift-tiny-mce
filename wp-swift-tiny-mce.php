<?php
/*
Plugin Name: WP Swift: Tiny MCE Extras
Plugin URI: 
Description: Adds extra function to WYSIWYG editor which allows user to add classes such as lead paragraph. This also loads the front-end css into the WYSIWYG so we can see the changes.
Version: 1
Author: Gary Swift
Author URI: https://github.com/wp-swift-wordpress-plugins
License: GPL2
*/

/*
 * Filters the second-row list of TinyMCE buttons (Visual tab)
 *
 * @link https://developer.wordpress.org/reference/hooks/mce_buttons_2/
 */
function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');


/*
 * Callback function to filter the MCE settings
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/tiny_mce_before_init
 */
function foundationpress_before_tiny_mce_init_insert_formats( $init_array ) {  

	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Lead Paragraph',  
			'block' => 'div',  
			'classes' => 'lead',
			'wrapper' => true,
		),			
	);  

	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array;
} 
/*
 * Attach callback to 'tiny_mce_before_init' 
 */
add_filter( 'tiny_mce_before_init', 'foundationpress_before_tiny_mce_init_insert_formats' ); 



/**
 * Registers an editor stylesheet for the theme.
 */
function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'css/style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );