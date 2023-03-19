<?php

namespace MDBHC;

class ExecutionTime {

	private $timeStart;

	function __construct() {
	}

	public function start() {
		$this->timeStart = microtime( true );
	}

	public function stop() {
		$timeIntervall = $this->timeStart - microtime( true );
		$this->insert( $timeIntervall );
	}

	private function insert( $timeIntervall ) {
		global $wpdb;

		$wpdb->insert(
			'mariadb_execution_time',
			[
				'seconds' => $timeIntervall,
			],
			[
				'%f',
			]
		);

	}

	/**
	 * get all the logged execution times from database
	 * contains the first day, the average timing in microseconds and the average number of queries
	 * @return array
	 */
	public function get() {

		global $wpdb;
		$query     = "select timestampdiff(HOUR, ts, now()) as 'hours-ago', avg(seconds) as 'avg-seconds', avg(queries_num) as 'queries-num' from " . $wpdb->prefix . "mariadb_execution_time where date(ts) >= now() - interval 7 day group by timestampdiff(HOUR, ts, now()) order by ts;";
		$resultsDb = $wpdb->get_results( $query, ARRAY_A );
		$results   = [];
		$dates     = [];
		foreach ( $resultsDb as $k => $r ) {
			$timestamp = time() - $r['hours-ago'] * 60 * 60;
			$date      = date( 'd.m.Y', $timestamp );
			if ( isset( $dates[ $date ] ) ) {
				$results[ $k ]['date'] = '';
			} else {
				$dates[ $date ]        = $date;
				$results[ $k ]['date'] = $date;
			}

			$results[ $k ]['microseconds'] = $r['avg-seconds'] * 1000000;
			$results[ $k ]['queries-num']  = $r['queries-num'];
		}

		return $results;
	}

}
