<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package WooCommerce/Templates
 * @version 3.7.0
 * @see     https://docs.woocommerce.com/document/template-structure/
 */

defined('ABSPATH') || exit;

$context = \Timber\Timber::get_context();
$context ['WC'] = WC();
$context ['cart'] = WC()->cart;
$context ['args'] = $args;

\Timber\Timber::render(
    \App\Helpers\Theme::partialTwigFile('woocommerce/cart/mini-cart'),
    $context
);
