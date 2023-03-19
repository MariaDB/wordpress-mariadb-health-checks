<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

defined('WPINC') || die;

global $wpdb;

class MDB_DB
{
	public $total_query_time = 0.0;
	private $original = '';

	public function setWpdb( $wpdb )
	{
		$objValues = get_object_vars($wpdb); // return array of object values
		foreach($objValues AS $key => $value)
		{
			$this->$key = $value;
		}

		$this->original = $wpdb;
	}

	public function query($query)
	{
		$this->timer_start();
		$result = $this->original->query( $query );
		$this->total_query_time += $this->timer_stop();
		return $result;
	}
	public function __call($name, $arguments)
	{
	  return $this->original->$name(...$arguments);
	}
	public function getOriginal()
	{		
		$objValues = get_object_vars($this); // return array of object values
		foreach($objValues AS $key => $value)
		{
			$this->original->$key = $value;
		}

		return $this->original;
	}
}

$tmp = new MDB_DB();
$tmp->setWpdb($wpdb);
$wpdb = $tmp;

function mdbhc_save_average_query_execution_time()
{

	global $wpdb;

	$average = $wpdb->total_query_time / $wpdb->num_queries;

	$table_name = $wpdb->prefix . 'mariadb_execution_time';

	$wpdb->insert($table_name, array(
		'seconds' => $average,
		'queries_num' => $wpdb->num_queries,
	));

}

add_action('admin_footer', 'mdbhc_save_average_query_execution_time');
add_action('wp_print_footer_scripts', 'mdbhc_save_average_query_execution_time');
