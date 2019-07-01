<?php

$context = \Timber\Timber::get_context();

$context ['post'] = new \Timber\Post();

$context['featured'] = new \Timber\Post(189);

\Timber\Timber::render([
	'views/front-page.twig',
	'views/index.twig'
], $context);
