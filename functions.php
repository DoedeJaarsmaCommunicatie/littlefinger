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

function woocommerce_widget_shopping_cart_button_view_cart()
{
    $context = \Timber\Timber::get_context();

    if (is_multisite() && is_plugin_active_for_network('woo-global-cart')) {
        $old_site = get_current_blog_id();
        switch_to_blog(get_network()->site_id);
        $context['cart_url'] = esc_url(wc_get_checkout_url());
        switch_to_blog($old_site);
    } else {
        $context['cart_url'] = esc_url(wc_get_checkout_url());
    }
    $context['content'] = esc_html__('Checkout', 'woocommerce');

    \Timber\Timber::render('partials/woocommerce/cart/button-checkout.html.twig', $context);
}

function woocommerce_widget_shopping_cart_proceed_to_checkout()
{
    $context = \Timber\Timber::get_context();

    if (is_multisite() && is_plugin_active_for_network('woo-global-cart')) {
        $old_site = get_current_blog_id();
        switch_to_blog(get_network()->site_id);
        $context['cart_url'] = esc_url(wc_get_cart_url());
        switch_to_blog($old_site);
    } else {
        $context['cart_url'] = esc_url(wc_get_cart_url());
    }
    $context['content'] = esc_html__('View cart', 'woocommerce');

    \Timber\Timber::render('partials/woocommerce/cart/button-cart.html.twig', $context);
}


add_filter('woocommerce_register_post_type_product', static function ($args) {
    $args['supports'][] = 'revisions';
    return $args;
});

add_filter('woocommerce_checkout_fields', static function ($fields) {
    $fields['billing']['billing_company']['placeholder'] = __('Alleen voor zakelijke klanten', 'ltfg');
    $fields['shipping']['billing_company']['placeholder'] = __('Alleen voor zakelijke klanten', 'ltfg');

    unset($fields[ 'billing' ][ 'billing_address_2' ], $fields[ 'shipping' ][ 'shipping_address_2' ]);

    return $fields;
});

/**
 * Changes 'delivery note' to remove prices.
 */
function example_price_free_delivery_note()
{
    ?>
    <style>
        .delivery-note .head-item-price,
        .delivery-note .head-price,
        .delivery-note .product-item-price,
        .delivery-note .product-price,
        .delivery-note .order-items tfoot {
            display: none;
        }
        .delivery-note .head-name,
        .delivery-note .product-name {
            width: 50%;
        }
        .delivery-note .head-quantity,
        .delivery-note .product-quantity {
            width: 50%;
        }
        .delivery-note .order-items tbody tr:last-child {
            border-bottom: 0.24em solid black;
        }
    </style>
    <?php
}
add_action('wcdn_head', 'example_price_free_delivery_note', 20);
