<?php
/**
 * @version 3.4.0
 */
use Timber\Timber;

$context = Timber::get_context();
$context['products'] = Timber::get_posts();

if (is_product_category()) {
    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    $context['category'] = get_term($term_id, 'product_cat');
    $context['title'] = single_term_title('', false);
}

Timber::render(
    \App\Helpers\Template::viewTwigFile('woocommerce/archive-product'),
    $context
);
