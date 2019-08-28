<?php

use Timber\Post;
use Timber\Timber;

$context = Timber::get_context();

$context['post'] = new Post();

$context['product'] = wc_get_product( $context['post']->ID );

$related_limit               =  4;
$related_ids                 =  wc_get_related_products($context['product']->get_id(), $related_limit);
$context['related_products'] =  Timber::get_posts($related_ids);
wp_reset_postdata();

Timber::render( 'views/woocommerce/single-product.twig', $context );
