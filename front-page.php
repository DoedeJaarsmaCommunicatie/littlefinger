<?php

$context = \Timber\Timber::get_context();

$context ['post'] = new \App\Post();

//$context['featured'] = new \Timber\Post($context['post']->get_field('')[0]['id']);
$context['featured'] = carbon_get_theme_option('featured_product')[0]['id'];

\Timber\Timber::render([
	'views/front-page.twig',
	'views/index.twig'
], $context);
