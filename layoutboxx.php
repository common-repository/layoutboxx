<?php
/**
 * Plugin Name: LayoutBoxx
 * Plugin URI: https://layoutboxx.com/
 * Description: This plugin is an easy way to integrate your LayoutBoxx Designer into your Wordpress site.
 * Version: 0.3.1
 * Author: LayoutBoxx
 * Author URI: https://layoutboxx.com/
 * License: MIT/X11 License
 * License URI: https://directory.fsf.org/wiki/License:X11
 */

require_once('admin-menu.php'); //INCLUDING THE ADMIN-UI
require_once('templates/templates.php');

// EMBED LAYOUTBOXX
function add_layoutboxx( $atts ) {

  extract(shortcode_atts( array(
	  'username' => ' ',
	  'ratio' => '16:9'
  ), $atts));

	$ratio = explode(":", $ratio);
	$ratio = 100*floatval($ratio[1])/floatval($ratio[0]);

  $embed = '<div style="position: relative; width: 100%; padding-bottom: ' . $ratio . '%;"><iframe src="https://designer.layoutboxx.com/' . $username . '/" style="position: absolute; border: none; width: 0; height: 0; max-height: 100%; max-width: 100%; min-height: 100%; min-width: 100%;"></iframe></div>';
  // Maybe also -webkit-overflow-scrolling: touch; at height: 100%;

  return $embed;

}
add_shortcode('layoutboxx', 'add_layoutboxx');



/****************************************/
add_filter('widget_text', 'do_shortcode');
add_filter('comment_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');

function layoutboxx_remove_empty_paragraphs( $content ) {

  $array = array(
   '<p>['    => '[',
   ']</p>'   => ']',
   ']<br />' => ']'
  );
  return strtr( $content, $array );

}
add_filter( 'the_content', 'layoutboxx_remove_empty_paragraphs' );
