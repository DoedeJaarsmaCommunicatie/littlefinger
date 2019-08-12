<?php
namespace App\Controllers\Customizer\General;

use App\Providers\CustomizerServiceProvider;

/**
 * Class ThemeOptionsController
 *
 * @package App\Controllers\Customizer
 */
class UspCustomizerController extends Customizer
{

    /**
     * This holds the section data.
     *
     * @var array Holds the section data.
     */
    protected $section = [
        'title'       => 'USP Settings',
        'description' => 'These values are used as your USP',
    ];

    /**
     * The section name.
     *
     * @var string $section_name
     */
    protected $section_name = 'usp_settings';


    /**
     * The basic fields.
     *
     * @var array
     */
    protected $fields = [
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'text',
            'settings' => 'shipping_fee',
            'label'    => 'Gratis verzending vanaf:',
            'section'  => 'usp_settings',
            'default'  => 'Gratis verzending vanaf &euro; 50,-',
            'priority' => 10,
        ],
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'text',
            'settings' => 'delivery_time',
            'label'    => 'Bezorgtijd:',
            'section'  => 'usp_settings',
            'default'  => 'Voor 15:00 besteld, dezelfde werkdag verzonden.',
            'priority' => 20,
        ],
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'text',
            'settings' => 'more_shops',
            'label'    => 'Ook bij onze andere shops:',
            'section'  => 'usp_settings',
            'default'  => 'Bestellen bij meerdere webshops.',
            'priority' => 30,
        ],
    ];
}
