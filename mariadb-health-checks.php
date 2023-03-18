<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

/**
 * Plugin Name: MariaDB Health Checks
 * Plugin URI: http://github.com/ahmu83/mariadb-health-checks/
 * Description: MariaDB Health Checks
 * Version: 1.0.0
 * Plugin Prefixes: mdbhc, Mdbhc, MDBHC
 * Author: Ahmad Karim
 * Author URI: https://github.com/ahmu83
 */

defined('WPINC') || die;

define( 'MDBHC_URL', plugin_dir_url( __FILE__ ) );
define( 'MDBHC_DIR', plugin_dir_path( __FILE__ ) );

require_once 'inc/bootstrap.php';

new \MDBHC\AdminScreen();

