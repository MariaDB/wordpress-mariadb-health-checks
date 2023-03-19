<h3><?php _e( 'MariaDB Database Information', 'mdbhc' ); ?></h3>
<?php

$GeneralData = new MDBHC\GeneralData();

$gd = $GeneralData->get();

echo '<pre>';
print_r( $gd );
echo '</pre>';


if( isset( $gd['innodb_version'] ) ) {
?>
<p><?php _e( 'InnoDB version', 'mdbhc' ); ?>: <?php echo $gd['innodb_version']; ?></p>
<?php
}
?>

