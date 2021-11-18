<?php 

/*
Plugin Name: My demo widget 
Plugin URI: http://msajib.com
Description: mu custom widget
Version: 1.00
Author: Sajib
Author URI: http://msajib.com
Text Domain: textdomain
Domain Path: /languages/
*/


function setup_textdomain(){
	load_plugin_textdomain( 'textdomain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action('plugins_loaded','setup_textdomain');


function setup_widget_assets($screen) {
	if ( $screen == 'widgets.php') {
		wp_enqueue_media();
		wp_enqueue_script('widget-js', plugin_dir_url(__FILE__)."assets/js/demowidget.js", array('jquery'), time(), true);
	}
}
add_action('admin_enqueue_scripts','setup_widget_assets');


include_once plugin_dir_path( __FILE__ )."class/class-googlemap.php";
include_once plugin_dir_path( __FILE__ )."class/class-imguploader.php";

function register_demowidget(){
	register_widget( 'DemoWidgetGoogleMap' );
	register_widget( 'imgUploader' );
}
add_action('widgets_init','register_demowidget');



