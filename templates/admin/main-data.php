<h3><?php _e( 'MariaDB Data', 'mdbhc' ); ?></h3>

<h4><?php _e( 'Histogram Graph', 'mdbhc' ); ?></h4>
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

<h4><?php _e( 'Histogram Data', 'mdbhc' ); ?></h4>

<?php
	echo '<p>DB Execution Time Graph</p>';
	$executionTime = new MDBHC\ExecutionTime();
	$executionTimeAjax = new MDBHC\AdminScreen();

	print_r($executionTime->get());
?>
