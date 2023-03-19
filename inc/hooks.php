<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

defined('WPINC') || die;

global $wpdb;

class MDB_DB extends wpdb
{
	public $total_query_time = 0.0;

	public function loadFromParentObj($parentObj)
	{
		$objValues = get_object_vars($parentObj); // return array of object values
		foreach ($objValues as $key => $value) {
			$this->$key = $value;
		}
	}

	public function query($query)
	{
		$this->timer_start();
		$result = parent::query($query);
		$this->total_query_time += $this->timer_stop();
		return $result;
	}
}

$tmp = new MDB_DB(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
$tmp->loadFromParentObj($wpdb);
$wpdb = $tmp;

function mdbhc_save_average_query_execution_time()
{
	\MDBHC\ExecutionTime::save_average_query_execution_time();

}

function histograms_test() {
	$result = array(
		'status'      => 'good',
		'label'       => 'MariaDB Histogram Test',
		'badge'       => array(
			'label' =>  __( 'Performance' ),
			'color' => 'blue',
		),
		'description' => 'MariaDB Histograms are up to date',
		'actions'     => '',
		'test'        => 'histograms_test',
	);

	$histograms = new MDBHC\Histograms();

	if($histograms->check() == 0) {
		$result['status'] = 'recommended';
		$result['description'] = 'MariaDB Histograms have not been run!';
		return $result;
	} else {
		$result['status'] = 'recommended';
		$result['description'] = 'You do not have permissions to check MariaDB Histograms. Add grants to the mysql.*_stats tables to add support here.';
		return $result;
	}

	if($histograms->isReRunNeeded()) {
		$result['status'] = 'recommended';
		$result['description'] = 'Rerun is needed.';
	}

	return $result;
}

function maria_db_version_test() {
	$dbInformation = getAllDbInformation();
	$supported_text = 'The version of your MariaDB is fully supported until ' . $dbInformation['eol'];
	$result = array(
		'status'      => 'good',
		'label'       => 'MariaDB Version Test',
		'badge'       => array(
			'label' =>  __( 'Performance' ),
			'color' => 'blue',
		),
		'description' => $supported_text,
		'actions'     => '',
		'test'        => 'maria_db_version_test',
	);

	if($dbInformation['isEndOfLive']) {
		$result['status'] = 'critical';
		$result['description'] = 'Your version is past end of life. Please update your MariaDB database to a newer version.';
	}

	return $result;
}

function add_custom_test( $tests ) {
	$histograms = new MDBHC\Histograms();
	if($histograms->hasHistograms() != 0) {
		$tests['direct']['histograms_test'] = [
			'label' => 'Maria DB Histogram',
			'test' => 'histograms_test'
		];
	}

	$tests['direct']['maria_db_version_test'] = [
		'label' => 'Maria DB Version Test',
		'test' => 'maria_db_version_test'
	];

	return $tests;
}

add_filter( 'site_status_tests', 'add_custom_test' );
add_action('shutdown', 'mdbhc_save_average_query_execution_time');
