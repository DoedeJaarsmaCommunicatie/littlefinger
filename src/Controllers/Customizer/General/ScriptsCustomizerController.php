<?php
namespace App\Controllers\Customizer\General;

use App\Providers\CustomizerServiceProvider;

class ScriptsCustomizerController extends Customizer
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
        'title'       => 'General Scripts settings',
        'description' => 'Here you can insert all kinds of scripts to show in the header.',
    ];

    /**
     * The section name.
     *
     * @var string $section_name
     */
    protected $section_name = 'general_settings_scripts';

    /**
     * The basic fields.
     *
     * @var array
     */
    protected $fields = [
        [
            'id'          => CustomizerServiceProvider::CONFIG_ID,
            'type'        => 'code',
            'settings'    => 'code_header_js',
            'description' => 'Voer hier JS in voor in de header. Zonder script tags.',
            'label'       => 'Header Javascript',
            'section'     => 'general_settings_scripts',
            'priority'    => 20,
            'choices'     => [
                'language' => 'js',
            ]
        ],
        [
            'id'          => CustomizerServiceProvider::CONFIG_ID,
            'type'        => 'code',
            'settings'    => 'code_header_css',
            'description' => 'Voer hier CSS in voor in de header.',
            'label'       => 'Header CSS',
            'section'     => 'general_settings_scripts',
            'priority'    => 20,
            'choices'     => [
                'language' => 'css',
            ]
        ],
        [
            'id'          => CustomizerServiceProvider::CONFIG_ID,
            'type'        => 'code',
            'settings'    => 'code_header_html',
            'description' => 'Voer hier HTML in voor in de header. zoals globale nieuwe meta tags',
            'label'       => 'Header HTML',
            'section'     => 'general_settings_scripts',
            'priority'    => 20,
            'choices'     => [
                'language' => 'html',
            ]
        ],
    ];
}
