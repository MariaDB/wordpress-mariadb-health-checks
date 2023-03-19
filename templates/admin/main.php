<h2><?php _e( 'MariaDB Health Checks', 'mdbhc' ); ?></h2>
<div class="wrap">
	<?php settings_errors(); ?>
	<?php mdbhc__template('templates/admin/notices'); ?>
	<?php $active_tab = isset( $_GET['tab'] ) ? strval( $_GET['tab'] ) : 'general'; ?>
	<h2 class="nav-tab-wrapper">
		<a href="?page=mdbhc&tab=general" class="nav-tab <?php echo 'general' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'General', 'mdbhc' ); ?></a>
		<a href="?page=mdbhc&tab=data" class="nav-tab <?php echo 'data' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Data', 'mdbhc' ); ?></a>
	</h2>
	<?php
	if ('general' === $active_tab) {
		echo '<p>';
		esc_html_e('Blah blah blah', 'mdbhc');
		echo '</p>';
		echo '<div><canvas id="mdbhc-chart"></canvas></div>';
		mdbhc__template('templates/admin/main-general');
	}
	if ( 'data' === $active_tab ) {
		mdbhc__template( 'templates/admin/main-data' );
	}
	?>
</div>
