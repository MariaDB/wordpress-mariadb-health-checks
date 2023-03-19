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

        $variables = $wpdb->get_results( "SHOW variables" );

        foreach( $variables as $variable ) {

            // Autocommit
            if( 'autocommit' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['autocommit'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Bind Address
            if( 'bind_address' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['bind_address'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Character set Client
            if( 'character_set_client' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['character_set_client'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Character set Connection
            if( 'character_set_connection' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['character_set_connection'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Character set Database
            if( 'character_set_database' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['character_set_database'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Character set Filesystem
            if( 'character_set_filesystem' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['character_set_filesystem'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Character set Results
            if( 'character_set_results' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['character_set_results'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Character set Server
            if( 'character_set_server' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['character_set_server'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Character set System
            if( 'character_set_system' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['character_set_system'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Collation Connection
            if( 'collation_connection' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['collation_connection'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Collation Database
            if( 'collation_database' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['collation_database'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Collation Server
            if( 'collation_server' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['collation_server'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Concurrent insert
            if( 'concurrent_insert' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['concurrent_insert'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // Concurrent insert
            if( 'connect_timeout' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['connect_timeout'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // date format
            if( 'date_format' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['date_format'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // date/time format
            if( 'datetime_format' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['datetime_format'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // error count
            if( 'error_count' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['error_count'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // expire log days
            if( 'expire_logs_days' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['expire_logs_days'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // have_compress
            if( 'have_compress' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['have_compress'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // have_crypt
            if( 'have_crypt' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['have_crypt'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // have_dynamic_loading
            if( 'have_dynamic_loading' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['have_dynamic_loading'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // have_geometry
            if( 'have_geometry' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['have_geometry'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // have_openssl
            if( 'have_openssl' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['have_openssl'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // have_profiling
            if( 'have_profiling' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['have_profiling'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // have_query_cache
            if( 'have_query_cache' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['have_query_cache'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // have_rtree_keys
            if( 'have_rtree_keys' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['have_rtree_keys'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // have_ssl
            if( 'have_ssl' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['have_ssl'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // have_symlink
            if( 'have_symlink' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['have_symlink'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // histogram_size
            if( 'histogram_size' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['histogram_size'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // histogram_type
            if( 'histogram_type' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['histogram_type'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // hostname
            if( 'hostname' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['hostname'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // InnoDB version
            if( 'innodb_version' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['innodb_version'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // lc_messages
            if( 'lc_messages' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['lc_messages'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // lc_time_names
            if( 'lc_time_names' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['lc_time_names'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // license
            if( 'license' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['license'] = wp_kses( $variable->Value, 'strip' );
                }
            }

            // max_connections
            if( 'max_connections' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['max_connections'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // max_connect_errors
            if( 'max_connect_errors' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['max_connect_errors'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // max_user_connections
            if( 'max_user_connections' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['max_user_connections'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // max_error_count
            if( 'max_error_count' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['max_error_count'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // port
            if( 'port' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['port'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // protocol_version
            if( 'protocol_version' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['protocol_version'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // read_only
            if( 'read_only' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['read_only'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // require_secure_transport
            if( 'require_secure_transport' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['require_secure_transport'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // server_id
            if( 'server_id' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['server_id'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // log_error
            if( 'log_error' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['log_error'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // log_error
            if( 'slow_query_log' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['slow_query_log'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // log_error
            if( 'slow_query_log_file' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['slow_query_log_file'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // sql_mode
            if( 'sql_mode' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['sql_mode'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // storage_engine
            if( 'storage_engine' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['storage_engine'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // time_format
            if( 'time_format' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['time_format'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // time_zone
            if( 'time_zone' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['time_zone'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // timestamp
            if( 'timestamp' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['timestamp'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // tls_version
            if( 'tls_version' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['tls_version'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // version
            if( 'version' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['version'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // version_comment
            if( 'version_comment' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['version_comment'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // version_compile_machine
            if( 'version_compile_machine' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['version_compile_machine'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // version_compile_os
            if( 'version_compile_os' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['version_compile_os'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // version_malloc_library
            if( 'version_malloc_library' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['version_malloc_library'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // version_source_revision
            if( 'version_source_revision' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['version_source_revision'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // version_ssl_library
            if( 'version_ssl_library' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['version_ssl_library'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // wait_timeout
            if( 'wait_timeout' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['wait_timeout'] = wp_kses( $variable->Value, 'strip' );
                }
            }
            // warning_count
            if( 'warning_count' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['warning_count'] = wp_kses( $variable->Value, 'strip' );
                }
            }

        }
        return $generaldata;

    }

}
