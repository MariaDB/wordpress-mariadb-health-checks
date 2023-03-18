<?php

namespace MDBHC;

class Helper {
  
  function __construct() {

  }

  public static function printr($obj) {

    echo '<pre>';
    print_r($obj, true);
    echo '</pre>';

  }

}


