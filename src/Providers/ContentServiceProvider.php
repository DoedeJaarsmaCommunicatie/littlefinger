<?php
namespace App\Providers;

use cdk_model;
use cdk_hashed_model;
use Timber\Post;
use Timber\Twig_Function;
use function get_sites;

/**
 * Class ContentServiceProvider
 *
 * @package App\Providers
 */
class ContentServiceProvider
{

    /**
     * ContentServiceProvider constructor.
     */
    public function __construct()
    {
        $this->boot();
        $this->registered();
    }

    /**
     * Adds functionality to the theme.
     *
     * @return void
     */
    public function boot(): void
    {
    	$this->add_to_twig_context();
    	$this->add_to_twig_functions();
    }
	
	/**
	 * Adds functionality to the theme after the boot function.
	 *
	 * @return void
	 */
    public function registered(): void {
		$this->add_count_to_wc_fragment();
    }
	
	/**
	 * Adds context to the twig context instance.
	 *
	 * @return void
	 */
    private function add_to_twig_context(): void {
	    add_filter(
		    'timber/context',
		    static function ($context) {
			    if (function_exists('get_sites')) {
				    $context['sites'] = get_sites(
					    [
						    'site__not_in' => get_current_blog_id(),
						    'public'       => 1,
						    'archived'     => 0,
					    ]
				    );
			    }
			    if (true === get_theme_mod('cdelk_use_hash')) {
				    $context['kiyoh'] = (new cdk_hashed_model())->get();
			    } else {
				    $context['kiyoh'] = (new cdk_model())->get();
			    }
			    $context['featured'] = new Post(carbon_get_theme_option('featured_product')[0]['id']);
			
			    if ( function_exists( 'wc' ) && ! is_admin() ) {
				    $context['wc_cart_count'] = wc()->cart->get_cart_contents_count();
			    }
			
			    return $context;
		    }
	    );
    }
	
	/**
	 * Add functions to twig.
	 *
	 * @return void
	 */
    private function add_to_twig_functions(): void {
	    add_filter(
		    'timber/twig',
		    static function ($twig) {
			    $twig->addFunction(new Twig_Function('theme_option', 'carbon_get_theme_option'));
			
			    return $twig;
		    }
	    );
    }
	
	/**
	 * Add the wc cart count to the fragments response.
	 *
	 * @return void
	 */
    private function add_count_to_wc_fragment(): void {
	    add_filter( 'woocommerce_add_to_cart_fragments',
		    static function ( $fragments ) {
			    $fragments['cart_contents_count'] = wc()->cart->get_cart_contents_count();
			    return $fragments;
		    }
	    );
    }
}
