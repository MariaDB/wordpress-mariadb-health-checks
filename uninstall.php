<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 */
// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

$table_contents_file = plugin_dir_path( __FILE__ ) . 'static/table-uninstall.sql';

if (!file_exists($table_contents_file)) exit;

global $wpdb;

$charset_collate = $wpdb->get_charset_collate();

$vars = array(
	'%%VAR_PREFIX%%' => $wpdb->prefix,
	'%%VAR_CHARACTER%%' => $charset_collate,
);

$sql = file_get_contents($table_contents_file);
$sql = str_replace(array_keys($vars), array_values($vars), $sql);

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

$wpdb->query($sql);
