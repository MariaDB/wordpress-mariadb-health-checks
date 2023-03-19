<script type="text/javascript">
function showMessage() {
if (window.confirm('Histograms assist the MariaDB optimizer in making better decisions on how to execute a query to rerieve data. For WordPress this can mean up to a 30x performance improvement. Click "OK" to find out more.'))
{
	window.open('https://mariadb.org/mariadb-30x-faster/', '_blank');
};
}
</script>
<h3><?php _e( 'MariaDB Warnings', 'mdbhc' ); ?></h3>
<p>Blah blah blah</p>
<?php

echo '<p>DB Execution Time Graph</p>';
$executionTime = new MDBHC\ExecutionTime();

print_r($executionTime->get());
//require_once 'inc/App/Histograms.php'
// echo get_num_queries();

// echo '<br>';
// echo '<br>';

// echo timer_stop(1);


// global $wpdb;
// global $query_times_all;

// printr($wpdb->num_queries, '$wpdb->num_queries');
// printr( $wpdb->queries , '$wpdb->queries');
// $trace = $wpdb->queries[0]['trace'];
// printr($trace, '$trace');
// $trace = $wpdb->queries[0]['trace']->getTrace();
// printr( get_class_methods($wpdb->queries[0]['trace']) , '$wpdb->queries');

// printr($query_times_all, '$query_times_all');
	$histograms = new MDBHC\Histograms();
	if ($histograms->hasHistograms() == 0) {
		echo '<p>';
		esc_html_e('Unfortunately your MariaDB version is too old to support optimizer histograms.');
	} else {
		if (isset($_GET['runhistograms'])) {
				$histograms->run();
				echo '<p>';
				esc_html_e('Histograms have been run successfully');
				echo '</p>';
		}

		$res = $histograms->check();
		if ($res == -1) {
			echo '<p>';
			esc_html_e('Error checking Histograms, you may not have the correct permissions');
			echo '</p>';
		} else if ($res == 1 && $histograms->isReRunNeeded()) {
			echo '<p>';
			esc_html_e('Last histogram run: ' . $histograms->last());
			echo '</p><p>';
			esc_html_e('Rerun is needed.');
			echo '</p>';
		} else if ($res == 1) {
			echo '<p>';
			esc_html_e('Last histogram run: ' . $histograms->last());
			echo '</p>';
		} else {
			echo '<p>';
			esc_html_e('Histograms have not been run!');
			echo '<p>';
		}
		echo ' <a href="" onClick="showMessage()">Read more about MariaDB Histograms</a>.</p>';
		if ($res != -1) {
			echo '<p>';
			echo '<a href="?page=mdbhc&tab=warnings&runhistograms" class="button button-primary">Run histograms</a>';
			echo '</p>';
		}
	}
	echo '<p>';
	esc_html_e('WARNINGS Blah blah blah', 'mdbhc');
	echo '</p>';
?>
