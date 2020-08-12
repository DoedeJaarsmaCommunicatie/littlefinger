<?php

/**
 * @version 1.6.4
 */

use App\Helpers\Cookie;
use App\Helpers\Counter;
use App\Helpers\Template;
use App\Helpers\Woo;
use App\Post;
use Timber\Timber;

$context = Timber::get_context();
$context['post'] = new \App\Models\Product();
$context['product'] = Woo::getProduct($context['post']->ID);

Counter::setPostViews($context['post']->ID);
Cookie::setViewCookie($context['post']->ID);

$related_limit               =  4;
$related_ids                 =  wc_get_related_products($context['product']->get_id(), $related_limit);
$context['related_products'] =  Timber::get_posts($related_ids);
wp_reset_postdata();

Timber::render(
    Template::viewTwigFile('woocommerce/single-product'),
    $context
);
