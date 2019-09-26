<?php
namespace App;

use App\Controllers\Filters\Cart;
use App\Providers\CarbonServiceProvider;
use App\Providers\ContentServiceProvider;
use App\Providers\CustomizerServiceProvider;
use App\Providers\MenuServiceProvider;
use App\Providers\PageServiceProvider;

return [
    'providers'     => [
        MenuServiceProvider::class,
        CustomizerServiceProvider::class,
        ContentServiceProvider::class,
        PageServiceProvider::class,
        CarbonServiceProvider::class,
    ],
    'filters'       => [
        Cart::class
    ],
    'actions'       => []
];
