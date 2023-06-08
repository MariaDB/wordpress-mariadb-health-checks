<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

namespace MDBHC;

class PluginActivation
{

	public function __construct()
	{

	}

	public static function index()
	{

		self::create_versions_table();
		self::insert_versions_data();
		self::create_execution_table();
		self::create_config_table();

	}

	private static function create_execution_table()
	{

		$table_contents_file = mdbhc_dir('static/table-mariadb_execution_time-structure.sql');

		if (!file_exists($table_contents_file)) return;

		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$vars = array(
			'%%VAR_PREFIX%%' => $wpdb->prefix,
			'%%VAR_CHARACTER%%' => $charset_collate,
		);

		$sql = file_get_contents($table_contents_file);
		$sql = str_replace(array_keys($vars), array_values($vars), $sql);

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta($sql);

	}

	private static function create_versions_table()
	{

		$table_contents_file = mdbhc_dir('static/table-mariadb_versions-structure.sql');

		if (!file_exists($table_contents_file)) return;

		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$vars = array(
			'%%VAR_PREFIX%%' => $wpdb->prefix,
			'%%VAR_CHARACTER%%' => $charset_collate,
		);

		$sql = file_get_contents($table_contents_file);
		$sql = str_replace(array_keys($vars), array_values($vars), $sql);

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

	}

	private static function insert_versions_data()
	{

		$table_contents_file = mdbhc_dir('static/table-mariadb_versions-data.sql');

		if (!file_exists($table_contents_file)) return;

		global $wpdb;

		$table_name = $wpdb->prefix . 'mariadb_versions';

		$record = $wpdb->get_var("SELECT COUNT(*) from $table_name where id = 1");
		if ($record) {
			$sql = "TRUNCATE TABLE " . $wpdb->prefix . "mariadb_versions;";
			$wpdb->query($sql);
		}

		$charset_collate = $wpdb->get_charset_collate();

		$vars = array(
			'%%VAR_PREFIX%%' => $wpdb->prefix,
		);

		$sql = file_get_contents($table_contents_file);
		$sql = str_replace(array_keys($vars), array_values($vars), $sql);

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta($sql);

	}

	private static function create_config_table()
	{

		$table_contents_file = mdbhc_dir('static/table-mariadb_config-structure.sql');

		if (!file_exists($table_contents_file)) return;

		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$vars = array(
			'%%VAR_PREFIX%%' => $wpdb->prefix,
			'%%VAR_CHARACTER%%' => $charset_collate,
		);

		$sql = file_get_contents($table_contents_file);
		$sql = str_replace(array_keys($vars), array_values($vars), $sql);

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta($sql);

		self::insert_config_data();

	}

	private static function insert_config_data()
	{
		$table_contents_file = mdbhc_dir('static/table-mariadb_config-data.sql');

		if (!file_exists($table_contents_file)) return;

		global $wpdb;

		$table_name = $wpdb->prefix . 'mariadb_config';

		$record = $wpdb->get_var("SELECT COUNT(*) from $table_name");

		// print_r($record);exit;

		if ($record) return;

		$charset_collate = $wpdb->get_charset_collate();

		$vars = array(
			'%%VAR_PREFIX%%' => $wpdb->prefix,
		);

		$sql = file_get_contents($table_contents_file);
		$sql = str_replace(array_keys($vars), array_values($vars), $sql);

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta($sql);
	}

}

