<?php

defined('ABSPATH') || exit;

$context = \Timber\Timber::get_context();

/* @noinspection PhpUndefinedVariableInspection */
$context['checkout'] = $checkout;

echo \Timber\Timber::compile('partials/woocommerce/checkout/form.html.twig', $context);
