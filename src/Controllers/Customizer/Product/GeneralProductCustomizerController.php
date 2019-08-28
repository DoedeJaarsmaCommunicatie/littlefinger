<?php
namespace App\Controllers\Customizer\Product;

use App\Controllers\Customizer\General\Customizer;
use App\Providers\CustomizerServiceProvider;

class GeneralProductCustomizerController extends Customizer
{
	/**
	 * This holds the section data.
	 *
	 * @var array Holds the section data.
	 */
	protected $section = [
		'title'       => 'Product Settings',
		'description' => 'These values are used on the product pages.',
	];
	
	/**
	 * The section name.
	 *
	 * @var string $section_name
	 */
	protected $section_name = 'product_general';
	
	/**
	 * Footer data.
	 *
	 * @var array
	 */
	protected $panel = [
		'title'       => 'Product',
		'description' => 'Product settings wrapper',
	];
	
	/**
	 * Panel name.
	 *
	 * @var string
	 */
	protected $panel_name = 'product_settings';
	
	/**
	 * The basic fields.
	 *
	 * @var array
	 */
	protected $fields = [
		[
			'id'       => CustomizerServiceProvider::CONFIG_ID,
			'type'     => 'repeater',
			'settings' => 'product_usp',
			'label'    => 'USP\'s',
			'section'  => 'product_general',
			'priority' => 10,
			'fields' => [
				'usp_title' => [
					'type'        => 'text',
					'label'       => 'USP',
					'description' => 'Een USP',
					'default'     => '',
				],
				'icon'      => [
					'type'        => 'select',
					'label'       => 'icon',
					'description' => 'Icoon',
					'choices'     => [
						'far fa-clock'  => 'Klok',
						'fas fa-truck'  => 'Truck',
						'fas fa-wine-glass-alt'  => 'Wijn glas',
						'fas fa-home'   => 'Huis',
						'fas fa-trophy' => 'Beker'
					],
				]
			]
		],
	];
}
