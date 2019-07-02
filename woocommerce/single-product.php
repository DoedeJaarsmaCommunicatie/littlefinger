<?php
$context = \Timber\Timber::get_context();

$context['post'] = new \Timber\Post();

$context['product'] = wc_get_product( $context['post']->ID );

\Timber\Timber::render( 'views/woocommerce/single-product.twig', $context );
