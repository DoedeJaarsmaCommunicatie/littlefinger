<?php

use Elderbraum\CasaProductFactory\Products\Newest;
use Elderbraum\CasaProductFactory\ProductsFactory;
use Timber\Post;
use Timber\Timber;

$context = Timber::get_context();

$context['post'] = new Post();

$templates = [
	'views/single.twig',
	'views/index.twig'
];

if (get_post_type() === 'streek') {
	/** @var Newest $products */
	$products = ProductsFactory::create( Newest::class);
	
	$products->boot();
	$products->add_args(
		[
			'tax_query'     => [
				[
					'taxonomy'      => 'pa_streek',
					'field'         => 'slug',
					'terms'         => $context['post']->slug
				]
			]
		]
	);
	
	if ($products->initialize_query()->get_wp_query()->have_posts()) {
		$context['products'] = Timber::get_posts($products->query->posts);
		
	}
	
	array_unshift($templates, 'views/single/streek/' . $context['post']->slug . '.twig', 'views/single/streek.twig');
}

Timber::render($templates, $context);
