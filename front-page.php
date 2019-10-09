<?php
use App\Post;
use Timber\Timber;

$fp = new \App\Controllers\Http\FrontPage(new Post());

$context = $fp->getContext();

Timber::render(
    \App\Helpers\Template::viewTwigFile(['front-page', 'index']),
    $context
);
