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
		add_action('wp_ajax_mdbhc_executiontime', [$this, 'ajax']);
	}

	public function ajax()
	{
		check_ajax_referer('mdbhc_executiontime', 'nonce', true);
		$executionTime = new ExecutionTime();
		wp_send_json([
			"data" => $executionTime->get(),
			"config" => [
				'high_contrast' => Accessibility::getActivateStatus(),
			]
		]);
	}



	public function admin_enqueues()
	{
		wp_enqueue_style('mdbhc-styles', mdbhc_url('/css/styles.css'), array(), false, 'all');
		wp_enqueue_script('mdbhc--chartjs', mdbhc_url('js/chart.4.2.1.min.js'), array(), false, true);
		wp_enqueue_script('mdbhc--moment', mdbhc_url('js/moment.js'), array(), false, true);
		wp_enqueue_script('mdbhc--adapter-moment', mdbhc_url('js/chartjs-adapter-moment.js'), array(), false, true);
		wp_enqueue_script('mdbhc--scripts', mdbhc_url('js/scripts.js'), ['jquery'], false, true);
		wp_add_inline_script('mdbhc--scripts', 'const mdbhc = ' . json_encode([
			'dir' => plugin_dir_path(__DIR__),
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('mdbhc_executiontime'),
		]), 'before');
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
