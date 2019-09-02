<?php
namespace App;

use App\Controllers\Meta\Blocks\ImageProducts;
use App\Controllers\Meta\Blocks\Producten;
use App\Controllers\Meta\Fields\FrontPage;
use App\Controllers\Meta\MenuMeta;
use App\Controllers\Meta\Options\Theme;

return [
	MenuMeta::class,
	Theme::class,
	FrontPage::class,
	Producten::class,
	ImageProducts::class,
];
