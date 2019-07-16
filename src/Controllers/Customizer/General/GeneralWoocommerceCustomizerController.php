<?php
namespace App\Controllers\Customizer\General;

use App\Providers\CustomizerServiceProvider;

class GeneralWoocommerceCustomizerController extends Customizer
{
    
    /**
     * The panel name.
     *
     * @var string $panel_name
     */
    protected $panel_name = 'general';
    
    /**
     * This holds the section data.
     *
     * @var array Holds the section data.
     */
    protected $section = [
        'title'       => 'General WooCommerce Settings',
        'description' => 'These values are used all over the site for woocommerce.',
    ];

    /**
     * The section name.
     *
     * @var string $section_name
     */
    protected $section_name = 'general_settings_woocommerce';

    /**
     * The basic fields.
     *
     * @var array
     */
    protected $fields = [
        [
            'id'          => CustomizerServiceProvider::CONFIG_ID,
            'type'        => 'text',
            'settings'    => 'cs_woocommerce',
            'description' => 'Voer dit zonder cx_ voorvoegsel in.',
            'label'       => 'WooCommerce Secret',
            'section'     => 'general_settings_woocommerce',
            'priority'    => 20,
        ],
        [
            'id'          => CustomizerServiceProvider::CONFIG_ID,
            'type'        => 'text',
            'settings'    => 'ck_woocommerce',
            'description' => 'Voer dit zonder cx_ voorvoegsel in.',
            'label'       => 'WooCommerce Key',
            'section'     => 'general_settings_woocommerce',
            'priority'    => 20,
        ],
    ];
}
