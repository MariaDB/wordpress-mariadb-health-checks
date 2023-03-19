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
    /*        
            
            
            
            
            
            
            
            datetime_format
            
            error_count
            
            expire_logs_days
            
            have_compress
            have_crypt
            have_dynamic_loading
            have_geometry
            have_openssl
            have_profiling
            have_query_cache
            have_rtree_keys
            have_ssl
            have_symlink
            
            histogram_size
            histogram_type
            
            hostname

            // InnoDB version
            if( 'innodb_version' == $variable->Variable_name ) {
                if( isset( $variable->Value ) ) {
                    $generaldata['innodb_version'] = wp_kses( $variable->Value, 'strip' );
                }
            }

            lc_messages
            lc_time_names
            
            license
            
            log_error
            
            max_connections
            max_connect_errors
            max_error_count
            max_user_connections
            
            port
            protocol_version
            read_only
            require_secure_transport
            server_id
            slow_query_log
            slow_query_log_file
            
            sql_mode
            storage_engine
            
            time_format
            time_zone
            timestamp
            
            tls_version
            
            version
            version_comment
            version_compile_machine
            version_compile_os
            version_malloc_library
            version_source_revision
            version_ssl_library
            
            wait_timeout
            
            warning_count
            
    */
        }
        return $generaldata;

    }

}
