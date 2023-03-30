<?php
$dbInformation = getAllDbInformation();
$mariaDBUrl         = 'https://mariadb.com/kb/en/mariadb-server-release-dates/';
$mariaDBUrlDownload = 'https://mariadb.org/download/';
$ismariadb = null;
if ( $dbInformation['isMariaDB'] ) {
	$ismariadb = '(MariaDB)';
}
?>
<p><?php printf(
		/* translators: %1$s: The database version you want. */
				__( 'You are currently using version %1$s of your database %2$s server.', 'mariadb-health-checks' ),
				$dbInformation['dbVersion'],
				$ismariadb
		); ?>
	</p>
<?php if ( $dbInformation['isEndOfLive'] ) { ?>
		<p><?php _e( 'Your version is past end of life. Please update your MariaDB database to a newer version.', 'mariadb-health-checks' ); ?></p>
		<p><?php printf(
					__( 'See <a href="%1$s" target="_blank">MariaDB version list</a> to get more details about the different versions.', 'mariadb-health-checks' ),
					$mariaDBUrl,
			); ?></p>
		<p><?php printf(
					__( 'Please, <a href="%1$s" target="_blank">download an updated version of MariaDB</a>.', 'mariadb-health-checks' ),
					$mariaDBUrlDownload,
			); ?></p>
<?php } else { ?>
		<p><?php printf(
					__( 'The version of your MariaDB is fully supported until %1$s.', 'mariadb-health-checks' ),
					$dbInformation['eol'],
			); ?></p>
		<p><?php printf(
					__( 'See <a href="%1$s" target="_blank">MariaDB version list</a> to get more details about the different versions.', 'mariadb-health-checks' ),
					$mariaDBUrl,
			); ?></p>
<?php } ?>
<p><a href="tools.php?page=mdbhc&tab=tools" class="button button-primary"><?php _e( 'Go to MariaDB Health Checks tool', 'mariadb-health-checks' ); ?></a></p>
