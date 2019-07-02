<?php
namespace App\Providers;

use cdk_model;
use function get_sites;

/**
 * Class ContentServiceProvider
 *
 * @package App\Providers
 */
class ContentServiceProvider {

	/**
	 * ContentServiceProvider constructor.
	 */
	public function __construct() {
		$this->boot();
	}

	/**
	 * Adds functionality to the \Timber\Context.
	 */
	public function boot(): void {
		add_filter(
			'timber/context',
			static function ( $context ) {
				if ( function_exists( 'get_sites' ) ) {
					$context['sites'] = get_sites(
						[
							'site__not_in' => get_current_blog_id(),
							'public'       => 1,
							'archived'     => 0,
						]
					);
				}
				$context['kiyoh'] = (new cdk_model())->get();
				$context['featured'] = new \Timber\Post(carbon_get_theme_option('featured_product')[0]['id']);
				
				return $context;
			}
		);
		
		add_filter(
			'timber/twig',
			static function ($twig) {
				$twig->addFunction(new \Timber\Twig_Function( 'theme_option', 'carbon_get_theme_option' ));
				
				return $twig;
			}
		);
	}
}
