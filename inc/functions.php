<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

defined('WPINC') || die;

/**
 * Get template content
 *
 * @param string $template_path Template path
 * @param array $args Template arguments
 * @param boolean $echo Print template content
 * @return string
 */
function mdbhc_template($template_path, $args = array(), $echo = false)
{

	$template_path = $template_path . '.php';

	ob_start();

	mdbhc_inc($template_path, $args);

	if (!$echo) return ob_get_clean();

	return ob_get_clean();

}

/**
 * Print template content
 *
 * @param string $template_path Template path
 * @param array $args Template arguments
 * @param boolean $echo Print template content
 * @return string
 */
function mdbhc__template($template_path, $args = array())
{

	echo mdbhc_template($template_path, $args, true);

}

/**
 * Create the function to output the content of our Dashboard Widget.
 */
function mariadb_health_check_widget_render()
{
	mdbhc__template( 'templates/admin/widget' );

}

function mdbhc_enable_errors()
{

	@ini_set('display_errors', 1);
	@ini_set('display_startup_errors', 1);
	@error_reporting(E_ALL);

}

function printr($obj, $title = '')
{

	echo '<pre>';
	echo '<h3>' . $title . '</h3>';
	print_r($obj);
	echo '</pre>';

}
