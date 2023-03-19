<h3><?php _e( 'MariaDB Data', 'mdbhc' ); ?></h3>

<h4><?php _e( 'Execution Time Graph', 'mdbhc' ); ?></h4>
<?php
	$histograms    = new MDBHC\Histograms();
	$hasHistograms = $histograms->hasHistograms();
	if( $hasHistograms != 0 ) {
		if (isset($_GET['runhistograms'])) {
			$histograms->run();
			echo '<div class="notice notice-success is-dismissible"><p>';
			esc_html_e('Histograms have been run successfully');
			echo '</p></div>';

			unset($_GET['runhistograms']);
		}
	}
?>
<div><canvas id="mdbhc-chart"></canvas></div>

<h4><?php _e( 'Execution Time Data', 'mdbhc' ); ?></h4>

<?php
	$executionTime = new MDBHC\ExecutionTime();
	$executionTimeAjax = new MDBHC\AdminScreen();
  echo '<table class="wp-list-table widefat"><tr><th>Date / Time</th><th>Average Exection Time (μS)</th><th>Average Queries</th></tr>';
  $execTime = $executionTime->get_raw();
  foreach ($execTime as $value) {
		echo '<tr><td>' . date("Y-m-d H:00", strtotime('-' . $value['hours-ago'] . ' hour')) . '</td><td>' . round($value['avg-seconds'] * 1000000) . '</td><td>' . round($value['queries-num']) . '</td></tr>';
  }
	echo '</table>';
?>
