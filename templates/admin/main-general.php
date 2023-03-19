<?php
$dbInformation = getAllDbInformation();
//var_dump( $dbInformation );
$mariaDBUrl = 'https://mariadb.com/kb/en/mariadb-server-release-dates/';
?>
<div class="notice notice-info"><p>You are currently using version <?php echo $dbInformation['dbVersion']; ?> of your
		database<?php if ( $dbInformation['isMariaDB'] ) {
			echo ' (MariaDB)';
		} ?> server.</p>
</div>
<?php if ( $dbInformation['isEndOfLive'] ) { ?>
	<div class="notice notice-error">
		<p>Your version is end of live. Please update your MariaDB database to a newer version.</p>
		<p>See <a href="<?php echo $mariaDBUrl; ?>" target="_blank"><?php echo $mariaDBUrl; ?></a> to get more details about the different versions.</p>
	</div>
<?php } else { ?>
	<div class="notice notice-success">
		<p>The version of your MariaDB is fully supported until now.</p>
		<p>See <a href="<?php echo $mariaDBUrl; ?>" target="_blank"><?php echo $mariaDBUrl; ?></a> to get more details about the different versions.</p>
	</div>
<?php } ?>
	<h3><?php _e( 'MariaDB Database Information', 'mdbhc' ); ?></h3>
