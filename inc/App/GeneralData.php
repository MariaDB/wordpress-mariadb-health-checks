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
            '%%VAR_PREFIX%%' => $wpdb->prefix,
            '%%VAR_CHARACTER%%' => $charset_collate,
        );

        $variablelist = array(
            'autocommit',
            'bind_address',
            'character_set_client',
            'character_set_connection',
            'character_set_database',
            'character_set_filesystem',
            'character_set_results',
            'character_set_server',
            'character_set_system',
            'collation_connection',
            'collation_database',
            'collation_server',
            'concurrent_insert',
            'connect_timeout',
            'date_format',
            'datetime_format',
            'error_count',
            'expire_logs_days',
            'have_compress',
            'have_crypt',
            'have_dynamic_loading',
            'have_geometry',
            'have_openssl',
            'have_profiling',
            'have_query_cache',
            'have_rtree_keys',
            'have_ssl',
            'have_symlink',
            'histogram_size',
            'histogram_type',
            'hostname',
            'innodb_version',
            'lc_messages',
            'lc_time_names',
            'license',
            'max_connections',
            'max_connect_errors',
            'max_user_connections',
            'max_error_count',
            'port',
            'protocol_version',
            'read_only',
            'require_secure_transport',
            'server_id',
            'log_error',
            'slow_query_log',
            'slow_query_log_file',
            'sql_mode',
            'storage_engine',
            'time_format',
            'time_zone',
            'timestamp',
            'tls_version',
            'version',
            'version_comment',
            'version_compile_machine',
            'version_compile_os',
            'version_malloc_library',
            'version_source_revision',
            'version_ssl_library',
            'wait_timeout',
            'warning_count',
        );


        $variables = $wpdb->get_results( "SHOW variables" );

        foreach( $variables as $variable ) {

            if( in_array( $variable->Variable_name, $variablelist ) ) {
                if( isset( $variable->Value ) ) {
                    $generaldata[$variable->Variable_name] = wp_kses( $variable->Value, 'strip' );
                }
            }

        }
        return $generaldata;

    }

}
