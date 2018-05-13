<?php

/**
 * @package Ezbreezies
 * Ezbreezies Functions and Includes
**/


/**
 * Removing default wp jquery in favor of latest version
 * @link https://css-tricks.com/snippets/wordpress/include-jquery-in-wordpress-theme/
**/

if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

// require get_template_directory() . '/functions.php';

// Enqueue scripts and styles.

function ezbreezies_styles() {

	wp_enqueue_style( 'ezbreezies-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'ezbreezies-main-style', get_template_directory_uri() . '/library/css/main-min.css' );

}
add_action( 'wp_enqueue_scripts', 'ezbreezies_styles' );

function ezbreezies_scripts() {

	wp_enqueue_script( 'ezbreezies-js', get_template_directory_uri() . '/library/js/min/scripts-min.js', array(), false, true );

}
add_action( 'wp_enqueue_scripts', 'ezbreezies_scripts' );





