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
		$query     = "select timestampdiff(HOUR, ts, now()) as 'hours-ago', avg(seconds) as 'avg-seconds', sum(queries_num) as 'queries-num' from " . $wpdb->prefix . "mariadb_execution_time where date(ts) >= now() - interval 7 day group by timestampdiff(HOUR, ts, now()) order by ts;";
		$resultsDb = $wpdb->get_results($query, ARRAY_A);
		$results   = [];
		foreach ($resultsDb as $k => $r) {
			$timestamp = time() - $r['hours-ago'] * 60 * 60;
			$date      = $timestamp;
			$results[$k]['date'] = $date;
			$results[$k]['microseconds'] = $r['avg-seconds'] * 1000000;
			$results[$k]['queries-num']  = $r['queries-num'];
		}

		return $results;
	}

	public function get_raw()
	{
		global $wpdb;
		$query     = "select timestampdiff(HOUR, ts, now()) as 'hours-ago', avg(seconds) as 'avg-seconds', sum(queries_num) as 'queries-num' from " . $wpdb->prefix . "mariadb_execution_time where date(ts) >= now() - interval 7 day group by timestampdiff(HOUR, ts, now()) order by ts;";
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
