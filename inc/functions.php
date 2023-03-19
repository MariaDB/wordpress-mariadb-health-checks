<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

defined( 'WPINC' ) || die;

/**
 * Get template content
 *
 * @param string $template_path Template path
 * @param array $args Template arguments
 * @param boolean $echo Print template content
 *
 * @return string
 */
function mdbhc_template( $template_path, $args = array(), $echo = false ) {

	$template_path = $template_path . '.php';

	ob_start();

	mdbhc_inc( $template_path, $args );

	if ( ! $echo ) {
		return ob_get_clean();
	}

	return ob_get_clean();

}

/**
 * Print template content
 *
 * @param string $template_path Template path
 * @param array $args Template arguments
 * @param boolean $echo Print template content
 *
 * @return string
 */
function mdbhc__template( $template_path, $args = array() ) {

	echo mdbhc_template( $template_path, $args, true );

}

/**
 * Create the function to output the content of our Dashboard Widget.
 */
function mariadb_health_check_widget_render() {
	mdbhc__template( 'templates/admin/widget' );

}

function mdbhc_enable_errors() {

	@ini_set( 'display_errors', 1 );
	@ini_set( 'display_startup_errors', 1 );
	@error_reporting( E_ALL );

}

function printr( $obj, $title = '' ) {

	echo '<pre>';
	echo '<h3>' . $title . '</h3>';
	print_r( $obj );
	echo '</pre>';

}


/**
 * Get the full version of the database server
 *
 * @return string|null
 */
function getFullDatabaseVersion() {
	global $wpdb;

	return $wpdb->get_var( "SELECT VERSION();" );
}

/**
 * Check if the server is MariaDB or not
 *
 * @return bool
 */
function isMariaDB( $versionString = '' ) {
	if ( empty( $versionString ) ) {
		$versionString = getFullDatabaseVersion();
	}
	$isMariaDB = false;
	if ( stripos( $versionString, 'MariaDB' ) > - 1 ) {
		$isMariaDB = true;
	}

	return $isMariaDB;
}

/**
 * Check the database version and compare the end of life date for MariaDB
 * returns an array with all the information
 *
 * @return array
 */
function getAllDbInformation() {
	$debug = false;
	global $wpdb;
	$GeneralData = new MDBHC\GeneralData();
	$gd   = $GeneralData->get();
	$data = [
		'fullVersion' => getFullDatabaseVersion(),
		'eol'         => '',
		'isEndOfLive' => false,
	];

	$data['isMariaDB'] = isMariaDB( $data['fullVersion'] );
	if ( isset( $gd['innodb_version'] ) ) {
		$data['dbVersion'] = $gd['innodb_version'];
	} else {
		$versionSplit      = explode( '-', $data['fullVersion'] );
		$data['dbVersion'] = $versionSplit[0] ?: '';
	}
	$versionSplit2          = explode( '.', $data['dbVersion'] );
	$data['dbVersionShort'] = $versionSplit2[0] ?: '';
	$data['dbVersionShort'] .= '.';
	$data['dbVersionShort'] .= $versionSplit2[1] ?: '0';

	/* Test DB Versions */
	if($debug){
		$data['dbVersion'] = '10.0.11';
		$data['dbVersionShort'] = '10.0';
		$data['fullVersion'] = '10.0.11-MariaDB-1:10.3.37+maria~ubu2004-log';
	}

	if ( $data['isMariaDB'] ) {
		$table_name = $wpdb->prefix . 'mariadb_versions';
		$query      = "SELECT * from " . $table_name . ' where version = \'' . $data['dbVersionShort'] . '\'';
		$record     = $wpdb->get_results( $query, ARRAY_A );
		if ( isset( $record[0]['version'], $record[0]['eol'] ) ) {
			$data['eol']         = $record[0]['eol'];
			$data['isEndOfLive'] = checkEndOfLive( $record[0]['eol'] );
		}
	}

	return $data;
}

/**
 * Check if a date is in the past or not
 *
 * @param string $date
 *
 * @return bool
 */
function checkEndOfLive( $date ) {
	$dateTime = strtotime( $date );

	if ( time() > $dateTime ) {
		return true;
	}

	return false;
}
