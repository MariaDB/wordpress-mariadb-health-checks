<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

defined('WPINC') || die;

/**
 * Get the plugin directory path
 * 
 * @param  boolean $append Append a file to the path
 * @return string
 */
function mdbhc_dir($append = false) {

  return MDBHC_DIR . $append;

}

/**
 * Get the plugin directory URL
 * 
 * @param  boolean $append Append to the plugin directory URL
 * @return string
 */
function mdbhc_url($append = false) {

  return MDBHC_URL . $append;

}

/**
 * Include a file(s)
 * 
 * @param  string|array $inc  File path or Array of file paths
 * @param  array        $args Arguments to pass to the file
 * @param  boolean      $once Include once or not
 * @return void
 */
function mdbhc_inc($file, $args = array(), $once = false) {

  $includes = is_array($file) ? $file : array($file);
  $base_dir = mdbhc_dir();

  if( is_array($args) && count($args) > 0 ) {

    extract($args);

  }

  foreach ($includes as $include) {

    $include = $base_dir . $include;

    !$once ? 
      include $include : 
      include_once $include;

  }

}

mdbhc_inc(array(
  'vendor/autoload.php',
  'inc/constants.php',
  'inc/functions.php',
));

