<?php
namespace App\Controllers\Customizer\General;

use App\Providers\CustomizerServiceProvider;

class StoreCustomizerController extends Customizer
{
    protected $section = [
        'title'       => 'Store settings',
        'description' => 'Here you can set specific store settings',
    ];

    protected $section_name = 'store_settings';

    protected $fields = [
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'text',
            'settings' => 'store_filter',
            'label'    => 'Shortcode voor het filter voor het grotere stramien',
            'section'  => 'store_settings',
            'priority' => 10,
        ],
    ];
}
