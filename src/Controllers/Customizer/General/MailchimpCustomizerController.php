<?php
namespace App\Controllers\Customizer\General;

use App\Providers\CustomizerServiceProvider;
use Kirki;

class MailchimpCustomizerController extends Customizer 
{
    protected $panel_name = 'general';

    protected $section = [
        'title'         => 'General Mailchimp settings',
        'description'   => 'These values are used in the mailchimp'
    ];

    protected $section_name = 'general_settings_mailchimp';

    protected $fields = [
        [
            'id'        => CustomizerServiceProvider::CONFIG_ID,
            'type'      => 'text',
            'settings'  => 'mailchimp_key',
            'label'     => 'Mailchimp API key',
            'section'   => 'general_settings_mailchimp',
            'priority'  => 20,
            'default'   => '6ba707b6d50900268e0fc846e3f4a35e-us4'
        ],
        [
            'id'        => CustomizerServiceProvider::CONFIG_ID,
            'type'      => 'text',
            'settings'  => 'mailchimp_list',
            'label'     => 'Mailchimp Lijst ID',
            'section'   => 'general_settings_mailchimp',
            'priority'  => 20,
            'default'   => '4722ceec90'
        ],
        [
            'id'        => CustomizerServiceProvider::CONFIG_ID,
            'type'      => 'text',
            'settings'  => 'mailchimp_form_title',
            'label'     => 'Mailchimp titel',
            'section'   => 'general_settings_mailchimp',
            'priority'  => 20,
            'default'   => ''
        ],
        [
            'id'        => CustomizerServiceProvider::CONFIG_ID,
            'type'      => 'editor',
            'settings'  => 'mailchimp_form_context',
            'label'     => 'mailchimp_form_text',
            'section'   => 'general_settings_mailchimp',
            'priority'  => 20,
            'default'   => ''
        ],
    ];

    public function register_custom_controls() : void {
        Kirki::add_field(
        	CustomizerServiceProvider::CONFIG_ID,
	        [
		        'type'          => 'repeater',
		        'label'         => 'Invoervelden',
		        'section'       => 'general_settings_mailchimp',
		        'priority'      => 30,
		        'row_label'     => [
		        	'type'          => 'text',
			        'value'         => 'Invoerveld',
		        ],
		        'button_label'  => 'Nieuw item toevoegen',
		        'settings'      => 'mailchimp_fields',
		        'fields'        => [
		        	'type'     => [
		        		'type'          => 'select',
				        'label'         => 'Soort invoerveld',
                        'default'       => 'text',
                        'choices'       => [
                            'email'     => 'Emailadres',
                            'text'      => 'Textveld'
                        ]
                    ],
                    'id'        => [
                        'type'          => 'text',
                        'label'         => 'Invoerveld ID',
                    ],
                    'required'  => [
                        'type'          => 'checkbox',
                        'label'         => 'Verplicht veld'
                    ],
                    'placeholder'   => [
                        'type'          => 'text',
                        'label'         => 'Placeholder'
                    ],
                    'label'         => [
                        'type'          => 'text',
                        'label'         => 'Label'
                    ]
		        ]
	        ]
        );
    }
}
