<?php
namespace App\Providers;

use App\Helpers\WP;
use cdk_model;
use cdk_hashed_model;
use Symfony\Component\Finder\Finder;
use Timber\Twig_Function;

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
        $this->add_search_placeholder();
        $this->add_to_twig_functions();
    }
    
    /**
     * Adds functionality to the theme after the boot function.
     *
     * @return void
     */
    public function registered(): void
    {
        $this->add_count_to_wc_fragment();
    }
    
    /**
     * Adds context to the twig context instance.
     *
     * @return void
     */
    private function add_to_twig_context(): void
    {
        add_filter(
            'timber/context',
            static function ($context) {
                $finder = new Finder();
                
                $context['sites'] = WP::getAllPublicSitesButCurrent();
                
                if (true === get_theme_mod('cdelk_use_hash') && class_exists('cdk_hashed_model')) {
                    $context['kiyoh'] = (new cdk_hashed_model())->get();
                } elseif (class_exists('cdk_model')) {
                    $context['kiyoh'] = (new cdk_model())->get();
                }
                
                $context['secure_payment'] = $finder
                    ->files()
                    ->in(WP::getStylesheetDir() . '/dist/images/payment_methods')
                    ->name('*.svg');
                
                if (function_exists('wc') &&
                    !is_admin() &&
                    wc()->cart) {
                    $context['wc_cart_count'] = wc()->cart->get_cart_contents_count();
                }
                
                if (get_theme_mod('large_layout')) {
                    $context['stramien_large'] = get_theme_mod('large_layout');
                } else {
                    $context['stramien_large'] = false;
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
    private function add_to_twig_functions(): void
    {
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
    private function add_count_to_wc_fragment(): void
    {
        add_filter(
            'woocommerce_add_to_cart_fragments',
            static function ($fragments) {
                if (!is_admin()) {
                    $fragments['cart_contents_count'] = wc()->cart->get_cart_contents_count();
                }
                return $fragments;
            }
        );
    }
    
    public function add_search_placeholder(): void
    {
        add_filter(
            'timber/context',
            static function ($context) {
                $context['search_placeholder'] = 'Hi, waar ben je naar op zoek?';
                if (is_user_logged_in()) {
                    $name = wp_get_current_user()->user_firstname;
                    $context['search_placeholder'] = sprintf('Hi %s, waar ben je naar op zoek?', $name);
                }
                
                return $context;
            }
        );
    }
}
