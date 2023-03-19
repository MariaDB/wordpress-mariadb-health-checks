<?php

namespace MDBHC;

class ExecutionTime
{
	public const TABLE_NAME = 'mariadb_execution_time';

	function __construct()
	{
	}

	public static function save_average_query_execution_time()
	{
		global $wpdb;

		$average = $wpdb->total_query_time / $wpdb->num_queries;

		$wpdb->insert(
			$wpdb->prefix . self::TABLE_NAME,
			[
				'seconds' => $average,
				'queries_num' => $wpdb->num_queries
			]
		);
	}

	public function get()
	{
		global $wpdb;

		$query = "select timestampdiff(HOUR, ts, now()) as 'Hours Ago', avg(seconds) from " . $wpdb->prefix . "mariadb_execution_time where date(ts) >= now() - interval 7 day group by timestampdiff(HOUR, ts, now()) order by ts;";

		return $wpdb->get_results($query, OBJECT);
	}

}


