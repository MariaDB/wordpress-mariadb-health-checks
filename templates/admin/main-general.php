<h3><?php _e( 'MariaDB Database Information', 'mdbhc' ); ?></h3>
<?php
$dbInformation = getAllDbInformation();
$mariaDBUrl         = 'https://mariadb.com/kb/en/mariadb-server-release-dates/';
$mariaDBUrlDownload = 'https://mariadb.org/download/';
$mdbhc_GeneralData = new MDBHC\GeneralData();
$mdbhc_gd = $mdbhc_GeneralData->get();
$active_stab = isset($_GET['stab']) ? strval($_GET['stab']) : 'general';
?>
	<div class="notice notice-info"><p>You are currently using version <?php echo $dbInformation['dbVersion']; ?> of
			your
			database<?php if ( $dbInformation['isMariaDB'] ) {
				echo ' (MariaDB)';
			} ?> server.</p>
	</div>
<?php if ( $dbInformation['isEndOfLive'] ) { ?>
	<div class="notice notice-error">
		<p>Your version is end of live. Please update your MariaDB database to a newer version.</p>
		<p>See <a href="<?php echo $mariaDBUrl; ?>" target="_blank"><?php echo $mariaDBUrl; ?></a> to get more details
			about the different versions.</p>
		<p>Find a newer version here <a href="<?php echo $mariaDBUrlDownload; ?>"
										target="_blank"><?php echo $mariaDBUrlDownload; ?>.</a></p>
	</div>
<?php } else { ?>
	<div class="notice notice-success">
		<p>The version of your MariaDB is fully supported until now.</p>
		<p>See <a href="<?php echo $mariaDBUrl; ?>" target="_blank"><?php echo $mariaDBUrl; ?></a> to get more details
			about the different versions.</p>
	</div>
<?php } ?>

<h4 class="nav-tab-wrapper">
	<a href="?page=mdbhc&tab=general&stab=general" class="nav-tab <?php echo 'general' === $active_stab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('General information', 'mdbhc'); ?></a>
	<a href="?page=mdbhc&tab=general&stab=logs" class="nav-tab <?php echo 'logs' === $active_stab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Logs', 'mdbhc'); ?></a>
	<a href="?page=mdbhc&tab=general&stab=locale" class="nav-tab <?php echo 'locale' === $active_stab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Locale', 'mdbhc'); ?></a>
	<a href="?page=mdbhc&tab=general&stab=conn" class="nav-tab <?php echo 'conn' === $active_stab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Connections', 'mdbhc'); ?></a>
	<a href="?page=mdbhc&tab=general&stab=histogram" class="nav-tab <?php echo 'histogram' === $active_stab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Histogram', 'mdbhc'); ?></a>
	<a href="?page=mdbhc&tab=general&stab=characterset" class="nav-tab <?php echo 'characterset' === $active_stab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Character Set', 'mdbhc'); ?></a>
	<a href="?page=mdbhc&tab=general&stab=collation" class="nav-tab <?php echo 'collation' === $active_stab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Character Collation', 'mdbhc'); ?></a>
	<a href="?page=mdbhc&tab=general&stab=has" class="nav-tab <?php echo 'has' === $active_stab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Options available', 'mdbhc'); ?></a>
	<a href="?page=mdbhc&tab=general&stab=innodb" class="nav-tab <?php echo 'innodb' === $active_stab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('InnoDB', 'mdbhc'); ?></a>
