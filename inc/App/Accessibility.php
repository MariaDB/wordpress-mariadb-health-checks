<?php

namespace MDBHC;

class Accessibility {
	public const TABLE_NAME = 'mariadb_config';

	function __construct() {
	}

	public static function activate() {
		global $wpdb;

		// $wpdb->update(
		// 	$wpdb->prefix . self::TABLE_NAME,
		// 	[
		// 		'data' => 'true'
        //     ],
        //     [
        //         'name' => 'high_contrast'
        //     ]
		// );

		$wpdb->query("UPDATE " . $wpdb->prefix . self::TABLE_NAME . " SET `data` = 'true' WHERE " . $wpdb->prefix . self::TABLE_NAME . ".`name` = 'high_contrast'");
	}

	public static function deactivate() {
		global $wpdb;

		// $wpdb->update(
		// 	$wpdb->prefix . self::TABLE_NAME,
		// 	[
		// 		'data' => 'false'
        //     ],
        //     [
        //         'name' => 'high_contrast'
        //     ]
		// );

		$wpdb->query("UPDATE " . $wpdb->prefix . self::TABLE_NAME . " SET `data` = 'false' WHERE " . $wpdb->prefix . self::TABLE_NAME . ".`name` = 'high_contrast'");
	}

	public static function getActivateStatus() {
		global $wpdb;

        $query = "SELECT * FROM " . $wpdb->prefix . self::TABLE_NAME . " WHERE `name` = 'high_contrast'";

		$results = $wpdb->get_results($query, ARRAY_A);

        return "true" === $results[0]['data'];
	}
}
