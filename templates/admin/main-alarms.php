<h3><?php _e( 'MariaDB Alarms', 'mariadb-health-checks' ); ?></h3>

<!-- SOME i18 EXAMPLES -->
<?php
/*
https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#localization-functions
*/

$value = __( 'Value', 'mariadb-health-checks' );

$another_value = 'Another Value';

printf(
	/* translators: %s: The value you want */
	__( 'Your value is %s.', 'mariadb-health-checks' ),
	$another_value
);

$city = 'Barcelona';
$zipcode = '08001';
printf(
	/* translators: 1: Name of a city 2: ZIP code */
	__( 'Your city is %1$s, and your zip code is %2$s.', 'mariadb-health-checks' ),
	$city,
	$zipcode
);

// SOME PLURALS

$plurals = 2;
printf(
	_n(
		'%s value',
		'%s values',
		$plurals,
		'mariadb-health-checks'
	),
	number_format_i18n( $plurals )
);


?>
<p><?php _e( 'Value', 'mariadb-health-checks' ); ?></p>
