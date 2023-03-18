<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

defined('WPINC') || die;

function mdbhc_save_average_query_execution_time() {

  if ( !defined('SAVEQUERIES') ) return;

  global $wpdb;

  $queries = $wpdb->queries;
  $query_times = array();

  foreach ( $queries as $key => $value ) {

    $query_time = $value[1];

    $query_times[] = $query_time;

  }

  $average = array_sum($query_times) / count($query_times);

  $table_name = $wpdb->prefix . 'mariadb_execution_time';

  $wpdb->insert($table_name, array(
    'seconds' => $average,
    'queries_num' => $wpdb->num_queries,
  ));

}
add_action('admin_footer', 'mdbhc_save_average_query_execution_time');
add_action('wp_print_footer_scripts', 'mdbhc_save_average_query_execution_time');
