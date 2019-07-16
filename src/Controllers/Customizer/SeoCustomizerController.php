<?php
namespace App\Controllers\Customizer\General;

use App\Providers\CustomizerServiceProvider;

/**
 * Class SeoCustomizerController
 * @package App\Controllers\Customizer
 */
class SeoCustomizerController extends Customizer
{

    /**
     * This holds the section data.
     *
     * @var array
     */
    protected $section = [
        'title'       => 'SEO Settings',
        'description' => 'Here you can add and edit certain SEO boosting texts',
    ];

    /**
     * The current section name.
     *
     * @var string
     */
    protected $section_name = 'seo_settings';

    /**
     * The basic fields.
     *
     * @var array
     */
    protected $fields = [
        [
            'id'       => CustomizerServiceProvider::CONFIG_ID,
            'type'     => 'editor',
            'settings' => 'seo_large',
            'label'    => 'Grote seo tekst footer',
            'section'  => 'seo_settings',
            'priority' => 10,
        ],
    ];
}
