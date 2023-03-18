<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

defined('WPINC') || die;

/**
 * Get template content
 * 
 * @param  string   $template_path Template path
 * @param  array    $args          Template arguments
 * @param  boolean  $echo          Print template content
 * @return string
 */
function mdbhc_template($template_path, $args = array(), $echo = false) {

  $template_path = $template_path . '.php';

  ob_start();

  mdbhc_inc($template_path, $args);

  if ( !$echo ) return ob_get_clean();

  return ob_get_clean();

}

/**
 * Print template content
 * 
 * @param  string   $template_path Template path
 * @param  array    $args          Template arguments
 * @param  boolean  $echo          Print template content
 * @return string
 */
function mdbhc__template($template_path, $args = array()) {

  echo mdbhc_template($template_path, $args, true);

}

