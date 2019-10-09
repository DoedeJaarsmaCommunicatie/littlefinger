<?php

defined('ABSPATH') || exit;

$context = \Timber\Timber::get_context();

/* @noinspection PhpUndefinedVariableInspection */
$context['checkout'] = $checkout;

echo \Timber\Timber::compile(
    \App\Helpers\Template::partialHtmlTwigFile('woocommerce/checkout/form'),
    $context
);
