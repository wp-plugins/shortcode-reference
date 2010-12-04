<?php
 /**
  * This file contains some utilities to get the extension working.  
  **/
define (SHORTCODE_REFERENCE_PLUGIN_DIR, '/'.str_replace(array(ABSPATH,conf),array('',''),dirname(__FILE__)));

/**
 * Utility-function to automatically include a dir recursively
 * 
 * @param string $path
 */
function shortcode_overview_util_require_files($path) {
	$filelist = scandir($path);
	$filelist = array_diff($filelist,array('..','.'));
	foreach($filelist as $file) {
		if (is_file($path.'/'.$file)){
			include_once($path.'/'.$file);
		} else {
			shortcode_overview_util_require_files($path.'/'.$file);
		}
	}
}

/**
 * Render the meta-boxes on the correct places
 */
function shortcode_reference_render_meta_box(){
	$ShortcodeReferenceUIManager = new ShortcodeReferenceUIManager();
	add_meta_box('shortcode_overview_container',__('Shortcode reference','ShortcodesAutoreference'), array(&$ShortcodeReferenceUIManager,'showReferencePanel'), 'post','side');
 	add_meta_box('shortcode_overview_container',__('Shortcode reference','ShortcodesAutoreference'), array(&$ShortcodeReferenceUIManager,'showReferencePanel'), 'page','side');
 	add_meta_box('shortcode_overview_container',__('Shortcode reference','ShortcodesAutoreference'), array(&$ShortcodeReferenceUIManager,'showReferencePanel'), 'link','side');
}

/**
 * A little utility-function to retrieve the shortcode's details. Executed in a custom action
 */
function shortcode_reference_get_reference(){
	$ShortcodeReferenceUIManager = new ShortcodeReferenceUIManager();
	$shortcode = $_POST['shortcode'];
	$ShortcodeReferenceUIManager->getReference($shortcode);	
}

wp_register_style('shortcode-reference-style', SHORTCODE_REFERENCE_PLUGIN_DIR.'/css/shortcode-reference.css',false);