<?php
$mdbhc_GeneralData = new MDBHC\GeneralData();
$mdbhc_gd = $mdbhc_GeneralData->get();
?>
<h4><?php _e( 'General information', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_general = true;
if( isset( $mdbhc_gd['version'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'MariaDB version', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['version']; if( isset( $mdbhc_gd['version_comment'] ) ) { echo $mdbhc_gd['version_comment'];  } ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['version_compile_os'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'OS', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['version_compile_os']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['version_compile_machine'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Compilation Machine', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['version_compile_machine']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['version_source_revision'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Source version', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['version_source_revision']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['version_malloc_library'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'malloc version', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['version_malloc_library']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['version_ssl_library'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'SSL version', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['version_ssl_library']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['bind_address'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Bind Address', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['bind_address']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['port'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Port', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['port']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['hostname'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Hostname', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['hostname']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['server_id'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Server ID', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['server_id']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['protocol_version'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Protocol version', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['protocol_version']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['tls_version'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'TLS version', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['tls_version']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['sql_mode'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'SQL Mode', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['sql_mode']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['storage_engine'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Storage Engine', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['storage_engine']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['require_secure_transport'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Require secure transport', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['require_secure_transport']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['read_only'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Read only', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['read_only']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['connect_timeout'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Connection timeout', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['connect_timeout']; ?></td>
	</tr>
<?php
}

if( isset( $mdbhc_gd['wait_timeout'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Waiting timeout', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['wait_timeout']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['warning_count'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Waiting count', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['warning_count']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['license'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'License', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['license']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['autocommit'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Auto Commit', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['autocommit']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['concurrent_insert'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Concurrent Insert', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['concurrent_insert']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['error_count'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Error count', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['error_count']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['expire_logs_days'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Expire log days', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['expire_logs_days']; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
if( $mdbhc_gd_general ) {
	_e( 'There is no General information to show.', 'mdbhc' );
}
unset( $mdbhc_gd_general );
?>

<h4><?php _e( 'Logs', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_logs = true;
if( isset( $mdbhc_gd['log_error'] ) ) {
	$mdbhc_gd_logs = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Error', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['log_error']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['slow_query_log'] ) ) {
	$mdbhc_gd_logs = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Slow queries', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['slow_query_log']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['slow_query_log_file'] ) ) {
	$mdbhc_gd_logs = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Slow queries file', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['slow_query_log_file']; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
if( $mdbhc_gd_logs ) {
	_e( 'There is no Logs information to show.', 'mdbhc' );
}
unset( $mdbhc_gd_logs );
?>

<h4><?php _e( 'Locale', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_datetime = true;
if( isset( $mdbhc_gd['date_format'] ) ) {
	$mdbhc_gd_datetime = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Date format', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['date_format']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['time_format'] ) ) {
	$mdbhc_gd_datetime = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Time format', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['time_format']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['datetime_format'] ) ) {
	$mdbhc_gd_datetime = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Date/Time format', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['datetime_format']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['timestamp'] ) ) {
	$mdbhc_gd_datetime = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Timestamp', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['timestamp']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['time_zone'] ) ) {
	$mdbhc_gd_datetime = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'TimeZone', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['time_zone']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['lc_messages'] ) ) {
	$mdbhc_gd_datetime = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Locale messages', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['lc_messages']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['lc_time_names'] ) ) {
	$mdbhc_gd_datetime = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Locale time names', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['lc_time_names']; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
if( $mdbhc_gd_datetime ) {
	_e( 'There is no Locale information to show.', 'mdbhc' );
}
unset( $mdbhc_gd_datetime );
?>


<h4><?php _e( 'Connections', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_conn = true;
if( isset( $mdbhc_gd['max_connections'] ) ) {
	$mdbhc_gd_conn = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Max Connections', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['max_connections']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['max_user_connections'] ) ) {
	$mdbhc_gd_conn = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Max Users Connections', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['max_user_connections']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['max_connect_errors'] ) ) {
	$mdbhc_gd_conn = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Max Connect errors', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['max_connect_errors']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['max_error_count'] ) ) {
	$mdbhc_gd_conn = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Max error count', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['max_error_count']; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
if( $mdbhc_gd_conn ) {
	_e( 'There is no Connections information to show.', 'mdbhc' );
}
unset( $mdbhc_gd_conn );
?>

<h4><?php _e( 'Histogram', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_histogram = true;
if( isset( $mdbhc_gd['histogram_size'] ) ) {
	$mdbhc_gd_histogram = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Size', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['histogram_size']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['histogram_type'] ) ) {
	$mdbhc_gd_histogram = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Type', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['histogram_type']; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
if( $mdbhc_gd_histogram ) {
	_e( 'There is no Histogram information to show.', 'mdbhc' );
}
unset( $mdbhc_gd_histogram );
?>

<h4><?php _e( 'Character Set', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_characterset = true;
if( isset( $mdbhc_gd['character_set_client'] ) ) {
	$mdbhc_gd_characterset = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Client', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['character_set_client']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['character_set_connection'] ) ) {
	$mdbhc_gd_characterset = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Connection', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['character_set_connection']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['character_set_database'] ) ) {
	$mdbhc_gd_characterset = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Database', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['character_set_database']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['character_set_filesystem'] ) ) {
	$mdbhc_gd_characterset = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Filesystem', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['character_set_filesystem']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['character_set_results'] ) ) {
	$mdbhc_gd_characterset = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Reults', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['character_set_results']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['character_set_server'] ) ) {
	$mdbhc_gd_characterset = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Server', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['character_set_server']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['character_set_system'] ) ) {
	$mdbhc_gd_characterset = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'System', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['character_set_system']; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
if( $mdbhc_gd_characterset ) {
	_e( 'There is no Character Set information to show.', 'mdbhc' );
}
unset( $mdbhc_gd_characterset );
?>

<h4><?php _e( 'Character Collation', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_collation = true;
if( isset( $mdbhc_gd['collation_connection'] ) ) {
	$mdbhc_gd_collation = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Connection', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['collation_connection']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['collation_database'] ) ) {
	$mdbhc_gd_collation = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Database', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['collation_database']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['collation_server'] ) ) {
	$mdbhc_gd_collation = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Server', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['collation_server']; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
if( $mdbhc_gd_collation ) {
	_e( 'There is no Character Collation information to show.', 'mdbhc' );
}
unset( $mdbhc_gd_collation );
?>

<h4><?php _e( 'Options available', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_has = true;
if( isset( $mdbhc_gd['have_compress'] ) ) {
	$mdbhc_gd_has = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Compress', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['have_compress']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['have_crypt'] ) ) {
	$mdbhc_gd_has = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Crypt', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['have_crypt']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['have_dynamic_loading'] ) ) {
	$mdbhc_gd_has = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Dynamic Loading', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['have_dynamic_loading']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['have_geometry'] ) ) {
	$mdbhc_gd_has = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Geometry', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['have_geometry']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['have_openssl'] ) ) {
	$mdbhc_gd_has = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'OpenSSL', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['have_openssl']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['have_profiling'] ) ) {
	$mdbhc_gd_has = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Profiling', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['have_profiling']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['have_query_cache'] ) ) {
	$mdbhc_gd_has = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Query Cache', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['have_query_cache']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['have_rtree_keys'] ) ) {
	$mdbhc_gd_has = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'RTree keys', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['have_rtree_keys']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['have_ssl'] ) ) {
	$mdbhc_gd_has = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'SSL', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['have_ssl']; ?></td>
	</tr>
<?php
}
if( isset( $mdbhc_gd['have_symlink'] ) ) {
	$mdbhc_gd_has = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Symlink', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['have_symlink']; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
if( $mdbhc_gd_has ) {
	_e( 'There is no Options information to show.', 'mdbhc' );
}
unset( $mdbhc_gd_has );
?>

<h4><?php _e( 'InnoDB', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_innodb = true;
if( isset( $mdbhc_gd['innodb_version'] ) ) {
	$mdbhc_gd_innodb = false;
?>
	<tr>
		<td><?php
			/* translators: *** Please, some context here *** */
			_e( 'Version', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['innodb_version']; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
if( $mdbhc_gd_innodb ) {
	_e( 'There is no InnoDB information to show.', 'mdbhc' );
}
unset( $mdbhc_gd_innodb );

unset( $mdbhc_gd );
