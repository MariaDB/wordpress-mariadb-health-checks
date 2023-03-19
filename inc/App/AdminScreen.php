<?php

/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

namespace MDBHC;

class AdminScreen
{

	public function __construct()
	{

		add_action('admin_enqueue_scripts', array($this, 'admin_enqueues'));
		add_action('admin_menu', array($this, 'admin_menu'));
		add_action('wp_dashboard_setup', array($this, 'admin_mdbhc_add_dashboard_widgets'));
	}

	public function admin_enqueues()
	{

		wp_enqueue_style('mdbhc--styles', mdbhc_url('css/styles.css'));

		wp_enqueue_script('mdbhc--chartjs', '//cdn.jsdelivr.net/npm/chart.js', array(), null, true);
		wp_enqueue_script('mdbhc--scripts', mdbhc_url('js/scripts.js'), array(), false, true);
		wp_enqueue_script('mdbhc--alpinejs', mdbhc_url('js/alpine.3.12.0.min.js'), array(), null, true);
	}

	public function admin_menu()
	{

		add_submenu_page(
			'tools.php',
			'MariaDB Health Checks',
			'MariaDB Health Checks',
			'manage_options',
			'mdbhc',
			array($this, 'admin_screen_template')
		);
	}

	public function admin_screen_template()
	{

		mdbhc__template('templates/admin/main');
	}

	/**
	 * Add a widget to the dashboard.
	 *
	 * This function is hooked into the 'wp_dashboard_setup' action below.
	 */
	function admin_mdbhc_add_dashboard_widgets()
	{

		wp_add_dashboard_widget(
			'mariadb_health_check_widget',
			esc_html__('MariaDB Health Check', 'mdbhc'),
			'mariadb_health_check_widget_render'
		);
		/*
		add_meta_box('mariadb_health_check_widget',
			'MariaDB Health Check',
			'mariadb_health_check_widget_render',
			'dashboard',
			'normal',
			'high');
		*/
	}
}
