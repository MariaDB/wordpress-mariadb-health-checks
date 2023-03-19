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

  public function get() {
    global $wpdb;

    $query = "select timestampdiff(HOUR, ts, now()) as 'Hours Ago', avg(seconds) from " . $wpdb->prefix . "mariadb_execution_time where date(ts) >= now() - interval 7 day group by timestampdiff(HOUR, ts, now()) order by ts;";

    return $wpdb->get_results($query, OBJECT);
  }

}


