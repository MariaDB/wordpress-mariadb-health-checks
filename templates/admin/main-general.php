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
