<h3><?php _e( 'MariaDB Alarms', 'mdbhc' ); ?></h3>

<!-- SOME i18 EXAMPLES -->
<?php
/*
https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#localization-functions
*/

$value = __( 'Value', 'mdbhc' );

$another_value = 'Another Value';

printf(
	/* translators: %s: The value you want */
	__( 'Your value is %s.', 'mdbhc' ),
	$another_value
);

$city = 'Barcelona';
$zipcode = '08001';
printf(
	/* translators: 1: Name of a city 2: ZIP code */
	__( 'Your city is %1$s, and your zip code is %2$s.', 'mdbhc' ),
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
		'mdbhc'
	),
	number_format_i18n( $plurals )
);


?>
<p><?php _e( 'Value', 'mdbhc' ); ?></p>
