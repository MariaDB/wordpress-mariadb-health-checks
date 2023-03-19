<h3><?php _e( 'MariaDB Database Information', 'mdbhc' ); ?></h3>
<?php
$mdbhc_GeneralData = new MDBHC\GeneralData();
$mdbhc_gd = $mdbhc_GeneralData->get();
?>
<h4><?php _e( 'General information', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_general = true;
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
if( isset( $mdbhc_gd['connect_timeout'] ) ) {
	$mdbhc_gd_general = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Bind Address', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['connect_timeout']; ?></td>
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
?>
</table>
<?php
if( $mdbhc_gd_general ) {
	_e( 'There is no General information to show.', 'mdbhc' );
}
unset( $mdbhc_gd_general );
?>

<h4><?php _e( 'Date and Time', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_datetime = true;
if( isset( $mdbhc_gd['date_format'] ) ) {
	$mdbhc_gd_datetime = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
			_e( 'Date format', 'mdbhc' );
		?></td>
		<td><?php echo $mdbhc_gd['date_format']; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
if( $mdbhc_gd_datetime ) {
	_e( 'There is no Date / Time information to show.', 'mdbhc' );
}
unset( $mdbhc_gd_datetime );
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
			/* translators: IP address for the database */
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
			/* translators: IP address for the database */
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
			/* translators: IP address for the database */
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

<h4><?php _e( 'InnoDB', 'mdbhc' ); ?></h4>
<table style="min-width: 320px;">
<?php
$mdbhc_gd_innodb = true;
if( isset( $mdbhc_gd['innodb_version'] ) ) {
	$mdbhc_gd_innodb = false;
?>
	<tr>
		<td><?php
			/* translators: IP address for the database */
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
