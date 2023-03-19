<?php

namespace MDBHC;

class ExecutionTime {
	public const TABLE_NAME = 'mariadb_execution_time';

	function __construct() {
	}

	public static function save_average_query_execution_time() {
		global $wpdb;

		$average = $wpdb->total_query_time / $wpdb->num_queries;

		$wpdb->insert(
			$wpdb->prefix . self::TABLE_NAME,
			[
				'seconds'     => $average,
				'queries_num' => $wpdb->num_queries
			]
		);
	}

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


