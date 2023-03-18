<?php
/**
 * @package MariaDB_Health_Checks
 * @version 1.0.0
 */

namespace MDBHC;

class AdminScreen {

  public function __construct() {

    add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueues') );
    add_action( 'admin_menu', array($this, 'admin_menu') );

  }

  public function admin_enqueues() {

    wp_enqueue_style('mdbhc--styles', mdbhc_url('css/styles.css'));

    wp_enqueue_script('mdbhc--scripts', mdbhc_url('js/scripts.js'), array(), false, true);
    wp_enqueue_script('mdbhc--alpinejs', '//unpkg.com/alpinejs', array(), null, true);

  }

  public function admin_menu() {

    add_submenu_page(
      'tools.php',
      'MariaDB Health Checks',
      'MariaDB Health Checks',
      'manage_options',
      'mdbhc',
      array($this, 'admin_screen_template')
    );

  }

  public function admin_screen_template() {

    mdbhc__template('templates/admin/main');

  }

}

