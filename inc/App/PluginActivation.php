<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

namespace MDBHC;

class PluginActivation {

  public function __construct() {

    mdbhc_enable_errors();

  }

  public static function index() {

    self::create_versions_table();
    self::create_execution_table();

  }

  private static function create_execution_table() {

    $table_contents_file = mdbhc_dir('static/table-mariadb_execution_time-structure.sql');

    if ( !file_exists($table_contents_file) ) return;

    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $vars = array(
      '%%VAR_PREFIX%%'    => $wpdb->prefix,
      '%%VAR_CHARACTER%%' => $charset_collate,
    );

    $sql = file_get_contents($table_contents_file);
    $sql = str_replace(array_keys($vars), array_values($vars), $sql);

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($sql);
  
  }

  private static function create_versions_table() {

    $table_contents_file = mdbhc_dir('static/table-mariadb_versions-structure.sql');

    if ( !file_exists($table_contents_file) ) return;

    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $vars = array(
      '%%VAR_PREFIX%%'    => $wpdb->prefix,
      '%%VAR_CHARACTER%%' => $charset_collate,
    );

    $sql = file_get_contents($table_contents_file);
    $sql = str_replace(array_keys($vars), array_values($vars), $sql);

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($sql);

    self::insert_versions_data();

  }

  private static function insert_versions_data() {

    $table_contents_file = mdbhc_dir('static/table-mariadb_versions-data.sql');

    if ( !file_exists($table_contents_file) ) return;

    global $wpdb;

    $table_name = $wpdb->prefix . 'mariadb_versions';

    $record = $wpdb->get_var( "SELECT COUNT(*) from $table_name where id = 1" );

    if ( !is_null($record) ) return;

    $charset_collate = $wpdb->get_charset_collate();

    $vars = array(
      '%%VAR_PREFIX%%' => $wpdb->prefix,
    );

    $sql = file_get_contents($table_contents_file);
    $sql = str_replace(array_keys($vars), array_values($vars), $sql);

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($sql);
  
  }

}

