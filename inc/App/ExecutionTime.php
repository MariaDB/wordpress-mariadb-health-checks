<?php

namespace MDBHC;

class ExecutionTime {
  
  private $timeStart;
  
  function __construct() {
  }

  public function start() {
    $this->timeStart = microtime(true);
  }

  public function stop() {
    $timeIntervall = $this->timeStart - microtime(true);
    $this->insert($timeIntervall);
  }

  private function insert($timeIntervall) {
    global $wpdb;

    $wpdb->insert(
        'mariadb_execution_time',
        [
            'seconds' => $timeIntervall,
        ],
        [
            '%f',
        ]
    );

  }

}


