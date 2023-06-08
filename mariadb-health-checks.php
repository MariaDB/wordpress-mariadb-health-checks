<?php
/**
 * Plugin Name: MariaDB Health Checks
 * Plugin URI: http://github.com/MariaDB/wordpress-mariadb-health-checks
 * Description: MariaDB Health Checks
 * Version: 1.0.2
 * Plugin Prefixes: mdbhc, Mdbhc, MDBHC
 * Text Domain: mariadb-health-checks
 * Author: Cloudfest Hackathon 2023 Team
 * Author URI: https://github.com/MariaDB/wordpress-mariadb-health-checks
 * GitHub Plugin URI: https://github.com/MariaDB/wordpress-mariadb-health-checks
 */

defined( 'WPINC' ) || die;

define( 'MDBHC_URL', plugin_dir_url( __FILE__ ) );
define( 'MDBHC_DIR', plugin_dir_path( __FILE__ ) );

require_once 'inc/bootstrap.php';

register_activation_hook( __FILE__, 'mdbhc_activation' );
add_action( 'upgrader_process_complete', 'mdbhc_activation' );


function wpauto_plugin_init() {
	load_plugin_textdomain( 'mariadb-health-checks', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

function mdbhc_activation() {

	( new \MDBHC\PluginActivation() )::index();

}

new \MDBHC\AdminScreen();
