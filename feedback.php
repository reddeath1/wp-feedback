<?php
/**
 * Plugin Name: Feedback | Frank Galos
 * Author:Frank Galos
 * Email:frankslayer1@gmail.com
 * Description: This plugin is for displaying user feedback for darceramica.co.tz!
 * @license: Apache License 2.0
 * @link: https://github.com/reddeath1/wp-feedback
 * @package: wp-feedback
 */




function fb_add_menu(){

    add_menu_page( 'DCC Feedback',
        'Feedback',
        'manage_options',
        'feedback',
        'fb_setup',
        plugins_url('/images/logo.png',__FILE__)
    );
}

function fb_styles(){
    // Register the style like this for a plugin:
    wp_register_style( 'bootstrap', "//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css", array(), '20120208', 'all' );

    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'bootstrap' );
    // Register the style like this for a plugin:
    wp_register_style( 'feedback-style', plugins_url( '/css/style.css', __FILE__ ), array(), '20120208', 'all' );

    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'feedback-style' );
}

function fb_scripts(){
    // Register the script like this for a plugin:
    wp_register_script( 'bootstrap',"//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js",array() );

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'bootstrap' );
    // Register the script like this for a plugin:
    wp_register_script( 'feedback-script', plugins_url( '/js/js.js', __FILE__ ),array( 'jquery') );

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'feedback-script' );
}

function add_fb_shortcode(){

    $url = plugin_dir_url().'feedback/includes';
    $user = (int) current_user_can('administrator');
    $data = "I m feedback" ;

    return $data;
}

function fb_setup(){
    include_once( 'views/Home.php' );
}

function fb_install(){
    add_shortcode('fb_shortcode','add_fb_shortcode');
}

function fb_uninstall(){

}


add_action( 'admin_menu', 'fb_add_menu' );
add_action( 'admin_enqueue_scripts', 'fb_styles');
add_action( 'wp_enqueue_scripts', 'fb_scripts');
register_activation_hook( __FILE__, 'fb_install' );
register_deactivation_hook( __FILE__, 'fb_uninstall' );