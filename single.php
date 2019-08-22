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
}

if (get_post_type() === 'druif') {
	/** @var Newest $products */
	$products = ProductsFactory::create('Newest');
	$products->boot();
	$products->add_args(
		[
			'tax_query' => [
				[
					'taxonomy'      => 'pa_druif',
					'field'         => 'slug',
					'operator'      => 'IN',
					'terms'         => $context['post']->slug
				]
			]
		]
	);
	
	if ($products->initialize_query()->get_wp_query()->have_posts()) {
		$context['products'] = $products->query->posts;
	}
	
}

if (get_post_type() === 'producent') {
	/** @var Newest $products */
	$products = ProductsFactory::create('Newest');
	$products->boot();
	$products->add_args(
		[
			'tax_query'     => [
				[
					'taxonomy'  => 'pa_domein',
					'field'     => 'slug',
					'operator'  => 'IN',
					'terms'     => $context['post']->slug
				]
			]
		]
	);
	
	if ($products->initialize_query()->get_wp_query()->have_posts()) {
		$context['products'] = Timber::get_posts($products->query->posts);
	}
}

array_unshift($templates, 'views/single/' . get_post_type() . '/' . $context['post']->slug . '.twig', 'views/single/' . get_post_type() . '.twig');

Timber::render($templates, $context);
