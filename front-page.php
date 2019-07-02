<?php

$context = \Timber\Timber::get_context();

$context ['post'] = new \App\Post();

\Timber\Timber::render([
	'views/front-page.twig',
	'views/index.twig'
], $context);
