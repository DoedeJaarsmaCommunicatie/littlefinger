<?php
namespace App\Controllers\Customizer\General;

use App\Providers\CustomizerServiceProvider;

/**
 * Class FooterCustomizerController
 * @package App\Controllers\Customizer
 */
class FooterCustomizerController extends Customizer {
	/**
	 * This holds the section data.
	 *
	 * @var array Holds the section data.
	 */
	protected $section = [
		'title'       => 'Footer Settings',
		'description' => 'These values are used in the footer.',
	];

	/**
	 * The section name.
	 *
	 * @var string $section_name
	 */
	protected $section_name = 'footer_settings';

	/**
	 * Footer data.
	 *
	 * @var array
	 */
	protected $panel = [
		'title'       => 'Footer',
		'description' => 'Footer settings wrapper',
	];

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
			'type'     => 'editor',
			'settings' => 'no_alcohol',
			'label'    => 'Nix18 blok',
			'section'  => 'footer_settings',
			'priority' => 10,
		],
		[
			'id'       => CustomizerServiceProvider::CONFIG_ID,
			'type'     => 'editor',
			'settings' => 'benefits',
			'label'    => 'Voordelen blok',
			'section'  => 'footer_settings',
			'priority' => 20,
		],
	];
}
