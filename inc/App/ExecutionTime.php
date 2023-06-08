<?php

namespace MDBHC;

class ExecutionTime {
	public const TABLE_NAME = 'mariadb_execution_time';

	function __construct() {
	}

	public static function save_average_query_execution_time() {
		global $wpdb;

		if( !empty( $wpdb->total_query_time ) && !empty( $wpdb->num_queries ) && $wpdb->num_queries > 0 ) {

			$wpdb->insert(
				$wpdb->prefix . self::TABLE_NAME,
				[
					'seconds'     => $wpdb->total_query_time,
					'queries_num' => $wpdb->num_queries
				]
			);

		}
	}

	public function get() {
		global $wpdb;
		$query     = "select timestampdiff(HOUR, ts, now()) as 'hours-ago', sum(seconds) / sum(queries_num) as 'avg-seconds', sum(queries_num) as 'queries-num', avg(seconds) as 'avg-seconds-per-page', avg(queries_num) as 'avg-queries-per-page' from " . $wpdb->prefix . "mariadb_execution_time where date(ts) >= now() - interval 7 day group by timestampdiff(HOUR, ts, now()) order by ts;";
		$resultsDb = $wpdb->get_results($query, ARRAY_A);
		$results   = [];
		foreach ($resultsDb as $k => $r) {
			$timestamp = time() - $r['hours-ago'] * 60 * 60;
			$date      = $timestamp;
			$results[$k]['date'] = $date;
			$results[$k]['microseconds'] = $r['avg-seconds'] * 1000000;
			$results[$k]['queries-num']  = $r['queries-num'];
			$results[$k]['queries-per-page']  = $r['avg-queries-per-page'];
			$results[$k]['time-per-page']  = $r['avg-seconds-per-page'] * 1000;
		}

		return $results;
	}

	public function get_raw()
	{
		global $wpdb;
		$query     = "select timestampdiff(HOUR, ts, now()) as 'hours-ago', sum(seconds) / sum(queries_num) as 'avg-seconds', sum(queries_num) as 'queries-num', avg(seconds) as 'avg-seconds-per-page', avg(queries_num) as 'avg-queries-per-page' from " . $wpdb->prefix . "mariadb_execution_time where date(ts) >= now() - interval 7 day group by timestampdiff(HOUR, ts, now()) order by ts;";
		return $wpdb->get_results( $query, ARRAY_A );
	}

	public function cleanup_data()
	{
		global $wpdb;
		$query = "delete from " . $wpdb->prefix . "mariadb_execution_time where date(ts) < now() - interval 14 day;";
		$wpdb->query($query);
		$query = "optimize table " . $wpdb->prefix . "mariadb_execution_time;";
		$wpdb->query($query);
	}
}
