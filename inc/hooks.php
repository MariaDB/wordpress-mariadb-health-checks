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

add_action('admin_footer', 'mdbhc_save_average_query_execution_time');
add_action('wp_print_footer_scripts', 'mdbhc_save_average_query_execution_time');
