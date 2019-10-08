<?php
/**
 * @version 1.6.4
 */
use App\Post;
use Timber\Timber;

$context = Timber::get_context();
$context['post'] = new Post();
$context['product'] = \App\Helpers\Woo::getProduct($context['post']->ID);

\App\Helpers\Counter::setPostViews($context['post']->ID);
\App\Helpers\Cookie::setViewCookie($context['post']->ID);

$related_limit               =  4;
$related_ids                 =  wc_get_related_products($context['product']->get_id(), $related_limit);
$context['related_products'] =  Timber::get_posts($related_ids);
wp_reset_postdata();

Timber::render(
    \App\Helpers\Theme::viewTwigFile('woocommerce/single-product'),
    $context
);
