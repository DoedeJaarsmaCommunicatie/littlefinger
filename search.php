<?php

$context = \Timber\Timber::get_context();

$context['posts'] = new Timber\PostQuery();

\Timber\Timber::render('views/search.twig', $context);
