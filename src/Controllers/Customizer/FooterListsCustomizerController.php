<?php
namespace App\Controllers\Customizer\General;

use App\Providers\CustomizerServiceProvider;

class FooterListsCustomizerController extends Customizer
{
    /**
     * This holds the section data.
     *
     * @var array Holds the section data.
     */
    protected $section = [
        'title'       => 'Footer lists settings',
        'description' => 'These values are used in the SEO lists.',
    ];

    /**
     * The section name.
     *
     * @var string $section_name
     */
    protected $section_name = 'footer_lists_settings';
    
    /**
     * Panel name.
     *
     * @var string
     */
    protected $panel_name = 'footer_settings';

    /**
     * The basic fields.
     *
     * @var array
     */
    protected $fields = [
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'text',
            'settings' => 'shop_list_title',
            'label'    => 'Al onze winkels titel',
            'section'  => 'footer_lists_settings',
            'priority' => 5,
        ],
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'editor',
            'settings' => 'shop_list',
            'label'    => 'Al onze winkels',
            'section'  => 'footer_lists_settings',
            'priority' => 10,
        ],
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'text',
            'settings' => 'domain_list_title',
            'label'    => 'Wijnhuizen titel',
            'section'  => 'footer_lists_settings',
            'priority' => 15,
        ],
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'editor',
            'settings' => 'domain_list',
            'label'    => 'Wijnhuizen',
            'section'  => 'footer_lists_settings',
            'priority' => 20,
        ],
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'editor',
            'settings' => 'grapes_list_title',
            'label'    => 'Al onze Druiven titel',
            'section'  => 'footer_lists_settings',
            'priority' => 25,
        ],
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'editor',
            'settings' => 'grapes_list',
            'label'    => 'Al onze Druiven',
            'section'  => 'footer_lists_settings',
            'priority' => 30,
        ],
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'text',
            'settings' => 'regions_list_titel',
            'label'    => 'Al onze regio\'s titel',
            'section'  => 'footer_lists_settings',
            'priority' => 35,
        ],
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'editor',
            'settings' => 'regions_list',
            'label'    => 'Al onze regio\'s',
            'section'  => 'footer_lists_settings',
            'priority' => 40,
        ],
    ];
}
