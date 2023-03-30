<h3><?php _e( 'MariaDB Tools', 'mariadb-health-checks' ); ?></h3>
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
<div id="metabox" class="postbox" style="max-width: 50%">
	<div class="inside">
		<div class="main">
		<h2><span><?php _e('MariaDB Histograms', 'mariadb-health-checks'); ?></span></h2>
<?php
	if ($hasHistograms == 0) {
		echo '<p>';
		_e('Unfortunately your MariaDB version is too old to support optimizer histograms.', 'mariadb-health-checks');
		echo '</p>';
	} else {
		$res = $histograms->check();
		if ($res == -1) {
			echo '<p>';
			_e('Error checking Histograms, you may not have the correct permissions', 'mariadb-health-checks');
			echo '</p>';
			echo '<p>';
			_e('To work with histograms you will need permissions to the "mysql.*" tables in your database with your actual user.', 'mariadb-health-checks');
			echo '</p>';
		} else if ($res == 1) {
			echo '<p>';
			printf(
				__( 'Last histogram run: %1$s.', 'mariadb-health-checks' ),
				$histograms->last(),
			);
			echo '</p>';
		} else {
			echo '<p>';
			_e('Histograms have not been run!', 'mariadb-health-checks');
			echo '<p>';
		}
		echo '<p>';
		_e('Histograms assist the MariaDB optimizer in making better decisions on how to execute a query to rerieve data. For WordPress this can mean up to a 30x performance improvement.', 'mariadb-health-checks');
		echo '</p>';

		echo '<p><a href="https://mariadb.org/mariadb-30x-faster/" target="_blank">'. __('Read more about MariaDB Histograms', 'mariadb-health-checks') . '</a>.</p>';

		if ($res != -1) {
			echo '<p>';
			echo '<a href="?page=mdbhc&tab=tools&runhistograms" class="button button-primary">'. __('Run histograms', 'mariadb-health-checks') . '</a>';
			echo '</p>';
		}
	}
?>
		</div>
	</div>
</div>
