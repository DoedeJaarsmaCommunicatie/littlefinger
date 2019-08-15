<?php
namespace App\Controllers\Customizer\General;

use App\Providers\CustomizerServiceProvider;

use Kirki;

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
	    [
	    	'id'        => CustomizerServiceProvider::CONFIG_ID,
		    'type'      => 'editor',
		    'settings'  => 'seo_store_flyout',
		    'label'     => 'Text flyout',
		    'section'   => 'seo_settings',
		    'priority'  => 20
	    ]
    ];
    
    public function register_custom_controls() : void {
        Kirki::add_field(
        	CustomizerServiceProvider::CONFIG_ID,
	        [
		        'type'          => 'repeater',
		        'label'         => 'Seo tekst review balk',
		        'section'       => 'seo_settings',
		        'priority'      => 30,
		        'row_label'     => [
		        	'type'          => 'text',
			        'value'         => 'Lijst-item',
		        ],
		        'button_label'  => 'Nieuw item toevoegen',
		        'settings'      => 'seo_reviews',
		        'fields'        => [
		        	'item_text'     => [
		        		'type'          => 'text',
				        'label'         => 'Extra USP/SEO tekst',
				        'description'   => 'Dit punt komt in het lijstje bij de reviews te staan.',
				        'default'       => ''
			        ]
		        ],
		        'default'       => [
		        	[
		        		'item_text' => 'Groot assortiment wijnen overzichtelijk geordend in wijnwebshops per land',
			        ],
			        [
			        	'item_text' => 'Makkelijk wijn bestellen: één winkelmandje voor alle webshops',
			        ]
		        ]
	        ]
        );
    }
}
