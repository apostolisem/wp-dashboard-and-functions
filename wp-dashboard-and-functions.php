<?php
/*
Plugin Name: Demo Company Dashboard & Functions
Plugin URI: https://yourwebsite.com
Description: Replaces the original WordPress dashboard and adds some useful features.
Version: 3.0.5
Author: Demo Company
Author URI: https://yourwebsite.com
License: GPL2 or later
Text Domain: wp-dashboard-and-functions
*/

// work only if called from withing wordpress universe
defined( 'ABSPATH' ) or die( 'error!' );

// plugin folder url
if(!defined('WPCDF_PLUGIN_URL')) {
	define('WPCDF_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}

// main class
class wpcdf_custom_constructor {

	/*--------------------------------------------*
	* Constructor
	*--------------------------------------------*/

	/**
	* Initializes the plugin by setting localization, filters, and administration functions.
	*/
	function __construct() {

		add_action('admin_menu', array( &$this,'wpcdf_register_menu') );
		add_action('admin_menu', array( &$this,'wpcdf_load_plugin_settings') );
		add_action('load-index.php', array( &$this,'wpcdf_redirect_dashboard') );
		add_action('admin_head', array( &$this,'wpcdf_hide_original_link_to_dashboard') );
		add_filter('plugins_loaded', array( &$this,'load_custom_plugin_translation_file'), 10, 2 );

	} // end constructor

	function wpcdf_redirect_dashboard() {

		if( is_admin() ) {
			$screen = get_current_screen();

			if( $screen->base == 'dashboard' ) {
				wp_safe_redirect( admin_url( 'index.php?page=democo-dashboard' ) );
				exit;
			}
		}

	}

	function wpcdf_register_menu() {
		add_dashboard_page( __( 'Dashboard', 'wp-dashboard-and-functions' ), __( 'Dashboard', 'wp-dashboard-and-functions' ), 'read', 'democo-dashboard', array( &$this,'wpcdf_create_dashboard') );
	}

	function wpcdf_create_dashboard() {
		include_once( 'includes/templates/dashboard.php'  );
	}

	function wpcdf_load_plugin_settings() {
		include_once( 'plugin-settings.php'  );
	}

	function wpcdf_hide_original_link_to_dashboard() {
		echo '<style>.menu-icon-dashboard .wp-first-item {	display:none; }</style>';
	}

	function load_custom_plugin_translation_file() {
		$mofile = plugin_dir_path( __FILE__ ) . 'wp-dashboard-and-functions-' . get_locale() . '.mo';
		return load_textdomain('wp-dashboard-and-functions', $mofile);
	}


}

// instantiate plugin's class
$GLOBALS['democo_custom_dashboard'] = new wpcdf_custom_constructor();
