<?php
include_once get_stylesheet_directory() . '/vendor/autoload.php';

add_theme_support('custom-logo');
add_theme_support('WooCommerce');

\Timber\Timber::$locations = [
	get_stylesheet_directory() . '/templates/',
	ABSPATH . 'wp-content/templates/kaiser/'
];

add_action(
	'after_setup_theme',
	static function () {
		\Carbon_Fields\Carbon_Fields::boot();
	}
);

//$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
//	'https://github.com/DoedeJaarsmaCommunicatie/casadelkiyoh/',
//	__FILE__,
//	'casadelkiyoh'
//);
