<?php
include_once get_stylesheet_directory() . '/vendor/autoload.php';

add_theme_support('custom-logo');
add_theme_support('woocommerce');

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

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/DoedeJaarsmaCommunicatie/littlefinger/',
	__FILE__,
	'littlefinger'
);

remove_filter('the_content', 'wpautop');

function woocommerce_widget_shopping_cart_button_view_cart() {
	print '<a href="' . esc_url( wc_get_cart_url() ) . '" class="btn primary round large shaded outline mr-4">' . esc_html__( 'View cart', 'woocommerce' ) . '</a>';
}

function woocommerce_widget_shopping_cart_proceed_to_checkout() {
	echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="btn primary round large shaded">' . esc_html__( 'Checkout', 'woocommerce' ) . '</a>';
}