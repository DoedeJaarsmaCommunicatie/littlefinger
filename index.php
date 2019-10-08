<?php
$context = \Timber\Timber::get_context();

$context['post'] = new \Timber\Post();

\Timber\Timber::render(
    \App\Helpers\Theme::viewTwigFile('index'),
    $context
);
