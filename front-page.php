<?php

use App\Post;
use Timber\Timber;

$fp = new \App\Controllers\Http\FrontPage(new Post());

$context = $fp->getContext();

Timber::render([
	'views/front-page.twig',
	'views/index.twig'
], $context);
