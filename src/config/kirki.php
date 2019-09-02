<?php
namespace App;

use App\Controllers\Customizer\General\FooterCustomizerController;
use App\Controllers\Customizer\General\FooterListsCustomizerController;
use App\Controllers\Customizer\General\GeneralCustomizerController;
use App\Controllers\Customizer\General\GeneralLayoutCustomizerController;
use App\Controllers\Customizer\General\GeneralWoocommerceCustomizerController;
use App\Controllers\Customizer\General\ScriptsCustomizerController;
use App\Controllers\Customizer\General\SeoCustomizerController;
use App\Controllers\Customizer\General\StoreCustomizerController;
use App\Controllers\Customizer\General\UspCustomizerController;
use App\Controllers\Customizer\Product\GeneralProductCustomizerController;

return [
	UspCustomizerController::class,
	SeoCustomizerController::class,
	FooterCustomizerController::class,
	FooterListsCustomizerController::class,
	StoreCustomizerController::class,
	GeneralCustomizerController::class,
	GeneralWoocommerceCustomizerController::class,
	ScriptsCustomizerController::class,
	GeneralLayoutCustomizerController::class,
	GeneralProductCustomizerController::class,
];
