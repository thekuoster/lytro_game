<?php
/*
Plugin Name: NextGen NivoSlider
Description: Allows you to pick a gallery from the 'NextGen Gallery' plugin to use as a Nivo Slider.
Author: Aldert Vaandering
Author URI: http://aldertvaandering.com
Version: 3.2.5
*/

if ( ! defined( 'WPNGG_NIVOSLIDER_PLUGIN_BASENAME' ) ) {
	define( 'WPNGG_NIVOSLIDER_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'WPNGG_NIVOSLIDER_PLUGIN_NAME' ) ) {
	define( 'WPNGG_NIVOSLIDER_PLUGIN_NAME', trim( dirname( WPNGG_NIVOSLIDER_PLUGIN_BASENAME ), '/' ) );
}
if ( ! defined( 'WPNGG_NIVOSLIDER_PLUGIN_DIR' ) ) {
	define( 'WPNGG_NIVOSLIDER_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . WPNGG_NIVOSLIDER_PLUGIN_NAME );
}

function WPNGG_NIVOSLIDER_set_plugin_meta($links, $file) {
	$plugin = WPNGG_NIVOSLIDER_PLUGIN_BASENAME;
	if ($file == $plugin) {
		$links[] = '<a href="http://wordpress.org/extend/plugins/nextgen-nivoslider">' . 'Visit plugin site' . '</a>';
	}
	return $links;
}

if( is_admin() ) {
	add_filter( 'plugin_row_meta', 'WPNGG_NIVOSLIDER_set_plugin_meta', 10, 2 );
}

require_once WPNGG_NIVOSLIDER_PLUGIN_DIR . '/includes/ngg-nivoslider-main.php';

$nggNivoSlider = new NGG_NivoSlider();