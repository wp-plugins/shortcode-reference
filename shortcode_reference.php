<?php
 /**
  * Plugin Name: Shortcode Reference
  * Plugin URI: http://www.linkedin.com/in/bartstroeken
  * Version : 0.1
  * Author: Bart Stroeken
  * Author URI: http://www.linkedin.com/in/bartstroeken
  * Description: This plugin will provide the details about all available shortcodes when you'll need it most: when you're editing your content  
  **/
if (version_compare(phpversion(),'5.0.0','gt')) {
	require_once 'conf/include.php';
	
	wp_enqueue_style('shortcode-reference-style');
	wp_enqueue_script('shortcode-reference-js', SHORTCODE_REFERENCE_PLUGIN_DIR.'/js/shortcode-reference.js', null,null,true);
	
	$dir = dirname(__FILE__).'/lib';
	shortcode_overview_util_require_files($dir);
	/**
	 * Add an extra meta-box
	 */
	add_action('add_meta_boxes','shortcode_reference_render_meta_box');
	add_action('wp_ajax_shortcode_reference_find_shortcode', 'shortcode_reference_get_reference');
}