</h4>
<?php
if ('general' === $active_stab) {
?>
	<h4><?php _e( 'General information', 'mdbhc' ); ?></h4>
	<table style="min-width: 320px;">
	<?php
	$mdbhc_gd_general = true;
	if( isset( $mdbhc_gd['version'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#version" target="_blank" title="<?php _e( wp_kses( 'Server version number. It may also include a suffix with configuration or build information. -debug indicates debugging support was enabled on the server, and -log indicates at least one of the binary log, general log or slow query log are enabled, for example 10.0.1-MariaDB-mariadb1precise-log. From MariaDB 10.2.1, this variable can be set at startup in order to fake the server version.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Server version number */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#version_compile_os" target="_blank" title="<?php _e( wp_kses( 'Operating system that MariaDB was built on, for example debian-linux-gnu. ', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Operating system that MariaDB was built on */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#version_compile_machine" target="_blank" title="<?php _e( wp_kses( 'The machine type or architecture MariaDB was built on, for example i686.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The machine type or architecture MariaDB was built on */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#version_source_revision" target="_blank" title="<?php _e( wp_kses( 'Source control revision id for MariaDB source code, enabling one to see exactly which version of the source was used for a build.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Source control revision id for MariaDB source code */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#version_malloc_library" target="_blank" title="<?php _e( wp_kses( 'Version of the used malloc library.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Version of the used malloc library. */
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
			<td><a href="https://mariadb.com/kb/en/ssltls-system-variables/#version_ssl_library" target="_blank" title="<?php _e( wp_kses( 'The version of the TLS library that is being used. Note that the version returned by this system variable does not always necessarily correspond to the exact version of the OpenSSL package installed on the system. OpenSSL shared libraries tend to contain interfaces for multiple versions at once to allow for backward compatibility. Therefore, if the OpenSSL package installed on the system is newer than the OpenSSL version that the MariaDB server binary was built with, then the MariaDB server binary might use one of the interfaces for an older version.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The version of the TLS library that is being used. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#bind_address" target="_blank" title="<?php _e( wp_kses( 'By default, the MariaDB server listens for TCP/IP connections on all addresses. You can specify an alternative when the server starts using this option; either a host name, an IPv4 or an IPv6 address, \'::\' or \'*\' (all addresses). In some systems, such as Debian and Ubuntu, the bind_address is set to 127.0.0.1, which binds the server to listen on localhost only. bind_address has always been available as a mysqld option; from MariaDB 10.3.3 its also available as a system variable. Before MariaDB 10.6.0 \'::\' implied listening additionally on IPv4 addresses like \'*\'. From 10.6.0 onwards it refers to IPv6 stictly.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: By default, the MariaDB server listens for TCP/IP connections on all addresses. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#port" target="_blank" title="<?php _e( wp_kses( 'Port to listen for TCP/IP connections. If set to 0, will default to, in order of preference, my.cnf, the MYSQL_TCP_PORT environment variable, /etc/services, built-in default (3306).', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Port to listen for TCP/IP connections. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#hostname" target="_blank" title="<?php _e( wp_kses( 'When the server starts, this variable is set to the server host name.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: When the server starts, this variable is set to the server host name. */
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
			<td><a href="https://mariadb.com/kb/en/replication-and-binary-log-system-variables/#server_id" target="_blank" title="<?php _e( wp_kses( 'This system variable is used with MariaDB replication to identify unique primary and replica servers in a topology. This system variable is also used with the binary log to determine which server a specific transaction originated on.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: This system variable is used with MariaDB replication to identify unique primary and replica servers in a topology. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#protocol_version" target="_blank" title="<?php _e( wp_kses( 'The version of the client/server protocol used by the MariaDB server.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The version of the client/server protocol used by the MariaDB server. */
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
			<td><a href="https://mariadb.com/kb/en/ssltls-system-variables/#tls_version" target="_blank" title="<?php _e( wp_kses( 'This system variable accepts a comma-separated list (with no whitespaces) of TLS protocol versions. A TLS protocol version will only be enabled if it is present in this list. All other TLS protocol versions will not be permitted.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: This system variable accepts a comma-separated list (with no whitespaces) of TLS protocol versions. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#sql_mode" target="_blank" title="<?php _e( wp_kses( 'Sets the SQL Mode. Multiple modes can be set, separated by a comma. ', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Sets the SQL Mode. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#storage_engine" target="_blank" title="<?php _e( wp_kses( 'The default storage engine. The default storage engine must be enabled at server startup or the server won\'t start.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The default storage engine. */
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
			<td><a href="require_secure_transport" target="_blank" title="<?php _e( wp_kses( 'When this option is enabled, connections attempted using insecure transport will be rejected. Secure transports are SSL/TLS, Unix sockets or named pipes. Note that per-account requirements take precedence.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Secure transports are SSL/TLS, Unix sockets or named pipes. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#read_only" target="_blank" title="<?php _e( wp_kses( 'When set to 1 (0 is default), no updates are permitted except from users with the SUPER privilege or, from MariaDB 10.5.2, the READ ONLY ADMIN privilege, or replica servers updating from a primary. The read_only variable is useful for replica servers to ensure no updates are accidentally made outside of what are performed on the primary.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The read_only variable is useful for replica servers to ensure no updates are accidentally made outside of what are performed on the primary. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#connect_timeout" target="_blank" title="<?php _e( wp_kses( 'Time in seconds that the server waits for a connect packet before returning a \'Bad handshake\'. Increasing may help if clients regularly encounter \'Lost connection to MySQL server at \'X\', system error: error_number\' type-errors.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Time in seconds that the server waits for a connect packet before returning a Bad handshake. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#wait_timeout" target="_blank" title="<?php _e( wp_kses( 'Time in seconds that the server waits for a connection to become active before closing it. The session value is initialized when a thread starts up from either the global value, if the connection is non-interactive, or from the interactive_timeout value, if the connection is interactive.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Time in seconds that the server waits for a connection to become active before closing it. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#warning_count" target="_blank" title="<?php _e( wp_kses( 'Read-only variable indicating the number of warnings, errors and notes resulting from the most recent statement that generated messages. See SHOW WARNINGS for more. Note warnings will only be recorded if sql_notes is true (the default).', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Read-only variable indicating the number of warnings, errors and notes resulting from the most recent statement that generated messages. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#license" target="_blank" title="<?php _e( wp_kses( 'Server license, for example GPL.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Server license */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#autocommit" target="_blank" title="<?php _e( wp_kses( 'If set to 1, the default, all queries are committed immediately. The LOCK IN SHARE MODE and FOR UPDATE clauses therefore have no effect. If set to 0, they are only committed upon a COMMIT statement, or rolled back with a ROLLBACK statement. If autocommit is set to 0, and then changed to 1, all open transactions are immediately committed.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: If set to 1, the default, all queries are committed immediately. */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#concurrent_insert" target="_blank" title="<?php _e( wp_kses( 'If set to AUTO or 1, the default, MariaDB allows concurrent INSERTs and SELECTs for MyISAM tables with no free blocks in the data (deleted rows in the middle). If set to NEVER or 0, concurrent inserts are disabled. If set to ALWAYS or 2, concurrent inserts are permitted for all MyISAM tables, even those with holes, in which case new rows are added at the end of a table if the table is being used by another thread.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: MariaDB allows concurrent INSERTs and SELECTs for MyISAM tables with no free blocks in the data (deleted rows in the middle). */
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#error_count" target="_blank" title="<?php _e( wp_kses( 'Read-only variable denoting the number of errors from the most recent statement in the current session that generated errors.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Read-only variable denoting the number of errors from the most recent statement in the current session that generated errors. */
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
			<td><a href="https://mariadb.com/kb/en/replication-and-binary-log-system-variables/#expire_logs_days" target="_blank" title="<?php _e( wp_kses( 'Number of days after which the binary log can be automatically removed. By default 0, or no automatic removal. When using replication, should always be set higher than the maximum lag by any replica.', 'strip' ), 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Number of days after which the binary log can be automatically removed. */
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
}
if ('logs' === $active_stab) {
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
}
if ('locale' === $active_stab) {
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
}
if ('conn' === $active_stab) {
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
}
if ('histogram' === $active_stab) {
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
}
if ('characterset' === $active_stab) {
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
}
if ('collation' === $active_stab) {
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
}
if ('has' === $active_stab) {
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
}
if ('innodb' === $active_stab) {
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
}
unset( $mdbhc_gd );
