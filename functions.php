<?php
include_once get_stylesheet_directory() . '/vendor/autoload.php';

add_theme_support('custom-logo');
add_theme_support('woocommerce');

\Timber\Timber::$locations = [
	get_stylesheet_directory() . '/templates/',
	ABSPATH . 'wp-content/templates/kaiser/'
];

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/DoedeJaarsmaCommunicatie/littlefinger/',
	__FILE__,
	'littlefinger'
);

remove_filter('the_content', 'wpautop');

function woocommerce_widget_shopping_cart_button_view_cart() {
	print '<a href="' . esc_url( wc_get_cart_url() ) . '" class="btn primary round large shaded outline lg:mr-4 w-full lg:w-auto">' . esc_html__( 'View cart', 'woocommerce' ) . '</a>';
}

function woocommerce_widget_shopping_cart_proceed_to_checkout() {
	echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="btn primary round large shaded w-full lg:w-auto mt-4 lg:mt-0">' . esc_html__( 'Checkout', 'woocommerce' ) . '</a>';
}

add_filter('woocommerce_register_post_type_product', 'enable_product_revisions');
function enable_product_revisions( $args ) {
	$args['supports'][] = 'revisions';
	return $args;
}
