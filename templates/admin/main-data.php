<h3><?php _e( 'MariaDB Data', 'mdbhc' ); ?></h3>
<p><?php _e( 'Here you have the information of the MariaDB histograms.', 'mdbhc' ); ?></p>
<p><?php _e( 'In the graph you can see, in blue, the average execution time per hour of the queries of your site. In red, you can see the number of queries that have been executed.', 'mdbhc' ); ?></p>
<p><?php _e( 'At the bottom you have the graph data in table format for a better reading.', 'mdbhc' ); ?></p>

<h4><?php _e( 'Execution Time Graph', 'mdbhc' ); ?></h4>
<?php
	$histograms    = new MDBHC\Histograms();
	$hasHistograms = $histograms->hasHistograms();
	if( $hasHistograms != 0 ) {
		if (isset($_GET['runhistograms'])) {
			$histograms->run();
			echo '<div class="notice notice-success is-dismissible"><p>';
			_e('Histograms have been run successfully', 'mdbhc');
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
  echo '<table class="wp-list-table widefat striped table-view-list"><thead><tr><th>'. __('Date / Time', 'mdbhc') . "</th><th>". __('Average Exection Time (μs)', 'mdbhc'). '</th><th>' . __('Average Queries', 'mdbhc'). '</th></tr></thead>';
	echo '<tbody id="the-list">';
  $execTime = $executionTime->get_raw();
  foreach ($execTime as $value) {
		echo '<tr class="inactive"><td>' . date("Y-m-d H:00", strtotime('-' . $value['hours-ago'] . ' hour')) . '</td><td>' . round($value['avg-seconds'] * 1000000) . '</td><td>' . round($value['queries-num']) . '</td></tr>';
  }
	echo '</tbody></table>';
?>
