<h3><?php _e( 'MariaDB Database Information', 'mdbhc' ); ?></h3>
<?php
$dbInformation = getAllDbInformation();
$mariaDBUrl         = 'https://mariadb.com/kb/en/mariadb-server-release-dates/';
$mariaDBUrlDownload = 'https://mariadb.org/download/';
$mdbhc_GeneralData = new MDBHC\GeneralData();
$mdbhc_gd = $mdbhc_GeneralData->get();
$active_stab = isset($_GET['stab']) ? wp_kses(strval($_GET['stab']), 'strip') : 'general';
$ismariadb = null;
if ( $dbInformation['isMariaDB'] ) {
	$ismariadb = '(MariaDB)';
}
?>
	<div class="notice notice-info"><p><?php printf(
	/* translators: %1$s: The database version you want. */
	__( 'You are currently using version %1$s of your database %2$s server.', 'mdbhc' ),
	$dbInformation['dbVersion'],
	$ismariadb
); ?>
</p>
	</div>
<?php if ( $dbInformation['isEndOfLive'] ) { ?>
	<div class="notice notice-error">
		<p><?php _e( 'Your version is past end of life. Please update your MariaDB database to a newer version.', 'mdbhc' ); ?></p>
		<p><?php printf(
			__( 'See <a href="%1$s" target="_blank">MariaDB version list</a> to get more details about the different versions.', 'mdbhc' ),
			$mariaDBUrl,
		); ?></p>
		<p><?php printf(
			__( 'Please, <a href="%1$s" target="_blank">download an updated version of MariaDB</a>.', 'mdbhc' ),
			$mariaDBUrlDownload,
		); ?></p>
	</div>
<?php } else { ?>
	<div class="notice notice-success">

		<p><?php printf(
			__( 'The version of your MariaDB is fully supported until %1$s.', 'mdbhc' ),
			$dbInformation['eol'],
		); ?></p>
		<p><?php printf(
			__( 'See <a href="%1$s" target="_blank">MariaDB version list</a> to get more details about the different versions.', 'mdbhc' ),
			$mariaDBUrl,
		); ?></p>
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#version" target="_blank" title="<?php _e( 'Server version number. It may also include a suffix with configuration or build information. -debug indicates debugging support was enabled on the server, and -log indicates at least one of the binary log, general log or slow query log are enabled, for example 10.0.1-MariaDB-mariadb1precise-log. From MariaDB 10.2.1, this variable can be set at startup in order to fake the server version.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Server version number */
				_e( 'MariaDB version', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['version']); if( isset( $mdbhc_gd['version_comment'] ) ) { echo esc_html($mdbhc_gd['version_comment']);  } ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['version_compile_os'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#version_compile_os" target="_blank" title="<?php _e( 'Operating system that MariaDB was built on, for example debian-linux-gnu. ', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Operating system that MariaDB was built on */
				_e( 'OS', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['version_compile_os']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['version_compile_machine'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#version_compile_machine" target="_blank" title="<?php _e( 'The machine type or architecture MariaDB was built on, for example i686.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The machine type or architecture MariaDB was built on */
				_e( 'Compilation Machine', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['version_compile_machine']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['version_source_revision'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#version_source_revision" target="_blank" title="<?php _e( 'Source control revision id for MariaDB source code, enabling one to see exactly which version of the source was used for a build.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Source control revision id for MariaDB source code */
				_e( 'Source version', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['version_source_revision']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['version_malloc_library'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#version_malloc_library" target="_blank" title="<?php _e( 'Version of the used malloc library.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Version of the used malloc library. */
				_e( 'malloc version', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['version_malloc_library']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['version_ssl_library'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/ssltls-system-variables/#version_ssl_library" target="_blank" title="<?php _e( 'The version of the TLS library that is being used. Note that the version returned by this system variable does not always necessarily correspond to the exact version of the OpenSSL package installed on the system. OpenSSL shared libraries tend to contain interfaces for multiple versions at once to allow for backward compatibility. Therefore, if the OpenSSL package installed on the system is newer than the OpenSSL version that the MariaDB server binary was built with, then the MariaDB server binary might use one of the interfaces for an older version.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The version of the TLS library that is being used. */
				_e( 'SSL version', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['version_ssl_library']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['bind_address'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#bind_address" target="_blank" title="<?php _e( 'By default, the MariaDB server listens for TCP/IP connections on all addresses. You can specify an alternative when the server starts using this option; either a host name, an IPv4 or an IPv6 address, \'::\' or \'*\' (all addresses). In some systems, such as Debian and Ubuntu, the bind_address is set to 127.0.0.1, which binds the server to listen on localhost only. bind_address has always been available as a mysqld option; from MariaDB 10.3.3 its also available as a system variable. Before MariaDB 10.6.0 \'::\' implied listening additionally on IPv4 addresses like \'*\'. From 10.6.0 onwards it refers to IPv6 stictly.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: By default, the MariaDB server listens for TCP/IP connections on all addresses. */
				_e( 'Bind Address', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['bind_address']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['port'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#port" target="_blank" title="<?php _e( 'Port to listen for TCP/IP connections. If set to 0, will default to, in order of preference, my.cnf, the MYSQL_TCP_PORT environment variable, /etc/services, built-in default (3306).', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Port to listen for TCP/IP connections. */
				_e( 'Port', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['port']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['hostname'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#hostname" target="_blank" title="<?php _e( 'When the server starts, this variable is set to the server host name.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: When the server starts, this variable is set to the server host name. */
				_e( 'Hostname', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['hostname']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['server_id'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/replication-and-binary-log-system-variables/#server_id" target="_blank" title="<?php _e( 'This system variable is used with MariaDB replication to identify unique primary and replica servers in a topology. This system variable is also used with the binary log to determine which server a specific transaction originated on.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: This system variable is used with MariaDB replication to identify unique primary and replica servers in a topology. */
				_e( 'Server ID', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['server_id']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['protocol_version'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#protocol_version" target="_blank" title="<?php _e( 'The version of the client/server protocol used by the MariaDB server.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The version of the client/server protocol used by the MariaDB server. */
				_e( 'Protocol version', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['protocol_version']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['tls_version'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/ssltls-system-variables/#tls_version" target="_blank" title="<?php _e( 'This system variable accepts a comma-separated list (with no whitespaces) of TLS protocol versions. A TLS protocol version will only be enabled if it is present in this list. All other TLS protocol versions will not be permitted.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: This system variable accepts a comma-separated list (with no whitespaces) of TLS protocol versions. */
				_e( 'TLS version', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['tls_version']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['sql_mode'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#sql_mode" target="_blank" title="<?php _e( 'Sets the SQL Mode. Multiple modes can be set, separated by a comma. ', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Sets the SQL Mode. */
				_e( 'SQL Mode', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['sql_mode']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['storage_engine'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#storage_engine" target="_blank" title="<?php _e( 'The default storage engine. The default storage engine must be enabled at server startup or the server won\'t start.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The default storage engine. */
				_e( 'Storage Engine', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['storage_engine']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['require_secure_transport'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="require_secure_transport" target="_blank" title="<?php _e( 'When this option is enabled, connections attempted using insecure transport will be rejected. Secure transports are SSL/TLS, Unix sockets or named pipes. Note that per-account requirements take precedence.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Secure transports are SSL/TLS, Unix sockets or named pipes. */
				_e( 'Require secure transport', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['require_secure_transport']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['read_only'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#read_only" target="_blank" title="<?php _e( 'When set to 1 (0 is default), no updates are permitted except from users with the SUPER privilege or, from MariaDB 10.5.2, the READ ONLY ADMIN privilege, or replica servers updating from a primary. The read_only variable is useful for replica servers to ensure no updates are accidentally made outside of what are performed on the primary.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The read_only variable is useful for replica servers to ensure no updates are accidentally made outside of what are performed on the primary. */
				_e( 'Read only', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['read_only']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['connect_timeout'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#connect_timeout" target="_blank" title="<?php _e( 'Time in seconds that the server waits for a connect packet before returning a \'Bad handshake\'. Increasing may help if clients regularly encounter \'Lost connection to MySQL server at \'X\', system error: error_number\' type-errors.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Time in seconds that the server waits for a connect packet before returning a Bad handshake. */
				_e( 'Connection timeout', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['connect_timeout']); ?></td>
		</tr>
	<?php
	}

	if( isset( $mdbhc_gd['wait_timeout'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#wait_timeout" target="_blank" title="<?php _e( 'Time in seconds that the server waits for a connection to become active before closing it. The session value is initialized when a thread starts up from either the global value, if the connection is non-interactive, or from the interactive_timeout value, if the connection is interactive.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Time in seconds that the server waits for a connection to become active before closing it. */
				_e( 'Waiting timeout', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['wait_timeout']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['warning_count'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#warning_count" target="_blank" title="<?php _e( 'Read-only variable indicating the number of warnings, errors and notes resulting from the most recent statement that generated messages. See SHOW WARNINGS for more. Note warnings will only be recorded if sql_notes is true (the default).', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Read-only variable indicating the number of warnings, errors and notes resulting from the most recent statement that generated messages. */
				_e( 'Waiting count', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['warning_count']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['license'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#license" target="_blank" title="<?php _e( 'Server license, for example GPL.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Server license */
				_e( 'License', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['license']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['autocommit'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#autocommit" target="_blank" title="<?php _e( 'If set to 1, the default, all queries are committed immediately. The LOCK IN SHARE MODE and FOR UPDATE clauses therefore have no effect. If set to 0, they are only committed upon a COMMIT statement, or rolled back with a ROLLBACK statement. If autocommit is set to 0, and then changed to 1, all open transactions are immediately committed.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: If set to 1, the default, all queries are committed immediately. */
				_e( 'Auto Commit', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['autocommit']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['concurrent_insert'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#concurrent_insert" target="_blank" title="<?php _e( 'If set to AUTO or 1, the default, MariaDB allows concurrent INSERTs and SELECTs for MyISAM tables with no free blocks in the data (deleted rows in the middle). If set to NEVER or 0, concurrent inserts are disabled. If set to ALWAYS or 2, concurrent inserts are permitted for all MyISAM tables, even those with holes, in which case new rows are added at the end of a table if the table is being used by another thread.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: MariaDB allows concurrent INSERTs and SELECTs for MyISAM tables with no free blocks in the data (deleted rows in the middle). */
				_e( 'Concurrent Insert', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['concurrent_insert']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['error_count'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#error_count" target="_blank" title="<?php _e( 'Read-only variable denoting the number of errors from the most recent statement in the current session that generated errors.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Read-only variable denoting the number of errors from the most recent statement in the current session that generated errors. */
				_e( 'Error count', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['error_count']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['expire_logs_days'] ) ) {
		$mdbhc_gd_general = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/replication-and-binary-log-system-variables/#expire_logs_days" target="_blank" title="<?php _e( 'Number of days after which the binary log can be automatically removed. By default 0, or no automatic removal. When using replication, should always be set higher than the maximum lag by any replica.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Number of days after which the binary log can be automatically removed. */
				_e( 'Expire log days', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['expire_logs_days']); ?></td>
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#log_error" target="_blank" title="<?php _e( 'Specifies the name of the error log. MariaDB always writes its error log, but the destination is configurable.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Specifies the name of the error log. */
				_e( 'Error', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['log_error']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['slow_query_log'] ) ) {
		$mdbhc_gd_logs = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#slow_query_log" target="_blank" title="<?php _e( 'If set to 0, the default unless the --slow-query-log option is used, the slow query log is disabled, while if set to 1 (both global and session variables), the slow query log is enabled. From MariaDB 10.11.0, an alias for log_slow_query.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: If set to 0, the default unless the --slow-query-log option is used, the slow query log is disabled, while if set to 1 (both global and session variables), the slow query log is enabled. */
				_e( 'Slow queries', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['slow_query_log']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['slow_query_log_file'] ) ) {
		$mdbhc_gd_logs = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#slow_query_log_file" target="_blank" title="<?php _e( 'Name of the slow query log file. From MariaDB 10.11, an alias for log_slow_query_file.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Name of the slow query log file. */
				_e( 'Slow queries file', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['slow_query_log_file']); ?></td>
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#date_format" target="_blank" title="<?php _e( 'Unused.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				_e( 'Date format', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['date_format']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['time_format'] ) ) {
		$mdbhc_gd_datetime = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#time_format" target="_blank" title="<?php _e( 'Unused.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				_e( 'Time format', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['time_format']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['datetime_format'] ) ) {
		$mdbhc_gd_datetime = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#datetime_format" target="_blank" title="<?php _e( 'Unused.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				_e( 'Date/Time format', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['datetime_format']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['timestamp'] ) ) {
		$mdbhc_gd_datetime = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#timestamp" target="_blank" title="<?php _e( 'Sets the time for the client. This will affect the result returned by the NOW() function, not the SYSDATE() function, unless the server is started with the --sysdate-is-now option, in which case SYSDATE becomes an alias of NOW, and will also be affected. Also used to get the original timestamp when restoring rows from the binary log.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Sets the time for the client. */
				_e( 'Timestamp', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['timestamp']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['time_zone'] ) ) {
		$mdbhc_gd_datetime = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#time_zone" target="_blank" title="<?php _e( 'The global value determines the default time zone for sessions that connect. The session value determines the session\'s active time zone. When it is set to SYSTEM, the session\'s time zone is determined by the system_time_zone system variable. ', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The global value determines the default time zone for sessions that connect. */
				_e( 'TimeZone', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['time_zone']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['lc_messages'] ) ) {
		$mdbhc_gd_datetime = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#lc_messages" target="_blank" title="<?php _e( 'This system variable can be specified as a locale name. The language of the associated locale will be used for error messages. See Server Locales for a list of supported locales and their associated languages.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: This system variable can be specified as a locale name. */
				_e( 'Locale messages', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['lc_messages']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['lc_time_names'] ) ) {
		$mdbhc_gd_datetime = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#lc_time_names" target="_blank" title="<?php _e( 'The locale that determines the language used for the date and time functions DAYNAME(), MONTHNAME() and DATE_FORMAT(). Locale names are language and region subtags, for example \'en_ZA\' (English - South Africa) or \'es_US: Spanish - United States\'. The default is always \'en-US\' regardless of the system\'s locale setting.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The locale that determines the language used for the date and time functions. */
				_e( 'Locale time names', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['lc_time_names']); ?></td>
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#max_connections" target="_blank" title="<?php _e( 'The maximum number of simultaneous client connections.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The maximum number of simultaneous client connections. */
				_e( 'Max Connections', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['max_connections']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['max_user_connections'] ) ) {
		$mdbhc_gd_conn = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#max_user_connections" target="_blank" title="<?php _e( 'Maximum simultaneous connections permitted for each user account. When set to 0, there is no per user limit. Setting it to -1 stops users without the SUPER privilege or, from MariaDB 10.5.2, the CONNECTION ADMIN privilege, from connecting to the server. The session variable is always read-only and only privileged users can modify user limits.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Maximum simultaneous connections permitted for each user account. */
				_e( 'Max Users Connections', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['max_user_connections']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['max_connect_errors'] ) ) {
		$mdbhc_gd_conn = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#max_connect_errors" target="_blank" title="<?php _e( 'Limit to the number of successive failed connects from a host before the host is blocked from making further connections. The count for a host is reset to zero if they successfully connect.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Limit to the number of successive failed connects from a host before the host is blocked from making further connections. */
				_e( 'Max Connect errors', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['max_connect_errors']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['max_error_count'] ) ) {
		$mdbhc_gd_conn = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#max_error_count" target="_blank" title="<?php _e( 'Specifies the maximum number of messages stored for display by SHOW ERRORS and SHOW WARNINGS statements.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Specifies the maximum number of messages stored for display by SHOW ERRORS and SHOW WARNINGS statements. */
				_e( 'Max error count', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['max_error_count']); ?></td>
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#histogram_size" target="_blank" title="<?php _e( 'Number of bytes used for a histogram, or, from MariaDB 10.7 when histogram_type is set to JSON_HB, number of buckets. If set to 0, no histograms are created by ANALYZE. ', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Number of bytes used for a histogram. */
				_e( 'Size', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['histogram_size']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['histogram_type'] ) ) {
		$mdbhc_gd_histogram = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#histogram_type" target="_blank" title="<?php _e( 'Specifies the type of histograms created by ANALYZE. ', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Specifies the type of histograms created by ANALYZE.  */
				_e( 'Type', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['histogram_type']); ?></td>
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
		<td><a href="https://mariadb.com/kb/en/server-system-variables/#character_set_client" target="_blank" title="<?php _e( 'Determines the character set for queries arriving from the client. It can be set per session by the client, although the server can be configured to ignore client requests with the --skip-character-set-client-handshake option. If the client does not request a character set, or requests a character set that the server does not support, the global value will be used.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Determines the character set for queries arriving from the client. */
				_e( 'Client', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['character_set_client']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['character_set_connection'] ) ) {
		$mdbhc_gd_characterset = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#character_set_connection" target="_blank" title="<?php _e( 'Character set used for number to string conversion, as well as for literals that don\'t have a character set introducer.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Character set used for number to string conversion, as well as for literals that don't have a character set introducer. */
				_e( 'Connection', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['character_set_connection']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['character_set_database'] ) ) {
		$mdbhc_gd_characterset = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#character_set_database" target="_blank" title="<?php _e( 'Character set used by the default database, and set by the server whenever the default database is changed. If there\'s no default database, character_set_database contains the same value as character_set_server.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Character set used by the default database, and set by the server whenever the default database is changed. */
				_e( 'Database', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['character_set_database']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['character_set_filesystem'] ) ) {
		$mdbhc_gd_characterset = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#character_set_filesystem" target="_blank" title="<?php _e( 'The character set for the filesystem. Used for converting file names specified as a string literal from character_set_client to character_set_filesystem before opening the file.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: The character set for the filesystem. */
				_e( 'Filesystem', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['character_set_filesystem']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['character_set_results'] ) ) {
		$mdbhc_gd_characterset = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#character_set_results" target="_blank" title="<?php _e( 'Character set used for results and error messages returned to the client.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Character set used for results and error messages returned to the client. */
				_e( 'Reults', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['character_set_results']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['character_set_server'] ) ) {
		$mdbhc_gd_characterset = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#character_set_system" target="_blank" title="<?php _e( 'Character set used by the server to store identifiers, always set to utf8, or its synonym utf8mb3 starting with MariaDB 10.6.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Character set used by the server to store identifiers */
				_e( 'Server', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['character_set_server']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['character_set_system'] ) ) {
		$mdbhc_gd_characterset = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#character_set_system" target="_blank" title="<?php _e( 'Character set used by the server to store identifiers, always set to utf8, or its synonym utf8mb3 starting with MariaDB 10.6.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Character set used by the server to store identifiers */
				_e( 'System', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['character_set_system']); ?></td>
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#collation_connection" target="_blank" title="<?php _e( 'Collation used for the connection character set.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Collation used for the connection character set. */
				_e( 'Connection', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['collation_connection']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['collation_database'] ) ) {
		$mdbhc_gd_collation = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#collation_database" target="_blank" title="<?php _e( 'Collation used for the default database. Set by the server if the default database changes, if there is no default database the value from the collation_server variable is used.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Collation used for the default database. */
				_e( 'Database', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['collation_database']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['collation_server'] ) ) {
		$mdbhc_gd_collation = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#collation_server" target="_blank" title="<?php _e( 'Default collation used by the server. This is set to the default collation for a given character set automatically when character_set_server is changed, but it can also be set manually.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: Default collation used by the server. */
				_e( 'Server', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['collation_server']); ?></td>
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
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#have_compress" target="_blank" title="<?php _e( 'If the zlib compression library is accessible to the server, this will be set to YES, otherwise it will be NO.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: If the zlib compression library is accessible to the server. */
				_e( 'Compress', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['have_compress']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['have_crypt'] ) ) {
		$mdbhc_gd_has = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#have_crypt" target="_blank" title="<?php _e( 'If the crypt() system call is available this variable will be set to YES, otherwise it will be set to NO.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: If the crypt() system call is available */
				_e( 'Crypt', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['have_crypt']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['have_dynamic_loading'] ) ) {
		$mdbhc_gd_has = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#have_dynamic_loading" target="_blank" title="<?php _e( 'If the server supports dynamic loading of plugins, will be set to YES, otherwise will be set to NO.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: If the server supports dynamic loading of plugins */
				_e( 'Dynamic Loading', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['have_dynamic_loading']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['have_geometry'] ) ) {
		$mdbhc_gd_has = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#have_geometry" target="_blank" title="<?php _e( 'If the server supports spatial data types, will be set to YES, otherwise will be set to NO. ', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: If the server supports spatial data types */
				_e( 'Geometry', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['have_geometry']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['have_openssl'] ) ) {
		$mdbhc_gd_has = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/ssltls-system-variables/#have_openssl" target="_blank" title="<?php _e( 'This variable shows whether the server is linked with OpenSSL rather than MariaDB\'s bundled TLS library, which might be wolfSSL or yaSSL.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: This variable shows whether the server is linked with OpenSSL */
				_e( 'OpenSSL', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['have_openssl']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['have_profiling'] ) ) {
		$mdbhc_gd_has = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#have_profiling" target="_blank" title="<?php _e( 'If statement profiling is available, will be set to YES, otherwise will be set to NO.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: If statement profiling is available. */
				_e( 'Profiling', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['have_profiling']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['have_query_cache'] ) ) {
		$mdbhc_gd_has = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#have_query_cache" target="_blank" title="<?php _e( 'If the server supports the query cache, will be set to YES, otherwise will be set to NO.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: *** Please, some context here *** */
				_e( 'Query Cache', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['have_query_cache']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['have_rtree_keys'] ) ) {
		$mdbhc_gd_has = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#have_rtree_keys" target="_blank" title="<?php _e( 'If RTREE indexes (used for spatial indexes) are available, will be set to YES, otherwise will be set to NO.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: If RTREE indexes (used for spatial indexes) are available. */
				_e( 'RTREE indexes', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['have_rtree_keys']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['have_ssl'] ) ) {
		$mdbhc_gd_has = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/ssltls-system-variables/#have_ssl" target="_blank" title="<?php _e( 'This variable shows whether the server supports using TLS to secure connections.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: This variable shows whether the server supports using TLS to secure connections. */
				_e( 'SSL', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['have_ssl']); ?></td>
		</tr>
	<?php
	}
	if( isset( $mdbhc_gd['have_symlink'] ) ) {
		$mdbhc_gd_has = false;
	?>
		<tr>
			<td><a href="https://mariadb.com/kb/en/server-system-variables/#have_symlink" target="_blank" title="<?php _e( 'This system variable can be used to determine whether the server supports symbolic links (note that it has no meaning on Windows).', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: This system variable can be used to determine whether the server supports symbolic links. */
				_e( 'Symlink', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['have_symlink']); ?></td>
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
			<td><a href="https://mariadb.com/kb/en/innodb-system-variables/#innodb_version" target="_blank" title="<?php _e( 'InnoDB version number. From MariaDB 10.3.7, as the InnoDB implementation in MariaDB has diverged from MySQL, the MariaDB version is instead reported.', 'mdbhc' ); ?>"><small><span class="dashicons dashicons-info"></span></small></a> <?php
				/* translators: InnoDB version number. */
				_e( 'Version', 'mdbhc' );
			?></td>
			<td><?php echo esc_html($mdbhc_gd['innodb_version']); ?></td>
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
