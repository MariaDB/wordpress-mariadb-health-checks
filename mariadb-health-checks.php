<?php
/**
 * Plugin Name: MariaDB Health Checks
 * Plugin URI: http://github.com/MariaDB/wordpress-mariadb-health-checks
 * Description: MariaDB Health Checks
 * Version: 1.0.0
 * Plugin Prefixes: mdbhc, Mdbhc, MDBHC
 * Author: Cloudfest Hackathon 2023 Team
 * Author URI: https://github.com/MariaDB/wordpress-mariadb-health-checks
 */

defined( 'WPINC' ) || die;

define( 'MDBHC_URL', plugin_dir_url( __FILE__ ) );
define( 'MDBHC_DIR', plugin_dir_path( __FILE__ ) );

require_once 'inc/bootstrap.php';

register_activation_hook( __FILE__, 'mdbhc_activation' );

function wpauto_plugin_init() {
	load_plugin_textdomain( 'mdbhc', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

function mdbhc_activation() {

	( new \MDBHC\PluginActivation() )::index();

}

new \MDBHC\AdminScreen();
