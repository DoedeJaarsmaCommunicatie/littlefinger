<?php


namespace App\Controllers\Customizer\General;


use App\Providers\CustomizerServiceProvider;

class GeneralLayoutCustomizerController extends Customizer
{
	protected $panel_name = 'general';
	
	protected $panel_priority = 15;
	
	protected $section = [
		'title'         => 'General Layout',
		'description'   => 'These values are used to determine the layout.',
		'panel'         => 'general'
	];
	
	protected $section_name = 'general_settings_layout';
	
	protected $fields = [
		[
			'id'        => CustomizerServiceProvider::CONFIG_ID,
			'type'      => 'text',
			'settings'  => 'header_store-text',
			'label'     => 'Label voor knop `alle winkels`',
			'section'   => 'general_settings_layout',
			'default'   => 'Alle winkels',
			'priority'  => 10
		],
		[
			'id'        => CustomizerServiceProvider::CONFIG_ID,
			'type'      => 'text',
			'settings'  => 'my_account-text',
			'label'     => 'Label voor knop `mijn account`',
			'section'   => 'general_settings_layout',
			'default'   => 'Mijn account',
			'priority'  => 20,
		],
		[
			'id'        => CustomizerServiceProvider::CONFIG_ID,
			'type'      => 'text',
			'settings'  => 'winkelwagen-text',
			'label'     => 'Label voor knop `winkelwagen`',
			'section'   => 'general_settings_layout',
			'default'   => 'Winkelmandje',
			'priority'  => 20,
		],
	];
}
