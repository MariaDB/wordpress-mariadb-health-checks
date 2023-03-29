<?php

namespace MDBHC;

use \DateTime;

class Histograms {

	function __construct()
	{
	}

	public function hasHistograms() {
		global $wpdb;
		$query = "select cast(version() as int) > 11 or ( cast(version() as int) >= 10 and REGEXP_REPLACE(version(), '^[[:digit:]]+\.([[:digit:]]+)(.*)', '\\\\1') >= 4) as version_check;";
		$ret = $wpdb->get_var($query);
		return $ret;
	}

	public function check() {
		global $wpdb;
		$supp = $wpdb->suppress_errors(true);
		$query = "show create table mysql.table_stats;";
		$ret = $wpdb->get_var($query);
		$wpdb->suppress_errors($supp);
		if (!$ret) {
			return -1;
		}
		$query = "select count(*) from mysql.table_stats where db_name = '" . DB_NAME . "' and table_name LIKE '" . $wpdb->prefix . "%';";
		$ret = $wpdb->get_var($query);

		if ($ret > 0) {
			return 1;
		}
		return 0;
	}

	public function last()
	{
		global $wpdb;
		$query = "select UPDATE_TIME from information_schema.tables where table_schema='mysql' and table_name='table_stats';";
		$result = $wpdb->get_var($query);
		if (is_null($result)) {
			$result = "Unknown";
		}
		return $result;
	}

	public function isReRunNeeded() {
		if ($this->last() == "Unknown") {
			return true;
		}
		$lastRun = new DateTime($this->last());
		$now = new DateTime();

		$interval = $lastRun->diff($now);

		if(90 < (int) $interval->format('%a')){
			return true;
		}

		return false;
	}

	public function run() {
	global $wpdb;
		// TODO: check that we have permissions for mysql privileges tables
		foreach ($wpdb->tables as $value) {
			$query = "ANALYZE TABLE " . DB_NAME . "." . $wpdb->prefix . $value . " PERSISTENT FOR ALL;";
			// TODO: check errors
			$wpdb->query($query);
		}
	}
}
