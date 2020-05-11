<?php

use App\Helpers\Template;
use Timber\Timber;

defined('ABSPATH') || exit;

$context = Timber::get_context();

Timber::render(
    Template::viewHtmlTwigFile(['404']),
    $context
);
