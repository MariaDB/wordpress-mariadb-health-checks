<script type="text/javascript">
function showMessage() {
if (window.confirm('Histograms assist the MariaDB optimizer in making better decisions on how to execute a query to rerieve data. For WordPress this can mean up to a 30x performance improvement. Click "OK" to find out more.'))
{
	window.open('https://mariadb.org/mariadb-30x-faster/', '_blank');
};
}
</script>
<?php
$histograms    = new MDBHC\Histograms();
$hasHistograms = $histograms->hasHistograms();

if ($hasHistograms != 0) {
	if (isset($_GET['runhistograms'])) {
		$histograms->run();
		echo '<div class="notice notice-success is-dismissible"><p>';
		esc_html_e('Histograms have been run successfully');
		echo '</p></div>';

		unset($_GET['runhistograms']);
	}
}

?>
<h3><?php _e( 'MariaDB Warnings', 'mdbhc' ); ?></h3>
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
?>
<div id="metabox" class="postbox" style="max-width: 400px">
	<div class="inside">
		<div class="main">
		<h2><span>MariaDB Histograms</span></h2>
<?php
	if ($hasHistograms == 0) {
		echo '<p>';
		esc_html_e('Unfortunately your MariaDB version is too old to support optimizer histograms.');
		echo '</p>';
	} else {
		$res = $histograms->check();
		if ($res == -1) {
			echo '<p>';
			esc_html_e('Error checking Histograms, you may not have the correct permissions');
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
		echo '<p><a onClick="showMessage()">Read more about MariaDB Histograms</a>.</p>';
		if ($res != -1) {
			echo '<p>';
			echo '<a href="?page=mdbhc&tab=warnings&runhistograms" class="button button-primary">Run histograms</a>';
			echo '</p>';
		}
	}
?>
		</div>
	</div>
</div>
