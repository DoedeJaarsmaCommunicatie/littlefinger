<?php

namespace App\Providers;

use App\Helpers\WP;
use cdk_model;
use cdk_hashed_model;
use Symfony\Component\Finder\Finder;
use Timber\Helper;
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
        \add_action('wp_enqueue_scripts', [$this, 'handleAssets']);
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
            function ($context) {

                $context['sites'] = WP::getAllPublicSitesButCurrent();
    
                if (true === get_theme_mod('cdelk_use_hash') && class_exists('cdk_hashed_model')) {
                    $context['kiyoh'] = (new cdk_hashed_model())->get();
                } elseif (class_exists('cdk_model')) {
                    $context['kiyoh'] = (new cdk_model())->get();
                }
                
                $context['secure_payment'] = static::get_cached_payment_icons();
                
                if (
                    function_exists('wc') &&
                    !is_admin() &&
                    wc()->cart
                ) {
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
    
    public static function get_cached_payment_icons()
    {
        return Helper::transient('payment_icons', static function () {
            $finder = new Finder();
            
            return $finder
                ->files()
                ->in(WP::getStylesheetDir() . '/dist/images/payment_methods')
                ->name('*.svg');
        }, 3600);
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
    
    public function handleAssets(): void
    {
        WP::removeStyle('wc-block-style');
        WP::removeStyle('wp-block-library');
    
        if (is_product() || !( is_cart() || is_checkout() || is_woocommerce())) {
            WP::removeStyle('woocommerce_frontend_styles');
            WP::removeStyle('woocommerce-general');
            WP::removeStyle('woocommerce-layout');
            WP::removeStyle('woocommerce-smallscreen');
            WP::removeStyle('woocommerce_prettyPhoto_css');
            
            WP::removeStyle('wooajaxcart');
            WP::removeStyle('wcpf-plugin-style');
            WP::removeStyle('wpgdprc.css');
            
            WP::removeScript('selectWoo');
            WP::removeScript('wc-add-payment-method');
            WP::removeScript('wc_price_slider');
            WP::removeScript('wc-single-product');
            WP::removeScript('wc-credit-card-form');
            WP::removeScript('wc-chosen');
            WP::removeScript('wc-cart');
            WP::removeScript('jqueryui');
            WP::removeScript('fancybox');
            WP::removeScript('prettyPhoto');
            WP::removeScript('prettyPhoto-init');
            WP::removeScript('woocommerce');
            WP::removeScript('jquery-blockui');
            WP::removeScript('jquery-placeholder');
            WP::removeScript('jquery-payment');
            
            WP::removeScript('wcpf-plugin-polyfills-script');
            WP::removeScript('wcpf-plugin-vendor-script');
        }
        // Remove jQuery.
        WP::removeScript('jquery');
        WP::addScript('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js');
    }
}
