<!-- <pre> -->
<?php

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


<div>
	<canvas id="mdbhc-chart"></canvas>
</div>
<div class="wrap">

	<?php settings_errors(); ?>
	<?php $active_tab = isset($_GET['tab']) ? strval($_GET['tab']) : 'general'; ?>
	<h2 class="nav-tab-wrapper">
		<a href="?page=mdbhc&tab=general" class="nav-tab <?php echo 'general' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('General', 'mdbhc'); ?></a>
		<a href="?page=mdbhc&tab=alarms" class="nav-tab <?php echo 'alarms' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Alarms', 'mdbhc'); ?></a>
		<a href="?page=mdbhc&tab=warnings" class="nav-tab <?php echo 'warnings' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Warnings', 'mdbhc'); ?></a>
		<a href="?page=mdbhc&tab=events" class="nav-tab <?php echo 'events' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Events', 'mdbhc'); ?></a>
	</h2>
	<?php
	if ('general' === $active_tab) {
		echo '<p>';
		esc_html_e('Blah blah blah', 'mdbhc');
		echo '</p>';
	}
	if ('alarms' === $active_tab) {
		echo '<p>';
		esc_html_e('ALARMS Blah blah blah', 'mdbhc');
		echo '</p>';
	}
	if ('warnings' === $active_tab) {
		echo '<p>';
		esc_html_e('WARNINGS Blah blah blah', 'mdbhc');
		echo '</p>';
	}
	if ('events' === $active_tab) {
		echo '<p>';
		esc_html_e('EVENTS Blah blah blah', 'mdbhc');
		echo '</p>';
	}
	?>
</div>
