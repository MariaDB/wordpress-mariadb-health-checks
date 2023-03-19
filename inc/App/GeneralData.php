<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

namespace MDBHC;

class GeneralData {

  public function __construct() {

    mdbhc_enable_errors();

  }

  public static function get() {

    $generaldata = array();
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $vars = array(
      '%%VAR_PREFIX%%'    => $wpdb->prefix,
      '%%VAR_CHARACTER%%' => $charset_collate,
    );

    $tmp = $wpdb->get_results( "SHOW variables LIKE 'innodb_version'" );
    if( isset( $tmp[0]->Value ) ) {
        $generaldata['innodb_version'] = wp_kses( $tmp[0]->Value, 'strip' );
    }


    /*
    $generaldata['protocol_version'] = $wpdb->get_var( "show variables = 'protocol_version'" );
    $generaldata['tls_version'] = $wpdb->get_var( "show variables = 'tls_version'" );
    $generaldata['version'] = $wpdb->get_var( "show variables = 'version'" );
    $generaldata['version_comment'] = $wpdb->get_var( "show variables = 'version_comment'" );
    $generaldata['version_compile_machine'] = $wpdb->get_var( "show variables = 'version_compile_machine'" );
    $generaldata['version_compile_os'] = $wpdb->get_var( "show variables = 'version_compile_os'" );
    */
    return $generaldata;
  
  }
  
}

